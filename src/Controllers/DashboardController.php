<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        $students   = (new Student())->all();
        $courses    = (new Course())->all();
        $attendance = (new Attendance())->stats();   // deja există

        $totalStudents = count($students);
        $totalCourses  = count($courses);
        $totalPresence = array_sum(array_column($attendance,'Sem1')) +
                         array_sum(array_column($attendance,'Sem2'));
        include __DIR__ . '/../../views/dashboard/index.php';
    }
}
