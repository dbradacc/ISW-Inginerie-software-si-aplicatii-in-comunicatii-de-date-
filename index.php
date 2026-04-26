<?php
// /public/index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/config.php';

$resource = $_GET['resource'] ?? 'students';
$action   = $_GET['action']   ?? 'index';

session_start();

/* protejează toate resursele, cu excepţia auth->login */
if (empty($_SESSION['user']) && !($resource === 'auth' && $action === 'login')) {
    header('Location: index.php?resource=auth&action=login'); exit;
}

switch ($resource) {
    
    case 'auth':
    $ctrl = new \App\Controllers\AuthController();
    break;
    case 'students':
        $ctrl = new \App\Controllers\StudentController();
        break;
    case 'courses':
        $ctrl = new \App\Controllers\CourseController();
        break;
    case 'enrollments':
        $ctrl = new \App\Controllers\EnrollmentController();
        break;
        case 'attendance':
    $ctrl = new \App\Controllers\AttendanceController();
    break;
    case 'attendance':
    $ctrl = new \App\Controllers\AttendanceController();
    break;
    case 'export':
    $ctrl = new \App\Controllers\ExportController(); break;
    case 'dashboard':
    $ctrl = new \App\Controllers\DashboardController(); break;
    case 'users':
    $ctrl = new \App\Controllers\UserController(); break;
    case 'audit':
    $ctrl = new \App\Controllers\AuditController(); break;

    default:
        http_response_code(404);
        exit('Not Found');

}

if (!method_exists($ctrl, $action)) {
    http_response_code(404);
    exit('Not Found');
}

call_user_func([$ctrl, $action]);