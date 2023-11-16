<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Session di akhiri jika ada -->
<?php
    // Mengakhiri sesi
    session_start();
    session_unset();
    session_destroy();
?>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Header Website-->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';
?>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Title Website -->
<title>Login</title>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Style Website -->
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
            <h1>Logout</h1><hr>
            
            <p style="color: white; font-size: 30px; text-align:center" >You have Been logout, please visit us again later!</p>
        </div>
    </div>

    <meta http-equiv="refresh"  content="3;url=index.php" />
</body>
</html>