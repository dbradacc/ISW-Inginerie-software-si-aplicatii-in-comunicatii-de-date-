<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class Student
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /* LISTĂ cu opțiune de filtrare */
    public function search(string $q = '', string $an = ''): array
    {
        $sql  = "SELECT * FROM Studenti WHERE 1";
        $args = [];

        if ($q !== '') {
            $sql .= " AND (Nume LIKE ? OR Prenume LIKE ? OR Email LIKE ?)";
            $args[] = "%$q%";
            $args[] = "%$q%";
            $args[] = "%$q%";
        }
        if ($an !== '') {
            $sql .= " AND An_Studiu = ?";
            $args[] = (int) $an;
        }
        $st = $this->db->prepare($sql);
        $st->execute($args);
        return $st->fetchAll();
    }

    /* CRUD clasic --------------------------------------------------- */
    public function all()        { return $this->search(); }
    public function find($id)    { $st=$this->db->prepare("SELECT * FROM Studenti WHERE ID_Student=?"); $st->execute([$id]); return $st->fetch(); }

    public function create($d)
    {
        $st = $this->db->prepare(
            "INSERT INTO Studenti (Nume,Prenume,Email,Telefon,An_Studiu)
             VALUES (?,?,?,?,?)"
        );
        $st->execute([
            $d['nume'], $d['prenume'], $d['email'],
            $d['telefon'], (int) $d['an_studiu']
        ]);
    }

    public function update($id, $d)
    {
        $st = $this->db->prepare(
            "UPDATE Studenti
               SET Nume=?,Prenume=?,Email=?,Telefon=?,An_Studiu=?
             WHERE ID_Student=?"
        );
        $st->execute([
            $d['nume'], $d['prenume'], $d['email'],
            $d['telefon'], (int) $d['an_studiu'], $id
        ]);
    }

    public function delete($id)
    {
        $this->db->prepare("DELETE FROM Studenti WHERE ID_Student=?")
                 ->execute([$id]);
    }
}