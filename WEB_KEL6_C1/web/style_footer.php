footer {
    background-color: rgb(29, 27, 29); /* Match the HTML background color */
    position: relative;
    width: 100%;
    min-height: 350px;
    padding: 3rem 0; /* Adjust padding */
}

.container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 1rem; /* Adjust padding */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around; /* Adjust spacing */
    align-items: center;
}

.col {
    min-width: 250px;
    max-width: 100%;
    box-sizing: border-box;
    color: #f2f2f2;
    font-family: poppins;
    padding: 0 1rem; /* Adjust padding */
    margin-bottom: 20px;
}

    .col .logo {
    width: 100%; /* Gunakan lebar 100% agar gambar menyesuaikan lebar kolom */
    max-width: 300px; /* Tentukan lebar maksimum sesuai keinginan Anda */
    margin-bottom: 25px;
}

    .col h3 {
        color: rgb(255, 255, 255);
        margin-bottom: 20px;
        position: auto;
        cursor: pointer;
    }

    .col h3::after {
        content: '';
        height: 3px;
        width: 0px;
        background-color: rgb(255, 255, 255);
        position: absolute;
        bottom: 0;
        left: 0;
        transition: 0.3s ease;
    }

    .col h3:hover::after {
        width: 30px;
    }

    .col .social a i {
    color: rgb(255, 255, 255);
    margin-top: 2rem;
    margin-right: 10px; /* Sesuaikan margin agar lebih terpisah dari teks */
    font-size: 50px; /* Sesuaikan ukuran font sesuai keinginan Anda */
    transition: 0.3s ease;
}



    .col .links a {
        display: block;
        text-decoration: none;
        color: #f2f2f2;
        margin-bottom: 5px;
        position: relative;
        transition: 0.3s ease;
    }

    .col .links a::before {
        content: '';
        height: 16px;
        width: 3px;
        position: absolute;
        top: 5px;
        left: -10px;
        background-color: rgb(49, 6, 46);
        transition: 0.5s ease;
        opacity: 0;
    }

    .col .links a:hover::before {
        opacity: 1;
    }

    .col .links a:hover {
        transform: translateX(-8px);
        color: rgb(255, 255, 255);
    }

    .col {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.logo-container {
    width: 100%;
    max-width: 300px;
    margin-bottom: 15px;
}

.col .text {
    margin-bottom: 20px;
}

.col .social {
    display: flex;
    justify-content: center;
}

.col .contact-details {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.col .detail {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

    /* Media Queries */
    @media (max-width: 768px) {
        .col {
            min-width: 100%;
        }

        .col .contact-details {
            margin-bottom: 0; /* Remove margin between contact details on smaller screens */
        }
    }