<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
// Mengimpor header.php untuk bagian header halaman.
require 'header.php';

if(!isset($_SESSION['email'])){
    header('location:login.php');
}
?>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Profile</title>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
<?php
    // Mengimpor style utama
    require 'style_index.php';
?>

/* Tambahan stye untuk menampilkan profile */

.form {
    width: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 35px;
    border-radius: 10px;
    z-index: 1;
    margin-top: 50px;
    
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}


.form-container {
    background-color: rgba(0, 0, 0, 0.9); 
    padding: 20px;
    border-radius: 10px;
    text-align: center; 
}

h1 {
    color: #fff;
    margin-bottom: 20px; 
    font-size: 2.5em; 
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
}


.controls {
    display: flex;
    flex-direction: column;
    align-items: center;
}

p {
    color: #ffffff;
    margin-bottom: 10px;
}
</style>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Mengakses data untuk di tampilkan -->
<?php
    $uploadDir = 'profile/';

    // Membuat direktori "uploads" jika tidak ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Redirect ke halaman login jika pengguna tidak masuk
    if (!isset($_SESSION['email'])) {
        header('location: login.php'); 
    }

    // Mengambil data pengguna dari database berdasarkan email pengguna yang masuk
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

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
    }

    // Mengatur jalur gambar profil pengguna
    $profilePicturePath = $user['profile_picture'];

    // Penjelasan //
    // 1. is_dir             : untuk melihat kondisi path ke direktori ada atau tidak
    // 2. mkdir              : make direktori path jika belum ada di mana 0777 artinya mempunyai hak akses penuh pada pengguna(read, write, dan execute)
    // 3. if($result)        : mengecek jika ada data yang di temukan setelah perintah di eksekusi
    // 4. mysqli_fetch_assoc : menyimpan hasil satu baris sebagai asosiastif array
?>


</head>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [5] Body Website -->
<body>

<?php
    // Mengimpor navbar.php untuk bagian navbar
    require 'navbar.php';
?>


<div class="form">
        <div class="form-container">
        <div style="text-align: center;">
            <h1>Profile</h1>
            <div  class="controls">
                <center>
                    <img style="width: 150px; height: 150px; border-radius: 100px" src="<?php echo $profilePicturePath; ?>" alt="Foto Profil">
                    <?php
                        if (empty($profilePicturePath)) {
                            echo "Foto profil tidak ditemukan.";
                        }
                    ?>
                </center>
                
                <p style="color: #ffffff;" ><strong>Name   :</strong> <?php echo $user['name'   ]; ?></p>
                <p style="color: #ffffff;" ><strong>Email  :</strong> <?php echo $user['email'  ]; ?></p>
                <p style="color: #ffffff;" ><strong>Contact:</strong> <?php echo $user['contact']; ?></p>
                <a style="background-color: #ffffff; border: #000000 1px solid; padding: 5px 10px; color: #070606; text-decoration: none; border-radius: 3px; margin: 10px 0px;" href="edit_profile.php">Edit Profile</a>
                
            </div>
        </div>
    </div>
</div>

</body>
</html>
