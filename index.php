<?php
require_once 'controllers/roleController.php';
require_once 'controllers/adminController.php';
require_once 'controllers/santriController.php';
require_once 'controllers/guruController.php';
require_once 'controllers/bendaharaController.php';
require_once 'controllers/mapelController.php';
require_once 'controllers/kelasController.php';
require_once 'controllers/absenController.php';
require_once 'controllers/nilaiController.php';
require_once 'controllers/keuanganController.php';

require_once 'controllers/loginController.php';

require_once 'models/santriModel.php';
require_once 'models/nilaiModel.php';
require_once 'models/keuanganModel.php';
require_once 'models/kelasModel.php';
require_once 'models/absenModel.php';



session_start();

$_SESSION['username_login'] = isset($_SESSION['username_login']) ? $_SESSION['username_login'] : null;

$modul = isset($_GET['modul']) ? $_GET['modul'] : null;

$objRoles = new RoleController();
$objSantri = new SantriController();
$objAdmin = new AdminController();
$objGuru = new GuruController();
$objBendahara = new BendaharaController();
$objMapel = new MapelController();
$objKelas = new KelasController();
$objAbsen = new AbsenController();
$objNilai = new NilaiController();
$objKeuangan = new KeuanganController();

$objLogin = new loginController();

$santri = new SantriModel();
$nilai = new NilaiModel();
$keuangan = new KeuanganModel();
$kelas = new KelasModel();
$absen = new AbsenModel();



switch ($modul) {
    case 'login':
        $objLogin->login();
        break;
    case 'logout':
        $objLogin->logout();
        break;
    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objRoles->listRoles();
                break;
            case 'input':
                include 'views/role/roleInput.php';
                break;
            case 'add':
                $objRoles->addRoles();
            case 'edit':
                $objRoles->editById();
                break;
            case 'update':
                $objRoles->updateRoles();
                break;
            case 'delete':
                $objRoles->deleteRoles();
                break;
            default:
                $objRoles->listRoles();
                break;
        }
        break;
    case 'admin':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objAdmin->listUsers();
                break;
            case 'input':
                include 'views/admin/adminInput.php';
                break;
            case 'add':
                $objAdmin->addUser();
                break;
            case 'edit':
                $objAdmin->editById();
                break;
            case 'update':
                $objAdmin->updateUser();
                break;
            case 'delete':
                $objAdmin->deleteUser();
                break;
            default:
                $objAdmin->listUsers();
                break;
        }
        break;

    case 'santri':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objSantri->listSantri();
                break;
            case 'input':
                $objSantri->inputSantri();
                break;
            case 'add':
                $objSantri->addSantri();
                break;
            case 'edit':
                $objSantri->editById();
                break;
            case 'update':
                $objSantri->updateSantri();
                break;
            case 'delete':
                $objSantri->deleteSantri();
                break;
            default:
                $objSantri->listSantri();
                break;
        }
        break;
    case 'guru':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objGuru->listUsers();
                break;
            case 'input':
                include 'views/guru/guruInput.php';
                break;
            case 'add':
                $objGuru->addUser();
                break;
            case 'edit':
                $objGuru->editById();
                break;
            case 'update':
                $objGuru->updateUser();
                break;
            case 'delete':
                $objGuru->deleteUser();
                break;
            default:
                $objGuru->listUsers();
                break;
        }
        break;
    case 'bendahara':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objBendahara->listBendaharas();
                break;
            case 'input':
                include 'views/bendahara/bendaharaInput.php';
                break;
            case 'add':
                $objBendahara->addBendaharas();
                break;
            case 'edit':
                $objBendahara->editById();
                break;
            case 'update':
                $objBendahara->updateBendaharas();
                break;
            case 'delete':
                $objBendahara->deleteBendaharas();
                break;
            default:
                $objBendahara->listBendaharas();
                break;
        }
        break;

    case 'mapel':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objMapel->listMapels();
                break;
            case 'input':
                $objMapel->inputMapels();
                break;
            case 'add':
                $objMapel->addMapels();
                break;
            case 'edit':
                $objMapel->editById();
                break;
            case 'update':
                $objMapel->updateMapels();
                break;
            case 'delete':
                $objMapel->deleteMapels();
                break;
            case 'default':
                $objMapel->listMapels();
                break;
        }
        $objMapel->listMapels();
        break;

    case 'kelas':

        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objKelas->listKelas();
                break;
            case 'input':
                $objKelas->inputKelas();
                break;
            case 'add':
                $objKelas->addKelas();
                break;
            case 'edit':
                $objKelas->editKelas();
                break;
            case 'update':
                $objKelas->updateKelas();
                break;
            case 'delete':
                $objKelas->deleteKelas();
                break;
            case 'default':
                $objKelas->listKelas();
                break;
        }
        $objKelas->listKelas();
        break;
    case 'absen':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objAbsen->listAbsen();
                break;
            case 'input':
                $objAbsen->inputAbsen();
                break;
            case 'add':
                $objAbsen->addAbsen();
                break;
            case 'edit':
                $objAbsen->editAbsen();
                break;
            case 'update':
                $objAbsen->updateAbsen();
                break;
            case 'delete':
                $objAbsen->deleteAbsen();
                break;
        }
        break;
    case 'nilai':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objNilai->listNilais();
                break;
            case 'input':
                $objNilai->inputNilais();
                break;
            case 'add':
                $objNilai->addNilais();
                break;
            default:
                $objNilai->listNilais();
                break;
        }
        $objNilai->listNilais();
        break;
    case 'keuangan':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objKeuangan->listKeuangans();
                break;
            case 'input':
                $objKeuangan->inputKeuangans();
                break;
            case 'add':
                $objKeuangan->addKeuangans();
                break;
            default:
                $objKeuangan->listKeuangans();
                break;
        }
        break;
    case 'asSantri':
        $santri = $_SESSION['username_login'];
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        switch ($fitur) {
            case 'profil':
                include 'views/santri/santriProfilAsSantri.php';
                break;
            case 'nilai':
                $nilai = $nilai->getNilaiBySantriId($santri['id']);

                include 'views/santri/santriNilaiAsSantri.php';
                break;
            case 'absen':
                $absen = $absen->getAbsenBySantriId($santri['id']);

                include 'views/santri/santriAbsenAsSantri.php';
                break;
            case 'keuangan':
                $keuangan = $keuangan->getKeuanganBySantriId($santri['id']);
                
                include 'views/santri/santriKeuanganAsSantri.php';
                break;
            default:
                include 'views/santri/santriDashboard.php';
                break;
        }
        break;
    case 'asGuru':
        $guru = $_SESSION['username_login'];
        $kelas = $kelas->getKelasByGuruId($guru['id']);
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        switch ($fitur) {
            case 'profil':
                include 'views/guru/guruProfilAsGuru.php';
                break;

            default:
                include 'views/guru/guruDashboard.php';
                break;
        }
        break;
    case 'asBendahara':
        $bendahara = $_SESSION['username_login'];
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        switch ($fitur) {
            case 'profil':
                include 'views/bendahara/bendaharaProfilAsBendahara.php';
                break;
            default:
                include 'views/bendahara/bendaharaDashboard.php';
                break;
        }
        break;
    default:
        $objLogin->checkLogin();

        break;
}
