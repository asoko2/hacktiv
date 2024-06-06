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
  <script src="https://cdn.tailwindcss.com"></script>
  <style type="text/tailwindcss">
    .container {
      @apply flex gap-4 justify-between w-full p-4 items-center bg-white rounded shadow-sm mb-8
    }

    .button {
      @apply px-3 py-2 rounded border
    }

    .data {
      @apply flex gap-4
    }

    .data > p {
      @apply flex-auto justify-start
    }
    
    .data > p:first-child{
      @apply w-1/3
    }

    .data > p:last-child{
      @apply w-2/3 text-gray-500
    }

    .form {
      @apply w-full flex flex-col gap-2 mb-4
    }

    .input {
      @apply border border-slate-500 px-3 py-2 rounded
    }
  </style>
</head>

<body class="px-48 bg-slate-100 font-sans">
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
    <div class="img-profile flex flex-auto">
      <img class="w-36" src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
    </div>
    <div class="description flex-auto w-4/12">
      <div id="description-data" class="mb-4">
        <h1 class="text-3xl font-bold"><?php echo $portofolio->name ?? '-'; ?></h1>
        <p class="text-sm text-gray-500"><?php echo $portofolio->role ?? '-'; ?></p>
      </div>
      <div id="description-action" class="flex gap-4">
        <form action="action.php" method="POST">
          <input type="hidden" name="edit" value="true" />
          <input type="hidden" name="email" value="<?php echo $portofolio->email ?? '' ?>" />
          <input type="submit" class="button bg-blue-500 hover:bg-blue-700 text-white cursor-pointer" value="Edit" <?php if (!$portofolioExist) echo 'disabled' ?>>
        </form>
        <a href="#" class="button border-green-700 text-green-700 hover:bg-slate-100">Resume</a>
      </div>
    </div>
    <div class="information flex-auto w-5/12 border-l border-slate-300 pl-4 h-full">
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
    <form method="POST" action="action.php" class="w-full">
      <div class="form">
        <label>Nama</label>
        <input class="input" type="text" name="nama" placeholder="masukkan nama anda" required value="<?php echo $editPortofolio['name'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Role</label>
        <input class="input"  type="text" name="role" required value="<?php echo $editPortofolio['role'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Availability</label>
        <input class="input"  type="text" name="availability" required value="<?php echo $editPortofolio['availability'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Usia</label>
        <input class="input"  type="number" name="usia" required value="<?php echo $editPortofolio['age'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Lokasi</label>
        <input class="input"  type="text" name="lokasi" required value="<?php echo $editPortofolio['location'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Years Experience</label>
        <input class="input"  type="number" name="pengalaman" required value="<?php echo $editPortofolio['experience'] ?? '' ?>">
      </div>
      <div class="form">
        <label>Email</label>
        <input class="input"  type="email" name="email" required value="<?php echo $editPortofolio['email'] ?? '' ?>">
      </div>
      <div class="form">
        <input type="submit" name="submit" value="SUBMIT" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded cursor-pointer">
      </div>
    </form>
  </section>
</body>

</html>