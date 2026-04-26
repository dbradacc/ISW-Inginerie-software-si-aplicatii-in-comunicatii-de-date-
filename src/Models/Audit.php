<?php
namespace App\Models;
use App\Core\Database;

class Audit
{
    public static function log(int $userId,string $act,string $tbl,
                               ?int $id=null, ?string $info=null): void
    {
        $ip  = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        $db  = Database::getInstance()->getConnection();
        $st  = $db->prepare(
          "INSERT INTO Audit_Log (ID_User,IP,Actiune,Entitate,ID_Ent,Info)
           VALUES (?,?,?,?,?,?)"
        );
        $st->execute([$userId,$ip,$act,$tbl,$id,$info]);
    }
}
