<?php

session_start();

require "./db_conn.php";

$db = new Database();

if (isset($_POST['edit']) == 'true') {
  $result = $db->getPortofolio()->fetch_assoc();
  $_SESSION['name'] = $result['name'];
  $_SESSION['age'] = $result['age'];
  $_SESSION['role'] = $result['role'];
  $_SESSION['availability'] = $result['availability'];
  $_SESSION['location'] = $result['location'];
  $_SESSION['experience'] = $result['experience'];
  $_SESSION['email'] = $result['email'];
  
  header('Location: index.php?edit=true');
}

if (isset($_POST['nama']) && isset($_POST['role']) && isset($_POST['availability']) && isset($_POST['usia']) && isset($_POST['lokasi']) && isset($_POST['pengalaman']) && isset($_POST['email'])) {

  $data = array(
    'name' => $_POST['nama'],
    'role' => $_POST['role'],
    'availability' => $_POST['availability'],
    'age' => $_POST['usia'],
    'location' => $_POST['lokasi'],
    'experience' => $_POST['pengalaman'],
    'email' => $_POST['email'],
  );

  if ($db->checkPortofolioExist($data['email']) > 0) {
    $db->update($data);
    header('Location: index.php');
  } else {
    $db->insert($data);
    header('Location: index.php');
  }

}