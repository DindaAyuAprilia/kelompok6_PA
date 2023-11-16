#users {
        width: 80%;
        margin: 50px auto;
        background-color: #000; /* Change background color to black */
        color: #fff; /* Change text color to white */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .users-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .users-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .user-item {
        width: 30%;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #fff; /* Change border color to purple */
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        background-color: #444; /* Change background color to purple */
        transition: transform 0.3s ease-in-out;
    }

    /* New styles for small screens */
    @media screen and (max-width: 800px) {
        .users-list {
            justify-content: center;
        }

        .user-item {
            width: calc(80% - 20px); /* Adjust the width for smaller screens */
        }
    }

    .user-item:hover {
        transform: scale(1.05);
    }

    .user-item img {
        width: 100%;
        border-radius: 5px;
    }

    .user-item h2 {
        font-size: 24px;
        margin-top: 10px;
        margin-bottom: 5px;
        color: #fff; /* Change text color to white */
    }

    .user-item p {
        font-size: 18px;
        margin: 5px 0;
        color: #ccc; /* Change text color to light gray */
    }

    .user-item a {
        display: block;
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px auto;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .user-item a:hover {
        background-color: #45a049;
    }