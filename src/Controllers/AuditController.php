<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Database;

class AuditController extends Controller
{
    public function index()
    {
        if (!Auth::can('view')) { http_response_code(403); exit('Interzis'); }

        $db   = Database::getInstance()->getConnection();
        $logs = $db->query(
            "SELECT al.*, u.username
             FROM Audit_Log al
             LEFT JOIN Utilizatori u ON u.ID_User = al.ID_User
             ORDER BY al.ID_Audit DESC"
        )->fetchAll();

        /* IMPORTANT: UNICUL include – view-ul se ocupă de header/footer */
        include __DIR__ . '/../../views/audit/list.php';
    }
}