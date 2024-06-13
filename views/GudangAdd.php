<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$GudangAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gudang: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fgudangadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fgudangadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["kode", [fields.kode.visible && fields.kode.required ? ew.Validators.required(fields.kode.caption) : null], fields.kode.isInvalid],
            ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
            ["lokasi", [fields.lokasi.visible && fields.lokasi.required ? ew.Validators.required(fields.lokasi.caption) : null], fields.lokasi.isInvalid]
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
<form name="fgudangadd" id="fgudangadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gudang">
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
<table id="tbl_gudangadd" class="<?= $Page->TableClass ?>"><!-- table* -->
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_kode"<?= $Page->kode->rowAttributes() ?>>
        <label id="elh_gudang_kode" for="x_kode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kode->cellAttributes() ?>>
<span id="el_gudang_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" name="x_kode" id="x_kode" data-table="gudang" data-field="x_kode" value="<?= $Page->kode->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kode->formatPattern()) ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_kode"<?= $Page->kode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gudang_kode"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->kode->cellAttributes() ?>>
<span id="el_gudang_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" name="x_kode" id="x_kode" data-table="gudang" data-field="x_kode" value="<?= $Page->kode->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->kode->formatPattern()) ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_gudang_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_gudang_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="gudang" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nama->formatPattern()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gudang_nama"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el_gudang_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="gudang" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nama->formatPattern()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_lokasi"<?= $Page->lokasi->rowAttributes() ?>>
        <label id="elh_gudang_lokasi" for="x_lokasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lokasi->caption() ?><?= $Page->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lokasi->cellAttributes() ?>>
<span id="el_gudang_lokasi">
<input type="<?= $Page->lokasi->getInputTextType() ?>" name="x_lokasi" id="x_lokasi" data-table="gudang" data-field="x_lokasi" value="<?= $Page->lokasi->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lokasi->formatPattern()) ?>"<?= $Page->lokasi->editAttributes() ?> aria-describedby="x_lokasi_help">
<?= $Page->lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_lokasi"<?= $Page->lokasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gudang_lokasi"><?= $Page->lokasi->caption() ?><?= $Page->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->lokasi->cellAttributes() ?>>
<span id="el_gudang_lokasi">
<input type="<?= $Page->lokasi->getInputTextType() ?>" name="x_lokasi" id="x_lokasi" data-table="gudang" data-field="x_lokasi" value="<?= $Page->lokasi->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lokasi->formatPattern()) ?>"<?= $Page->lokasi->editAttributes() ?> aria-describedby="x_lokasi_help">
<?= $Page->lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fgudangadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fgudangadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("gudang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
