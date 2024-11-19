<?php
include_once 'models/santriModel.php';
include_once 'models/guruModel.php';
include_once 'models/adminModel.php';


class loginController
{
    private $santriModel;
    private $guruModel;
    private $adminModel;
    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->guruModel = new GuruModel();
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $santri = $this->santriModel->getSantriByUsername($username);
        $guru = $this->guruModel->getGuruByUsername($username);
        $admin = $this->adminModel->getAdminByUsername($username);

        if ($santri) {
            if ($santri->password == $password && $santri->role->roleId == 3) {
                $_SESSION['username_login'] = $santri;
                header("Location: index.php?modul=null");
                exit();
            } else {
                return "Password atau role tidak sesuai.";
            }
        } elseif ($guru) {
            if ($guru->password == $password && $guru->role->roleId == 2) {
                $_SESSION['username_login'] = $guru;
                header("Location: index.php?modul=null");
                exit();
            } else {
                return "Password atau role tidak sesuai.";
            }
        } elseif ($admin) {
            if ($admin->password == $password && $admin->role->roleId == 1) {
                $_SESSION['username_login'] = $admin;
                header("Location: index.php?modul=null");
                exit();
            } else {
                return "Password atau role tidak sesuai.";
            }
        } else {
            return "Username tidak ditemukan.";
        }
        exit();
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
        if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 3) {
            // echo "<script>alert('Selamat datang, " . $_SESSION['username_login']->username . "!');</script>";
            include 'views/santri/santriDashboard.php';
            exit();
        } else if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 2) {
            // echo "<script>alert('Selamat datang, " . $_SESSION['username_login']->username . "!');</script>";
            include 'views/role/roleDashboard.php';
            exit();
        } else if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 1) {
            // echo "<script>alert('Selamat datang, " . $_SESSION['username_login']->username . "!');</script>";
            include 'views/role/roleDashboard.php';
            exit();
        }
        include 'views/items/login.php';
        exit();
    }
}
