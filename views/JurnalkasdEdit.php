<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$JurnalkasdEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<form name="fjurnalkasdedit" id="fjurnalkasdedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jurnalkasd: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjurnalkasdedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnalkasdedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["jurnal_id", [fields.jurnal_id.visible && fields.jurnal_id.required ? ew.Validators.required(fields.jurnal_id.caption) : null, ew.Validators.integer], fields.jurnal_id.isInvalid],
            ["akun_id", [fields.akun_id.visible && fields.akun_id.required ? ew.Validators.required(fields.akun_id.caption) : null, ew.Validators.integer], fields.akun_id.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jurnalkasd">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jurnalkas") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jurnalkas">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->jurnal_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_jurnalkasd_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_jurnalkasd_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jurnalkasd" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jurnal_id->Visible) { // jurnal_id ?>
    <div id="r_jurnal_id"<?= $Page->jurnal_id->rowAttributes() ?>>
        <label id="elh_jurnalkasd_jurnal_id" for="x_jurnal_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jurnal_id->caption() ?><?= $Page->jurnal_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jurnal_id->cellAttributes() ?>>
<?php if ($Page->jurnal_id->getSessionValue() != "") { ?>
<span<?= $Page->jurnal_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->jurnal_id->getDisplayValue($Page->jurnal_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_jurnal_id" name="x_jurnal_id" value="<?= HtmlEncode($Page->jurnal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jurnalkasd_jurnal_id">
<input type="<?= $Page->jurnal_id->getInputTextType() ?>" name="x_jurnal_id" id="x_jurnal_id" data-table="jurnalkasd" data-field="x_jurnal_id" value="<?= $Page->jurnal_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jurnal_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->jurnal_id->formatPattern()) ?>"<?= $Page->jurnal_id->editAttributes() ?> aria-describedby="x_jurnal_id_help">
<?= $Page->jurnal_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jurnal_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->akun_id->Visible) { // akun_id ?>
    <div id="r_akun_id"<?= $Page->akun_id->rowAttributes() ?>>
        <label id="elh_jurnalkasd_akun_id" for="x_akun_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->akun_id->caption() ?><?= $Page->akun_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->akun_id->cellAttributes() ?>>
<span id="el_jurnalkasd_akun_id">
<input type="<?= $Page->akun_id->getInputTextType() ?>" name="x_akun_id" id="x_akun_id" data-table="jurnalkasd" data-field="x_akun_id" value="<?= $Page->akun_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->akun_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->akun_id->formatPattern()) ?>"<?= $Page->akun_id->editAttributes() ?> aria-describedby="x_akun_id_help">
<?= $Page->akun_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->akun_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->debet->Visible) { // debet ?>
    <div id="r_debet"<?= $Page->debet->rowAttributes() ?>>
        <label id="elh_jurnalkasd_debet" for="x_debet" class="<?= $Page->LeftColumnClass ?>"><?= $Page->debet->caption() ?><?= $Page->debet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->debet->cellAttributes() ?>>
<span id="el_jurnalkasd_debet">
<input type="<?= $Page->debet->getInputTextType() ?>" name="x_debet" id="x_debet" data-table="jurnalkasd" data-field="x_debet" value="<?= $Page->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->debet->formatPattern()) ?>"<?= $Page->debet->editAttributes() ?> aria-describedby="x_debet_help">
<?= $Page->debet->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->debet->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kredit->Visible) { // kredit ?>
    <div id="r_kredit"<?= $Page->kredit->rowAttributes() ?>>
        <label id="elh_jurnalkasd_kredit" for="x_kredit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kredit->caption() ?><?= $Page->kredit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kredit->cellAttributes() ?>>
<span id="el_jurnalkasd_kredit">
<input type="<?= $Page->kredit->getInputTextType() ?>" name="x_kredit" id="x_kredit" data-table="jurnalkasd" data-field="x_kredit" value="<?= $Page->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kredit->formatPattern()) ?>"<?= $Page->kredit->editAttributes() ?> aria-describedby="x_kredit_help">
<?= $Page->kredit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kredit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjurnalkasdedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjurnalkasdedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jurnalkasd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
