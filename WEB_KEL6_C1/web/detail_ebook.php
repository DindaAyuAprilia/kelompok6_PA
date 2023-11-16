<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
// Mengimpor header.php untuk bagian header halaman.
require 'header.php';
    

// Memeriksa apakah judul buku diberikan
if (!isset($_GET['judul'])) {
    header('location: index.php');
    exit();
}

$judul = mysqli_real_escape_string($con, $_GET['judul']);
$query = "SELECT * FROM ebook WHERE judul = '$judul'";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);

?>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Detail Buku: <?php echo $row['judul']; ?></title>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
<?php
    // Mengimpor style utama
    require 'style_index.php';
?>

<?php
    // Mengimpor style utama
    require 'style_detail.php';
?>

</style>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
<body>

<?php
// Mengimpor navbar.php untuk bagian navbar
require 'navbar.php';
?>

<section id="book-detail">
    <div class="books-header">
        <div class="book-detail-container">

            <!-- Menampilkan data buku -->
            <div class="book-detail-left">
                <img src="<?php echo $row['cover']; ?>" alt="Book Cover" class="book-cover">
            </div>
            <div style="text-align: left;" class="book-detail-right">
                <h2><?php          echo $row['judul']; ?></h2>
                <p>Author:   <?php echo $row['penulis']; ?></p>
                <p>Genre :   <?php echo $row['genre']; ?></p>
                <p>Pages :   <?php echo $row['halaman']; ?></p>
                <p>Price : Rp<?php echo $row['harga']; ?></p>
                <p>Description: <br><br>
                     <?php echo nl2br($row['deskripsi']); ?></p>
                
                     <?php
                     if(isset($_SESSION['email'])){
                
                        // Cek data buku, apakah sudah di beli atau belum
                        $checkStatusQuery = "SELECT * FROM checkout WHERE email = '{$_SESSION['email']}' AND judul = '$judul'";
                        $checkStatusResult = mysqli_query($con, $checkStatusQuery);

                        // Cek datanya apakah ada 
                        if ($checkStatusResult && mysqli_num_rows($checkStatusResult) > 0) {
                            $statusRow = mysqli_fetch_assoc($checkStatusResult);

                            if ($statusRow['status'] == 'Sudah Dibeli') {
                                
                                // Menampilkan check nox
                                echo '<p style="font-size:20px;color:green"> <input type="checkbox" disabled checked> This book has already been purchased.</p>';
                            } else {
                                // Jika belum di beli, bisa di tambahkan ke keranjang
                                echo '<form action="keranjang.php" method="post">
                                        <input type="hidden" name="judul" value="' . $row['judul'] . '">
                                        <button type="submit" name="action" value="tambah">Tambah ke Keranjang</button>
                                    </form>';
                            }
                        } else {
                            // Jika belum di beli, bisa menambahkan ke keranjang
                            echo '<form action="keranjang.php" method="post">
                                    <input type="hidden" name="judul" value="' . $row['judul'] . '">
                                    <button type="submit" name="action" value="tambah">Tambah ke Keranjang</button>
                                </form>';
                        }

                    }

                    else {
                        // Jika belum di beli, bisa menambahkan ke keranjang
                        echo '<form action="keranjang.php" method="post">
                        <input type="hidden" name="judul" value="' . $row['judul'] . '">
                        <button type="submit" name="action" value="tambah">Tambah ke Keranjang</button>
                    </form>';
                    }
                    ?>
            </div>
            
        </div>
    </div>
</section>


</body>
</html>