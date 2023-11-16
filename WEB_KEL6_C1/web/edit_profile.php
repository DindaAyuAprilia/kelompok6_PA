<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website-->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';
?>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Login</title>

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
            
            <!-- Mengisi data diri baru -->
            <h1>Edit Profile</h1><hr>
            <form method="post" enctype="multipart/form-data">
                <input type="text"      name="name"        placeholder="Masukan nama baru"           class="textfield" required>
                <input type="tel"       name="contact"     placeholder="Masukan nomor ponsel"        class="textfield" pattern="(\+?628|08)[0-9]{9,13}"     title="Nomor ponsel harus di awali 08 atau +628 dan jumlahnya antara 11 - 15 nomor" required>
                <input type="password"  name="password"    placeholder="Masukan password lama"       class="textfield" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Password harus memiliki minimal 8 karakter, setidaknya satu angka, dan satu huruf besar" autocomplete="off" required>
                <input type="password"  name="newPassword" placeholder="Masukan password baru"       class="textfield" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Password harus memiliki minimal 8 karakter, setidaknya satu angka, dan satu huruf besar" autocomplete="off" required>
                <input type="password"  name="retype"      placeholder="Masukan ulang password baru" class="textfield" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Password harus memiliki minimal 8 karakter, setidaknya satu angka, dan satu huruf besar" autocomplete="off" required>
                <label for="profile_picture">Profile Picture:</label><br>
                <input type="file"      name="profile_picture" accept="image/*"> <br>
                <button type="submit"   name="change" class="login-btn">Ubah</button>  
            </form>
        </div>
    </div>

<!-- Penjelasan -->
<!-- 1. type inputan : sesuai inputan yang di minta -->
<!-- 2. name inputan : identitas inputan -->
<!-- 3. class inputan: style inputan -->
<!-- 4. placeholder  : tulisan penjelas pada inputan -->
<!-- 5. pattren      : kondisi untuk string, seperti batas panjang karakter dan karakter apa yang boleh di masukan -->
<!-- 6. title        : memberitahu informasi yang di sediakan saat inputan di hover -->

<?php
// ____________________________________________________________________________________________________________//
//                                             PROSES EDIT DATA DIRI                                           //
// ____________________________________________________________________________________________________________//

if (isset($_POST['change'])) {

    // Mengambil inputan dan membersihkan inputan jika memiliki querry sql
    $pass           = mysqli_real_escape_string($con, $_POST['newPassword']);
    $cpassword      = mysqli_real_escape_string($con, $_POST['retype'     ]);
    $name           = mysqli_real_escape_string($con, $_POST['name'       ]);
    $contact        = mysqli_real_escape_string($con, $_POST['contact'    ]);
    $newpassword    = mysqli_real_escape_string($con, $_POST['newPassword']);
    
    // Membersihkan inputan untuk karakter html
    $pass           = htmlspecialchars ($pass,        ENT_QUOTES, 'UTF-8');
    $cpassword      = htmlspecialchars ($cpassword,   ENT_QUOTES, 'UTF-8');
    $name           = htmlspecialchars ($name,        ENT_QUOTES, 'UTF-8');
    $contact        = htmlspecialchars ($contact,     ENT_QUOTES, 'UTF-8');
    $newpassword    = htmlspecialchars ($newpassword, ENT_QUOTES, 'UTF-8');

    $email          = $_SESSION['email'];

    // Penjelasan //
    // 1. mysqli_real_escape_string : agar inputan dari bahasa sql tidak akan terbaca
    // 2. htmlspecialchars          : agar inputan yang mengandung karakter html tidak terbaca
    // 3. end_qoutes                : membaca inputan di antara tanda petik '' atau ""
    // 4. UTF-8                     : menentukan karakter encoding yang di gunakan

// ____________________________________________________________________________________________________________//
   
// [1] Membuat Direktori untuk mengunggah berkas gambar profil pengguna
    $uploadDir = 'profile/';

    // Membuat direktori "profile" jika belum ada.
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Penjelasan //
    // 1. is_dir : untuk melihat kondisi path ke direktori ada atau tidak
    // 2. mkdir  : make direktori path jika belum ada di mana 0777 artinya mempunyai hak akses penuh pada pengguna(read, write, dan execute)
// ____________________________________________________________________________________________________________//

// [2] Pemeriksaan Kesalahan saat Upload Gambar

    // Membuat batasan tipe file gambar yang bisa masuk
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Menaruh sementara gambar yang lama
    $gambar_query  = "SELECT profile_picture FROM users WHERE email = '$email'";
    $gambar_result = mysqli_query      ($con, $gambar_query);
    $gambar_row    = mysqli_fetch_assoc($gambar_result);
    $gambar        = $gambar_row       ['profile_picture'];

    // Memeriksa kesalahan upload gambar
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        
        // Hapus gambar profil lama (jika ada)
        $query = "SELECT profile_picture FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        // Mengambil data gambar profil lama dari database berdasarkan alamat email pengguna yang sedang masuk
        if ($row = mysqli_fetch_assoc($result)) {
            $oldProfilePicture = $row['profile_picture'];

            // Memeriksa apakah gambar profil lama ada (file fisiknya ada di server)
            if (file_exists($oldProfilePicture)) {
                // Jika gambar profil lama ada, hapus file gambar tersebut dari server
                unlink($oldProfilePicture);
            }
        }

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
            
            else {
                ?>
                    <script>
                        window.alert("Terjadi kesalahan saat mengunggah foto");
                    </script>
                    <meta http-equiv="refresh" content="0;url=edit_profile.php" />
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
                <meta http-equiv="refresh" content="0;url=edit_profile.php" />
            <?php
            exit();
        }
    } 

    elseif ($_FILES['profile_picture']['error'] === UPLOAD_ERR_NO_FILE) {
        // Jika tidak ada gambar yang diunggah, set foto profil ke foto default
        $profilePicturePath = $gambar; 
    }
    
    // Jika terjadi kesalahan saat mengupload gambar
    else {
        ?>
            <script>
                window.alert("Terjadi kesalahan saat mengunggah foto");
            </script>
            <meta http-equiv="refresh" content="0;url=edit_profile.php" />
        <?php
        exit();

    }

    // Penjelasan //
    // 1. mysqli_query       : mengeksekusi atau menjalankan perintah sql dan menyimpan hasilnya
    // 2. mysqli_num_rows    : melihat apakah setidaknya berisi satu baris hasil
    // 3. mysqli_fetch_assoc : menyimpan hasil satu baris sebagai asosiastif array

// ____________________________________________________________________________________________________________//

// [3] Pemeriksaan Kesalahan saat Memasukan Password

    if ($pass != $cpassword) {
        ?>
        <script>
            window.alert("Kata sandi dan konfirmasi kata sandi yang di masukan tidak sama...");
        </script>
        <meta http-equiv="refresh" content="0;url=edit_profile.php" />
    <?php
        exit(); // Menghentikan eksekusi program
    }

    // Hash kata sandi sebelum menyimpannya di database
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
// ____________________________________________________________________________________________________________//

// [4] Pemeriksaan Kesalahan saat Memasukan Nomor Ponsel

    // Melakukan query untuk memeriksa apakah kontak sudah ada dalam database
    $sql = "SELECT * FROM users WHERE contact = '$contact'";
    $result = mysqli_query($con, $sql);

    // Jika kontak sudah ada
    if (mysqli_num_rows($result) > 0) {
        ?>
            <script>
                window.alert("Nomor kontak ini sudah terdaftar, silahkan masukan nomor lain...");
            </script>
            <meta http-equiv="refresh" content="0;url=edit_profile.php" />
        <?php
        exit();
    }
// ____________________________________________________________________________________________________________//

// [5] Mencocokan data dan memasukan data ke dalam database
    $password                   = mysqli_real_escape_string($con, $_POST['password']);  
    $user_authentication_query  = "SELECT id, email, password FROM users WHERE email='$email'";  
    $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));  // Menjalankan kueri dan menangani kesalahan jika ada.

    // Jika Tidak di temukan data
    if (mysqli_num_rows($user_authentication_result) == 0) {
        ?>
        <script>
            window.alert("Nama email salah");
        </script>
        <meta http-equiv="refresh" content="0;url=edit_profile.php" />
        <?php
        exit();
    } 
    
    // Jika ada datanya
    else {
        $row = mysqli_fetch_array($user_authentication_result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            
            $update_password_query  = "UPDATE users SET password='$hashedPass' WHERE email='$email'";
            $update_name_query      = "UPDATE users SET name    ='$name'       WHERE email='$email'";
            $update_contact_query   = "UPDATE users SET contact ='$contact'    WHERE email='$email'";
            
            // Jika ada jalur gambar profil yang ditentukan, update juga jalur gambar profil.
            if (isset($profilePicturePath)) {
                $update_profile_picture_query = "UPDATE users SET profile_picture='$profilePicturePath' WHERE email='$email'";
                mysqli_query($con, $update_profile_picture_query) or die(mysqli_error($con));
            }
        
            // Melakukan pembaruan data pengguna, termasuk kata sandi baru jika kata sandi lama sesuai.
            $update_password_result = mysqli_query($con, $update_password_query) or die(mysqli_error($con));
            $update_name_result     = mysqli_query($con, $update_name_query)     or die(mysqli_error($con));
            $update_contact_result  = mysqli_query($con, $update_contact_query)  or die(mysqli_error($con));
        
            ?>
            <!-- Menampilkan pesan sukses dan mengarahkan ke halaman lain setelah perbaruan data berhasil. -->
            <script>
                window.alert("Data baru telah diperbarui");
            </script>
            <meta http-equiv="refresh" content="0;url=index.php" />
            <?php
            exit();
        } else {
            // Password tidak cocok, tampilkan pesan kesalahan dan arahkan kembali ke halaman login.
            ?>
            <script>
                window.alert("Kata sandi salah");
            </script>
            <meta http-equiv="refresh" content="0;url=login.php" />
            <?php
            exit();
        }
    }
}

  

?>

</body>

</html>

