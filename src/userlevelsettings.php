<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\prj_accounting;

/**
 * User levels
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User level name
 */
$USER_LEVELS = [["-2","Anonymous"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}akun","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}audittrail","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}grup","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}gudang","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}home.php","-2","72"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}jurnal","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}jurnald","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}kelompok","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}klasifikasi","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}konversi","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}kurs","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}matauang","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}pajak","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}pengiriman","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}periode","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}person","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}produk","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}saldoawal","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}satuan","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}subgrup","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}tipejurnal","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}top","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}tos","-2","0"],
    ["{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}type","-2","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["akun","akun","Akun",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","akunlist"],
    ["audittrail","audittrail","audittrail",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","audittraillist"],
    ["grup","grup","Grup",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","gruplist"],
    ["gudang","gudang","gudang",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","gudanglist"],
    ["home.php","home","Home",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","home"],
    ["jurnal","jurnal","Jurnal",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","jurnallist"],
    ["jurnald","jurnald","Detail",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","jurnaldlist"],
    ["kelompok","kelompok","kelompok",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","kelompoklist"],
    ["klasifikasi","klasifikasi","klasifikasi",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","klasifikasilist"],
    ["konversi","konversi","konversi",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","konversilist"],
    ["kurs","kurs","kurs",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","kurslist"],
    ["matauang","matauang","matauang",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","matauanglist"],
    ["pajak","pajak","pajak",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","pajaklist"],
    ["pengiriman","pengiriman","pengiriman",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","pengirimanlist"],
    ["periode","periode","Periode",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","periodelist"],
    ["person","person","person",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","personlist"],
    ["produk","produk","produk",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","produklist"],
    ["saldoawal","saldoawal","Saldo Awal",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","saldoawallist"],
    ["satuan","satuan","satuan",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","satuanlist"],
    ["subgrup","subgrup","Sub Grup",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","subgruplist"],
    ["tipejurnal","tipejurnal","Tipe Jurnal",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","tipejurnallist"],
    ["top","top","top",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","toplist"],
    ["tos","tos","tos",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","toslist"],
    ["type","type","type",true,"{BF72DE82-CB59-461F-848A-24CDFE0DCFE4}","typelist"]];
