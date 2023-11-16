body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #121212; /* Dark background color */
        color: #fff; /* Light text color */
    }

    #checkout {
        max-width: 800px;
        margin: 20px auto;
        background-color: #1f1f1f; /* Darker background color */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #fff; /* Purple text color */
        text-align: center;
    }

    /* [2] Styling untuk Informasi Pengguna */
    .user-info {
        margin-bottom: 20px;
    }

    .user-info h2 {
        color: #7f00ff; /* Purple text color */
        border-bottom: 1px solid #673ab7; /* Darker purple border color */
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .user-info p {
        margin: 5px 0;
    }

    /* [3] Styling untuk Ringkasan Pesanan */
    .order-summary {
        margin-bottom: 20px;
    }

    .order-summary h2 {
        color: #7f00ff; /* Purple text color */
        border-bottom: 1px solid #673ab7; /* Darker purple border color */
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        color: #fff; /* Light text color */
    }

    table, th, td {
        border: 1px solid #673ab7; /* Purple border color */
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #512da8; /* Darker purple background color for table header */
    }

    tr.total {
        font-weight: bold;
        background-color: #512da8; /* Darker purple background color for total row */
    }

    /* [4] Styling untuk Tombol Checkout */
    button {
        background-color: #4CAF50; /* Green button color */
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

    /* [5] Styling untuk Pesan Status */
    p.empty-cart {
        color: red;
        text-align: center;
        font-weight: bold;
    }