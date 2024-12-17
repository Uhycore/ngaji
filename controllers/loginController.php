<?php
include_once 'models/santriModel.php';
include_once 'models/guruModel.php';
include_once 'models/adminModel.php';
include_once 'models/bendaharaModel.php';

class loginController
{
    private $santriModel;
    private $guruModel;
    private $adminModel;
    private $bendaharaModel;

    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->guruModel = new GuruModel();
        $this->adminModel = new AdminModel();
        $this->bendaharaModel = new BendaharaModel();
    }

    public function login()
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $santri = $this->santriModel->getSantriByUsername($username);
        $guru = $this->guruModel->getGuruByUsername($username);
        $admin = $this->adminModel->getAdminByUsername($username);

        $bendahara = $this->bendaharaModel->getBendaharaByUsername($username);

        if ($bendahara && $bendahara['password'] == $password && $bendahara['roleId'] == 4) {
            $objBendahara = $this->bendaharaModel->getBendaharaById($bendahara['bendaharaId']);
            $_SESSION['username_login'] = $objBendahara;
            header("Location: index.php?modul=null");
            exit();
        } elseif ($santri && $santri['password'] == $password && $santri['roleId'] == 3) {
            $objSantri = $this->santriModel->getSantriById($santri['santriId']);
           
            $_SESSION['username_login'] = $objSantri;
            header("Location: index.php?modul=null");
            exit();
        } elseif ($guru && $guru['password'] == $password && $guru['roleId'] == 2) {
            $objGuru = $this->guruModel->getGuruById($guru['guruId']);
            $_SESSION['username_login'] = $objGuru;
            header("Location: index.php?modul=null");
            exit();
        } elseif ($admin && $admin['password'] == $password && $admin['roleId'] == 1) {
            $objAdmin = $this->adminModel->getAdminById($admin['adminId']);
            $_SESSION['username_login'] = $objAdmin;
            header("Location: index.php?modul=null");
            exit();
        } else {
            echo "<script>
            alert('salah brooo!');
            
            </script>";
            $this->checkLogin();
            exit();
        }
    }

    public function logout()
    {

        unset($_SESSION['username_login']);

        echo "<script>
            alert('Logout berhasil!');
            window.location.href = 'index.php?modul=null';
            </script>";

        exit();
    }

    public function checkLogin()
    {

        if (isset($_SESSION['username_login']) && $_SESSION['username_login']['roleId']['roleId'] == 4) {
            include 'views/bendahara/bendaharaDashboard.php';
            exit();
        } elseif (isset($_SESSION['username_login']) && $_SESSION['username_login']['roleId']['roleId'] == 3) {
            include 'views/santri/santriDashboard.php';
            exit();
        } elseif (isset($_SESSION['username_login']) && $_SESSION['username_login']['roleId']['roleId'] == 2) {
            include 'views/guru/guruDashboard.php';
            exit();
        } elseif (isset($_SESSION['username_login']) && $_SESSION['username_login']['roleId']['roleId'] == 1) {
            include 'views/role/roleDashboard.php';
            exit();
        }
        include 'views/items/login.php';
        exit();
    }
}
