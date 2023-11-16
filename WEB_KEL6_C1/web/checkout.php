<?php
// [1] Header Website
require 'header.php';

// Jika Session Sudah di mulai
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}



// [2] Title Website
echo '<title>Checkout</title>';
?>

<style>


<?php
// [3] Style Website
require 'style_index.php';

require 'style_checkout.php';
?>



</style>

<!-- [5] Body Website -->
<body>

<?php
// [4] Navbar
require 'navbar.php';

// Check if the cart is empty
$email = $_SESSION['email'];
$cartCheckQuery = "SELECT * FROM cart WHERE email='$email'";
$cartCheckResult = mysqli_query($con, $cartCheckQuery);

if (!$cartCheckResult || mysqli_num_rows($cartCheckResult) == 0) {
    // Cart is empty, display a message and exit
    echo "<p style='text-align: center;background-color: rgba(0, 0, 0, 0.7);color: red;'>Your shopping cart is empty. Cannot proceed with checkout.</p>";
    exit();
}

?>

<!-- Tampilkan isi checkout di sini -->
<section id="checkout">
    <h1>Checkout</h1>

    <?php
    // Mendapatkan informasi user
    $email = $_SESSION['email'];
    $userQuery = "SELECT * FROM users WHERE email='$email'";
    $userResult = mysqli_query($con, $userQuery);
    $query = "SELECT k.judul, e.penulis, e.harga FROM cart k
          JOIN ebook e ON k.judul = e.judul
          WHERE k.email = '$email'";
    $result = mysqli_query($con, $query);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userData = mysqli_fetch_assoc($userResult);

        // Loop untuk setiap buku dalam keranjang
        while ($row = mysqli_fetch_assoc($result)) {
            $judul = $row['judul'];

            // Update jumlah penjualan pada tabel ebook
            $updateEbookQuery = "UPDATE ebook SET penjualan = penjualan + 1 WHERE judul = '$judul'";
            $updateEbookResult = mysqli_query($con, $updateEbookQuery);

            // Tambahkan data checkout ke tabel checkout
            $checkoutQuery = "INSERT INTO checkout (judul, email, status) VALUES ('$judul', '$email', 'Sudah Dibeli')";
            $checkoutResult = mysqli_query($con, $checkoutQuery);

            if (!$updateEbookResult) {
                // Gagal update jumlah penjualan
                echo "<p class='empty-cart'>Gagal update jumlah penjualan ebook.</p>";
                exit(); // Keluar dari skrip jika terjadi kesalahan
            }
        }


        ?>
        <div class="user-info">
            <h2>Informasi Pengguna</h2>
            <p><strong>Nama:</strong> <?php echo $userData['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
        </div>

        <div class="order-summary">
            <h2>Ringkasan Pesanan</h2>

            <table>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                </tr>

                <?php
                $query = "SELECT k.judul, e.penulis, e.harga FROM cart k
                          JOIN ebook e ON k.judul = e.judul
                          WHERE k.email = '$email'";
                $result = mysqli_query($con, $query);

                $totalBelanja = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $totalBelanja += $row['harga'];
                    $judul = $row['judul'];
                    ?>
                    <tr>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['penulis']; ?></td>
                        <td>Rp<?php echo $row['harga']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr class="total">
                    <td colspan="2">Total Belanja</td>
                    <td>Rp<?php echo $totalBelanja; ?></td>
                </tr>
            </table>

        </div>

        <p>Email konfirmasi telah dikirimkan ke <?php echo $userData['email']; ?>.</p>
        <?php
    } else {
        echo "<p class='empty-cart'>Gagal mendapatkan informasi pengguna.</p>";
    }

    // Mendapatkan informasi user
    $email = $_SESSION['email'];
    $userQuery = "SELECT * FROM users WHERE email='$email'";
    $userResult = mysqli_query($con, $userQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userData = mysqli_fetch_assoc($userResult);

        // Hapus data dari tabel cart
        $hapusCartQuery = "DELETE FROM cart WHERE email='$email'";
        $hapusCartResult = mysqli_query($con, $hapusCartQuery);

        

    } else {
        echo "<p class='empty-cart'>Gagal mendapatkan informasi pengguna.</p>";
}
    ?>

</section>

</body>
</html>
