<?php

namespace PHPMaker2024\prj_accounting;

// Table
$jurnalkas = Container("jurnalkas");
$jurnalkas->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($jurnalkas->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jurnalkasmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jurnalkas->id->Visible) { // id ?>
        <tr id="r_id"<?= $jurnalkas->id->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->id->caption() ?></td>
            <td<?= $jurnalkas->id->cellAttributes() ?>>
<span id="el_jurnalkas_id">
<span<?= $jurnalkas->id->viewAttributes() ?>>
<?= $jurnalkas->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnalkas->tipejurnal_id->Visible) { // tipejurnal_id ?>
        <tr id="r_tipejurnal_id"<?= $jurnalkas->tipejurnal_id->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->tipejurnal_id->caption() ?></td>
            <td<?= $jurnalkas->tipejurnal_id->cellAttributes() ?>>
<span id="el_jurnalkas_tipejurnal_id">
<span<?= $jurnalkas->tipejurnal_id->viewAttributes() ?>>
<?= $jurnalkas->tipejurnal_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnalkas->period_id->Visible) { // period_id ?>
        <tr id="r_period_id"<?= $jurnalkas->period_id->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->period_id->caption() ?></td>
            <td<?= $jurnalkas->period_id->cellAttributes() ?>>
<span id="el_jurnalkas_period_id">
<span<?= $jurnalkas->period_id->viewAttributes() ?>>
<?= $jurnalkas->period_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnalkas->createon->Visible) { // createon ?>
        <tr id="r_createon"<?= $jurnalkas->createon->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->createon->caption() ?></td>
            <td<?= $jurnalkas->createon->cellAttributes() ?>>
<span id="el_jurnalkas_createon">
<span<?= $jurnalkas->createon->viewAttributes() ?>>
<?= $jurnalkas->createon->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnalkas->keterangan->Visible) { // keterangan ?>
        <tr id="r_keterangan"<?= $jurnalkas->keterangan->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->keterangan->caption() ?></td>
            <td<?= $jurnalkas->keterangan->cellAttributes() ?>>
<span id="el_jurnalkas_keterangan">
<span<?= $jurnalkas->keterangan->viewAttributes() ?>>
<?= $jurnalkas->keterangan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnalkas->person_id->Visible) { // person_id ?>
        <tr id="r_person_id"<?= $jurnalkas->person_id->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->person_id->caption() ?></td>
            <td<?= $jurnalkas->person_id->cellAttributes() ?>>
<span id="el_jurnalkas_person_id">
<span<?= $jurnalkas->person_id->viewAttributes() ?>>
<?= $jurnalkas->person_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnalkas->nomer->Visible) { // nomer ?>
        <tr id="r_nomer"<?= $jurnalkas->nomer->rowAttributes() ?>>
            <td class="<?= $jurnalkas->TableLeftColumnClass ?>"><?= $jurnalkas->nomer->caption() ?></td>
            <td<?= $jurnalkas->nomer->cellAttributes() ?>>
<span id="el_jurnalkas_nomer">
<span<?= $jurnalkas->nomer->viewAttributes() ?>>
<?= $jurnalkas->nomer->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
