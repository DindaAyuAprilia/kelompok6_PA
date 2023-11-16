<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [1] Header Website -->
<?php
    // Mengimpor header.php untuk bagian header halaman.
    require 'header.php';
?>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [2] title Website -->
<title>HomePage</title>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [3] Style Website -->
<style>
    <?php
    // Mengimpor style.php untuk tampilan
    require 'style_index.php';
    ?>
</style>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [4] Body Website -->
</head>
<body>

    <?php
    // Mengimpor navbar.php untuk tampilan navbar.
    require 'navbar_index.php';
    ?>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [5] landing webstie -->
<section id="landing">
        <div>
            <h1>Welcome To XuenSun</h1>
            <p>Platform terbaik untuk menhabiskan waktu berkualitas kalian di dunia fanfict inpian!</p>
            <div>
                <a class="btn btn-alt" href="#about">More About Us</a>
                <a class="btn" href="#contact">Contact Us</a>
            </div>
        </div>
        <div>
            <img src="../web/images/xuensun.png" alt="Landing Image">
        </div>
</section>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [6] About Website -->
<section style="background-color: rgba(0, 0, 0, 0.2);" id="about">
    <div>
        <img src="../web/images/purple-book.jpg" alt="About Image">
    </div>
    <div>
        <h1>Kami adalah yang terbaik di bidang kami!</h1>
        <p>Selama 1 bulan terakhir kami selalu memberikan yang terbaik kepada klien kami~</p>
        <div class="about-stats">
            <div class="about-stats-item">
                <h1>5+</h1>
                <div></div>
                <p>Buku</p>
            </div>
            <div class="about-stats-item">
                <h1>3+</h1>
                <div></div>
                <p>Pengguna</p>
            </div>
            <div class="about-stats-item">
                <h1>10+</h1>
                <div></div>
                <p>Pemesanan</p>
            </div>
        </div>
    </div>
</section>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [7] Example Book Website -->
<section style="background-color: rgba(0, 0, 0, 0.7);" id="example">
    <div class="example-header">
        <div>
            <h1 style="color: antiquewhite;" >Our Example Book</h1>
            <p>Cerita kami akan membawa kalian memasuki dunia imajinasi yang tidak terbatas, bersama XuenSun. Apapun yang kalian inginkan akan jadi kenyataan!!</p>
        </div>
    </div>
    <div class="example-detail">
        <div class="example-detail-item">
            <a href="read_ebook.php">
            <img src="../icon/image/book3.jpg" alt="book1">
            <h2>Action</h2>
            <p>Dari seorang pelayan biasa menjadi seorang putri dalam satu malam? Bukankah itu terdengar ajaib dan mengagumkan?</p>
            </a>
        </div>
        <div class="example-detail-item">
        <a href="read_ebook.php">
            <img src="../icon/image/book2.jpg" alt="example 2 image">
            <h2>Comedy</h2>
            <p>Orang yang selalu aku ejek saat SMA itu ternyata adalah seorang idol terkenal!?</p>
            </a>
        </div>
        <div class="example-detail-item">
        <a href="read_ebook.php">
            <img src="../icon/image/buku1.jpg" alt="example 4 image">
            <h2>Romance</h2>
            <p>Cinta bertepuk sebelah tangan adalah hal biasa, tapi bagaimana jika orang yang kau cintai itu justru tidak menyadari perasaannya sendiri dan juga perasaanmu?</p>
            </a>
        </div>
    </div>
</section>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [8] Location Us -->
<center>
<section id="contact">
    <div class="contact-detail">
        <div>
            <h1 style="color: antiquewhite;" >Our Location</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d600.308970123427!2d117.15746961598613!3d-0.467711049539611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67fd91915b52b%3A0xf03d404d8fc3016!2sFKTI%20Unmul!5e1!3m2!1sid!2sid!4v1699712555757!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
    </div>
</section>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- [9] Footer Website -->
</center>
    <?php
        require 'footer.php';
    ?>
    </style>
</body>
</html>