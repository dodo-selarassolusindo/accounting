<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$JurnalkasView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
<form name="fjurnalkasview" id="fjurnalkasview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jurnalkas: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjurnalkasview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnalkasview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jurnalkas">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jurnalkas_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tipejurnal_id->Visible) { // tipejurnal_id ?>
    <tr id="r_tipejurnal_id"<?= $Page->tipejurnal_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_tipejurnal_id"><?= $Page->tipejurnal_id->caption() ?></span></td>
        <td data-name="tipejurnal_id"<?= $Page->tipejurnal_id->cellAttributes() ?>>
<span id="el_jurnalkas_tipejurnal_id">
<span<?= $Page->tipejurnal_id->viewAttributes() ?>>
<?= $Page->tipejurnal_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->period_id->Visible) { // period_id ?>
    <tr id="r_period_id"<?= $Page->period_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_period_id"><?= $Page->period_id->caption() ?></span></td>
        <td data-name="period_id"<?= $Page->period_id->cellAttributes() ?>>
<span id="el_jurnalkas_period_id">
<span<?= $Page->period_id->viewAttributes() ?>>
<?= $Page->period_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createon->Visible) { // createon ?>
    <tr id="r_createon"<?= $Page->createon->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_createon"><?= $Page->createon->caption() ?></span></td>
        <td data-name="createon"<?= $Page->createon->cellAttributes() ?>>
<span id="el_jurnalkas_createon">
<span<?= $Page->createon->viewAttributes() ?>>
<?= $Page->createon->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_jurnalkas_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->person_id->Visible) { // person_id ?>
    <tr id="r_person_id"<?= $Page->person_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_person_id"><?= $Page->person_id->caption() ?></span></td>
        <td data-name="person_id"<?= $Page->person_id->cellAttributes() ?>>
<span id="el_jurnalkas_person_id">
<span<?= $Page->person_id->viewAttributes() ?>>
<?= $Page->person_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomer->Visible) { // nomer ?>
    <tr id="r_nomer"<?= $Page->nomer->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkas_nomer"><?= $Page->nomer->caption() ?></span></td>
        <td data-name="nomer"<?= $Page->nomer->cellAttributes() ?>>
<span id="el_jurnalkas_nomer">
<span<?= $Page->nomer->viewAttributes() ?>>
<?= $Page->nomer->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("jurnalkasd", explode(",", $Page->getCurrentDetailTable())) && $jurnalkasd->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jurnalkasd", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JurnalkasdGrid.php" ?>
<?php } ?>
</form>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
