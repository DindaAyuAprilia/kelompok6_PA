<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
// Mengimpor header.php untuk bagian header halaman.
require 'header.php';

    // Jika belum login
    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
    

    // Jika bukan admin
    if($_SESSION['email'] !== $adminEmail) {
        header('location:index.php');
    }

?>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Data Akun User</title>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
<?php
    // Mengimpor style utama
    require 'style_index.php';
?>

<?php
    // Mengimpor style tambahan
    require 'style_ReadUser.php';
?>

</style>

</head>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
<body>

<?php
    // Mengimpor navbar.php untuk bagian navbar
    require 'navbar.php';

    // Mengakses profil
    $uploadDir = 'profile/';

    // Membuat direktori "uploads" jika tidak ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query) or die("Error Querry: " . mysqli_error($con));;

    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } 

    else {
        ?>
            <script>
                window.alert("Kesalahan dalam mengambil data pengguna");
            </script>
            <meta http-equiv="refresh" content="0;url=read_ebook.php" />
        <?php
        exit();
    }

    // Mengatur jalur gambar profil pengguna
    $profilePicturePath = $user['profile_picture'];

    // Penjelasan //
    // 1. is_dir             : untuk melihat kondisi path ke direktori ada atau tidak
    // 2. mkdir              : make direktori path jika belum ada di mana 0777 artinya mempunyai hak akses penuh pada pengguna(read, write, dan execute)
    // 3. if($result)        : mengecek jika ada data yang di temukan setelah perintah di eksekusi
    // 4. mysqli_fetch_assoc : menyimpan hasil satu baris sebagai asosiastif array

?>;



<!-- Menampilkan semua data user yang ada -->
<section style="background-color: rgba(0, 0, 0, 0.7);" id="users">
    <div class="users-header">
        <h1 style="color: antiquewhite;" >Daftar Akun User</h1>
        <p>Temukan informasi lengkap tentang akun user di sini.</p>
    </div>

    <div  class="users-list">
        <?php
        // Loop untuk semua baris yang sudah di simpan dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div style="background-color: rgba(0, 0, 0, 0.7);" class="user-item">
                <img src="  <?php echo $row['profile_picture']; ?>" alt="User Profile Picture">
                <h2>        <?php echo $row['name'           ]; ?></h2>
                <p>Email:   <?php echo $row['email'          ]; ?></p>
                <p>Contact: <?php echo $row['contact'        ]; ?></p>
            </div>
            <?php
        }
        ?>
    </div>
</section>

</body>
</html>
