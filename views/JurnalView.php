<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$JurnalView = &$Page;
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
<form name="fjurnalview" id="fjurnalview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jurnal: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjurnalview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnalview")
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
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->createon->Visible) { // createon ?>
    <tr id="r_createon"<?= $Page->createon->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnal_createon"><?= $Page->createon->caption() ?></span></td>
        <td data-name="createon"<?= $Page->createon->cellAttributes() ?>>
<span id="el_jurnal_createon">
<span<?= $Page->createon->viewAttributes() ?>>
<?= $Page->createon->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomer->Visible) { // nomer ?>
    <tr id="r_nomer"<?= $Page->nomer->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnal_nomer"><?= $Page->nomer->caption() ?></span></td>
        <td data-name="nomer"<?= $Page->nomer->cellAttributes() ?>>
<span id="el_jurnal_nomer">
<span<?= $Page->nomer->viewAttributes() ?>>
<?= $Page->nomer->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnal_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_jurnal_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->debet->Visible) { // debet ?>
    <tr id="r_debet"<?= $Page->debet->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnal_debet"><?= $Page->debet->caption() ?></span></td>
        <td data-name="debet"<?= $Page->debet->cellAttributes() ?>>
<span id="el_jurnal_debet">
<span<?= $Page->debet->viewAttributes() ?>>
<?= $Page->debet->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kredit->Visible) { // kredit ?>
    <tr id="r_kredit"<?= $Page->kredit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnal_kredit"><?= $Page->kredit->caption() ?></span></td>
        <td data-name="kredit"<?= $Page->kredit->cellAttributes() ?>>
<span id="el_jurnal_kredit">
<span<?= $Page->kredit->viewAttributes() ?>>
<?= $Page->kredit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->selisih->Visible) { // selisih ?>
    <tr id="r_selisih"<?= $Page->selisih->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jurnal_selisih"><?= $Page->selisih->caption() ?></span></td>
        <td data-name="selisih"<?= $Page->selisih->cellAttributes() ?>>
<span id="el_jurnal_selisih">
<span<?= $Page->selisih->viewAttributes() ?>>
<?= $Page->selisih->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("jurnald", explode(",", $Page->getCurrentDetailTable())) && $jurnald->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jurnald", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JurnaldGrid.php" ?>
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
