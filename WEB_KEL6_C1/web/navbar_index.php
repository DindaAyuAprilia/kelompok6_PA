<header id="header">

    <!-- Logo xuenSun -->
    <a href="../web/index.php" title="Home"><h1>XuenSun</h1></a>
    
    <div class="navbar">
        <!-- Navbar Dropdown -->
        <div class="dropdown">
            <button class="dropbtn" style='font-size:20px;' onclick="toggleMenu()">More &#9662;</button>
            <div class="dropdown-content">

                <!-- Jika Login sebagai Admin -->
                <?php if (isset($_SESSION['email'])): ?>
                    <?php if ($_SESSION['email'] === $adminEmail): ?>
                        <a href="../web/index.php" title="Home">Home</a> 
                        <a href="read_ebook.php" title="List Book"> List Book </a>
                        <a href="create_ebook.php" title="Add Book"> Add Book </a>
                        <a href="read_user.php" title="Add Book"> List User</a>
                        <a href="logout.php"> Logout</a>
                    
                    <!-- Jika Login sebagai user -->
                    <?php else: ?>
                        <a href="../web/index.php" title="Home">Home</a>
                        <a href="profile.php" title="Profile"> Profile </a>
                        <a href="read_ebook.php" title="List Book"> List Book </a>
                        <a href="keranjang.php" title="Cart"> Cart </a>
                        <a href="#about">About</a>
                        <a href="#contact">Contact</a>
                        <a href="logout.php"> Logout </a>
                    <?php endif; ?>

                <!-- Jika Beum Login -->
                <?php else: ?>
                    <a href="../web/index.php" title="Home">Home</a>
                    <a href="read_ebook.php" title="List Book"> List Book </a>
                    <a href="#about">About</a>
                    <a href="#contact">Contact</a>
                    <a href="login.php" title="Masuk"> Login </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<script>
    // JavaScript untuk menu dropdown
    function toggleMenu() {
        var x = document.querySelector(".dropdown-content");
        x.style.display = (x.style.display === "block") ? "none" : "block";
    }
</script>