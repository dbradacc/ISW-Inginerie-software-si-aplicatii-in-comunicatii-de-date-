<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Audit;

class EnrollmentController extends Controller
{
    private Enrollment $model;
    public function __construct() { $this->model = new Enrollment(); }

    /* LISTĂ */
    public function index()
    {
        $enrollments = $this->model->all();
        include __DIR__ . '/../../views/enrollments/list.php';
    }

    /* CREATE (Catalog) */
    public function create()
    {
        if (!Auth::can('create')) { http_response_code(403); exit('Interzis'); }

        $students = (new Student())->all();
        $courses  = (new Course())->all();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->model->create($_POST);
                Audit::log($_SESSION['user']['id'],'create','Inscrieri',null,
                           json_encode($_POST, JSON_UNESCAPED_UNICODE));
                header('Location: index.php?resource=enrollments'); exit;

            } catch (\PDOException $ex) {
                if ($ex->getCode() == 23000) {
                    $error = 'Studentul selectat are deja o notă la acest curs.';
                } else throw $ex;
            }
        }
        include __DIR__ . '/../../views/enrollments/form.php';
    }

    /* EDIT */
    public function edit()
    {
        $sid = $_GET['student_id'] ?? null;
        $cid = $_GET['course_id']  ?? null;
        if (!$sid || !$cid) { header('Location: index.php?resource=enrollments'); exit; }

        $students = (new Student())->all();
        $courses  = (new Course())->all();
        $enrollment = $this->model->find($sid, $cid);
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->model->update($sid, $cid, $_POST);
                Audit::log($_SESSION['user']['id'],'update','Inscrieri',$sid,
                           json_encode($_POST, JSON_UNESCAPED_UNICODE));
                header('Location: index.php?resource=enrollments'); exit;

            } catch (\PDOException $ex) {
                if ($ex->getCode() == 23000) {
                    $error = 'Exista deja o înscriere pentru combinația student-curs.';
                } else throw $ex;
            }
        }
        include __DIR__ . '/../../views/enrollments/form.php';
    }

    /* DELETE – neschimbat */
    public function delete()
    {
        if (!Auth::can('delete')) { http_response_code(403); exit('Interzis'); }

        $sid = $_GET['student_id'] ?? null;
        $cid = $_GET['course_id']  ?? null;
        if ($sid && $cid) {
            $before = $this->model->find($sid,$cid);
            $this->model->delete($sid,$cid);
            Audit::log($_SESSION['user']['id'],'delete','Inscrieri',$sid,
                       json_encode($before, JSON_UNESCAPED_UNICODE));
        }
        header('Location: index.php?resource=enrollments'); exit;
    }
}