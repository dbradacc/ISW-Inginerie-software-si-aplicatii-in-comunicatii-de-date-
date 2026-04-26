<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class Enrollment {
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /** LISTĂ catalog cu nume student + curs */
    public function all() {
        $sql = "
          SELECT
            e.ID_Student,
            CONCAT(s.Nume, ' ', s.Prenume)  AS Student,
            e.ID_Curs,
            c.Denumire                      AS Curs,
            e.Nota_Finala
          FROM Inscrieri  e
          JOIN Studenti   s ON s.ID_Student = e.ID_Student
          JOIN Cursuri    c ON c.ID_Curs    = e.ID_Curs
          ORDER BY e.ID_Student, e.ID_Curs
        ";
        return $this->db->query($sql)->fetchAll();
    }

    /** restul metodelor rămân neschimbate */
    public function find($studentId, $courseId) {
        $st = $this->db->prepare(
          "SELECT * FROM Inscrieri WHERE ID_Student = ? AND ID_Curs = ?"
        );
        $st->execute([$studentId, $courseId]);
        return $st->fetch();
    }

    public function create($data) {
        $st = $this->db->prepare(
          "INSERT INTO Inscrieri (ID_Student,ID_Curs,Nota_Finala) VALUES (?,?,?)"
        );
        return $st->execute([
          $data['id_student'], $data['id_curs'], (float)$data['nota']
        ]);
    }

    public function update($studentId, $courseId, $data) {
        $st = $this->db->prepare(
          "UPDATE Inscrieri SET Nota_Finala=? WHERE ID_Student=? AND ID_Curs=?"
        );
        return $st->execute([
          (float)$data['nota'], $studentId, $courseId
        ]);
    }

    public function delete($studentId, $courseId) {
        $st = $this->db->prepare(
          "DELETE FROM Inscrieri WHERE ID_Student=? AND ID_Curs=?"
        );
        return $st->execute([$studentId, $courseId]);
    }
}
