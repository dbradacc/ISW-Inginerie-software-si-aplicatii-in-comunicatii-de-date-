<?php
/** /src/Controllers/ExportController.php */
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Attendance;

class ExportController extends Controller
{
    /* ============ CSV ============ */
    public function csv(): void
    {
        $type = $_GET['type'] ?? '';
        $filename = $type . '.csv';

        // golește orice buffer și setează anteturile
        if (ob_get_length()) ob_end_clean();
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=$filename");

        $out    = fopen('php://output', 'w');
        $escape = "\\";                    // parametru escape (prevenim warning)

        switch ($type) {
            case 'students':
                $rows = (new Student())->all();
                fputcsv($out,
                        ['ID', 'Nume', 'Prenume', 'Email', 'Telefon', 'An'],
                        ',', '"', $escape);
                foreach ($rows as $r) {
                    fputcsv($out, $r, ',', '"', $escape);
                }
                break;

            case 'courses':
                $rows = (new Course())->all();
                fputcsv($out,
                        ['ID', 'Denumire', 'Profesor', 'Credite', 'Semestru'],
                        ',', '"', $escape);
                foreach ($rows as $r) {
                    fputcsv($out, $r, ',', '"', $escape);
                }
                break;

            case 'attendance':
                $rows = (new Attendance())->all();
                fputcsv($out,
                        ['Data', 'Sem', 'ID Student', 'Student',
                         'ID Curs', 'Curs', 'Status'],
                        ',', '"', $escape);
                foreach ($rows as $r) {
                    fputcsv($out, $r, ',', '"', $escape);
                }
                break;

            default:
                // tip necunoscut → 404
                http_response_code(404);
                exit('Tip export necunoscut');
        }

        fclose($out);
        exit;
    }
}