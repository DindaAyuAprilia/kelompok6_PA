/* style_lihat_buku.php */

/* Container untuk detail buku */
.book-detail-container {
    display: flex;
    justify-content: space-between;
    background-color: #1f1f1f; /* Warna latar belakang gelap */
    padding: 20px;
    border-radius: 8px;
}

/* Bagian kiri dari detail buku */
.book-detail-left {
    flex: 1;
    margin-right: 20px;
}

/* Gambar buku */
.book-cover {
    width: 100%;
    max-width: 300px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan halus untuk kedalaman */
}

/* Bagian kanan dari detail buku */
.book-detail-right {
    flex: 2;
}

/* Gaya teks dalam bagian kanan */
.book-detail-right p {
    margin-bottom: 10px;
    color: #fff; /* Warna teks ungu terang */
}

/* Gaya judul buku */
h2 {
    color: #7f00ff; /* Warna judul ungu */
    font-size: 32px;
}

/* Gaya tombol */
button {
    background-color: #673ab7; /* Warna tombol ungu tua */
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Efek hover pada tombol */
button:hover {
    background-color: #512da8; /* Warna ungu yang lebih gelap saat dihover */
}
