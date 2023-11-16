<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website-->
<?php
// Mengimpor header.php untuk bagian header halaman.
require 'header.php';

// Jika Session belum di mulai
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------
// [2] Memeriksa kondisi keranjang

// Memeriksa apakah aksi keranjang diberikan (tambah, hapus, ubah)
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'tambah':
            tambahKeKeranjang();
            break;
        case 'hapus':
            hapusDariKeranjang();
            break;
        default:
            break;
    }
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------
// [3] Fungsi untuk menambahkan buku ke keranjang
function tambahKeKeranjang(){
    global $con;

    if (isset($_POST['judul'])) {
        $judul = mysqli_real_escape_string($con, $_POST['judul']);
        $email = $_SESSION['email'];

        // Mendapatkan informasi penulis dan harga buku dari tabel ebook
        $infoQuery = "SELECT penulis, harga FROM ebook WHERE judul='$judul'";
        $infoResult = mysqli_query($con, $infoQuery);

        // Cek null dan barisnya
        if ($infoResult && mysqli_num_rows($infoResult) > 0) {
            $bookInfo = mysqli_fetch_assoc($infoResult);
            $penulis  = $bookInfo['penulis'];
            $harga    = $bookInfo['harga'];

            // Memeriksa apakah buku sudah ada di keranjang
            $cekQuery = "SELECT * FROM cart WHERE judul='$judul' AND email='$email'";
            $cekResult = mysqli_query($con, $cekQuery);

            // Cek null dan barisnya
            if ($cekResult && mysqli_num_rows($cekResult) == 0) {

                // Jika buku belum ada di keranjang, tambahkan
                $tambahQuery = "INSERT INTO cart (judul, penulis, harga, email) VALUES ('$judul', '$penulis', '$harga', '$email')";
                $tambahResult = mysqli_query($con, $tambahQuery);

                // Cek apakah ada datanya
                if ($tambahResult) {
                    ?>
                        <script>
                            window.alert("Buku di tambahkan di keranjang");
                        </script>
                        <meta content="0;url=read_ebook.php" />
                    <?php
                } 
                
                // Jika terjadi kesalahan
                else {
                    ?>
                        <script>
                            window.alert("Gagal menambahkan buku ke keranjang");
                        </script>
                        <meta http-equiv="refresh" content="0;url=read_ebook.php" />
                    <?php
                    exit();
                }
            } 
            
            // Jika buku sudah ada di keranjang
            else {
                ?>
                    <script>
                        window.alert("Buku sudah ada di keranjang");
                    </script>
                    <meta http-equiv="refresh" content="0;url=read_ebook.php" />
                <?php
                exit();
            }
        } 
        
        // Jika terdapat kesalahan saat memuat data buku
        else {
            ?>
                <script>
                    window.alert("Gagal mendapatkan informasi buku");
                </script>
                <meta http-equiv="refresh" content="0;url=read_ebook.php" />
            <?php
            exit();
        }
    }
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------
// [4] Fungsi untuk menghapus buku dari keranjang
function hapusDariKeranjang()
{
    global $con;

    // Cek apakah judul ada di masukan
    if (isset($_POST['judul'])) {
        $judul = mysqli_real_escape_string($con, $_POST['judul']);
        $email = $_SESSION['email'];

        // Mengambil data dengan melakukan querry
        $hapusQuery = "DELETE FROM cart WHERE judul='$judul' AND email='$email'";
        $hapusResult = mysqli_query($con, $hapusQuery);

        // Jika data ada
        if ($hapusResult) {
            ?>
                <script>
                    window.alert("Buku di hapus dari keranjang");
                </script>
                <meta http-equiv="refresh" content="0;url=keranjang.php" />
            <?php
            exit();
        } 
        
        // Jika data tidak ada
        else {
            ?>
                <script>
                    window.alert("Gagal menghapus buku...");
                </script>
                <meta http-equiv="refresh" content="0;url=keranjang.php" />
            <?php
            exit();
        }
    }
}

?>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] Title Website -->
<title>Keranjang Belanja</title>


<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
    <?php
    // Mengimpor style utama
    require 'style_index.php';


    
    // Mengimpor style keranjang
    require 'style_keranjang.php';
    ?>


</style>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [5] Body Website -->
<body>

<?php
// Mengimpor navbar.php untuk bagian navbar
require 'navbar.php';
?>

<!-- Tampilan keranjang -->
<section style="background-color: rgba(0, 0, 0, 0.7);" id="keranjang">
    <h1>Cart</h1>

    <?php
    // Mengambil data dengan eksekusi querry
    $email = $_SESSION['email'];
    $query = "SELECT k.judul, e.penulis, e.harga FROM cart k
              JOIN ebook e ON k.judul = e.judul
              WHERE k.email = '$email'";
    $result = mysqli_query($con, $query);

    // Jika ada data dan tidak kosong
    if ($result && mysqli_num_rows($result) > 0) {
        ?>
        <table>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>

            <?php

            // Menambah total belanja dari setiap ebook di keranjang
            $totalBelanja = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row['harga'];
                $totalBelanja += $total;
                ?>
                <tr>
                    <td>  <?php echo $row['judul']; ?></td>
                    <td>  <?php echo $row['penulis']; ?></td>
                    <td>Rp<?php echo $row['harga']; ?></td>
                    <td>Rp<?php echo $total; ?></td>
                    <td>
                        <!-- Tombol hapus -->
                        <form action="keranjang.php" method="post">
                            <input type="hidden" name="action" value="hapus">
                            <input type="hidden" name="judul" value="<?php echo $row['judul']; ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr class="total">
                <td colspan="3">Total Belanja</td>
                <td>Rp<?php echo $totalBelanja; ?></td>
                <td></td>
            </tr>
        </table>

        <!-- tombol chekout -->
        <form action="checkout.php" method="post">
            <button type="submit">Checkout</button>
        </form>
        <?php
    } 
    
    // Jika datanya kosong
    else {
        echo "<p style='text-align: center;'>Your shopping cart is empty.</p>";

    }
    ?>
</section>


</body>
</html>
