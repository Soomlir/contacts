<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class UserModel extends BaseModel {

  public function getUsers() {
    $query = $this->db->query("SELECT * FROM users");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
