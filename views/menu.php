<?php

namespace PHPMaker2024\prj_accounting;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_akun", $Language->menuPhrase("1", "MenuText"), "akunlist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(2, "mi_audittrail", $Language->menuPhrase("2", "MenuText"), "audittraillist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(3, "mi_grup", $Language->menuPhrase("3", "MenuText"), "gruplist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_gudang", $Language->menuPhrase("4", "MenuText"), "gudanglist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(5, "mi_jurnal", $Language->menuPhrase("5", "MenuText"), "jurnallist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_jurnald", $Language->menuPhrase("6", "MenuText"), "jurnaldlist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(7, "mi_kelompok", $Language->menuPhrase("7", "MenuText"), "kelompoklist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(8, "mi_klasifikasi", $Language->menuPhrase("8", "MenuText"), "klasifikasilist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(9, "mi_konversi", $Language->menuPhrase("9", "MenuText"), "konversilist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_kurs", $Language->menuPhrase("10", "MenuText"), "kurslist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_matauang", $Language->menuPhrase("11", "MenuText"), "matauanglist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(12, "mi_pajak", $Language->menuPhrase("12", "MenuText"), "pajaklist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_pengiriman", $Language->menuPhrase("13", "MenuText"), "pengirimanlist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mi_periode", $Language->menuPhrase("14", "MenuText"), "periodelist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mi_person", $Language->menuPhrase("15", "MenuText"), "personlist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mi_produk", $Language->menuPhrase("16", "MenuText"), "produklist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(17, "mi_saldoawal", $Language->menuPhrase("17", "MenuText"), "saldoawallist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mi_satuan", $Language->menuPhrase("18", "MenuText"), "satuanlist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(19, "mi_subgrup", $Language->menuPhrase("19", "MenuText"), "subgruplist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(20, "mi_tipejurnal", $Language->menuPhrase("20", "MenuText"), "tipejurnallist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(21, "mi_top", $Language->menuPhrase("21", "MenuText"), "toplist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_tos", $Language->menuPhrase("22", "MenuText"), "toslist", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(23, "mi_type", $Language->menuPhrase("23", "MenuText"), "typelist", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
