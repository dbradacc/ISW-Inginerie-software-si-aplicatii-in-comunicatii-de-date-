<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Attendance
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /* ───────── LISTĂ COMPLETĂ ───────── */
    public function all(): array
    {
        $sql = "
          SELECT p.ID_Prezenta, p.Data, p.Semester, p.Status,
                 s.ID_Student, CONCAT(s.Nume,' ',s.Prenume) AS Student,
                 c.ID_Curs,    c.Denumire                    AS Curs
          FROM Prezente p
          JOIN Studenti s ON s.ID_Student = p.ID_Student
          JOIN Cursuri  c ON c.ID_Curs    = p.ID_Curs
          ORDER BY p.Data DESC
        ";
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $st = $this->db->prepare("SELECT * FROM Prezente WHERE ID_Prezenta = ?");
        $st->execute([$id]);
        return $st->fetch() ?: null;
    }

    public function create(array $d): void
    {
        $this->db->prepare(
          "INSERT INTO Prezente (Data, Semester, ID_Student, ID_Curs, Status)
           VALUES (?,?,?,?,?)"
        )->execute([
          $d['data'],
          $d['semester'],
          $d['id_student'],
          $d['id_curs'],
          $d['status']
        ]);
    }

    public function update(int $id, array $d): void
    {
        $this->db->prepare(
          "UPDATE Prezente
             SET Data = ?, Semester = ?, ID_Student = ?, ID_Curs = ?, Status = ?
           WHERE ID_Prezenta = ?"
        )->execute([
          $d['data'],
          $d['semester'],
          $d['id_student'],
          $d['id_curs'],
          $d['status'],
          $id
        ]);
    }

    public function delete(int $id): void
    {
        $this->db->prepare("DELETE FROM Prezente WHERE ID_Prezenta = ?")
                 ->execute([$id]);
    }

    /* câte înregistrări există deja pentru student-curs-semestru */
    public function countFor(int $student, int $curs, int $sem): int
    {
        $st = $this->db->prepare(
          "SELECT COUNT(*) FROM Prezente
           WHERE ID_Student = ? AND ID_Curs = ? AND Semester = ?"
        );
        $st->execute([$student, $curs, $sem]);
        return (int) $st->fetchColumn();
    }

    /* statistici pe semestrul 1 și 2 */
    public function stats(): array
    {
        $sql = "
          SELECT s.ID_Student,
                 CONCAT(s.Nume,' ',s.Prenume) AS Student,
                 SUM(CASE WHEN Semester = 1 AND Status = 'prezent' THEN 1 ELSE 0 END) AS Sem1,
                 SUM(CASE WHEN Semester = 2 AND Status = 'prezent' THEN 1 ELSE 0 END) AS Sem2
          FROM Prezente p
          JOIN Studenti s ON s.ID_Student = p.ID_Student
          GROUP BY s.ID_Student
          ORDER BY Student
        ";
        return $this->db->query($sql)->fetchAll();
    }
    public function search(string $student='', string $curs='', string $sem=''): array {
    $sql = "
      SELECT p.ID_Prezenta, p.Data, p.Semester, p.Status,
             s.ID_Student, CONCAT(s.Nume,' ',s.Prenume) AS Student,
             c.ID_Curs,    c.Denumire AS Curs
      FROM Prezente p
      JOIN Studenti s ON s.ID_Student = p.ID_Student
      JOIN Cursuri  c ON c.ID_Curs    = p.ID_Curs
      WHERE 1";
    $args = [];

    if ($student!=='') { $sql.=" AND s.Nume LIKE ?"; $args[]='%'.$student.'%'; }
    if ($curs!=='')    { $sql.=" AND c.Denumire LIKE ?"; $args[]='%'.$curs.'%'; }
    if ($sem!=='')     { $sql.=" AND p.Semester = ?";    $args[]=(int)$sem; }

    $st=$this->db->prepare($sql); $st->execute($args);
    return $st->fetchAll();
    }
}