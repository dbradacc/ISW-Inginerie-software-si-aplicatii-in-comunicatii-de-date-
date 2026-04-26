<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class Course {
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all() {
        return $this->db
            ->query("SELECT * FROM Cursuri ORDER BY ID_Curs DESC")
            ->fetchAll();
    }

    public function find($id) {
        $st = $this->db->prepare("SELECT * FROM Cursuri WHERE ID_Curs = ?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public function create($d) {
        $st = $this->db->prepare(
          "INSERT INTO Cursuri
             (Denumire, Profesor_Titular, Nr_Credite, Semester)
           VALUES (?,?,?,?)"
        );
        $st->execute([
          $d['denumire'], $d['profesor'],
          (int)$d['nr_credite'], (int)$d['semester']
        ]);
    }

    public function update($id,$d) {
        $st = $this->db->prepare(
          "UPDATE Cursuri
             SET Denumire=?, Profesor_Titular=?, Nr_Credite=?, Semester=?
           WHERE ID_Curs = ?"
        );
        $st->execute([
          $d['denumire'], $d['profesor'],
          (int)$d['nr_credite'], (int)$d['semester'], $id
        ]);
    }
    
    public function search(string $q='', string $sem=''): array {
    $sql = "SELECT * FROM Cursuri WHERE 1";
    $args = [];

    if ($q !== '') {
        $sql .= " AND (Denumire LIKE ? OR Profesor_Titular LIKE ?)";
        $args[]="%$q%"; $args[]="%$q%";
    }
    if ($sem !== '') {
        $sql .= " AND Semester = ?";
        $args[] = (int)$sem;
    }
    $st = $this->db->prepare($sql);
    $st->execute($args);
    return $st->fetchAll();
    }

    public function delete($id) {
        $this->db->prepare("DELETE FROM Cursuri WHERE ID_Curs = ?")
                 ->execute([$id]);
    }
}
