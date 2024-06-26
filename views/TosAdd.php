<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$TosAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tos: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var ftosadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftosadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["kode", [fields.kode.visible && fields.kode.required ? ew.Validators.required(fields.kode.caption) : null], fields.kode.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftosadd" id="ftosadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if (!$Page->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($Page->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_tosadd" class="<?= $Page->TableClass ?>"><!-- table* -->
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_kode"<?= $Page->kode->rowAttributes() ?>>
        <label id="elh_tos_kode" for="x_kode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kode->cellAttributes() ?>>
<span id="el_tos_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" name="x_kode" id="x_kode" data-table="tos" data-field="x_kode" value="<?= $Page->kode->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kode->formatPattern()) ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_kode"<?= $Page->kode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tos_kode"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->kode->cellAttributes() ?>>
<span id="el_tos_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" name="x_kode" id="x_kode" data-table="tos" data-field="x_kode" value="<?= $Page->kode->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kode->formatPattern()) ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_tos_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_tos_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="tos" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tos_name"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el_tos_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="tos" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_tos_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_tos_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="tos" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->keterangan->formatPattern()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tos_keterangan"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_tos_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="tos" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->keterangan->formatPattern()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
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
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftosadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftosadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("tos");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
