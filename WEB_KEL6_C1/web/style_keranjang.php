/* [1] Styling untuk Body dan Header */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

#keranjang {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
    text-align: center; /* Tambahkan penyesuaian untuk perataan teks */
}

/* [2] Styling untuk Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

/* [3] Styling untuk Tombol dan Formulir */
button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

form {
    display: inline-block;
    margin-right: 10px;
}

/* [4] Styling untuk Total Belanja */
tr.total {
    font-weight: bold;
    background-color: #f2f2f2;
}

/* [5] Styling untuk Responsiveness */
@media (max-width: 600px) {
    #keranjang {
        padding: 10px;
    }

    table {
        font-size: 12px;
    }

    button {
        padding: 8px 12px;
    }
}

body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #121212; /* Dark background color */
        color: #fff; /* Light text color */
    }

    #keranjang {
        max-width: 800px;
        margin: 20px auto;
        background-color: #1f1f1f; /* Darker background color */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #fff; /* white text color */
        text-align: center;
        margin-bottom: 20px;
    }

    /* [2] Styling untuk Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #333; /* Dark border color */
        color: #fff; /* Light text color */
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #333; /* Darker background color for table header */
    }

    /* [3] Styling untuk Tombol dan Formulir */
    button {
        background-color: #7f00ff; /* Purple button color */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    form {
        display: inline-block;
        margin-right: 10px;
    }

    /* [4] Styling untuk Total Belanja */
    tr.total {
        font-weight: bold;
        background-color: #333; /* Dark background color for total row */
    }

    /* [5] Styling untuk Responsiveness */
    @media (max-width: 600px) {
        #keranjang {
            padding: 10px;
        }

        table {
            font-size: 12px;
        }

        button {
            padding: 8px 12px;
        }
    }