<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
// Mengimpor header.php untuk bagian header halaman.
require 'header.php';

    // Jika bukan admin
    if($_SESSION['email'] !== $adminEmail) {
        header('location:index.php');
    }
    
?>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Create</title>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
<?php
// Mengimpor style utama
require 'style_index.php';
?>

<?php
// Mengimpor style utama
require 'style_create.php';
?>

</style>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
<body>

<?php
    // Mengimpor navbar.php untuk bagian navbar
    require 'navbar.php';
?>

    <!-- Form untuk menambahkan data buku -->
    <form method="post" enctype="multipart/form-data">
        <h1>Tambah Buku</h1>

        <!-- Tambah Cover -->
        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" name="cover" accept="image/*" required>
        </div>

        <!-- Tambah Judul -->
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul"  pattern="{1,100}" required>
        </div>

        <!-- Tambah Nama Penulis -->
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" pattern="{1,100}" required>
        </div>

        <!-- Tambah Genre -->
        <div class="form-group">
            <label for="genre">Genre</label>
            <select name="genre" required>
                <option value="Romance">Romance</option>
                <option value="Aksi"   >Aksi   </option>
                <option value="Komedi" >Komedi </option>
            </select>
        </div>

        <!-- Tambah Jumlah Halaman -->
        <div class="form-group">
            <label for="halaman">Jumlah Halaman</label>
            <input type="number" name="halaman" min="10" max="999" title="Halaman setidaknya terdiri dari 2-3 angka" required>
        </div>

        <!-- Tambah Harga -->
        <div class="form-group">
            <label for="harga">Harga Buku</label>
            <input type="number" name="harga" min="10000" max="999999" title="Harga setidaknya terdiri dari 5-9 angka" required>
        </div>

        <!-- Tambah Deskripsi -->
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" rows="4" cols="50" required></textarea>
        </div>


        <!-- Submit -->
        <div class="form-group">
        <button type="submit"   name="tambah">Tambah Buku</button>
        </div>
    </form>

<!-- Penjelasan -->
<!-- 1. type inputan   : sesuai inputan yang di minta -->
<!-- 2. name inputan   : identitas inputan -->
<!-- 3. class inputan  : style inputan -->
<!-- 4. placeholder    : tulisan penjelas pada inputan -->
<!-- 5. pattren        : kondisi untuk string, seperti batas panjang karakter dan karakter apa yang boleh di masukan -->
<!-- 6. accept image/* : agar di file hanya bisa muncul image -->
<!-- 7. require        : harus di isi -->
<!-- 8. title          : pesan yang muncul saat inputan di hover -->


<?php
// ____________________________________________________________________________________________________________//
//                                         PROSES TAMBAH BUKU                                                  //
// ____________________________________________________________________________________________________________//

if (isset($_POST['tambah'])) {

// [1] Memuat Direktori untuk mengunggah berkas gambar cover pengguna
    $uploadDir = 'cover/';

    // Membuat direktori "cover" jika belum ada.
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
// ____________________________________________________________________________________________________________//

// [2] Pemeriksaan Kesalahan saat Memasukan judul dan nama penlis

    // Mendapatkan dan membersihkan data nama penulis
    $penulis = mysqli_real_escape_string($con, $_POST['penulis']);
    $penulis = htmlspecialchars($penulis, ENT_QUOTES, 'UTF-8');

    // Mendapatkan dan membersihkan data deskripsi
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);
    $deskripsi = htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8');

    // Mendapatkan dan membersihkan data judul
    $judul = mysqli_real_escape_string($con, $_POST['judul']);
    $judul = htmlspecialchars($judul, ENT_QUOTES, 'UTF-8');

    // Melakukan query untuk memeriksa apakah judul sudah ada dalam database
    $sql = "SELECT * FROM ebook WHERE judul = '$judul'";
    $result = mysqli_query($con, $sql);

    // Jika kontak sudah ada
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Judul ini sudah terdaftar. Harap tambahkan karakter lain untuk membedakan...');</script>";
        exit();
    }
// ____________________________________________________________________________________________________________//

// [3] Pemeriksaan Kesalahan saat Upload Gambar

    // Membuat batasan tipe file gambar yang bisa masuk
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $judul = mysqli_real_escape_string($con, $_POST['judul']);

    // Membersihkan judul dari karakter yang tidak diizinkan dalam nama berkas
    $judul = preg_replace("/[^\w\s.,()_-]/", "_", $judul);

    // Memeriksa kesalahan upload gambar
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        
        // Mengambil nama asli dari berkas yang diunggah
        $originalFileName = $_FILES['cover']['name'];

        // Menggunakan fungsi pathinfo() untuk mendapatkan ekstensi berkas dari nama berkas
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);


        // Memeriksa apakah ekstensi berkas diizinkan
        if (in_array(strtolower($extension), $allowedExtensions)) {
            // Mengambil nama asli dari berkas yang diunggah
            
            // Membuat nama berkas baru dengan format ".[ekstensi]".
            $newFileName = $judul . "." . $extension;

            // Mendapatkan dan membersihkan data judul
            $judul = mysqli_real_escape_string($con, $_POST['judul']);
            $judul = htmlspecialchars($judul, ENT_QUOTES, 'UTF-8');


            // Menggabungkan direktori tujuan unggah dengan nama berkas baru.
            $uploadFile = $uploadDir . $newFileName;

            // Maksimum ukuran berkas (dalam byte)
            $maxFileSize = 5 * 1024 * 1024; // Contoh untuk 5 MB

            if ($_FILES['cover']['size'] > $maxFileSize) {
                ?>
                    <script>
                        window.alert("Ukuran file terlalu besar...");
                    </script>
                    <meta http-equiv="refresh" content="0;url=edit_ebook.php" />
                <?php
                exit();
            }

            // Memindahkan berkas cover ke direktori yang ditentukan.
            if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadFile)) {
                // Berkas berhasil diunggah, menyimpan jalur berkas di database.
                $cover = $uploadFile;
            } 
            
            else {
                ?>
                    <script>
                        window.alert("Terjadi kesalahan saat mengunggah foto...");
                    </script>
                    <meta http-equiv="refresh" content="0;url=edit_ebook.php" />
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
                <meta http-equiv="refresh" content="0;url=edit_ebook.php" />
            <?php
            exit();
        }
    } 

    elseif ($_FILES['cover']['error'] === UPLOAD_ERR_NO_FILE) {
        // Jika tidak ada gambar yang diunggah, set foto cover ke foto default
        $cover = $gambar; 
    }
    
    // Jika terjadi kesalahan saat mengupload gambar
    else {
        ?>
            <script>
                window.alert("Terjadi kesalahan saat mengunggah foto...");
            </script>
            <meta http-equiv="refresh" content="0;url=edit_ebook.php" />
        <?php
        exit();
    }

    
// ____________________________________________________________________________________________________________//

// [4] Memasukan data ke databse

    $genre   = $_POST['genre'];
    $halaman = $_POST['halaman'];
    $harga   = $_POST['harga'];

    // Mengeksekusi kueri untuk memeriksa apakah judul sudah ada di database.
    $duplicate_user_query  = "SELECT id FROM ebook WHERE judul = '$judul'";
    $duplicate_user_result = mysqli_query($con, $duplicate_user_query) or die(mysqli_error($con));
    $rows_fetched          = mysqli_num_rows($duplicate_user_result);

    // Jika judul sudah ada
    if ($rows_fetched > 0) {
        echo "<script>alert('Judul sudah ada dalam database kami!');</script>";
        ?>
        <meta content="1;url=create_ebook.php" />
        <?php
        exit();
    } 
    
    else {
        // Mengeksekusi kueri untuk menambahkan pengguna baru ke database.
        $user_ebook_query = "INSERT INTO ebook (judul, penulis, harga, genre, halaman, penjualan, cover, deskripsi) 
        VALUES ('$judul', '$penulis', '$harga', '$genre', '$halaman', '', '$cover', '$deskripsi')";


        $user_ebook_result = mysqli_query($con, $user_ebook_query) or die(mysqli_error($con));
        ?>

        <script>alert('Buku berhasil di tambahkan!');</script>
        <meta http-equiv="refresh" content="0;url=read_ebook.php" />
        <?php
    }
}
// ____________________________________________________________________________________________________________//

?>


</body>
</html>
