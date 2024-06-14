<?php

namespace PHPMaker2024\prj_accounting;

// Table
$jurnal = Container("jurnal");
$jurnal->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($jurnal->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jurnalmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jurnal->createon->Visible) { // createon ?>
        <tr id="r_createon"<?= $jurnal->createon->rowAttributes() ?>>
            <td class="<?= $jurnal->TableLeftColumnClass ?>"><?= $jurnal->createon->caption() ?></td>
            <td<?= $jurnal->createon->cellAttributes() ?>>
<span id="el_jurnal_createon">
<span<?= $jurnal->createon->viewAttributes() ?>>
<?= $jurnal->createon->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnal->nomer->Visible) { // nomer ?>
        <tr id="r_nomer"<?= $jurnal->nomer->rowAttributes() ?>>
            <td class="<?= $jurnal->TableLeftColumnClass ?>"><?= $jurnal->nomer->caption() ?></td>
            <td<?= $jurnal->nomer->cellAttributes() ?>>
<span id="el_jurnal_nomer">
<span<?= $jurnal->nomer->viewAttributes() ?>>
<?= $jurnal->nomer->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnal->keterangan->Visible) { // keterangan ?>
        <tr id="r_keterangan"<?= $jurnal->keterangan->rowAttributes() ?>>
            <td class="<?= $jurnal->TableLeftColumnClass ?>"><?= $jurnal->keterangan->caption() ?></td>
            <td<?= $jurnal->keterangan->cellAttributes() ?>>
<span id="el_jurnal_keterangan">
<span<?= $jurnal->keterangan->viewAttributes() ?>>
<?= $jurnal->keterangan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnal->debet->Visible) { // debet ?>
        <tr id="r_debet"<?= $jurnal->debet->rowAttributes() ?>>
            <td class="<?= $jurnal->TableLeftColumnClass ?>"><?= $jurnal->debet->caption() ?></td>
            <td<?= $jurnal->debet->cellAttributes() ?>>
<span id="el_jurnal_debet">
<span<?= $jurnal->debet->viewAttributes() ?>>
<?= $jurnal->debet->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnal->kredit->Visible) { // kredit ?>
        <tr id="r_kredit"<?= $jurnal->kredit->rowAttributes() ?>>
            <td class="<?= $jurnal->TableLeftColumnClass ?>"><?= $jurnal->kredit->caption() ?></td>
            <td<?= $jurnal->kredit->cellAttributes() ?>>
<span id="el_jurnal_kredit">
<span<?= $jurnal->kredit->viewAttributes() ?>>
<?= $jurnal->kredit->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jurnal->selisih->Visible) { // selisih ?>
        <tr id="r_selisih"<?= $jurnal->selisih->rowAttributes() ?>>
            <td class="<?= $jurnal->TableLeftColumnClass ?>"><?= $jurnal->selisih->caption() ?></td>
            <td<?= $jurnal->selisih->cellAttributes() ?>>
<span id="el_jurnal_selisih">
<span<?= $jurnal->selisih->viewAttributes() ?>>
<?= $jurnal->selisih->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
