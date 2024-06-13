<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$NoteEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<form name="fnoteedit" id="fnoteedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { note: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fnoteedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fnoteedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["NoteID", [fields.NoteID.visible && fields.NoteID.required ? ew.Validators.required(fields.NoteID.caption) : null], fields.NoteID.isInvalid],
            ["Tanggal", [fields.Tanggal.visible && fields.Tanggal.required ? ew.Validators.required(fields.Tanggal.caption) : null], fields.Tanggal.isInvalid],
            ["Catatan", [fields.Catatan.visible && fields.Catatan.required ? ew.Validators.required(fields.Catatan.caption) : null], fields.Catatan.isInvalid]
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
<input type="hidden" name="t" value="note">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NoteID->Visible) { // NoteID ?>
    <div id="r_NoteID"<?= $Page->NoteID->rowAttributes() ?>>
        <label id="elh_note_NoteID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NoteID->caption() ?><?= $Page->NoteID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NoteID->cellAttributes() ?>>
<span id="el_note_NoteID">
<span<?= $Page->NoteID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NoteID->getDisplayValue($Page->NoteID->EditValue))) ?>"></span>
<input type="hidden" data-table="note" data-field="x_NoteID" data-hidden="1" name="x_NoteID" id="x_NoteID" value="<?= HtmlEncode($Page->NoteID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Catatan->Visible) { // Catatan ?>
    <div id="r_Catatan"<?= $Page->Catatan->rowAttributes() ?>>
        <label id="elh_note_Catatan" for="x_Catatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Catatan->caption() ?><?= $Page->Catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Catatan->cellAttributes() ?>>
<span id="el_note_Catatan">
<textarea data-table="note" data-field="x_Catatan" name="x_Catatan" id="x_Catatan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Catatan->getPlaceHolder()) ?>"<?= $Page->Catatan->editAttributes() ?> aria-describedby="x_Catatan_help"><?= $Page->Catatan->EditValue ?></textarea>
<?= $Page->Catatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Catatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fnoteedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fnoteedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("note");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
