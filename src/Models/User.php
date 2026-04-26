<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class User
{
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all() {
        return $this->db->query("SELECT * FROM Utilizatori")->fetchAll();
    }

    public function find(int $id) {
        $st = $this->db->prepare("SELECT * FROM Utilizatori WHERE ID_User=?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public function create(array $d) {
        $st = $this->db->prepare(
          "INSERT INTO Utilizatori (username,password_hash,Role)
           VALUES (?,?,?)");
        $st->execute([
          $d['username'],
          password_hash($d['password'], PASSWORD_DEFAULT),
          $d['role']
        ]);
    }

    public function update(int $id,array $d) {
        $sql = "UPDATE Utilizatori SET username=?, Role=?";
        $args = [$d['username'],$d['role']];
        if (!empty($d['password'])) {
            $sql .= ", password_hash=?";
            $args[] = password_hash($d['password'], PASSWORD_DEFAULT);
        }
        $sql .= " WHERE ID_User=?";
        $args[] = $id;
        $st=$this->db->prepare($sql);
        $st->execute($args);
    }

    public function delete(int $id) {
        $this->db->prepare("DELETE FROM Utilizatori WHERE ID_User=?")
                 ->execute([$id]);
    }

    public function findByUsername(string $u) {
        $st=$this->db->prepare("SELECT * FROM Utilizatori WHERE username=?");
        $st->execute([$u]);
        return $st->fetch();
    }
}