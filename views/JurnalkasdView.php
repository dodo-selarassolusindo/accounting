<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$JurnalkasdView = &$Page;
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
<form name="fjurnalkasdview" id="fjurnalkasdview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jurnalkasd: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjurnalkasdview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnalkasdview")
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
<input type="hidden" name="t" value="jurnalkasd">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkasd_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jurnalkasd_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jurnal_id->Visible) { // jurnal_id ?>
    <tr id="r_jurnal_id"<?= $Page->jurnal_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkasd_jurnal_id"><?= $Page->jurnal_id->caption() ?></span></td>
        <td data-name="jurnal_id"<?= $Page->jurnal_id->cellAttributes() ?>>
<span id="el_jurnalkasd_jurnal_id">
<span<?= $Page->jurnal_id->viewAttributes() ?>>
<?= $Page->jurnal_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->akun_id->Visible) { // akun_id ?>
    <tr id="r_akun_id"<?= $Page->akun_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkasd_akun_id"><?= $Page->akun_id->caption() ?></span></td>
        <td data-name="akun_id"<?= $Page->akun_id->cellAttributes() ?>>
<span id="el_jurnalkasd_akun_id">
<span<?= $Page->akun_id->viewAttributes() ?>>
<?= $Page->akun_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->debet->Visible) { // debet ?>
    <tr id="r_debet"<?= $Page->debet->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkasd_debet"><?= $Page->debet->caption() ?></span></td>
        <td data-name="debet"<?= $Page->debet->cellAttributes() ?>>
<span id="el_jurnalkasd_debet">
<span<?= $Page->debet->viewAttributes() ?>>
<?= $Page->debet->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kredit->Visible) { // kredit ?>
    <tr id="r_kredit"<?= $Page->kredit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnalkasd_kredit"><?= $Page->kredit->caption() ?></span></td>
        <td data-name="kredit"<?= $Page->kredit->cellAttributes() ?>>
<span id="el_jurnalkasd_kredit">
<span<?= $Page->kredit->viewAttributes() ?>>
<?= $Page->kredit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
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
