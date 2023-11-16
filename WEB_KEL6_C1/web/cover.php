<?php
    $uploadDir = 'cover/';

    // Membuat direktori "cover" jika tidak ada di path
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $query = "SELECT * FROM ebook";
    $result = mysqli_query($con, $query) or die("Error Querry: " . mysqli_error($con));

    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } 

    else {
        echo "Kesalahan dalam mengambil data penggunas";
    }

    // Penjelasan //
    // 1. is_dir             : untuk melihat kondisi path ke direktori ada atau tidak
    // 2. mkdir              : make direktori path jika belum ada di mana 0777 artinya mempunyai hak akses penuh pada pengguna(read, write, dan execute)
    // 3. mysqli_query       : mengeksekusi atau menjalankan perintah sql dan menyimpan hasilnya
    // 4. if($result)        : mengecek jika ada data yang di temukan setelah perintah di eksekusi
    // 5. mysqli_fetch_assoc : menyimpan hasil satu baris sebagai asosiastif array

?>