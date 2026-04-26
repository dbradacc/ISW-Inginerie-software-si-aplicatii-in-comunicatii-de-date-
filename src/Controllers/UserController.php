<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\User;
use App\Models\Audit;

class UserController extends Controller
{
    private User $model;
    public function __construct() { $this->model = new User(); }

    public function index() {
        if (!Auth::can('view')) { http_response_code(403); exit('Interzis'); }
        $users = $this->model->all();
        include __DIR__.'/../../views/users/list.php';
    }

    public function create() {
        if (!Auth::can('create')) { http_response_code(403); exit('Interzis'); }
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $this->model->create($_POST);
            Audit::log($_SESSION['user']['id'],'create','Utilizatori',null,
                       json_encode($_POST));
            header('Location: index.php?resource=users'); exit;
        }
        include __DIR__.'/../../views/users/form.php';
    }

    public function edit() {
        if (!Auth::can('update')) { http_response_code(403); exit('Interzis'); }
        $id = $_GET['id'] ?? 0;
        $user = $this->model->find($id);
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $this->model->update($id,$_POST);
            Audit::log($_SESSION['user']['id'],'update','Utilizatori',$id,
                       json_encode($_POST));
            header('Location: index.php?resource=users'); exit;
        }
        include __DIR__.'/../../views/users/form.php';
    }

    public function delete() {
        if (!Auth::can('delete')) { http_response_code(403); exit('Interzis'); }
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        Audit::log($_SESSION['user']['id'],'delete','Utilizatori',$id,null);
        header('Location: index.php?resource=users'); exit;
    }
}
