<?php
require "Database.php";
class BaseModel
{
  protected $db;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database;
  }

  public function prepare($sql)
  {
    return $this->db->prepare($sql);
  }
}
