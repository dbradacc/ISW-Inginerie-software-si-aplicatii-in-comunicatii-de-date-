<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Audit;

class AuthController extends Controller
{
    private User $model;
    public function __construct() { $this->model = new User(); }

    /* -------- LOGIN -------- */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $u = $_POST['username'] ?? '';
            $p = $_POST['password'] ?? '';

            $user = $this->model->findByUsername($u);
            if ($user && password_verify($p,$user['password_hash'])) {
                $_SESSION['user'] = [
                  'id'       => $user['ID_User'],
                  'username' => $user['username'],
                  'role'     => $user['Role']
                ];

                /* ✔ logare în audit */
                Audit::log($user['ID_User'],'login','Auth',null,null);

                header('Location: index.php'); exit;
            }
            $error='Date incorecte!';
        }
        include __DIR__.'/../../views/auth/login.php';
    }

    /* -------- LOGOUT -------- */
    public function logout()
    {
        if (!empty($_SESSION['user']['id'])) {
            /* ✔ logare logout */
            Audit::log($_SESSION['user']['id'],'logout','Auth',null,null);
        }
        session_destroy();
        header('Location: index.php?resource=auth&action=login'); exit;
    }
}
