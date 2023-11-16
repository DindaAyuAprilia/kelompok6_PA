
<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';
?>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Data Buku</title>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>

<?php
    // Mengimpor style utama
    require 'style_index.php';
?>


</style>

</head>

<!-- --------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
<body>

<?php
    // Mengimpor navbar.php untuk bagian navbar
    require 'navbar.php';

    // Mengakses cover
    require 'cover.php';

    // Mengecek apakah sebelumnya meng-submit search
    if (isset($_GET['search'])) {

        // Mengambil dan membersihkan variabel search
        $search = mysqli_real_escape_string($con, $_GET['search']);
        $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');

        // Mencari pada databse untuk judul yang memuat inputan search
        $query = "SELECT * FROM ebook WHERE judul LIKE '%$search%'";
        $result = mysqli_query($con, $query);

        // Jika di temukan hasil
        if (mysqli_num_rows($result) > 0) {
            ?>

            <!-- Menampilkan Buku -->
            <section id="books">

                <!-- Menampilkan header hasil pencarian -->
                <div class="books-header">
                    <h1 style="color: antiquewhite;" >Search Results for "<?php echo $search; ?>"</h1>
                </div>

                <!-- Menampilkan isi bukunya -->
                <div class="books-list">
                    <?php
                    // Loop untuk semua baris yang sudah di simpan dalam array
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <div class="book-item">
                            <img src="  <?php echo $row['cover'  ]; ?>" alt="Book Cover">
                            <h2>        <?php echo $row['judul'  ]; ?></h2>
                            <p>Author:  <?php echo $row['penulis']; ?></p>
                            <p>Genre:   <?php echo $row['genre'  ]; ?></p>
                            <p>Pages:   <?php echo $row['halaman']; ?></p>
                            <p>Price: Rp<?php echo $row['harga'  ]; ?></p>

                            <!-- Jika masuk sebagai admin, tombol akan berupa tombol edit -->
                            <?php
                            if (isset($_SESSION['email']) && $_SESSION['email'] === $adminEmail) {
                                ?>
                                <a href="edit_ebook.php?judul=<?php echo urlencode($row['judul']); ?>">Edit</a>
                                <?php
                            } 
                            
                            // Jika sebagai user biasa, tombol akan berupa tombol detail
                            else {
                                ?>
                                <a href="detail_ebook.php?judul=<?php echo urlencode($row['judul']); ?>">Detail</a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                            }
                        ?>
                </div>
            </section>
            
            <?php
        } 
        
        // Jika tidak ada buku yang di temukan
        else {
            ?>
                <script>
                    window.alert("Tidak ada data yang di temukan!");
                </script>
                <meta http-equiv="refresh" content="0;url=read_ebook.php" />
            <?php
            exit();
            
        }
    } 
    
    // Jika belum ada yang di search
    else {
        ?>
            <script>
                window.alert("Tidak ada inputan yang di masukan");
            </script>
            <meta http-equiv="refresh" content="0;url=read_ebook.php" />
        <?php
        exit();
    }

    // Penjelasan //
    // 1. mysqli_real_escape_string    : agar inputan dari bahasa sql tidak akan terbaca
    // 2. htmlspecialchars             : agar inputan yang mengandung karakter html tidak terbaca
    // 3. end_qoutes                   : membaca inputan di antara tanda petik '' atau ""
    // 4. UTF-8                        : menentukan karakter encoding yang di gunakan
    // 5. mysqli_query                 : mengeksekusi atau menjalankan perintah sql dan menyimpan hasilnya
    // 6. mysqli_num_rows($result) > 0 : melihat apakah setidaknya berisi satu baris hasil
    // 7. urlencode                    : menambah text pada link
    // 8. mysqli_fetch_assoc           : menyimpan hasil satu baris sebagai asosiastif array
    ?>


</body>
</html>



