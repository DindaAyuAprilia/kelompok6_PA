<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website-->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';

    // Jika sudah login atau sesi email sudah di mulai
    if(isset($_SESSION['email'])){
        header('location:read_ebook.php');
    }

?>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Registrasi</title>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
/* Style untuk proses yang berkaitan dengan akun */
<?php
    require 'style_daftar.php';
?>
</style>

</head>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
<body>
    <div class="form">
        <div class="form-container">
            <h2> Registration </h2><hr>
            
            <form method="post" enctype="multipart/form-data">
                <input type="text"      name="name"      placeholder="Enter your name"           class="textfield" required>
                <input type="email"     name="email"     placeholder="Enter your email"          class="textfield" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}" required>
                <input type="tel"       name="contact"   placeholder="Enter your phone number"   class="textfield" pattern="(\+?628|08)[0-9]{9,13}"     title="Nomor ponsel harus di awali 08 atau +628 dan jumlahnya antara 11 - 15 nomor" required>
                <input type="password"  name="password"  placeholder="Enter your password"       class="textfield" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Password harus memiliki minimal 8 karakter, setidaknya satu angka, dan satu huruf besar" autocomplete="off" required>
                <input type="password"  name="cpassword" placeholder="Confrim your password"     class="textfield" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Password harus memiliki minimal 8 karakter, setidaknya satu angka, dan satu huruf besar" autocomplete="off" required>
                <label for="profile_picture">Profile Picture:</label><br>
                <input type="file"      name="profile_picture" accept="image/*" required> <br>
                <button type="submit"   name="register" class="login-btn">Registration Now</button>
            </form>
            <div>Do you have an account? <a href="login.php">Sign In</a></div>
        </div>
    </div>

<!-- Penjelasan -->
<!-- 1. type inputan : sesuai inputan yang di minta -->
<!-- 2. name inputan : identitas inputan -->
<!-- 3. class inputan: style inputan -->
<!-- 4. placeholder  : tulisan penjelas pada inputan -->
<!-- 5. pattren      : kondisi untuk string, seperti batas panjang karakter dan karakter apa yang boleh di masukan -->
<!-- 6. title        : memberitahu informasi yang di sediakan saat inputan di hover -->
<!-- 7. requierd     : inputan wajib di isi -->

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [5] Proses Registrasi -->
<?php

// Jika tombol submit di tekan, maka akan menjalankan proses berikut
if (isset($_POST['register'])) {


// ____________________________________________________________________________________________________________//
//                                             PROSES REGISTRASI                                               //
// ____________________________________________________________________________________________________________//

//  [1] Memuat Direktori untuk mengunggah berkas gambar profil pengguna
    $uploadDir = 'profile/';

    // Membuat direktori "profile" jika belum ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Penjelasan //
    // 1. is_dir : untuk melihat kondisi path ke direktori ada atau tidak
    // 2. mkdir  : make direktori path jika belum ada di mana 0777 artinya mempunyai hak akses penuh pada pengguna(read, write, dan execute)
   
    
// ____________________________________________________________________________________________________________//
//  [2] Pemeriksaan Kesalahan saat Upload Gambar

    // Membuat batasan tipe file gambar yang bisa masuk
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Memeriksa kesalahan jika ada gambar yang di upload dan terdapat error
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        
        // Mengambil nama asli dari berkas yang diunggah
        $originalFileName = $_FILES['profile_picture']['name'];

        // Menggunakan fungsi pathinfo() untuk mendapatkan ekstensi berkas dari nama berkas
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Memeriksa apakah ekstensi berkas diizinkan
        if (in_array(strtolower($extension), $allowedExtensions)) {
            
            // Membuat nama berkas baru dengan format "Y-m-d [ekstensi]".
            $newFileName = date("Y-m-d H-i-s") . "." . $extension;

            // Menggabungkan direktori tujuan unggah dengan nama berkas baru.
            $uploadFile = $uploadDir . $newFileName;

            // Memindahkan berkas gambar profil ke direktori yang ditentukan.
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
                // Berkas berhasil diunggah, menyimpan jalur berkas di database.
                $profilePicturePath = $uploadFile;
            } 
            
            // Jika gagal menyimpan gambar ke direktori
            else {
                ?>
                <script>
                    window.alert("Terjadi Kesalahan Saat Mengunggah File!");
                </script>
                <meta http-equiv="refresh" content="0;url=signup.php" />
                <?php
                exit();
            }
        } 
        
        // Jika bukan tipe file yang di izinkan
        else {
            ?>
                <script>
                    window.alert("Jenis berkas tidak diizinkan. Hanya file .jpg, .jpeg, dan .png yang diizinkan...");
                </script>
                <meta http-equiv="refresh" content="0;url=signup.php" />
                <?php
                exit();
        }
    } 
    
    // Jika terjadi kesalahan saat mengupload gambar
    else {
        ?>
            <script>
                window.alert("Terjadi Kesalahan Saat Mengunggah File!");
            </script>
            <meta http-equiv="refresh" content="0;url=signup.php" />
        <?php
        exit();
    }

// ____________________________________________________________________________________________________________//
//  [3] Pemeriksaan masukan email dan nama

    // Mendapatkan dan membersihkan data nama
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

    // Mendapatkan dan membersihkan data email.
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    // Penjelasan //
    // 1. mysqli_real_escape_string : agar inputan dari bahasa sql tidak akan terbaca
    // 2. htmlspecialchars          : agar inputan yang mengandung karakter html tidak terbaca
    // 3. end_qoutes                : membaca inputan di antara tanda petik '' atau ""
    // 4. UTF-8                     : menentukan karakter encoding yang di gunakan

// ____________________________________________________________________________________________________________//
//  [4] Pemeriksaan Kesalahan saat Memasukan Password
    
    // Mendapatkan dan membersihkan data password
    $password  = mysqli_real_escape_string($con, $_POST['password']);
    $password  = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $cpassword = htmlspecialchars($cpassword, ENT_QUOTES, 'UTF-8');

    if ($password != $cpassword) {
        ?>
            <script>
                window.alert("Kata sandi yang di masukan dan konfirmasi kata sandi tidak sama, harap sesuaikan...");
            </script>
            <meta http-equiv="refresh" content="0;url=signup.php" />
        <?php
        exit();
    }

    // Hash kata sandi sebelum menyimpannya di database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ____________________________________________________________________________________________________________//
//  [5] Pemeriksaan Kesalahan saat Memasukan Nomor Ponsel

    // Mendapatkan data kontak dari inputan
    $contact = $_POST['contact']; 
    
    // Melakukan query untuk memeriksa apakah kontak sudah ada dalam database
    $sql = "SELECT * FROM users WHERE contact = '$contact'";
    $result = mysqli_query($con, $sql) or die("Error Querry: " . mysqli_error($con));;

    // Jika kontak sudah ada
    if (mysqli_num_rows($result) > 0) {
        ?>
            <script>
                window.alert("Kontak ini sudah terdaftar, haraf masukan kontak lain....");
            </script>
            <meta http-equiv="refresh" content="0;url=signup.php" />
        <?php
        exit();
    }

    // Penjelasan //
    // 1. mysqli_query                 : mengeksekusi atau menjalankan perintah sql dan menyimpan hasilnya
    // 2. mysqli_num_rows($result) > 0 : melihat apakah setidaknya berisi satu baris hasil


// ____________________________________________________________________________________________________________//
//  [6] Memasukan data ke databse

    // Mengeksekusi kueri untuk memeriksa apakah email sudah ada di database.
    $duplicate_user_query  = "SELECT id FROM users WHERE email = '$email'";
    $duplicate_user_result = mysqli_query($con, $duplicate_user_query) or die("Error Querry: " . mysqli_error($con));
    $rows_fetched          = mysqli_num_rows($duplicate_user_result);

    // Jika email sudah ada
    if ($rows_fetched > 0) {
        echo "<script>alert('Email sudah ada dalam database kami!');</script>";
        ?>
            <script>
                window.alert("Email sudah ada di database kami! Harap masukan email yang lain...");
            </script>
            <meta http-equiv="refresh" content="0;url=signup.php" />
        <?php
        exit();
    } 
    
    else {
        // Mengeksekusi kueri untuk menambahkan pengguna baru ke database.
        $user_registration_query = "INSERT INTO users (name, email, password, contact, profile_picture) 
        VALUES ('$name', '$email', '$hashedPassword', '$contact', '$profilePicturePath')";

        $user_registration_result = mysqli_query($con, $user_registration_query) or die("Error Querry: " . mysqli_error($con));
        ?>
            <script>
                window.alert("Registrasi berhasil!");
            </script>
            <meta http-equiv="refresh" content="0;url=login.php" />
        <?php
        exit();

        // Penjelasan, content : pengarahan halaman
    }
}
// ____________________________________________________________________________________________________________//

?>

</body>

</html>




