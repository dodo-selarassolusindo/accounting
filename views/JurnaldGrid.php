<?php

namespace PHPMaker2024\prj_accounting;

// Set up and run Grid object
$Grid = Container("JurnaldGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjurnaldgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jurnald: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjurnaldgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["akun_id", [fields.akun_id.visible && fields.akun_id.required ? ew.Validators.required(fields.akun_id.caption) : null], fields.akun_id.isInvalid],
            ["debet", [fields.debet.visible && fields.debet.required ? ew.Validators.required(fields.debet.caption) : null, ew.Validators.float], fields.debet.isInvalid],
            ["kredit", [fields.kredit.visible && fields.kredit.required ? ew.Validators.required(fields.kredit.caption) : null, ew.Validators.float], fields.kredit.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["akun_id",false],["debet",false],["kredit",false]];
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
            "akun_id": <?= $Grid->akun_id->toClientList($Grid) ?>,
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
<div id="fjurnaldgrid" class="ew-form ew-list-form">
<div id="gmp_jurnald" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jurnaldgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->akun_id->Visible) { // akun_id ?>
        <th data-name="akun_id" class="<?= $Grid->akun_id->headerCellClass() ?>"><div id="elh_jurnald_akun_id" class="jurnald_akun_id"><?= $Grid->renderFieldHeader($Grid->akun_id) ?></div></th>
<?php } ?>
<?php if ($Grid->debet->Visible) { // debet ?>
        <th data-name="debet" class="<?= $Grid->debet->headerCellClass() ?>"><div id="elh_jurnald_debet" class="jurnald_debet"><?= $Grid->renderFieldHeader($Grid->debet) ?></div></th>
<?php } ?>
<?php if ($Grid->kredit->Visible) { // kredit ?>
        <th data-name="kredit" class="<?= $Grid->kredit->headerCellClass() ?>"><div id="elh_jurnald_kredit" class="jurnald_kredit"><?= $Grid->renderFieldHeader($Grid->kredit) ?></div></th>
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
    <?php if ($Grid->akun_id->Visible) { // akun_id ?>
        <td data-name="akun_id"<?= $Grid->akun_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_akun_id" class="el_jurnald_akun_id">
    <select
        id="x<?= $Grid->RowIndex ?>_akun_id"
        name="x<?= $Grid->RowIndex ?>_akun_id"
        class="form-control ew-select<?= $Grid->akun_id->isInvalidClass() ?>"
        data-select2-id="fjurnaldgrid_x<?= $Grid->RowIndex ?>_akun_id"
        data-table="jurnald"
        data-field="x_akun_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->akun_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->akun_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->akun_id->getPlaceHolder()) ?>"
        <?= $Grid->akun_id->editAttributes() ?>>
        <?= $Grid->akun_id->selectOptionListHtml("x{$Grid->RowIndex}_akun_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->akun_id->getErrorMessage() ?></div>
<?= $Grid->akun_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_akun_id") ?>
<script>
loadjs.ready("fjurnaldgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_akun_id", selectId: "fjurnaldgrid_x<?= $Grid->RowIndex ?>_akun_id" };
    if (fjurnaldgrid.lists.akun_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_akun_id", form: "fjurnaldgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_akun_id", form: "fjurnaldgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jurnald.fields.akun_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="jurnald" data-field="x_akun_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_akun_id" id="o<?= $Grid->RowIndex ?>_akun_id" value="<?= HtmlEncode($Grid->akun_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_akun_id" class="el_jurnald_akun_id">
    <select
        id="x<?= $Grid->RowIndex ?>_akun_id"
        name="x<?= $Grid->RowIndex ?>_akun_id"
        class="form-control ew-select<?= $Grid->akun_id->isInvalidClass() ?>"
        data-select2-id="fjurnaldgrid_x<?= $Grid->RowIndex ?>_akun_id"
        data-table="jurnald"
        data-field="x_akun_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->akun_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->akun_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->akun_id->getPlaceHolder()) ?>"
        <?= $Grid->akun_id->editAttributes() ?>>
        <?= $Grid->akun_id->selectOptionListHtml("x{$Grid->RowIndex}_akun_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->akun_id->getErrorMessage() ?></div>
<?= $Grid->akun_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_akun_id") ?>
<script>
loadjs.ready("fjurnaldgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_akun_id", selectId: "fjurnaldgrid_x<?= $Grid->RowIndex ?>_akun_id" };
    if (fjurnaldgrid.lists.akun_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_akun_id", form: "fjurnaldgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_akun_id", form: "fjurnaldgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jurnald.fields.akun_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_akun_id" class="el_jurnald_akun_id">
<span<?= $Grid->akun_id->viewAttributes() ?>>
<?= $Grid->akun_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnald" data-field="x_akun_id" data-hidden="1" name="fjurnaldgrid$x<?= $Grid->RowIndex ?>_akun_id" id="fjurnaldgrid$x<?= $Grid->RowIndex ?>_akun_id" value="<?= HtmlEncode($Grid->akun_id->FormValue) ?>">
<input type="hidden" data-table="jurnald" data-field="x_akun_id" data-hidden="1" data-old name="fjurnaldgrid$o<?= $Grid->RowIndex ?>_akun_id" id="fjurnaldgrid$o<?= $Grid->RowIndex ?>_akun_id" value="<?= HtmlEncode($Grid->akun_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->debet->Visible) { // debet ?>
        <td data-name="debet"<?= $Grid->debet->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_debet" class="el_jurnald_debet">
<input type="<?= $Grid->debet->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_debet" id="x<?= $Grid->RowIndex ?>_debet" data-table="jurnald" data-field="x_debet" value="<?= $Grid->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->debet->formatPattern()) ?>"<?= $Grid->debet->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->debet->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jurnald" data-field="x_debet" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_debet" id="o<?= $Grid->RowIndex ?>_debet" value="<?= HtmlEncode($Grid->debet->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_debet" class="el_jurnald_debet">
<input type="<?= $Grid->debet->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_debet" id="x<?= $Grid->RowIndex ?>_debet" data-table="jurnald" data-field="x_debet" value="<?= $Grid->debet->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->debet->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->debet->formatPattern()) ?>"<?= $Grid->debet->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->debet->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_debet" class="el_jurnald_debet">
<span<?= $Grid->debet->viewAttributes() ?>>
<?= $Grid->debet->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnald" data-field="x_debet" data-hidden="1" name="fjurnaldgrid$x<?= $Grid->RowIndex ?>_debet" id="fjurnaldgrid$x<?= $Grid->RowIndex ?>_debet" value="<?= HtmlEncode($Grid->debet->FormValue) ?>">
<input type="hidden" data-table="jurnald" data-field="x_debet" data-hidden="1" data-old name="fjurnaldgrid$o<?= $Grid->RowIndex ?>_debet" id="fjurnaldgrid$o<?= $Grid->RowIndex ?>_debet" value="<?= HtmlEncode($Grid->debet->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kredit->Visible) { // kredit ?>
        <td data-name="kredit"<?= $Grid->kredit->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_kredit" class="el_jurnald_kredit">
<input type="<?= $Grid->kredit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kredit" id="x<?= $Grid->RowIndex ?>_kredit" data-table="jurnald" data-field="x_kredit" value="<?= $Grid->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->kredit->formatPattern()) ?>"<?= $Grid->kredit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kredit->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jurnald" data-field="x_kredit" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_kredit" id="o<?= $Grid->RowIndex ?>_kredit" value="<?= HtmlEncode($Grid->kredit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_kredit" class="el_jurnald_kredit">
<input type="<?= $Grid->kredit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kredit" id="x<?= $Grid->RowIndex ?>_kredit" data-table="jurnald" data-field="x_kredit" value="<?= $Grid->kredit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kredit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->kredit->formatPattern()) ?>"<?= $Grid->kredit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kredit->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jurnald_kredit" class="el_jurnald_kredit">
<span<?= $Grid->kredit->viewAttributes() ?>>
<?= $Grid->kredit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jurnald" data-field="x_kredit" data-hidden="1" name="fjurnaldgrid$x<?= $Grid->RowIndex ?>_kredit" id="fjurnaldgrid$x<?= $Grid->RowIndex ?>_kredit" value="<?= HtmlEncode($Grid->kredit->FormValue) ?>">
<input type="hidden" data-table="jurnald" data-field="x_kredit" data-hidden="1" data-old name="fjurnaldgrid$o<?= $Grid->RowIndex ?>_kredit" id="fjurnaldgrid$o<?= $Grid->RowIndex ?>_kredit" value="<?= HtmlEncode($Grid->kredit->OldValue) ?>">
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
loadjs.ready(["fjurnaldgrid","load"], () => fjurnaldgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<?php
// Render aggregate row
$Grid->RowType = RowType::AGGREGATE;
$Grid->resetAttributes();
$Grid->renderRow();
?>
<?php if ($Grid->TotalRecords > 0 && $Grid->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Grid->renderListOptions();

// Render list options (footer, left)
$Grid->ListOptions->render("footer", "left");
?>
    <?php if ($Grid->akun_id->Visible) { // akun_id ?>
        <td data-name="akun_id" class="<?= $Grid->akun_id->footerCellClass() ?>"><span id="elf_jurnald_akun_id" class="jurnald_akun_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->debet->Visible) { // debet ?>
        <td data-name="debet" class="<?= $Grid->debet->footerCellClass() ?>"><span id="elf_jurnald_debet" class="jurnald_debet">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->debet->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Grid->kredit->Visible) { // kredit ?>
        <td data-name="kredit" class="<?= $Grid->kredit->footerCellClass() ?>"><span id="elf_jurnald_kredit" class="jurnald_kredit">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->kredit->ViewValue ?></span>
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Grid->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
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
<input type="hidden" name="detailpage" value="fjurnaldgrid">
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
    ew.addEventHandlers("jurnald");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
