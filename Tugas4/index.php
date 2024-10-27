<?php
require_once 'config/database.php';
require_once 'app/controllers/UserController.php';
 
// Koneksi ke database
$dbKoneksi = getDBConnection();

// Membuat Instance UserController
$controller = new UserController($dbKoneksi);
 
// Mendapatkan parameter dari URL menggunakan $_GET
// Memeriksa apakah parameter 'aksi' ada
if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($aksi == "detail" && $id) {
       
        $controller->show($id);

    } else if ($aksi == "edit" && $id) {
       
        $controller->Editdata($id);
        
    } else if ($aksi == "hapus" && $id) {

        $hapus = $controller->Hapus($id);
        
    } else if ($aksi == "tambah") {
        
        $controller->tambah();
    }
}else{
    $controller->tampilan();
}
