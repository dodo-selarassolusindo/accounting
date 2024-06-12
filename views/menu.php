<?php

namespace PHPMaker2024\prj_accounting;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(24, "mci_Master", $Language->menuPhrase("24", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(3, "mi_grup", $Language->menuPhrase("3", "MenuText"), "gruplist", 24, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(19, "mi_subgrup", $Language->menuPhrase("19", "MenuText"), "subgruplist", 24, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(1, "mi_akun", $Language->menuPhrase("1", "MenuText"), "akunlist", 24, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(17, "mi_saldoawal", $Language->menuPhrase("17", "MenuText"), "saldoawallist", 24, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(14, "mi_periode", $Language->menuPhrase("14", "MenuText"), "periodelist", 24, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(26, "mci_Transaksi", $Language->menuPhrase("26", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(5, "mi_jurnal", $Language->menuPhrase("5", "MenuText"), "jurnallist", 26, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(27, "mci_Setting", $Language->menuPhrase("27", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(12, "mi_pajak", $Language->menuPhrase("12", "MenuText"), "pajaklist", 27, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(20, "mi_tipejurnal", $Language->menuPhrase("20", "MenuText"), "tipejurnallist", 27, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(10, "mi_kurs", $Language->menuPhrase("10", "MenuText"), "kurslist", 27, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(11, "mi_matauang", $Language->menuPhrase("11", "MenuText"), "matauanglist", 27, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(25, "mci_Others", $Language->menuPhrase("25", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(2, "mi_audittrail", $Language->menuPhrase("2", "MenuText"), "audittraillist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(4, "mi_gudang", $Language->menuPhrase("4", "MenuText"), "gudanglist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(23, "mi_type", $Language->menuPhrase("23", "MenuText"), "typelist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(22, "mi_tos", $Language->menuPhrase("22", "MenuText"), "toslist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(21, "mi_top", $Language->menuPhrase("21", "MenuText"), "toplist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(18, "mi_satuan", $Language->menuPhrase("18", "MenuText"), "satuanlist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(16, "mi_produk", $Language->menuPhrase("16", "MenuText"), "produklist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(15, "mi_person", $Language->menuPhrase("15", "MenuText"), "personlist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(13, "mi_pengiriman", $Language->menuPhrase("13", "MenuText"), "pengirimanlist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(9, "mi_konversi", $Language->menuPhrase("9", "MenuText"), "konversilist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(8, "mi_klasifikasi", $Language->menuPhrase("8", "MenuText"), "klasifikasilist", 25, "", true, false, false, "", "", true, false);
$topMenu->addMenuItem(7, "mi_kelompok", $Language->menuPhrase("7", "MenuText"), "kelompoklist", 25, "", true, false, false, "", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(24, "mci_Master", $Language->menuPhrase("24", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(3, "mi_grup", $Language->menuPhrase("3", "MenuText"), "gruplist", 24, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(19, "mi_subgrup", $Language->menuPhrase("19", "MenuText"), "subgruplist", 24, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(1, "mi_akun", $Language->menuPhrase("1", "MenuText"), "akunlist", 24, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(17, "mi_saldoawal", $Language->menuPhrase("17", "MenuText"), "saldoawallist", 24, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(14, "mi_periode", $Language->menuPhrase("14", "MenuText"), "periodelist", 24, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(26, "mci_Transaksi", $Language->menuPhrase("26", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(5, "mi_jurnal", $Language->menuPhrase("5", "MenuText"), "jurnallist", 26, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(27, "mci_Setting", $Language->menuPhrase("27", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(12, "mi_pajak", $Language->menuPhrase("12", "MenuText"), "pajaklist", 27, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(20, "mi_tipejurnal", $Language->menuPhrase("20", "MenuText"), "tipejurnallist", 27, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(10, "mi_kurs", $Language->menuPhrase("10", "MenuText"), "kurslist", 27, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(11, "mi_matauang", $Language->menuPhrase("11", "MenuText"), "matauanglist", 27, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(25, "mci_Others", $Language->menuPhrase("25", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(2, "mi_audittrail", $Language->menuPhrase("2", "MenuText"), "audittraillist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(4, "mi_gudang", $Language->menuPhrase("4", "MenuText"), "gudanglist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(23, "mi_type", $Language->menuPhrase("23", "MenuText"), "typelist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(22, "mi_tos", $Language->menuPhrase("22", "MenuText"), "toslist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(21, "mi_top", $Language->menuPhrase("21", "MenuText"), "toplist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(18, "mi_satuan", $Language->menuPhrase("18", "MenuText"), "satuanlist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(16, "mi_produk", $Language->menuPhrase("16", "MenuText"), "produklist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(15, "mi_person", $Language->menuPhrase("15", "MenuText"), "personlist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(13, "mi_pengiriman", $Language->menuPhrase("13", "MenuText"), "pengirimanlist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(9, "mi_konversi", $Language->menuPhrase("9", "MenuText"), "konversilist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(8, "mi_klasifikasi", $Language->menuPhrase("8", "MenuText"), "klasifikasilist", 25, "", true, false, false, "", "", true, true);
$sideMenu->addMenuItem(7, "mi_kelompok", $Language->menuPhrase("7", "MenuText"), "kelompoklist", 25, "", true, false, false, "", "", true, true);
echo $sideMenu->toScript();
