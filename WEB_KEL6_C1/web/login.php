<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website-->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';

    // Jika Session Sudah di mulai
    if(isset($_SESSION['email'])){
        header('location:index.php');
    }
?>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Login</title>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>

/* Style untuk proses yang berkaitan dengan akun */
<?php
    require 'style_daftar.php';
?>
</style>

</head>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
<body>
    <div class="form">
        <div class="form-container">
            <h1>Login</h1><hr>
            <form method="post">
                <input type="email"     name="email"    placeholder="Enter your email"     class="textfield" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}" required>
                <input type="password"  name="password" placeholder="Enter your password"  class="textfield" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Password harus memiliki minimal 8 karakter, setidaknya satu angka, dan satu huruf besar" autocomplete="off" required>
                <button type="submit"   name="login"    class="login-btn">Login</button>
            </form>
            <div>Don't have an account yet? <br> <a href="signup.php">Sign Up</a></div>
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

<?php
// ____________________________________________________________________________________________________________//
//                                             PROSES LOGIN                                                    //
// ____________________________________________________________________________________________________________//

// Jika tombol login di klik akan mengarahkan ke proses loginS
if (isset($_POST['login'])) {

    // Mengambil inputan email dan password
    $email    = mysqli_real_escape_string($con, $_POST['email']);        
    $password = mysqli_real_escape_string($con, $_POST['password']); 

    // Querry untuk melihat data email
    $user_authentication_query = "SELECT id, email, password FROM users WHERE email='$email'";  
    $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con)); 

    // Jika tidak ada pengguna yang ditemukan, tampilkan pesan kesalahan dan arahkan kembali ke halaman login.
    if (mysqli_num_rows($user_authentication_result) == 0) {
        ?>
            <script>
                window.alert("Nama Gmail anda salah");
            </script>
            <meta http-equiv="refresh" content="0;url=login.php" />
        <?php
        exit();
    } 
    
    // Jika ada pengguna yang ditemukan
    else {
        // Mengambil nilai password dari baris yang ditemukan
        $row = mysqli_fetch_array($user_authentication_result);
        $hashedPassword = $row['password'];

        // Mengeccek apakah passwoed sama
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['email'] = $email;      // Menyimpan alamat email pengguna dalam sesi.
            $_SESSION['id']    = $row['id'];  // Menyimpan ID pengguna dalam sesi.

            // Jika email sesuai dengan email admin, alihkan ke halaman list book
            if ($email === $adminEmail) {
                ?>
                    <script>
                        window.alert("Login berhasil, selamat datang Admin");
                    </script>
                    <meta http-equiv="refresh" content="0;url=read_ebook.php" />
                <?php
                exit();
            } 
            
            // Jika email user akan masuk ke index.php
            else {
                ?>
                <script>
                    window.alert("Login berhasil, selamat datang!");
                </script>
                <meta http-equiv="refresh" content="0;url=index.php" />
                <?php 
                exit();
            }
        } 
        
        // Jika terjadi kesalahan pasword tidak sama dengan yang ada di database
        else {
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

// Penjelasan //
    // 1. mysqli_query                 : mengeksekusi atau menjalankan perintah sql dan menyimpan hasilnya
    // 2. mysqli_num_rows($result)     : melihat apakah ada baris hasil
    // 3. content                      : pengarahan halaman
?>

</body>

</html>

