<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Student;
use App\Models\Audit;

class StudentController extends Controller
{
    private Student $model;
    public function __construct() { $this->model = new Student(); }

    /* LISTĂ + filtrare */
    public function index()
    {
        $q  = $_GET['q']  ?? '';
        $an = $_GET['an'] ?? '';
        $students = $this->model->search($q,$an);
        include __DIR__ . '/../../views/students/list.php';
    }

    /* CREATE */
    public function create()
    {
        if (!Auth::can('create')) { http_response_code(403); exit('Interzis'); }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!preg_match('/^\d{1,10}$/', $_POST['telefon'])) {
                $error = 'Telefonul trebuie să conțină 1–10 cifre.';
            } else {
                try {
                    $this->model->create($_POST);
                    Audit::log($_SESSION['user']['id'],'create','Studenti',null,
                               json_encode($_POST, JSON_UNESCAPED_UNICODE));
                    header('Location: index.php?resource=students'); exit;

                } catch (\PDOException $ex) {
                    if ($ex->getCode() == 23000) {
                        $error = 'Adresa de e-mail există deja în sistem.';
                    } else throw $ex;
                }
            }
        }
        include __DIR__ . '/../../views/students/form.php';
    }

    /* EDIT – validare telefon + duplicate email */
    public function edit()
    {
        $id = $_GET['id'] ?? null; if(!$id) header('Location: index.php?resource=students');

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!preg_match('/^\d{1,10}$/', $_POST['telefon'])) {
                $error = 'Telefonul trebuie să conțină 1–10 cifre.';
            } else {
                try {
                    $this->model->update($id,$_POST);
                    Audit::log($_SESSION['user']['id'],'update','Studenti',$id,
                               json_encode($_POST, JSON_UNESCAPED_UNICODE));
                    header('Location: index.php?resource=students'); exit;

                } catch (\PDOException $ex) {
                    if ($ex->getCode() == 23000) {
                        $error = 'Există deja un alt student cu acest e-mail.';
                    } else throw $ex;
                }
            }
        }

        $student = $this->model->find($id);
        include __DIR__ . '/../../views/students/form.php';
    }

    /* DELETE – neschimbat */
    public function delete()
    {
        if (!Auth::can('delete')) { http_response_code(403); exit('Interzis'); }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $before = $this->model->find($id);
            $this->model->delete($id);
            Audit::log($_SESSION['user']['id'],'delete','Studenti',$id,
                       json_encode($before, JSON_UNESCAPED_UNICODE));
        }
        header('Location: index.php?resource=students'); exit;
    }
}