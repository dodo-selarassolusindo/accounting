<?php

namespace PHPMaker2024\prj_accounting;

// Set up and run Grid object
$Grid = Container("JurnalkasdGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjurnalkasdgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jurnalkasd: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnalkasdgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["jurnal_id", [fields.jurnal_id.visible && fields.jurnal_id.required ? ew.Validators.required(fields.jurnal_id.caption) : null, ew.Validators.integer], fields.jurnal_id.isInvalid],
            ["akun_id", [fields.akun_id.visible && fields.akun_id.required ? ew.Validators.required(fields.akun_id.caption) : null, ew.Validators.integer], fields.akun_id.isInvalid],
            ["debet", [fields.debet.visible && fields.debet.required ? ew.Validators.required(fields.debet.caption) : null, ew.Validators.float], fields.debet.isInvalid],
            ["kredit", [fields.kredit.visible && fields.kredit.required ? ew.Validators.required(fields.kredit.caption) : null, ew.Validators.float], fields.kredit.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["jurnal_id",false],["akun_id",false],["debet",false],["kredit",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
                return true;
            }
        )

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
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list">
<div id="ew-header-options">
<?php $Grid->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fjurnalkasdgrid" class="ew-form ew-list-form">
<div id="gmp_jurnalkasd" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jurnalkasdgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = RowType::HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_jurnalkasd_id" class="jurnalkasd_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->jurnal_id->Visible) { // jurnal_id ?>
        <th data-name="jurnal_id" class="<?= $Grid->jurnal_id->headerCellClass() ?>"><div id="elh_jurnalkasd_jurnal_id" class="jurnalkasd_jurnal_id"><?= $Grid->renderFieldHeader($Grid->jurnal_id) ?></div></th>
<?php } ?>
<?php if ($Grid->akun_id->Visible) { // akun_id ?>
        <th data-name="akun_id" class="<?= $Grid->akun_id->headerCellClass() ?>"><div id="elh_jurnalkasd_akun_id" class="jurnalkasd_akun_id"><?= $Grid->renderFieldHeader($Grid->akun_id) ?></div></th>
<?php } ?>
<?php if ($Grid->debet->Visible) { // debet ?>
        <th data-name="debet" class="<?= $Grid->debet->headerCellClass() ?>"><div id="elh_jurnalkasd_debet" class="jurnalkasd_debet"><?= $Grid->renderFieldHeader($Grid->debet) ?></div></th>
<?php } ?>
<?php if ($Grid->kredit->Visible) { // kredit ?>
        <th data-name="kredit" class="<?= $Grid->kredit->headerCellClass() ?>"><div id="elh_jurnalkasd_kredit" class="jurnalkasd_kredit"><?= $Grid->renderFieldHeader($Grid->kredit) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
while ($Grid->RecordCount < $Grid->StopRecord || $Grid->RowIndex === '$rowindex$') {
    if (
        $Grid->CurrentRow !== false &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->fetch();
    }
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id"<?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_id" class="el_jurnalkasd_id"></span>
<input type="hidden" data-table="jurnalkasd" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_id" class="el_jurnalkasd_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jurnalkasd" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_id" class="el_jurnalkasd_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnalkasd" data-field="x_id" data-hidden="1" name="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_id" id="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="jurnalkasd" data-field="x_id" data-hidden="1" data-old name="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_id" id="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jurnalkasd" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->jurnal_id->Visible) { // jurnal_id ?>
        <td data-name="jurnal_id"<?= $Grid->jurnal_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->jurnal_id->getSessionValue() != "") { ?>
<span<?= $Grid->jurnal_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jurnal_id->getDisplayValue($Grid->jurnal_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_jurnal_id" name="x<?= $Grid->RowIndex ?>_jurnal_id" value="<?= HtmlEncode($Grid->jurnal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_jurnal_id" class="el_jurnalkasd_jurnal_id">
<input type="<?= $Grid->jurnal_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jurnal_id" id="x<?= $Grid->RowIndex ?>_jurnal_id" data-table="jurnalkasd" data-field="x_jurnal_id" value="<?= $Grid->jurnal_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jurnal_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->jurnal_id->formatPattern()) ?>"<?= $Grid->jurnal_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jurnal_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="jurnalkasd" data-field="x_jurnal_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_jurnal_id" id="o<?= $Grid->RowIndex ?>_jurnal_id" value="<?= HtmlEncode($Grid->jurnal_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->jurnal_id->getSessionValue() != "") { ?>
<span<?= $Grid->jurnal_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jurnal_id->getDisplayValue($Grid->jurnal_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_jurnal_id" name="x<?= $Grid->RowIndex ?>_jurnal_id" value="<?= HtmlEncode($Grid->jurnal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_jurnal_id" class="el_jurnalkasd_jurnal_id">
<input type="<?= $Grid->jurnal_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jurnal_id" id="x<?= $Grid->RowIndex ?>_jurnal_id" data-table="jurnalkasd" data-field="x_jurnal_id" value="<?= $Grid->jurnal_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jurnal_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->jurnal_id->formatPattern()) ?>"<?= $Grid->jurnal_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jurnal_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_jurnal_id" class="el_jurnalkasd_jurnal_id">
<span<?= $Grid->jurnal_id->viewAttributes() ?>>
<?= $Grid->jurnal_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnalkasd" data-field="x_jurnal_id" data-hidden="1" name="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_jurnal_id" id="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_jurnal_id" value="<?= HtmlEncode($Grid->jurnal_id->FormValue) ?>">
<input type="hidden" data-table="jurnalkasd" data-field="x_jurnal_id" data-hidden="1" data-old name="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_jurnal_id" id="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_jurnal_id" value="<?= HtmlEncode($Grid->jurnal_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->akun_id->Visible) { // akun_id ?>
        <td data-name="akun_id"<?= $Grid->akun_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_akun_id" class="el_jurnalkasd_akun_id">
<input type="<?= $Grid->akun_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_akun_id" id="x<?= $Grid->RowIndex ?>_akun_id" data-table="jurnalkasd" data-field="x_akun_id" value="<?= $Grid->akun_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->akun_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->akun_id->formatPattern()) ?>"<?= $Grid->akun_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->akun_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jurnalkasd" data-field="x_akun_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_akun_id" id="o<?= $Grid->RowIndex ?>_akun_id" value="<?= HtmlEncode($Grid->akun_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_akun_id" class="el_jurnalkasd_akun_id">
<input type="<?= $Grid->akun_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_akun_id" id="x<?= $Grid->RowIndex ?>_akun_id" data-table="jurnalkasd" data-field="x_akun_id" value="<?= $Grid->akun_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->akun_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->akun_id->formatPattern()) ?>"<?= $Grid->akun_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->akun_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_akun_id" class="el_jurnalkasd_akun_id">
<span<?= $Grid->akun_id->viewAttributes() ?>>
<?= $Grid->akun_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnalkasd" data-field="x_akun_id" data-hidden="1" name="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_akun_id" id="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_akun_id" value="<?= HtmlEncode($Grid->akun_id->FormValue) ?>">
<input type="hidden" data-table="jurnalkasd" data-field="x_akun_id" data-hidden="1" data-old name="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_akun_id" id="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_akun_id" value="<?= HtmlEncode($Grid->akun_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->debet->Visible) { // debet ?>
        <td data-name="debet"<?= $Grid->debet->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_debet" class="el_jurnalkasd_debet">
<input type="<?= $Grid->debet->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_debet" id="x<?= $Grid->RowIndex ?>_debet" data-table="jurnalkasd" data-field="x_debet" value="<?= $Grid->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->debet->formatPattern()) ?>"<?= $Grid->debet->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->debet->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jurnalkasd" data-field="x_debet" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_debet" id="o<?= $Grid->RowIndex ?>_debet" value="<?= HtmlEncode($Grid->debet->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_debet" class="el_jurnalkasd_debet">
<input type="<?= $Grid->debet->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_debet" id="x<?= $Grid->RowIndex ?>_debet" data-table="jurnalkasd" data-field="x_debet" value="<?= $Grid->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->debet->formatPattern()) ?>"<?= $Grid->debet->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->debet->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_debet" class="el_jurnalkasd_debet">
<span<?= $Grid->debet->viewAttributes() ?>>
<?= $Grid->debet->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnalkasd" data-field="x_debet" data-hidden="1" name="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_debet" id="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_debet" value="<?= HtmlEncode($Grid->debet->FormValue) ?>">
<input type="hidden" data-table="jurnalkasd" data-field="x_debet" data-hidden="1" data-old name="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_debet" id="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_debet" value="<?= HtmlEncode($Grid->debet->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kredit->Visible) { // kredit ?>
        <td data-name="kredit"<?= $Grid->kredit->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_kredit" class="el_jurnalkasd_kredit">
<input type="<?= $Grid->kredit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kredit" id="x<?= $Grid->RowIndex ?>_kredit" data-table="jurnalkasd" data-field="x_kredit" value="<?= $Grid->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->kredit->formatPattern()) ?>"<?= $Grid->kredit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kredit->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jurnalkasd" data-field="x_kredit" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_kredit" id="o<?= $Grid->RowIndex ?>_kredit" value="<?= HtmlEncode($Grid->kredit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_kredit" class="el_jurnalkasd_kredit">
<input type="<?= $Grid->kredit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kredit" id="x<?= $Grid->RowIndex ?>_kredit" data-table="jurnalkasd" data-field="x_kredit" value="<?= $Grid->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->kredit->formatPattern()) ?>"<?= $Grid->kredit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kredit->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnalkasd_kredit" class="el_jurnalkasd_kredit">
<span<?= $Grid->kredit->viewAttributes() ?>>
<?= $Grid->kredit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnalkasd" data-field="x_kredit" data-hidden="1" name="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_kredit" id="fjurnalkasdgrid$x<?= $Grid->RowIndex ?>_kredit" value="<?= HtmlEncode($Grid->kredit->FormValue) ?>">
<input type="hidden" data-table="jurnalkasd" data-field="x_kredit" data-hidden="1" data-old name="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_kredit" id="fjurnalkasdgrid$o<?= $Grid->RowIndex ?>_kredit" value="<?= HtmlEncode($Grid->kredit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == RowType::ADD || $Grid->RowType == RowType::EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fjurnalkasdgrid","load"], () => fjurnalkasdgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking

    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fjurnalkasdgrid">
</div><!-- /.ew-list-form -->
<?php
// Close result set
$Grid->Recordset?->free();
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Grid->FooterOptions?->render("body") ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
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
<?php } ?>
