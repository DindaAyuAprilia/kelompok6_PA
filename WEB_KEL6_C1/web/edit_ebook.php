<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';

    // Jika bukan admin
    if($_SESSION['email'] !== $adminEmail) {
        header('location:index.php');
    }


    // Mendapatkan judul buku dari parameter URL
    $judul = urldecode($_GET['judul']);
?>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Update</title>

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
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Form untuk menambah data buku baru -->
    <form method="post" enctype="multipart/form-data">
        <h1>Edit Buku</h1>

        <!-- Ubah Cover -->
        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" name="cover" accept="image/*">
        </div>

        <!-- Ubah Harga -->
        <div class="form-group">
            <label for="harga">Harga Buku</label>
            <input type="number" name="harga" min="10000" max="999999999" title="Harga setidaknya terdiri dari 5-9 angka" required>
        </div>


        <!-- Submit -->
        <div class="form-group">
        <button type="submit" name="ubah">Edit Buku</button>
        </div>
    </form>

<!-- Penjelasan -->
<!-- 1. min dan max    : sebagai pembatas jumlah inputan -->
<!-- 2. accept image/* : agar di file hanya bisa muncul image -->
<!-- 3. require        : harus di isi -->
<!-- 4. title          : pesan yang muncul saat inputan di hover -->


<?php
// ____________________________________________________________________________________________________________//
//                                         PROSES UBAH BUKU                                                    //
// ____________________________________________________________________________________________________________//

if (isset($_POST['ubah'])) {

// [1] Memuat Direktori untuk mengunggah berkas gambar cover pengguna
    $uploadDir = 'cover/';

    // Membuat direktori "cover" jika belum ada.
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
    $gambar_query  = "SELECT cover FROM ebook WHERE judul = '$judul'";
    $gambar_result = mysqli_query($con, $gambar_query);
    $gambar_row    = mysqli_fetch_assoc($gambar_result);
    $gambar        = $gambar_row['cover'];

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
            $judul = urldecode($_GET['judul']);

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
// [5] Mencocokan data dan memasukan data ke dalam database

    // Melakukan pembaruan harga
    $harga   = $_POST['harga'];
    $update_harga_query      = "UPDATE ebook SET harga='$harga' WHERE judul='$judul'";
    // Melakukan pembaruan harga
    $update_harga_result = mysqli_query($con, $update_harga_query) or die(mysqli_error($con));
    
    if (isset($cover)) {
        // Jika ada jalur gambar profil yang ditentukan, update juga jalur gambar cover
        $update_cover_query     = "UPDATE ebook SET cover='$cover' WHERE judul='$judul'";
        mysqli_query($con, $update_cover_query) or die(mysqli_error($con));
    }

    // Menampilkan pesan sukses dan mengarahkan ke halaman lain setelah perbaruan data berhasil.
    ?>
    <script>
        window.alert("Data telah diperbarui");
    </script>
    <meta http-equiv="refresh" content="0;url=read_ebook.php" />
    <?php
    exit();
        
}
    
      
    
    ?>
    
    </body>
    
    </html>
    
    