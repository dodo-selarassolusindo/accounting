<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$JurnalkasDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jurnalkas: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjurnalkasdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnalkasdelete")
        .setPageId("delete")
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
<form name="fjurnalkasdelete" id="fjurnalkasdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jurnalkas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_jurnalkas_id" class="jurnalkas_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tipejurnal_id->Visible) { // tipejurnal_id ?>
        <th class="<?= $Page->tipejurnal_id->headerCellClass() ?>"><span id="elh_jurnalkas_tipejurnal_id" class="jurnalkas_tipejurnal_id"><?= $Page->tipejurnal_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->period_id->Visible) { // period_id ?>
        <th class="<?= $Page->period_id->headerCellClass() ?>"><span id="elh_jurnalkas_period_id" class="jurnalkas_period_id"><?= $Page->period_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createon->Visible) { // createon ?>
        <th class="<?= $Page->createon->headerCellClass() ?>"><span id="elh_jurnalkas_createon" class="jurnalkas_createon"><?= $Page->createon->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_jurnalkas_keterangan" class="jurnalkas_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->person_id->Visible) { // person_id ?>
        <th class="<?= $Page->person_id->headerCellClass() ?>"><span id="elh_jurnalkas_person_id" class="jurnalkas_person_id"><?= $Page->person_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nomer->Visible) { // nomer ?>
        <th class="<?= $Page->nomer->headerCellClass() ?>"><span id="elh_jurnalkas_nomer" class="jurnalkas_nomer"><?= $Page->nomer->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tipejurnal_id->Visible) { // tipejurnal_id ?>
        <td<?= $Page->tipejurnal_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->tipejurnal_id->viewAttributes() ?>>
<?= $Page->tipejurnal_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->period_id->Visible) { // period_id ?>
        <td<?= $Page->period_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->period_id->viewAttributes() ?>>
<?= $Page->period_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createon->Visible) { // createon ?>
        <td<?= $Page->createon->cellAttributes() ?>>
<span id="">
<span<?= $Page->createon->viewAttributes() ?>>
<?= $Page->createon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->person_id->Visible) { // person_id ?>
        <td<?= $Page->person_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->person_id->viewAttributes() ?>>
<?= $Page->person_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nomer->Visible) { // nomer ?>
        <td<?= $Page->nomer->cellAttributes() ?>>
<span id="">
<span<?= $Page->nomer->viewAttributes() ?>>
<?= $Page->nomer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
