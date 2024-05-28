<?php

class Database
{
  var $host = '127.0.0.1';
  var $user = 'root';
  var $pass = '';
  var $db = 'hacktiv';

  public $connection = null;

  function __construct()
  {
    $mysqli = new mysqli($this->host, $this->user, '', $this->db);

    if ($mysqli->connect_errno) {
      throw new RuntimeException('mysqli connection error: ' . $mysqli->connect_error);
    }

    $this->connection = $mysqli;
  }

  public function getPortofolio()
  {
    return $this->connection->query("SELECT * FROM portofolio");
  }

  public function checkPortofolioExist($email)
  {
    return $this->connection->query("SELECT * FROM portofolio where email = '$email'")->num_rows;
  }

  public function insert($data)
  {
    $this->connection->query("INSERT INTO portofolio (name, role, availability, age, location, experience, email) VALUES ('{$data['name']}', '{$data['role']}', '{$data['availability']}', {$data['age']}, '{$data['location']}', {$data['experience']}, '{$data['email']}')");
  }
  public function update($data)
  {
    $this->connection->query("
      UPDATE portofolio
      SET
        name = '{$data['name']}',
        role = '{$data['role']}',
        availability = '{$data['availability']}',
        age = '{$data['age']}',
        location = '{$data['location']}',
        experience = '{$data['experience']}',
        email = '{$data['email']}'
      WHERE
        email = '{$data['email']}'
      ");
  }
}
