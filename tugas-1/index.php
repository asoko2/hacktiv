<?php
session_start();

require "./db_conn.php";
require "./Portofolio.php";

//Get Data from DB

$db = new Database();
$query = $db->getPortofolio();

$portofolioExist = false;

if ($query->num_rows > 0) {
  $result = $query->fetch_assoc();
  $portofolio = new Portofolio($result['name'], $result['role'], $result['age'], $result['availability'], $result['location'], $result['email'], $result['experience']);
  $portofolioExist = true;
}

if (isset($_GET['edit']) && $_GET['edit'] == "true") {
  $editPortofolio = array(
    'name' => $_SESSION['name'],
    'role' => $_SESSION['role'],
    'availability' => $_SESSION['availability'],
    'age' => $_SESSION['age'],
    'location' => $_SESSION['location'],
    'experience' => $_SESSION['experience'],
    'email' => $_SESSION['email'],
  );
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Profil Saya</title>
  <!-- 1 Masukkan meta name habis itu ke style.css-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <!-- <nav>
    <div class="menu-mobile">
      <a href="#">Menu</a>
    </div>
    <ul>
      <li><a href="/">HOME</a></li>
      <li><a href="#">PRODUCT</a></li>
      <li><a href="#">GALLERY</a></li>
      <li><a href="#">BLOG</a></li>
      <li><a href="#">INVENTORY</a></li>
    </ul>
  </nav> -->

  <section id="box-profile" class="container">
    <div class="img-profile">
      <img
        src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
    </div>
    <div class="description">
      <div id="description-data">
        <h1><?php echo $portofolio->name ?? '-'; ?></h1>
        <p class="text-gray"><?php echo $portofolio->role ?? '-'; ?></p>
      </div>
      <div id="description-action">
        <form action="action.php" method="POST">
          <input type="hidden" name="edit" value="true" />
          <input type="hidden" name="email" value="<?php echo $portofolio->email ?? '' ?>" />
          <input type="submit" class="button bg-blue" value="Edit" <?php if (!$portofolioExist)
            echo 'disabled' ?>>
          </form>
          <a href="#" class="button border-green">Resume</a>
        </div>
      </div>
      <div class="information">
        <div class="data">
          <p class="field">Availability</p>
          <p class="text-gray"><?php echo $portofolio->availability ?? '-'; ?></p>
      </div>
      <div class="data">
        <p class="field">Usia</p>
        <p class="text-gray"><?php echo $portofolio->age ?? '-'; ?></p>
      </div>
      <div class="data">
        <p class="field">Lokasi</p>
        <p class="text-gray"><?php echo $portofolio->location ?? '-'; ?></p>
      </div>
      <div class="data">
        <p class="field">Pengalaman</p>
        <p class="text-gray"><?php echo $portofolio->experience ?? '-'; ?></p>
      </div>
      <div class="data">
        <p class="field">Email</p>
        <p class="text-gray"><?php echo $portofolio->email ?? '-'; ?></p>
      </div>
    </div>
  </section>

  <section id="input-form" class="container">
    <form method="POST" action="action.php">
      <div class="form">
        <label>Nama</label>
        <input type="text" name="nama" placeholder="masukkan nama anda" required
          value="<?php echo $editPortofolio['name'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Role</label>
        <input type="text" name="role" required
        value="<?php echo $editPortofolio['role'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Availability</label>
        <input type="text" name="availability" required
        value="<?php echo $editPortofolio['availability'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Usia</label>
        <input type="number" name="usia" required
        value="<?php echo $editPortofolio['age'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Lokasi</label>
        <input type="text" name="lokasi" required
        value="<?php echo $editPortofolio['location'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Years Experience</label>
        <input type="number" name="pengalaman" required
        value="<?php echo $editPortofolio['experience'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Email</label>
        <input type="email" name="email" required
        value="<?php echo $editPortofolio['email'] ?? '' ?>">
      </div>
      <div class="form">
        <input type="submit" name="submit" value="SUBMIT" class="bg-green">
      </div>
    </form>
  </section>
</body>

</html>