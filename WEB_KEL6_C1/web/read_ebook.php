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

/* Style Tambahan untuk button */
form {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #222; /* Light gray background */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

form:hover {
    transform: translateY(-5px);
}

button {
    background-color: #7f00ff;
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #6c757d;
}

.button {
    background-color: #7f00ff;
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #6c757d;
}


.button.sticky {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1; 
}



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
    ?>

    <!-- Form Searching -->
    <form class="form" action="searching.php" method="GET">
        <input style="padding: 8px;border: 1px solid #ccc;border-radius: 4px;" type="text" name="search" placeholder="Search by Title">
        <button type="submit">Search</button>
    </form>

    
    <!-- Form Sorting -->
    <form method="get" action="">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <option value="penjualan_desc">Top Books (By Sales)</option>
            <option value="harga_asc"     >Lowest Price        </option>
            <option value="harga_desc"    >Highest Price       </option>
        </select>
        <button type="submit">Sort</button>
    </form>

    <?php

    // Mendapatkan nilai pengurutan awal
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'penjualan_desc';

    // Menyesuaikan kueri SQL berdasarkan nilai pengurutan
    switch ($sort) {
        case 'harga_asc':
            $query = "SELECT * FROM ebook ORDER BY harga ASC";
            break;
        case 'harga_desc':
            $query = "SELECT * FROM ebook ORDER BY harga DESC";
            break;
        case 'penjualan_desc':
        default:
            $query = "SELECT * FROM ebook ORDER BY penjualan DESC";
            break;
    }

    // Mengeksekusi querry atau perintah sql
    $result = mysqli_query($con, $query) or die("Error Querry: " . mysqli_error($con));;

    // Jika ada data yang di dapatkan dari perintah querry yang di jalankan
    if (mysqli_num_rows($result) > 0) {
        ?>

        <!-- Tampilan header ebook bwebwda tergantung sorting -->
        <section id="books">
            <div class="books-header">
                <?php
                switch ($sort) {
                    case 'harga_asc':
                        ?>
                        <h1 >Cheapest Books</h1>
                        <p>Discover our collection of books sorted by the lowest price.</p>
                        <?php
                        break;
                    case 'harga_desc':
                        ?>
                        <h1 >Most Expensive Books</h1>
                        <p>Explore our collection of books sorted by the highest price.</p>
                        <?php
                        break;
                    case 'penjualan_desc':
                    default:
                        ?>
                        <h1 >Top Books</h1>
                        <p>Check out our top books based on the number of purchases.</p>
                        <?php
                        break;
                }
                ?>
            </div>

            <!-- Daftar buku dan urutannya -->
            <div class="books-list">
                <?php
                // Loop untuk semua baris yang sudah di simpan dalam array
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <div class="book-item">
                    <img src="      <?php echo $row['cover'  ]; ?>" alt="Book Cover">
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
    
    else {
        ?>
            <script>
                window.alert("Tidak ada buku");
            </script>
            <meta http-equiv="refresh" content="0;url=read_ebook.php" />
        <?php
    }
    ?>


</body>
</html>
