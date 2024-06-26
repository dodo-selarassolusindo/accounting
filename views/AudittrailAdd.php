<?php

namespace PHPMaker2024\prj_accounting;

// Page object
$AudittrailAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { audittrail: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var faudittrailadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("faudittrailadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["DateTime", [fields.DateTime.visible && fields.DateTime.required ? ew.Validators.required(fields.DateTime.caption) : null, ew.Validators.datetime(fields.DateTime.clientFormatPattern)], fields.DateTime.isInvalid],
            ["Script", [fields.Script.visible && fields.Script.required ? ew.Validators.required(fields.Script.caption) : null], fields.Script.isInvalid],
            ["User", [fields.User.visible && fields.User.required ? ew.Validators.required(fields.User.caption) : null], fields.User.isInvalid],
            ["_Action", [fields._Action.visible && fields._Action.required ? ew.Validators.required(fields._Action.caption) : null], fields._Action.isInvalid],
            ["_Table", [fields._Table.visible && fields._Table.required ? ew.Validators.required(fields._Table.caption) : null], fields._Table.isInvalid],
            ["Field", [fields.Field.visible && fields.Field.required ? ew.Validators.required(fields.Field.caption) : null], fields.Field.isInvalid],
            ["KeyValue", [fields.KeyValue.visible && fields.KeyValue.required ? ew.Validators.required(fields.KeyValue.caption) : null], fields.KeyValue.isInvalid],
            ["OldValue", [fields.OldValue.visible && fields.OldValue.required ? ew.Validators.required(fields.OldValue.caption) : null], fields.OldValue.isInvalid],
            ["NewValue", [fields.NewValue.visible && fields.NewValue.required ? ew.Validators.required(fields.NewValue.caption) : null], fields.NewValue.isInvalid]
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
<form name="faudittrailadd" id="faudittrailadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="audittrail">
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
<table id="tbl_audittrailadd" class="<?= $Page->TableClass ?>"><!-- table* -->
<?php } ?>
<?php if ($Page->DateTime->Visible) { // DateTime ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_DateTime"<?= $Page->DateTime->rowAttributes() ?>>
        <label id="elh_audittrail_DateTime" for="x_DateTime" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DateTime->caption() ?><?= $Page->DateTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->DateTime->cellAttributes() ?>>
<span id="el_audittrail_DateTime">
<input type="<?= $Page->DateTime->getInputTextType() ?>" name="x_DateTime" id="x_DateTime" data-table="audittrail" data-field="x_DateTime" value="<?= $Page->DateTime->EditValue ?>" placeholder="<?= HtmlEncode($Page->DateTime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->DateTime->formatPattern()) ?>"<?= $Page->DateTime->editAttributes() ?> aria-describedby="x_DateTime_help">
<?= $Page->DateTime->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DateTime->getErrorMessage() ?></div>
<?php if (!$Page->DateTime->ReadOnly && !$Page->DateTime->Disabled && !isset($Page->DateTime->EditAttrs["readonly"]) && !isset($Page->DateTime->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faudittrailadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("faudittrailadd", "x_DateTime", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_DateTime"<?= $Page->DateTime->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_DateTime"><?= $Page->DateTime->caption() ?><?= $Page->DateTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->DateTime->cellAttributes() ?>>
<span id="el_audittrail_DateTime">
<input type="<?= $Page->DateTime->getInputTextType() ?>" name="x_DateTime" id="x_DateTime" data-table="audittrail" data-field="x_DateTime" value="<?= $Page->DateTime->EditValue ?>" placeholder="<?= HtmlEncode($Page->DateTime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->DateTime->formatPattern()) ?>"<?= $Page->DateTime->editAttributes() ?> aria-describedby="x_DateTime_help">
<?= $Page->DateTime->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DateTime->getErrorMessage() ?></div>
<?php if (!$Page->DateTime->ReadOnly && !$Page->DateTime->Disabled && !isset($Page->DateTime->EditAttrs["readonly"]) && !isset($Page->DateTime->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faudittrailadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("faudittrailadd", "x_DateTime", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->Script->Visible) { // Script ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_Script"<?= $Page->Script->rowAttributes() ?>>
        <label id="elh_audittrail_Script" for="x_Script" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Script->caption() ?><?= $Page->Script->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Script->cellAttributes() ?>>
<span id="el_audittrail_Script">
<input type="<?= $Page->Script->getInputTextType() ?>" name="x_Script" id="x_Script" data-table="audittrail" data-field="x_Script" value="<?= $Page->Script->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Script->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Script->formatPattern()) ?>"<?= $Page->Script->editAttributes() ?> aria-describedby="x_Script_help">
<?= $Page->Script->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Script->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_Script"<?= $Page->Script->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_Script"><?= $Page->Script->caption() ?><?= $Page->Script->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->Script->cellAttributes() ?>>
<span id="el_audittrail_Script">
<input type="<?= $Page->Script->getInputTextType() ?>" name="x_Script" id="x_Script" data-table="audittrail" data-field="x_Script" value="<?= $Page->Script->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Script->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Script->formatPattern()) ?>"<?= $Page->Script->editAttributes() ?> aria-describedby="x_Script_help">
<?= $Page->Script->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Script->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_User"<?= $Page->User->rowAttributes() ?>>
        <label id="elh_audittrail_User" for="x_User" class="<?= $Page->LeftColumnClass ?>"><?= $Page->User->caption() ?><?= $Page->User->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->User->cellAttributes() ?>>
<span id="el_audittrail_User">
<input type="<?= $Page->User->getInputTextType() ?>" name="x_User" id="x_User" data-table="audittrail" data-field="x_User" value="<?= $Page->User->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->User->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->User->formatPattern()) ?>"<?= $Page->User->editAttributes() ?> aria-describedby="x_User_help">
<?= $Page->User->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->User->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_User"<?= $Page->User->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_User"><?= $Page->User->caption() ?><?= $Page->User->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->User->cellAttributes() ?>>
<span id="el_audittrail_User">
<input type="<?= $Page->User->getInputTextType() ?>" name="x_User" id="x_User" data-table="audittrail" data-field="x_User" value="<?= $Page->User->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->User->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->User->formatPattern()) ?>"<?= $Page->User->editAttributes() ?> aria-describedby="x_User_help">
<?= $Page->User->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->User->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_Action->Visible) { // Action ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__Action"<?= $Page->_Action->rowAttributes() ?>>
        <label id="elh_audittrail__Action" for="x__Action" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Action->caption() ?><?= $Page->_Action->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_Action->cellAttributes() ?>>
<span id="el_audittrail__Action">
<input type="<?= $Page->_Action->getInputTextType() ?>" name="x__Action" id="x__Action" data-table="audittrail" data-field="x__Action" value="<?= $Page->_Action->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Action->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_Action->formatPattern()) ?>"<?= $Page->_Action->editAttributes() ?> aria-describedby="x__Action_help">
<?= $Page->_Action->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Action->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r__Action"<?= $Page->_Action->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail__Action"><?= $Page->_Action->caption() ?><?= $Page->_Action->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->_Action->cellAttributes() ?>>
<span id="el_audittrail__Action">
<input type="<?= $Page->_Action->getInputTextType() ?>" name="x__Action" id="x__Action" data-table="audittrail" data-field="x__Action" value="<?= $Page->_Action->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Action->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_Action->formatPattern()) ?>"<?= $Page->_Action->editAttributes() ?> aria-describedby="x__Action_help">
<?= $Page->_Action->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Action->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->_Table->Visible) { // Table ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r__Table"<?= $Page->_Table->rowAttributes() ?>>
        <label id="elh_audittrail__Table" for="x__Table" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Table->caption() ?><?= $Page->_Table->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_Table->cellAttributes() ?>>
<span id="el_audittrail__Table">
<input type="<?= $Page->_Table->getInputTextType() ?>" name="x__Table" id="x__Table" data-table="audittrail" data-field="x__Table" value="<?= $Page->_Table->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Table->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_Table->formatPattern()) ?>"<?= $Page->_Table->editAttributes() ?> aria-describedby="x__Table_help">
<?= $Page->_Table->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Table->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r__Table"<?= $Page->_Table->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail__Table"><?= $Page->_Table->caption() ?><?= $Page->_Table->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->_Table->cellAttributes() ?>>
<span id="el_audittrail__Table">
<input type="<?= $Page->_Table->getInputTextType() ?>" name="x__Table" id="x__Table" data-table="audittrail" data-field="x__Table" value="<?= $Page->_Table->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Table->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_Table->formatPattern()) ?>"<?= $Page->_Table->editAttributes() ?> aria-describedby="x__Table_help">
<?= $Page->_Table->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Table->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->Field->Visible) { // Field ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_Field"<?= $Page->Field->rowAttributes() ?>>
        <label id="elh_audittrail_Field" for="x_Field" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Field->caption() ?><?= $Page->Field->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Field->cellAttributes() ?>>
<span id="el_audittrail_Field">
<input type="<?= $Page->Field->getInputTextType() ?>" name="x_Field" id="x_Field" data-table="audittrail" data-field="x_Field" value="<?= $Page->Field->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Field->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Field->formatPattern()) ?>"<?= $Page->Field->editAttributes() ?> aria-describedby="x_Field_help">
<?= $Page->Field->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Field->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_Field"<?= $Page->Field->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_Field"><?= $Page->Field->caption() ?><?= $Page->Field->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->Field->cellAttributes() ?>>
<span id="el_audittrail_Field">
<input type="<?= $Page->Field->getInputTextType() ?>" name="x_Field" id="x_Field" data-table="audittrail" data-field="x_Field" value="<?= $Page->Field->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Field->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Field->formatPattern()) ?>"<?= $Page->Field->editAttributes() ?> aria-describedby="x_Field_help">
<?= $Page->Field->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Field->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->KeyValue->Visible) { // KeyValue ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_KeyValue"<?= $Page->KeyValue->rowAttributes() ?>>
        <label id="elh_audittrail_KeyValue" for="x_KeyValue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KeyValue->caption() ?><?= $Page->KeyValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->KeyValue->cellAttributes() ?>>
<span id="el_audittrail_KeyValue">
<textarea data-table="audittrail" data-field="x_KeyValue" name="x_KeyValue" id="x_KeyValue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->KeyValue->getPlaceHolder()) ?>"<?= $Page->KeyValue->editAttributes() ?> aria-describedby="x_KeyValue_help"><?= $Page->KeyValue->EditValue ?></textarea>
<?= $Page->KeyValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KeyValue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_KeyValue"<?= $Page->KeyValue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_KeyValue"><?= $Page->KeyValue->caption() ?><?= $Page->KeyValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->KeyValue->cellAttributes() ?>>
<span id="el_audittrail_KeyValue">
<textarea data-table="audittrail" data-field="x_KeyValue" name="x_KeyValue" id="x_KeyValue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->KeyValue->getPlaceHolder()) ?>"<?= $Page->KeyValue->editAttributes() ?> aria-describedby="x_KeyValue_help"><?= $Page->KeyValue->EditValue ?></textarea>
<?= $Page->KeyValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KeyValue->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->OldValue->Visible) { // OldValue ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_OldValue"<?= $Page->OldValue->rowAttributes() ?>>
        <label id="elh_audittrail_OldValue" for="x_OldValue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OldValue->caption() ?><?= $Page->OldValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->OldValue->cellAttributes() ?>>
<span id="el_audittrail_OldValue">
<textarea data-table="audittrail" data-field="x_OldValue" name="x_OldValue" id="x_OldValue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->OldValue->getPlaceHolder()) ?>"<?= $Page->OldValue->editAttributes() ?> aria-describedby="x_OldValue_help"><?= $Page->OldValue->EditValue ?></textarea>
<?= $Page->OldValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OldValue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_OldValue"<?= $Page->OldValue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_OldValue"><?= $Page->OldValue->caption() ?><?= $Page->OldValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->OldValue->cellAttributes() ?>>
<span id="el_audittrail_OldValue">
<textarea data-table="audittrail" data-field="x_OldValue" name="x_OldValue" id="x_OldValue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->OldValue->getPlaceHolder()) ?>"<?= $Page->OldValue->editAttributes() ?> aria-describedby="x_OldValue_help"><?= $Page->OldValue->EditValue ?></textarea>
<?= $Page->OldValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OldValue->getErrorMessage() ?></div>
</span>
</td>
    </tr>
<?php } ?>
<?php } ?>
<?php if ($Page->NewValue->Visible) { // NewValue ?>
<?php if ($Page->IsMobileOrModal) { ?>
    <div id="r_NewValue"<?= $Page->NewValue->rowAttributes() ?>>
        <label id="elh_audittrail_NewValue" for="x_NewValue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NewValue->caption() ?><?= $Page->NewValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NewValue->cellAttributes() ?>>
<span id="el_audittrail_NewValue">
<textarea data-table="audittrail" data-field="x_NewValue" name="x_NewValue" id="x_NewValue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NewValue->getPlaceHolder()) ?>"<?= $Page->NewValue->editAttributes() ?> aria-describedby="x_NewValue_help"><?= $Page->NewValue->EditValue ?></textarea>
<?= $Page->NewValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NewValue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } else { ?>
    <tr id="r_NewValue"<?= $Page->NewValue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_audittrail_NewValue"><?= $Page->NewValue->caption() ?><?= $Page->NewValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
        <td<?= $Page->NewValue->cellAttributes() ?>>
<span id="el_audittrail_NewValue">
<textarea data-table="audittrail" data-field="x_NewValue" name="x_NewValue" id="x_NewValue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NewValue->getPlaceHolder()) ?>"<?= $Page->NewValue->editAttributes() ?> aria-describedby="x_NewValue_help"><?= $Page->NewValue->EditValue ?></textarea>
<?= $Page->NewValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NewValue->getErrorMessage() ?></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="faudittrailadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="faudittrailadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("audittrail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
