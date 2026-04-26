<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;
use App\Models\Audit;

class AttendanceController extends Controller
{
    private Attendance $model;
    public function __construct(){ $this->model = new Attendance(); }

    public function index()
    {
        $attendance = $this->model->search(
            $_GET['student']??'',
            $_GET['curs']??'',
            $_GET['sem']??''
        );
        $stats = $this->model->stats();
        include __DIR__.'/../../views/attendance/list.php';
    }

    public function create()
    {
        if(!Auth::can('create')){ http_response_code(403); exit; }

        $students=(new Student())->all();
        $courses =(new Course())->all();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $this->model->create($_POST);
            Audit::log($_SESSION['user']['id'],'create','Prezente',null,
                       json_encode($_POST,JSON_UNESCAPED_UNICODE));
            header('Location: index.php?resource=attendance'); exit;
        }
        include __DIR__.'/../../views/attendance/form.php';
    }

    public function edit()
    {
        $id=$_GET['id']??null; if(!$id){header('Location: index.php?resource=attendance');exit;}

        $students=(new Student())->all();
        $courses =(new Course())->all();
        $item=$this->model->find($id);

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $this->model->update($id,$_POST);
            Audit::log($_SESSION['user']['id'],'update','Prezente',$id,
                       json_encode($_POST,JSON_UNESCAPED_UNICODE));
            header('Location: index.php?resource=attendance'); exit;
        }
        include __DIR__.'/../../views/attendance/form.php';
    }

    public function delete()
    {
        if(!Auth::can('delete')){ http_response_code(403); exit; }

        $id=$_GET['id']??null;
        if($id){
            $before=$this->model->find($id);
            $this->model->delete($id);
            Audit::log($_SESSION['user']['id'],'delete','Prezente',$id,
                       json_encode($before,JSON_UNESCAPED_UNICODE));
        }
        header('Location: index.php?resource=attendance'); exit;
    }
}