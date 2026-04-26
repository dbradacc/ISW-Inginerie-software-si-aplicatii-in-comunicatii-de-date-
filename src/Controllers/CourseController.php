<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Course;
use App\Models\Audit;

class CourseController extends Controller
{
    private Course $model;
    public function __construct() { $this->model = new Course(); }

    public function index()
    {
        $q   = $_GET['q']   ?? '';
        $sem = $_GET['sem'] ?? '';
        $courses = $this->model->search($q,$sem);
        include __DIR__.'/../../views/courses/list.php';
    }

    public function create()
    {
        if (!Auth::can('create')) { http_response_code(403); exit; }

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $this->model->create($_POST);
            Audit::log($_SESSION['user']['id'],'create','Cursuri',null,
                       json_encode($_POST,JSON_UNESCAPED_UNICODE));
            header('Location: index.php?resource=courses'); exit;
        }
        include __DIR__.'/../../views/courses/form.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;  if(!$id) header('Location: index.php?resource=courses');

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $this->model->update($id,$_POST);
            Audit::log($_SESSION['user']['id'],'update','Cursuri',$id,
                       json_encode($_POST,JSON_UNESCAPED_UNICODE));
            header('Location: index.php?resource=courses'); exit;
        }
        $course = $this->model->find($id);
        include __DIR__.'/../../views/courses/form.php';
    }

    public function delete()
    {
        if (!Auth::can('delete')) { http_response_code(403); exit; }

        $id=$_GET['id']??null;
        if($id){
            $before=$this->model->find($id);
            $this->model->delete($id);
            Audit::log($_SESSION['user']['id'],'delete','Cursuri',$id,
                       json_encode($before,JSON_UNESCAPED_UNICODE));
        }
        header('Location: index.php?resource=courses'); exit;
    }
}
