/* style_login.php */

/* Styling untuk elemen body */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: aliceblue;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    margin: 0;
    padding: 0;
    position: relative;
    display: flex;
    justify-content: center;
    background-image: url(../icon/image/2.png);
    align-items: center;
    height: 100vh;
}

/* Efek overlay pada elemen body */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

/* Styling untuk form login */
.form {
    width: 30%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 35px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

/* Styling untuk container form */
.form-container {
    padding: 20px;
    border-radius: 10px;
}

/* Styling untuk judul form */
h1 {
    color: #fff;
    text-align: center;
    margin-bottom: 25px;
    font-size: 2.5em;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

/* Garis pemisah */
hr {
    border: 0;
    height: 3px;
    background: linear-gradient(to right, #7f00ff, #e100ff);
    margin-bottom: 20px;
}

/* Styling untuk input teks */
.textfield {
    width: 93%;
    padding: 15px;
    margin-bottom: 30px;
    border: 2px solid #7f00ff;
    background-color: #2c2c54;
    color: #fff;
    border-radius: 8px;
    font-size: 20px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

/* Efek focus pada input teks */
.textfield:focus {
    border-color: #5e54c7;
    box-shadow: 0 0 8px #5e54c7;
}

/* Styling untuk tombol login */
.login-btn {
    width: 100%;
    padding: 15px;
    background-color: #7f00ff;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 25px;
    transition: background-color 0.3s, transform 0.3s;
}

/* Efek hover pada tombol login */
.login-btn:hover {
    background-color: #5e54c7;
    transform: scale(1.05);
}

/* Efek tekan pada tombol login */
.login-btn:active {
    transform: scale(0.95);
}

/* Responsif untuk layar yang lebih kecil */
@media (max-width: 600px) {
    .form {
        width: 90%;
    }

    .textfield,
    .login-btn {
        font-size: 18px; /* Mengurangi ukuran font pada layar kecil */
    }
}

/* Styling untuk tautan pada elemen div */
div {
    color: #fff;
    text-align: center;
    font-size: 18px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin-bottom: 15px;
}

/* Styling untuk tautan pada elemen div */
div a {
    color: #7f00ff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
    font-size: x-large;
}

/* Efek hover pada tautan */
div a:hover {
    color: red;
}

/* CSS untuk memisahkan tautan dari teks sekitarnya */
div > div {
    margin-top: 15px;
}
