<?php

namespace PHPMaker2024\prj_accounting;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use Closure;

/**
 * Page class
 */
class ProdukEdit extends Produk
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ProdukEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "produkedit";

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->id->setVisibility();
        $this->kode->setVisibility();
        $this->nama->setVisibility();
        $this->kelompok_id->setVisibility();
        $this->satuan_id->setVisibility();
        $this->satuan_id2->setVisibility();
        $this->gudang_id->setVisibility();
        $this->minstok->setVisibility();
        $this->minorder->setVisibility();
        $this->akunhpp->setVisibility();
        $this->akunjual->setVisibility();
        $this->akunpersediaan->setVisibility();
        $this->akunreturjual->setVisibility();
        $this->hargapokok->setVisibility();
        $this->p->setVisibility();
        $this->l->setVisibility();
        $this->_t->setVisibility();
        $this->berat->setVisibility();
        $this->supplier_id->setVisibility();
        $this->waktukirim->setVisibility();
        $this->aktif->setVisibility();
        $this->id_FK->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->TableVar = 'produk';
        $this->TableName = 'produk';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (produk)
        if (!isset($GLOBALS["produk"]) || $GLOBALS["produk"]::class == PROJECT_NAMESPACE . "produk") {
            $GLOBALS["produk"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'produk');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return $Response?->getBody() ?? ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl())) ||
                    SameString($pageName, GetPageName($this->getViewUrl())) ||
                    SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "produkview"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                        $this->clearFailureMessage();
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;

        // Load record by position
        $loadByPosition = false;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
                if (!$loadByQuery || Get(Config("TABLE_START_REC")) !== null || Get(Config("TABLE_PAGE_NUMBER")) !== null) {
                    $loadByPosition = true;
                }
            }

            // Load result set
            if ($this->isShow()) {
                if (!$this->IsModal) { // Normal edit page
                    $this->StartRecord = 1; // Initialize start position
                    $this->Recordset = $this->loadRecordset(); // Load records
                    if ($this->TotalRecords <= 0) { // No record found
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("produklist"); // Return to list page
                        return;
                    } elseif ($loadByPosition) { // Load record by position
                        $this->setupStartRecord(); // Set up start record position
                        // Point to current record
                        if ($this->StartRecord <= $this->TotalRecords) {
                            $this->fetch($this->StartRecord);
                            // Redirect to correct record
                            $this->loadRowValues($this->CurrentRow);
                            $url = $this->getCurrentUrl();
                            $this->terminate($url);
                            return;
                        }
                    } else { // Match key values
                        if ($this->id->CurrentValue != null) {
                            while ($this->fetch()) {
                                if (SameString($this->id->CurrentValue, $this->CurrentRow['id'])) {
                                    $this->setStartRecordNumber($this->StartRecord); // Save record position
                                    $loaded = true;
                                    break;
                                } else {
                                    $this->StartRecord++;
                                }
                            }
                        }
                    }

                    // Load current row values
                    if ($loaded) {
                        $this->loadRowValues($this->CurrentRow);
                    }
                } else {
                    // Load current record
                    $loaded = $this->loadRow();
                } // End modal checking
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$this->IsModal) { // Normal edit page
                    if (!$loaded) {
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("produklist"); // Return to list page
                        return;
                    } else {
                    }
                } else { // Modal edit page
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("produklist"); // No matching record, return to list
                        return;
                    }
                } // End modal checking
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "produklist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "produklist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "produklist"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = RowType::EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();
        if (!$this->IsModal) { // Normal view page
            $this->Pager = new PrevNextPager($this, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager, false, false);
            $this->Pager->PageNumberName = Config("TABLE_PAGE_NUMBER");
            $this->Pager->PagePhraseId = "Record"; // Show as record
        }

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'kode' first before field var 'x_kode'
        $val = $CurrentForm->hasValue("kode") ? $CurrentForm->getValue("kode") : $CurrentForm->getValue("x_kode");
        if (!$this->kode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode->Visible = false; // Disable update for API request
            } else {
                $this->kode->setFormValue($val);
            }
        }

        // Check field name 'nama' first before field var 'x_nama'
        $val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
        if (!$this->nama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama->Visible = false; // Disable update for API request
            } else {
                $this->nama->setFormValue($val);
            }
        }

        // Check field name 'kelompok_id' first before field var 'x_kelompok_id'
        $val = $CurrentForm->hasValue("kelompok_id") ? $CurrentForm->getValue("kelompok_id") : $CurrentForm->getValue("x_kelompok_id");
        if (!$this->kelompok_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kelompok_id->Visible = false; // Disable update for API request
            } else {
                $this->kelompok_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'satuan_id' first before field var 'x_satuan_id'
        $val = $CurrentForm->hasValue("satuan_id") ? $CurrentForm->getValue("satuan_id") : $CurrentForm->getValue("x_satuan_id");
        if (!$this->satuan_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->satuan_id->Visible = false; // Disable update for API request
            } else {
                $this->satuan_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'satuan_id2' first before field var 'x_satuan_id2'
        $val = $CurrentForm->hasValue("satuan_id2") ? $CurrentForm->getValue("satuan_id2") : $CurrentForm->getValue("x_satuan_id2");
        if (!$this->satuan_id2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->satuan_id2->Visible = false; // Disable update for API request
            } else {
                $this->satuan_id2->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'gudang_id' first before field var 'x_gudang_id'
        $val = $CurrentForm->hasValue("gudang_id") ? $CurrentForm->getValue("gudang_id") : $CurrentForm->getValue("x_gudang_id");
        if (!$this->gudang_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gudang_id->Visible = false; // Disable update for API request
            } else {
                $this->gudang_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'minstok' first before field var 'x_minstok'
        $val = $CurrentForm->hasValue("minstok") ? $CurrentForm->getValue("minstok") : $CurrentForm->getValue("x_minstok");
        if (!$this->minstok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->minstok->Visible = false; // Disable update for API request
            } else {
                $this->minstok->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'minorder' first before field var 'x_minorder'
        $val = $CurrentForm->hasValue("minorder") ? $CurrentForm->getValue("minorder") : $CurrentForm->getValue("x_minorder");
        if (!$this->minorder->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->minorder->Visible = false; // Disable update for API request
            } else {
                $this->minorder->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'akunhpp' first before field var 'x_akunhpp'
        $val = $CurrentForm->hasValue("akunhpp") ? $CurrentForm->getValue("akunhpp") : $CurrentForm->getValue("x_akunhpp");
        if (!$this->akunhpp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->akunhpp->Visible = false; // Disable update for API request
            } else {
                $this->akunhpp->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'akunjual' first before field var 'x_akunjual'
        $val = $CurrentForm->hasValue("akunjual") ? $CurrentForm->getValue("akunjual") : $CurrentForm->getValue("x_akunjual");
        if (!$this->akunjual->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->akunjual->Visible = false; // Disable update for API request
            } else {
                $this->akunjual->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'akunpersediaan' first before field var 'x_akunpersediaan'
        $val = $CurrentForm->hasValue("akunpersediaan") ? $CurrentForm->getValue("akunpersediaan") : $CurrentForm->getValue("x_akunpersediaan");
        if (!$this->akunpersediaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->akunpersediaan->Visible = false; // Disable update for API request
            } else {
                $this->akunpersediaan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'akunreturjual' first before field var 'x_akunreturjual'
        $val = $CurrentForm->hasValue("akunreturjual") ? $CurrentForm->getValue("akunreturjual") : $CurrentForm->getValue("x_akunreturjual");
        if (!$this->akunreturjual->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->akunreturjual->Visible = false; // Disable update for API request
            } else {
                $this->akunreturjual->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'hargapokok' first before field var 'x_hargapokok'
        $val = $CurrentForm->hasValue("hargapokok") ? $CurrentForm->getValue("hargapokok") : $CurrentForm->getValue("x_hargapokok");
        if (!$this->hargapokok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hargapokok->Visible = false; // Disable update for API request
            } else {
                $this->hargapokok->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'p' first before field var 'x_p'
        $val = $CurrentForm->hasValue("p") ? $CurrentForm->getValue("p") : $CurrentForm->getValue("x_p");
        if (!$this->p->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->p->Visible = false; // Disable update for API request
            } else {
                $this->p->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'l' first before field var 'x_l'
        $val = $CurrentForm->hasValue("l") ? $CurrentForm->getValue("l") : $CurrentForm->getValue("x_l");
        if (!$this->l->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->l->Visible = false; // Disable update for API request
            } else {
                $this->l->setFormValue($val, true, $validate);
            }
        }

        // Check field name '_t' first before field var 'x__t'
        $val = $CurrentForm->hasValue("_t") ? $CurrentForm->getValue("_t") : $CurrentForm->getValue("x__t");
        if (!$this->_t->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_t->Visible = false; // Disable update for API request
            } else {
                $this->_t->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'berat' first before field var 'x_berat'
        $val = $CurrentForm->hasValue("berat") ? $CurrentForm->getValue("berat") : $CurrentForm->getValue("x_berat");
        if (!$this->berat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berat->Visible = false; // Disable update for API request
            } else {
                $this->berat->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'supplier_id' first before field var 'x_supplier_id'
        $val = $CurrentForm->hasValue("supplier_id") ? $CurrentForm->getValue("supplier_id") : $CurrentForm->getValue("x_supplier_id");
        if (!$this->supplier_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supplier_id->Visible = false; // Disable update for API request
            } else {
                $this->supplier_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'waktukirim' first before field var 'x_waktukirim'
        $val = $CurrentForm->hasValue("waktukirim") ? $CurrentForm->getValue("waktukirim") : $CurrentForm->getValue("x_waktukirim");
        if (!$this->waktukirim->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->waktukirim->Visible = false; // Disable update for API request
            } else {
                $this->waktukirim->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'aktif' first before field var 'x_aktif'
        $val = $CurrentForm->hasValue("aktif") ? $CurrentForm->getValue("aktif") : $CurrentForm->getValue("x_aktif");
        if (!$this->aktif->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->aktif->Visible = false; // Disable update for API request
            } else {
                $this->aktif->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id_FK' first before field var 'x_id_FK'
        $val = $CurrentForm->hasValue("id_FK") ? $CurrentForm->getValue("id_FK") : $CurrentForm->getValue("x_id_FK");
        if (!$this->id_FK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_FK->Visible = false; // Disable update for API request
            } else {
                $this->id_FK->setFormValue($val, true, $validate);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->kode->CurrentValue = $this->kode->FormValue;
        $this->nama->CurrentValue = $this->nama->FormValue;
        $this->kelompok_id->CurrentValue = $this->kelompok_id->FormValue;
        $this->satuan_id->CurrentValue = $this->satuan_id->FormValue;
        $this->satuan_id2->CurrentValue = $this->satuan_id2->FormValue;
        $this->gudang_id->CurrentValue = $this->gudang_id->FormValue;
        $this->minstok->CurrentValue = $this->minstok->FormValue;
        $this->minorder->CurrentValue = $this->minorder->FormValue;
        $this->akunhpp->CurrentValue = $this->akunhpp->FormValue;
        $this->akunjual->CurrentValue = $this->akunjual->FormValue;
        $this->akunpersediaan->CurrentValue = $this->akunpersediaan->FormValue;
        $this->akunreturjual->CurrentValue = $this->akunreturjual->FormValue;
        $this->hargapokok->CurrentValue = $this->hargapokok->FormValue;
        $this->p->CurrentValue = $this->p->FormValue;
        $this->l->CurrentValue = $this->l->FormValue;
        $this->_t->CurrentValue = $this->_t->FormValue;
        $this->berat->CurrentValue = $this->berat->FormValue;
        $this->supplier_id->CurrentValue = $this->supplier_id->FormValue;
        $this->waktukirim->CurrentValue = $this->waktukirim->FormValue;
        $this->aktif->CurrentValue = $this->aktif->FormValue;
        $this->id_FK->CurrentValue = $this->id_FK->FormValue;
    }

    /**
     * Load result set
     *
     * @param int $offset Offset
     * @param int $rowcnt Maximum number of rows
     * @return Doctrine\DBAL\Result Result
     */
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load result set
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->executeQuery();
        if (property_exists($this, "TotalRecords") && $rowcnt < 0) {
            $this->TotalRecords = $result->rowCount();
            if ($this->TotalRecords <= 0) { // Handle database drivers that does not return rowCount()
                $this->TotalRecords = $this->getRecordCount($this->getListSql());
            }
        }

        // Call Recordset Selected event
        $this->recordsetSelected($result);
        return $result;
    }

    /**
     * Load records as associative array
     *
     * @param int $offset Offset
     * @param int $rowcnt Maximum number of rows
     * @return void
     */
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load result set
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->executeQuery();
        return $result->fetchAllAssociative();
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->kode->setDbValue($row['kode']);
        $this->nama->setDbValue($row['nama']);
        $this->kelompok_id->setDbValue($row['kelompok_id']);
        $this->satuan_id->setDbValue($row['satuan_id']);
        $this->satuan_id2->setDbValue($row['satuan_id2']);
        $this->gudang_id->setDbValue($row['gudang_id']);
        $this->minstok->setDbValue($row['minstok']);
        $this->minorder->setDbValue($row['minorder']);
        $this->akunhpp->setDbValue($row['akunhpp']);
        $this->akunjual->setDbValue($row['akunjual']);
        $this->akunpersediaan->setDbValue($row['akunpersediaan']);
        $this->akunreturjual->setDbValue($row['akunreturjual']);
        $this->hargapokok->setDbValue($row['hargapokok']);
        $this->p->setDbValue($row['p']);
        $this->l->setDbValue($row['l']);
        $this->_t->setDbValue($row['t']);
        $this->berat->setDbValue($row['berat']);
        $this->supplier_id->setDbValue($row['supplier_id']);
        $this->waktukirim->setDbValue($row['waktukirim']);
        $this->aktif->setDbValue($row['aktif']);
        $this->id_FK->setDbValue($row['id_FK']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['kode'] = $this->kode->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['kelompok_id'] = $this->kelompok_id->DefaultValue;
        $row['satuan_id'] = $this->satuan_id->DefaultValue;
        $row['satuan_id2'] = $this->satuan_id2->DefaultValue;
        $row['gudang_id'] = $this->gudang_id->DefaultValue;
        $row['minstok'] = $this->minstok->DefaultValue;
        $row['minorder'] = $this->minorder->DefaultValue;
        $row['akunhpp'] = $this->akunhpp->DefaultValue;
        $row['akunjual'] = $this->akunjual->DefaultValue;
        $row['akunpersediaan'] = $this->akunpersediaan->DefaultValue;
        $row['akunreturjual'] = $this->akunreturjual->DefaultValue;
        $row['hargapokok'] = $this->hargapokok->DefaultValue;
        $row['p'] = $this->p->DefaultValue;
        $row['l'] = $this->l->DefaultValue;
        $row['t'] = $this->_t->DefaultValue;
        $row['berat'] = $this->berat->DefaultValue;
        $row['supplier_id'] = $this->supplier_id->DefaultValue;
        $row['waktukirim'] = $this->waktukirim->DefaultValue;
        $row['aktif'] = $this->aktif->DefaultValue;
        $row['id_FK'] = $this->id_FK->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = ExecuteQuery($sql, $conn);
            if ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // kode
        $this->kode->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // nama
        $this->nama->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // kelompok_id
        $this->kelompok_id->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // satuan_id
        $this->satuan_id->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // satuan_id2
        $this->satuan_id2->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // gudang_id
        $this->gudang_id->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // minstok
        $this->minstok->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // minorder
        $this->minorder->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // akunhpp
        $this->akunhpp->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // akunjual
        $this->akunjual->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // akunpersediaan
        $this->akunpersediaan->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // akunreturjual
        $this->akunreturjual->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // hargapokok
        $this->hargapokok->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // p
        $this->p->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // l
        $this->l->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // t
        $this->_t->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // berat
        $this->berat->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // supplier_id
        $this->supplier_id->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // waktukirim
        $this->waktukirim->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // aktif
        $this->aktif->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // id_FK
        $this->id_FK->RowCssClass = $this->IsMobileOrModal ? "row" : "";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // kode
            $this->kode->ViewValue = $this->kode->CurrentValue;

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;

            // kelompok_id
            $this->kelompok_id->ViewValue = $this->kelompok_id->CurrentValue;
            $this->kelompok_id->ViewValue = FormatNumber($this->kelompok_id->ViewValue, $this->kelompok_id->formatPattern());

            // satuan_id
            $this->satuan_id->ViewValue = $this->satuan_id->CurrentValue;
            $this->satuan_id->ViewValue = FormatNumber($this->satuan_id->ViewValue, $this->satuan_id->formatPattern());

            // satuan_id2
            $this->satuan_id2->ViewValue = $this->satuan_id2->CurrentValue;
            $this->satuan_id2->ViewValue = FormatNumber($this->satuan_id2->ViewValue, $this->satuan_id2->formatPattern());

            // gudang_id
            $this->gudang_id->ViewValue = $this->gudang_id->CurrentValue;
            $this->gudang_id->ViewValue = FormatNumber($this->gudang_id->ViewValue, $this->gudang_id->formatPattern());

            // minstok
            $this->minstok->ViewValue = $this->minstok->CurrentValue;
            $this->minstok->ViewValue = FormatNumber($this->minstok->ViewValue, $this->minstok->formatPattern());

            // minorder
            $this->minorder->ViewValue = $this->minorder->CurrentValue;
            $this->minorder->ViewValue = FormatNumber($this->minorder->ViewValue, $this->minorder->formatPattern());

            // akunhpp
            $this->akunhpp->ViewValue = $this->akunhpp->CurrentValue;
            $this->akunhpp->ViewValue = FormatNumber($this->akunhpp->ViewValue, $this->akunhpp->formatPattern());

            // akunjual
            $this->akunjual->ViewValue = $this->akunjual->CurrentValue;
            $this->akunjual->ViewValue = FormatNumber($this->akunjual->ViewValue, $this->akunjual->formatPattern());

            // akunpersediaan
            $this->akunpersediaan->ViewValue = $this->akunpersediaan->CurrentValue;
            $this->akunpersediaan->ViewValue = FormatNumber($this->akunpersediaan->ViewValue, $this->akunpersediaan->formatPattern());

            // akunreturjual
            $this->akunreturjual->ViewValue = $this->akunreturjual->CurrentValue;
            $this->akunreturjual->ViewValue = FormatNumber($this->akunreturjual->ViewValue, $this->akunreturjual->formatPattern());

            // hargapokok
            $this->hargapokok->ViewValue = $this->hargapokok->CurrentValue;
            $this->hargapokok->ViewValue = FormatNumber($this->hargapokok->ViewValue, $this->hargapokok->formatPattern());

            // p
            $this->p->ViewValue = $this->p->CurrentValue;
            $this->p->ViewValue = FormatNumber($this->p->ViewValue, $this->p->formatPattern());

            // l
            $this->l->ViewValue = $this->l->CurrentValue;
            $this->l->ViewValue = FormatNumber($this->l->ViewValue, $this->l->formatPattern());

            // t
            $this->_t->ViewValue = $this->_t->CurrentValue;
            $this->_t->ViewValue = FormatNumber($this->_t->ViewValue, $this->_t->formatPattern());

            // berat
            $this->berat->ViewValue = $this->berat->CurrentValue;
            $this->berat->ViewValue = FormatNumber($this->berat->ViewValue, $this->berat->formatPattern());

            // supplier_id
            $this->supplier_id->ViewValue = $this->supplier_id->CurrentValue;
            $this->supplier_id->ViewValue = FormatNumber($this->supplier_id->ViewValue, $this->supplier_id->formatPattern());

            // waktukirim
            $this->waktukirim->ViewValue = $this->waktukirim->CurrentValue;
            $this->waktukirim->ViewValue = FormatNumber($this->waktukirim->ViewValue, $this->waktukirim->formatPattern());

            // aktif
            $this->aktif->ViewValue = $this->aktif->CurrentValue;
            $this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, $this->aktif->formatPattern());

            // id_FK
            $this->id_FK->ViewValue = $this->id_FK->CurrentValue;
            $this->id_FK->ViewValue = FormatNumber($this->id_FK->ViewValue, $this->id_FK->formatPattern());

            // id
            $this->id->HrefValue = "";

            // kode
            $this->kode->HrefValue = "";

            // nama
            $this->nama->HrefValue = "";

            // kelompok_id
            $this->kelompok_id->HrefValue = "";

            // satuan_id
            $this->satuan_id->HrefValue = "";

            // satuan_id2
            $this->satuan_id2->HrefValue = "";

            // gudang_id
            $this->gudang_id->HrefValue = "";

            // minstok
            $this->minstok->HrefValue = "";

            // minorder
            $this->minorder->HrefValue = "";

            // akunhpp
            $this->akunhpp->HrefValue = "";

            // akunjual
            $this->akunjual->HrefValue = "";

            // akunpersediaan
            $this->akunpersediaan->HrefValue = "";

            // akunreturjual
            $this->akunreturjual->HrefValue = "";

            // hargapokok
            $this->hargapokok->HrefValue = "";

            // p
            $this->p->HrefValue = "";

            // l
            $this->l->HrefValue = "";

            // t
            $this->_t->HrefValue = "";

            // berat
            $this->berat->HrefValue = "";

            // supplier_id
            $this->supplier_id->HrefValue = "";

            // waktukirim
            $this->waktukirim->HrefValue = "";

            // aktif
            $this->aktif->HrefValue = "";

            // id_FK
            $this->id_FK->HrefValue = "";
        } elseif ($this->RowType == RowType::EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditValue = $this->id->CurrentValue;

            // kode
            $this->kode->setupEditAttributes();
            if (!$this->kode->Raw) {
                $this->kode->CurrentValue = HtmlDecode($this->kode->CurrentValue);
            }
            $this->kode->EditValue = HtmlEncode($this->kode->CurrentValue);
            $this->kode->PlaceHolder = RemoveHtml($this->kode->caption());

            // nama
            $this->nama->setupEditAttributes();
            if (!$this->nama->Raw) {
                $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // kelompok_id
            $this->kelompok_id->setupEditAttributes();
            $this->kelompok_id->EditValue = $this->kelompok_id->CurrentValue;
            $this->kelompok_id->PlaceHolder = RemoveHtml($this->kelompok_id->caption());
            if (strval($this->kelompok_id->EditValue) != "" && is_numeric($this->kelompok_id->EditValue)) {
                $this->kelompok_id->EditValue = FormatNumber($this->kelompok_id->EditValue, null);
            }

            // satuan_id
            $this->satuan_id->setupEditAttributes();
            $this->satuan_id->EditValue = $this->satuan_id->CurrentValue;
            $this->satuan_id->PlaceHolder = RemoveHtml($this->satuan_id->caption());
            if (strval($this->satuan_id->EditValue) != "" && is_numeric($this->satuan_id->EditValue)) {
                $this->satuan_id->EditValue = FormatNumber($this->satuan_id->EditValue, null);
            }

            // satuan_id2
            $this->satuan_id2->setupEditAttributes();
            $this->satuan_id2->EditValue = $this->satuan_id2->CurrentValue;
            $this->satuan_id2->PlaceHolder = RemoveHtml($this->satuan_id2->caption());
            if (strval($this->satuan_id2->EditValue) != "" && is_numeric($this->satuan_id2->EditValue)) {
                $this->satuan_id2->EditValue = FormatNumber($this->satuan_id2->EditValue, null);
            }

            // gudang_id
            $this->gudang_id->setupEditAttributes();
            $this->gudang_id->EditValue = $this->gudang_id->CurrentValue;
            $this->gudang_id->PlaceHolder = RemoveHtml($this->gudang_id->caption());
            if (strval($this->gudang_id->EditValue) != "" && is_numeric($this->gudang_id->EditValue)) {
                $this->gudang_id->EditValue = FormatNumber($this->gudang_id->EditValue, null);
            }

            // minstok
            $this->minstok->setupEditAttributes();
            $this->minstok->EditValue = $this->minstok->CurrentValue;
            $this->minstok->PlaceHolder = RemoveHtml($this->minstok->caption());
            if (strval($this->minstok->EditValue) != "" && is_numeric($this->minstok->EditValue)) {
                $this->minstok->EditValue = FormatNumber($this->minstok->EditValue, null);
            }

            // minorder
            $this->minorder->setupEditAttributes();
            $this->minorder->EditValue = $this->minorder->CurrentValue;
            $this->minorder->PlaceHolder = RemoveHtml($this->minorder->caption());
            if (strval($this->minorder->EditValue) != "" && is_numeric($this->minorder->EditValue)) {
                $this->minorder->EditValue = FormatNumber($this->minorder->EditValue, null);
            }

            // akunhpp
            $this->akunhpp->setupEditAttributes();
            $this->akunhpp->EditValue = $this->akunhpp->CurrentValue;
            $this->akunhpp->PlaceHolder = RemoveHtml($this->akunhpp->caption());
            if (strval($this->akunhpp->EditValue) != "" && is_numeric($this->akunhpp->EditValue)) {
                $this->akunhpp->EditValue = FormatNumber($this->akunhpp->EditValue, null);
            }

            // akunjual
            $this->akunjual->setupEditAttributes();
            $this->akunjual->EditValue = $this->akunjual->CurrentValue;
            $this->akunjual->PlaceHolder = RemoveHtml($this->akunjual->caption());
            if (strval($this->akunjual->EditValue) != "" && is_numeric($this->akunjual->EditValue)) {
                $this->akunjual->EditValue = FormatNumber($this->akunjual->EditValue, null);
            }

            // akunpersediaan
            $this->akunpersediaan->setupEditAttributes();
            $this->akunpersediaan->EditValue = $this->akunpersediaan->CurrentValue;
            $this->akunpersediaan->PlaceHolder = RemoveHtml($this->akunpersediaan->caption());
            if (strval($this->akunpersediaan->EditValue) != "" && is_numeric($this->akunpersediaan->EditValue)) {
                $this->akunpersediaan->EditValue = FormatNumber($this->akunpersediaan->EditValue, null);
            }

            // akunreturjual
            $this->akunreturjual->setupEditAttributes();
            $this->akunreturjual->EditValue = $this->akunreturjual->CurrentValue;
            $this->akunreturjual->PlaceHolder = RemoveHtml($this->akunreturjual->caption());
            if (strval($this->akunreturjual->EditValue) != "" && is_numeric($this->akunreturjual->EditValue)) {
                $this->akunreturjual->EditValue = FormatNumber($this->akunreturjual->EditValue, null);
            }

            // hargapokok
            $this->hargapokok->setupEditAttributes();
            $this->hargapokok->EditValue = $this->hargapokok->CurrentValue;
            $this->hargapokok->PlaceHolder = RemoveHtml($this->hargapokok->caption());
            if (strval($this->hargapokok->EditValue) != "" && is_numeric($this->hargapokok->EditValue)) {
                $this->hargapokok->EditValue = FormatNumber($this->hargapokok->EditValue, null);
            }

            // p
            $this->p->setupEditAttributes();
            $this->p->EditValue = $this->p->CurrentValue;
            $this->p->PlaceHolder = RemoveHtml($this->p->caption());
            if (strval($this->p->EditValue) != "" && is_numeric($this->p->EditValue)) {
                $this->p->EditValue = FormatNumber($this->p->EditValue, null);
            }

            // l
            $this->l->setupEditAttributes();
            $this->l->EditValue = $this->l->CurrentValue;
            $this->l->PlaceHolder = RemoveHtml($this->l->caption());
            if (strval($this->l->EditValue) != "" && is_numeric($this->l->EditValue)) {
                $this->l->EditValue = FormatNumber($this->l->EditValue, null);
            }

            // t
            $this->_t->setupEditAttributes();
            $this->_t->EditValue = $this->_t->CurrentValue;
            $this->_t->PlaceHolder = RemoveHtml($this->_t->caption());
            if (strval($this->_t->EditValue) != "" && is_numeric($this->_t->EditValue)) {
                $this->_t->EditValue = FormatNumber($this->_t->EditValue, null);
            }

            // berat
            $this->berat->setupEditAttributes();
            $this->berat->EditValue = $this->berat->CurrentValue;
            $this->berat->PlaceHolder = RemoveHtml($this->berat->caption());
            if (strval($this->berat->EditValue) != "" && is_numeric($this->berat->EditValue)) {
                $this->berat->EditValue = FormatNumber($this->berat->EditValue, null);
            }

            // supplier_id
            $this->supplier_id->setupEditAttributes();
            $this->supplier_id->EditValue = $this->supplier_id->CurrentValue;
            $this->supplier_id->PlaceHolder = RemoveHtml($this->supplier_id->caption());
            if (strval($this->supplier_id->EditValue) != "" && is_numeric($this->supplier_id->EditValue)) {
                $this->supplier_id->EditValue = FormatNumber($this->supplier_id->EditValue, null);
            }

            // waktukirim
            $this->waktukirim->setupEditAttributes();
            $this->waktukirim->EditValue = $this->waktukirim->CurrentValue;
            $this->waktukirim->PlaceHolder = RemoveHtml($this->waktukirim->caption());
            if (strval($this->waktukirim->EditValue) != "" && is_numeric($this->waktukirim->EditValue)) {
                $this->waktukirim->EditValue = FormatNumber($this->waktukirim->EditValue, null);
            }

            // aktif
            $this->aktif->setupEditAttributes();
            $this->aktif->EditValue = $this->aktif->CurrentValue;
            $this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());
            if (strval($this->aktif->EditValue) != "" && is_numeric($this->aktif->EditValue)) {
                $this->aktif->EditValue = FormatNumber($this->aktif->EditValue, null);
            }

            // id_FK
            $this->id_FK->setupEditAttributes();
            $this->id_FK->EditValue = $this->id_FK->CurrentValue;
            $this->id_FK->PlaceHolder = RemoveHtml($this->id_FK->caption());
            if (strval($this->id_FK->EditValue) != "" && is_numeric($this->id_FK->EditValue)) {
                $this->id_FK->EditValue = FormatNumber($this->id_FK->EditValue, null);
            }

            // Edit refer script

            // id
            $this->id->HrefValue = "";

            // kode
            $this->kode->HrefValue = "";

            // nama
            $this->nama->HrefValue = "";

            // kelompok_id
            $this->kelompok_id->HrefValue = "";

            // satuan_id
            $this->satuan_id->HrefValue = "";

            // satuan_id2
            $this->satuan_id2->HrefValue = "";

            // gudang_id
            $this->gudang_id->HrefValue = "";

            // minstok
            $this->minstok->HrefValue = "";

            // minorder
            $this->minorder->HrefValue = "";

            // akunhpp
            $this->akunhpp->HrefValue = "";

            // akunjual
            $this->akunjual->HrefValue = "";

            // akunpersediaan
            $this->akunpersediaan->HrefValue = "";

            // akunreturjual
            $this->akunreturjual->HrefValue = "";

            // hargapokok
            $this->hargapokok->HrefValue = "";

            // p
            $this->p->HrefValue = "";

            // l
            $this->l->HrefValue = "";

            // t
            $this->_t->HrefValue = "";

            // berat
            $this->berat->HrefValue = "";

            // supplier_id
            $this->supplier_id->HrefValue = "";

            // waktukirim
            $this->waktukirim->HrefValue = "";

            // aktif
            $this->aktif->HrefValue = "";

            // id_FK
            $this->id_FK->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->id->Visible && $this->id->Required) {
                if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                    $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
                }
            }
            if ($this->kode->Visible && $this->kode->Required) {
                if (!$this->kode->IsDetailKey && EmptyValue($this->kode->FormValue)) {
                    $this->kode->addErrorMessage(str_replace("%s", $this->kode->caption(), $this->kode->RequiredErrorMessage));
                }
            }
            if ($this->nama->Visible && $this->nama->Required) {
                if (!$this->nama->IsDetailKey && EmptyValue($this->nama->FormValue)) {
                    $this->nama->addErrorMessage(str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
                }
            }
            if ($this->kelompok_id->Visible && $this->kelompok_id->Required) {
                if (!$this->kelompok_id->IsDetailKey && EmptyValue($this->kelompok_id->FormValue)) {
                    $this->kelompok_id->addErrorMessage(str_replace("%s", $this->kelompok_id->caption(), $this->kelompok_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->kelompok_id->FormValue)) {
                $this->kelompok_id->addErrorMessage($this->kelompok_id->getErrorMessage(false));
            }
            if ($this->satuan_id->Visible && $this->satuan_id->Required) {
                if (!$this->satuan_id->IsDetailKey && EmptyValue($this->satuan_id->FormValue)) {
                    $this->satuan_id->addErrorMessage(str_replace("%s", $this->satuan_id->caption(), $this->satuan_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->satuan_id->FormValue)) {
                $this->satuan_id->addErrorMessage($this->satuan_id->getErrorMessage(false));
            }
            if ($this->satuan_id2->Visible && $this->satuan_id2->Required) {
                if (!$this->satuan_id2->IsDetailKey && EmptyValue($this->satuan_id2->FormValue)) {
                    $this->satuan_id2->addErrorMessage(str_replace("%s", $this->satuan_id2->caption(), $this->satuan_id2->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->satuan_id2->FormValue)) {
                $this->satuan_id2->addErrorMessage($this->satuan_id2->getErrorMessage(false));
            }
            if ($this->gudang_id->Visible && $this->gudang_id->Required) {
                if (!$this->gudang_id->IsDetailKey && EmptyValue($this->gudang_id->FormValue)) {
                    $this->gudang_id->addErrorMessage(str_replace("%s", $this->gudang_id->caption(), $this->gudang_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->gudang_id->FormValue)) {
                $this->gudang_id->addErrorMessage($this->gudang_id->getErrorMessage(false));
            }
            if ($this->minstok->Visible && $this->minstok->Required) {
                if (!$this->minstok->IsDetailKey && EmptyValue($this->minstok->FormValue)) {
                    $this->minstok->addErrorMessage(str_replace("%s", $this->minstok->caption(), $this->minstok->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->minstok->FormValue)) {
                $this->minstok->addErrorMessage($this->minstok->getErrorMessage(false));
            }
            if ($this->minorder->Visible && $this->minorder->Required) {
                if (!$this->minorder->IsDetailKey && EmptyValue($this->minorder->FormValue)) {
                    $this->minorder->addErrorMessage(str_replace("%s", $this->minorder->caption(), $this->minorder->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->minorder->FormValue)) {
                $this->minorder->addErrorMessage($this->minorder->getErrorMessage(false));
            }
            if ($this->akunhpp->Visible && $this->akunhpp->Required) {
                if (!$this->akunhpp->IsDetailKey && EmptyValue($this->akunhpp->FormValue)) {
                    $this->akunhpp->addErrorMessage(str_replace("%s", $this->akunhpp->caption(), $this->akunhpp->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->akunhpp->FormValue)) {
                $this->akunhpp->addErrorMessage($this->akunhpp->getErrorMessage(false));
            }
            if ($this->akunjual->Visible && $this->akunjual->Required) {
                if (!$this->akunjual->IsDetailKey && EmptyValue($this->akunjual->FormValue)) {
                    $this->akunjual->addErrorMessage(str_replace("%s", $this->akunjual->caption(), $this->akunjual->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->akunjual->FormValue)) {
                $this->akunjual->addErrorMessage($this->akunjual->getErrorMessage(false));
            }
            if ($this->akunpersediaan->Visible && $this->akunpersediaan->Required) {
                if (!$this->akunpersediaan->IsDetailKey && EmptyValue($this->akunpersediaan->FormValue)) {
                    $this->akunpersediaan->addErrorMessage(str_replace("%s", $this->akunpersediaan->caption(), $this->akunpersediaan->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->akunpersediaan->FormValue)) {
                $this->akunpersediaan->addErrorMessage($this->akunpersediaan->getErrorMessage(false));
            }
            if ($this->akunreturjual->Visible && $this->akunreturjual->Required) {
                if (!$this->akunreturjual->IsDetailKey && EmptyValue($this->akunreturjual->FormValue)) {
                    $this->akunreturjual->addErrorMessage(str_replace("%s", $this->akunreturjual->caption(), $this->akunreturjual->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->akunreturjual->FormValue)) {
                $this->akunreturjual->addErrorMessage($this->akunreturjual->getErrorMessage(false));
            }
            if ($this->hargapokok->Visible && $this->hargapokok->Required) {
                if (!$this->hargapokok->IsDetailKey && EmptyValue($this->hargapokok->FormValue)) {
                    $this->hargapokok->addErrorMessage(str_replace("%s", $this->hargapokok->caption(), $this->hargapokok->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->hargapokok->FormValue)) {
                $this->hargapokok->addErrorMessage($this->hargapokok->getErrorMessage(false));
            }
            if ($this->p->Visible && $this->p->Required) {
                if (!$this->p->IsDetailKey && EmptyValue($this->p->FormValue)) {
                    $this->p->addErrorMessage(str_replace("%s", $this->p->caption(), $this->p->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->p->FormValue)) {
                $this->p->addErrorMessage($this->p->getErrorMessage(false));
            }
            if ($this->l->Visible && $this->l->Required) {
                if (!$this->l->IsDetailKey && EmptyValue($this->l->FormValue)) {
                    $this->l->addErrorMessage(str_replace("%s", $this->l->caption(), $this->l->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->l->FormValue)) {
                $this->l->addErrorMessage($this->l->getErrorMessage(false));
            }
            if ($this->_t->Visible && $this->_t->Required) {
                if (!$this->_t->IsDetailKey && EmptyValue($this->_t->FormValue)) {
                    $this->_t->addErrorMessage(str_replace("%s", $this->_t->caption(), $this->_t->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->_t->FormValue)) {
                $this->_t->addErrorMessage($this->_t->getErrorMessage(false));
            }
            if ($this->berat->Visible && $this->berat->Required) {
                if (!$this->berat->IsDetailKey && EmptyValue($this->berat->FormValue)) {
                    $this->berat->addErrorMessage(str_replace("%s", $this->berat->caption(), $this->berat->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->berat->FormValue)) {
                $this->berat->addErrorMessage($this->berat->getErrorMessage(false));
            }
            if ($this->supplier_id->Visible && $this->supplier_id->Required) {
                if (!$this->supplier_id->IsDetailKey && EmptyValue($this->supplier_id->FormValue)) {
                    $this->supplier_id->addErrorMessage(str_replace("%s", $this->supplier_id->caption(), $this->supplier_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->supplier_id->FormValue)) {
                $this->supplier_id->addErrorMessage($this->supplier_id->getErrorMessage(false));
            }
            if ($this->waktukirim->Visible && $this->waktukirim->Required) {
                if (!$this->waktukirim->IsDetailKey && EmptyValue($this->waktukirim->FormValue)) {
                    $this->waktukirim->addErrorMessage(str_replace("%s", $this->waktukirim->caption(), $this->waktukirim->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->waktukirim->FormValue)) {
                $this->waktukirim->addErrorMessage($this->waktukirim->getErrorMessage(false));
            }
            if ($this->aktif->Visible && $this->aktif->Required) {
                if (!$this->aktif->IsDetailKey && EmptyValue($this->aktif->FormValue)) {
                    $this->aktif->addErrorMessage(str_replace("%s", $this->aktif->caption(), $this->aktif->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->aktif->FormValue)) {
                $this->aktif->addErrorMessage($this->aktif->getErrorMessage(false));
            }
            if ($this->id_FK->Visible && $this->id_FK->Required) {
                if (!$this->id_FK->IsDetailKey && EmptyValue($this->id_FK->FormValue)) {
                    $this->id_FK->addErrorMessage(str_replace("%s", $this->id_FK->caption(), $this->id_FK->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->id_FK->FormValue)) {
                $this->id_FK->addErrorMessage($this->id_FK->getErrorMessage(false));
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Load old values
            $this->loadDbValues($rsold);
        }

        // Get new row
        $rsnew = $this->getEditRow($rsold);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    /**
     * Get edit row
     *
     * @return array
     */
    protected function getEditRow($rsold)
    {
        global $Security;
        $rsnew = [];

        // kode
        $this->kode->setDbValueDef($rsnew, $this->kode->CurrentValue, $this->kode->ReadOnly);

        // nama
        $this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, $this->nama->ReadOnly);

        // kelompok_id
        $this->kelompok_id->setDbValueDef($rsnew, $this->kelompok_id->CurrentValue, $this->kelompok_id->ReadOnly);

        // satuan_id
        $this->satuan_id->setDbValueDef($rsnew, $this->satuan_id->CurrentValue, $this->satuan_id->ReadOnly);

        // satuan_id2
        $this->satuan_id2->setDbValueDef($rsnew, $this->satuan_id2->CurrentValue, $this->satuan_id2->ReadOnly);

        // gudang_id
        $this->gudang_id->setDbValueDef($rsnew, $this->gudang_id->CurrentValue, $this->gudang_id->ReadOnly);

        // minstok
        $this->minstok->setDbValueDef($rsnew, $this->minstok->CurrentValue, $this->minstok->ReadOnly);

        // minorder
        $this->minorder->setDbValueDef($rsnew, $this->minorder->CurrentValue, $this->minorder->ReadOnly);

        // akunhpp
        $this->akunhpp->setDbValueDef($rsnew, $this->akunhpp->CurrentValue, $this->akunhpp->ReadOnly);

        // akunjual
        $this->akunjual->setDbValueDef($rsnew, $this->akunjual->CurrentValue, $this->akunjual->ReadOnly);

        // akunpersediaan
        $this->akunpersediaan->setDbValueDef($rsnew, $this->akunpersediaan->CurrentValue, $this->akunpersediaan->ReadOnly);

        // akunreturjual
        $this->akunreturjual->setDbValueDef($rsnew, $this->akunreturjual->CurrentValue, $this->akunreturjual->ReadOnly);

        // hargapokok
        $this->hargapokok->setDbValueDef($rsnew, $this->hargapokok->CurrentValue, $this->hargapokok->ReadOnly);

        // p
        $this->p->setDbValueDef($rsnew, $this->p->CurrentValue, $this->p->ReadOnly);

        // l
        $this->l->setDbValueDef($rsnew, $this->l->CurrentValue, $this->l->ReadOnly);

        // t
        $this->_t->setDbValueDef($rsnew, $this->_t->CurrentValue, $this->_t->ReadOnly);

        // berat
        $this->berat->setDbValueDef($rsnew, $this->berat->CurrentValue, $this->berat->ReadOnly);

        // supplier_id
        $this->supplier_id->setDbValueDef($rsnew, $this->supplier_id->CurrentValue, $this->supplier_id->ReadOnly);

        // waktukirim
        $this->waktukirim->setDbValueDef($rsnew, $this->waktukirim->CurrentValue, $this->waktukirim->ReadOnly);

        // aktif
        $this->aktif->setDbValueDef($rsnew, $this->aktif->CurrentValue, $this->aktif->ReadOnly);

        // id_FK
        $this->id_FK->setDbValueDef($rsnew, $this->id_FK->CurrentValue, $this->id_FK->ReadOnly);
        return $rsnew;
    }

    /**
     * Restore edit form from row
     * @param array $row Row
     */
    protected function restoreEditFormFromRow($row)
    {
        if (isset($row['kode'])) { // kode
            $this->kode->CurrentValue = $row['kode'];
        }
        if (isset($row['nama'])) { // nama
            $this->nama->CurrentValue = $row['nama'];
        }
        if (isset($row['kelompok_id'])) { // kelompok_id
            $this->kelompok_id->CurrentValue = $row['kelompok_id'];
        }
        if (isset($row['satuan_id'])) { // satuan_id
            $this->satuan_id->CurrentValue = $row['satuan_id'];
        }
        if (isset($row['satuan_id2'])) { // satuan_id2
            $this->satuan_id2->CurrentValue = $row['satuan_id2'];
        }
        if (isset($row['gudang_id'])) { // gudang_id
            $this->gudang_id->CurrentValue = $row['gudang_id'];
        }
        if (isset($row['minstok'])) { // minstok
            $this->minstok->CurrentValue = $row['minstok'];
        }
        if (isset($row['minorder'])) { // minorder
            $this->minorder->CurrentValue = $row['minorder'];
        }
        if (isset($row['akunhpp'])) { // akunhpp
            $this->akunhpp->CurrentValue = $row['akunhpp'];
        }
        if (isset($row['akunjual'])) { // akunjual
            $this->akunjual->CurrentValue = $row['akunjual'];
        }
        if (isset($row['akunpersediaan'])) { // akunpersediaan
            $this->akunpersediaan->CurrentValue = $row['akunpersediaan'];
        }
        if (isset($row['akunreturjual'])) { // akunreturjual
            $this->akunreturjual->CurrentValue = $row['akunreturjual'];
        }
        if (isset($row['hargapokok'])) { // hargapokok
            $this->hargapokok->CurrentValue = $row['hargapokok'];
        }
        if (isset($row['p'])) { // p
            $this->p->CurrentValue = $row['p'];
        }
        if (isset($row['l'])) { // l
            $this->l->CurrentValue = $row['l'];
        }
        if (isset($row['t'])) { // t
            $this->_t->CurrentValue = $row['t'];
        }
        if (isset($row['berat'])) { // berat
            $this->berat->CurrentValue = $row['berat'];
        }
        if (isset($row['supplier_id'])) { // supplier_id
            $this->supplier_id->CurrentValue = $row['supplier_id'];
        }
        if (isset($row['waktukirim'])) { // waktukirim
            $this->waktukirim->CurrentValue = $row['waktukirim'];
        }
        if (isset($row['aktif'])) { // aktif
            $this->aktif->CurrentValue = $row['aktif'];
        }
        if (isset($row['id_FK'])) { // id_FK
            $this->id_FK->CurrentValue = $row['id_FK'];
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("produklist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
