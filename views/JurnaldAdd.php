<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$JurnaldAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jurnald: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjurnaldadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnaldadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["akun_id", [fields.akun_id.visible && fields.akun_id.required ? ew.Validators.required(fields.akun_id.caption) : null], fields.akun_id.isInvalid],
            ["debet", [fields.debet.visible && fields.debet.required ? ew.Validators.required(fields.debet.caption) : null, ew.Validators.float], fields.debet.isInvalid],
            ["kredit", [fields.kredit.visible && fields.kredit.required ? ew.Validators.required(fields.kredit.caption) : null, ew.Validators.float], fields.kredit.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "akun_id": <?= $Page->akun_id->toClientList($Page) ?>,
        })
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fjurnaldadd" id="fjurnaldadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jurnald">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jurnal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jurnal">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->jurnal_id->getSessionValue()) ?>">
<?php } ?>
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_jurnaldadd" class="<?= $Page->TableClass ?>"><!-- table* -->
<?php } ?>
<?php if ($Page->akun_id->Visible) { // akun_id ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_akun_id"<?= $Page->akun_id->rowAttributes() ?>>
        <label id="elh_jurnald_akun_id" for="x_akun_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->akun_id->caption() ?><?= $Page->akun_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->akun_id->cellAttributes() ?>>
<span id="el_jurnald_akun_id">
    <select
        id="x_akun_id"
        name="x_akun_id"
        class="form-control ew-select<?= $Page->akun_id->isInvalidClass() ?>"
        data-select2-id="fjurnaldadd_x_akun_id"
        data-table="jurnald"
        data-field="x_akun_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->akun_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->akun_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->akun_id->getPlaceHolder()) ?>"
        <?= $Page->akun_id->editAttributes() ?>>
        <?= $Page->akun_id->selectOptionListHtml("x_akun_id") ?>
    </select>
    <?= $Page->akun_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->akun_id->getErrorMessage() ?></div>
<?= $Page->akun_id->Lookup->getParamTag($Page, "p_x_akun_id") ?>
<script>
loadjs.ready("fjurnaldadd", function() {
    var options = { name: "x_akun_id", selectId: "fjurnaldadd_x_akun_id" };
    if (fjurnaldadd.lists.akun_id?.lookupOptions.length) {
        options.data = { id: "x_akun_id", form: "fjurnaldadd" };
    } else {
        options.ajax = { id: "x_akun_id", form: "fjurnaldadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jurnald.fields.akun_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_akun_id"<?= $Page->akun_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnald_akun_id"><?= $Page->akun_id->caption() ?><?= $Page->akun_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->akun_id->cellAttributes() ?>>
<span id="el_jurnald_akun_id">
    <select
        id="x_akun_id"
        name="x_akun_id"
        class="form-control ew-select<?= $Page->akun_id->isInvalidClass() ?>"
        data-select2-id="fjurnaldadd_x_akun_id"
        data-table="jurnald"
        data-field="x_akun_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->akun_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->akun_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->akun_id->getPlaceHolder()) ?>"
        <?= $Page->akun_id->editAttributes() ?>>
        <?= $Page->akun_id->selectOptionListHtml("x_akun_id") ?>
    </select>
    <?= $Page->akun_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->akun_id->getErrorMessage() ?></div>
<?= $Page->akun_id->Lookup->getParamTag($Page, "p_x_akun_id") ?>
<script>
loadjs.ready("fjurnaldadd", function() {
    var options = { name: "x_akun_id", selectId: "fjurnaldadd_x_akun_id" };
    if (fjurnaldadd.lists.akun_id?.lookupOptions.length) {
        options.data = { id: "x_akun_id", form: "fjurnaldadd" };
    } else {
        options.ajax = { id: "x_akun_id", form: "fjurnaldadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jurnald.fields.akun_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->debet->Visible) { // debet ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_debet"<?= $Page->debet->rowAttributes() ?>>
        <label id="elh_jurnald_debet" for="x_debet" class="<?= $Page->LeftColumnClass ?>"><?= $Page->debet->caption() ?><?= $Page->debet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->debet->cellAttributes() ?>>
<span id="el_jurnald_debet">
<input type="<?= $Page->debet->getInputTextType() ?>" name="x_debet" id="x_debet" data-table="jurnald" data-field="x_debet" value="<?= $Page->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->debet->formatPattern()) ?>"<?= $Page->debet->editAttributes() ?> aria-describedby="x_debet_help">
<?= $Page->debet->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->debet->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_debet"<?= $Page->debet->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnald_debet"><?= $Page->debet->caption() ?><?= $Page->debet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->debet->cellAttributes() ?>>
<span id="el_jurnald_debet">
<input type="<?= $Page->debet->getInputTextType() ?>" name="x_debet" id="x_debet" data-table="jurnald" data-field="x_debet" value="<?= $Page->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->debet->formatPattern()) ?>"<?= $Page->debet->editAttributes() ?> aria-describedby="x_debet_help">
<?= $Page->debet->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->debet->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->kredit->Visible) { // kredit ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_kredit"<?= $Page->kredit->rowAttributes() ?>>
        <label id="elh_jurnald_kredit" for="x_kredit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kredit->caption() ?><?= $Page->kredit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kredit->cellAttributes() ?>>
<span id="el_jurnald_kredit">
<input type="<?= $Page->kredit->getInputTextType() ?>" name="x_kredit" id="x_kredit" data-table="jurnald" data-field="x_kredit" value="<?= $Page->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kredit->formatPattern()) ?>"<?= $Page->kredit->editAttributes() ?> aria-describedby="x_kredit_help">
<?= $Page->kredit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kredit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_kredit"<?= $Page->kredit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnald_kredit"><?= $Page->kredit->caption() ?><?= $Page->kredit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->kredit->cellAttributes() ?>>
<span id="el_jurnald_kredit">
<input type="<?= $Page->kredit->getInputTextType() ?>" name="x_kredit" id="x_kredit" data-table="jurnald" data-field="x_kredit" value="<?= $Page->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kredit->formatPattern()) ?>"<?= $Page->kredit->editAttributes() ?> aria-describedby="x_kredit_help">
<?= $Page->kredit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kredit->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
    <?php if (strval($Page->jurnal_id->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_jurnal_id" id="x_jurnal_id" value="<?= HtmlEncode(strval($Page->jurnal_id->getSessionValue())) ?>">
    <?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjurnaldadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjurnaldadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
<?php if (!$Page->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jurnald");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
