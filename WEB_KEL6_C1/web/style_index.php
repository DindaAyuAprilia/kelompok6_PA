* {
font-family: "Montserrat";
box-sizing: border-box;
scroll-behavior: smooth;
}

html, body {
padding: 0;
margin: 0;
background-size: cover;
background-repeat: no-repeat;
background-image: url(../web/images/bc.png);
background-attachment: fixed;



}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url(../web/images/bc.png);
    background-size: cover;
    background-repeat: no-repeat;
    z-index: -1;
    
}



h1 {
font-weight: 700;
font-size: 48px;
margin: 0 0 16px 0;
color: #FFE3BB;
}

a {
text-decoration: none;
color: black;
font-size: 24px;
}

p {
color: #fff;
margin: 0 0 16px 0;
font-size: 24px;
}

section {
padding: 64px 128px;
}

img, iframe {
width: 100%;
}

.btn {
background-color: #7f00ff;
color: white;
padding: 8px 24px;
}

.btn-alt {
background-color: white;
color: black;
margin-right: 16px;
border: 2px solid #7f00ff;
}

#header {
display: flex;
align-items: center;
justify-content: space-between;
padding: 16px 128px;
position: sticky;
top: 0;
background-color: black !important;
z-index: 5;
}

#header h1 {
margin: 0;
/* animation: flash 1s infinite; */
animation: bounceIn 1s;
color: #ffffff;
}

@keyframes bounceIn {
0% {
filter: opacity(0);
transform: translateY(-20px);
}
35% {
filter: opacity(0.25);
transform: translateY(0);
}
70% {
filter: opacity(0.5);
transform: translateY(-10px);
}
100% {
filter: opacity(1);
transform: translateY(0);
}
}

@keyframes flash {
from {
filter: opacity(0);
}
to {
filter: opacity(1);
}
}

nav > a {
margin-left: 40px;
font-size: 30px;
color: #ffffff;
}

nav > a:hover {
color: #7f00ff;
}

#landing {
display: flex;
align-items: center;
justify-content: space-between;
column-gap: 16px;
}

#landing p {
margin-bottom: 32px;
}

#landing > div {
width: 50%;
}

#about {
display: flex;
align-items: center;
justify-content: space-between;
column-gap: 16px;
}

#about > div {
width: 50%;
}

.about-stats {
display: grid;
grid-template-columns: repeat(3, 1fr);
text-align: center;
margin-top: 72px;
}

.about-stats-item {
display: flex;
flex-direction: column;
align-items: center;
}

.about-stats-item div {
width: 50px;
height: 10px;
background-color: #7f00ff;
margin-bottom: 16px;
}

.example-header {
display: flex;
align-items: center;
justify-content: space-between;
}

.example-header h1 {
position: relative;
}

.example-header h1::before {
content: "";
width: 60px;
height: 60px;
position: absolute;
left: -20px;
top: -10px;
z-index: -1;
}

.example-detail {
display: grid;
grid-template-columns: repeat(3, 1fr);
column-gap: 128px;
margin-top: 72px;
}

.example-detail-item {
box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.1);
}

.example-detail-item:hover {
transform: scale(1.15);
}

.example-detail-item:hover img {
filter: grayscale(0);
}

.example-detail-item img {
width: 100%;
filter: grayscale(1);
}

.example-detail-item h2 {
padding: 0 16px;
color: #fff;
}

.example-detail-item h2:hover {
padding: 0 16px;
color: #512B81;
}

.example-detail-item p {
font-size: 16px;
padding: 0 16px;
}

#contact h1 {
position: relative;
}

#contact > h1::before {
content: "";
width: 60px;
height: 60px;
position: absolute;
left: -20px;
top: -10px;
z-index: -1;
}

.contact-detail {
display: flex;
justify-content: space-between;
margin-top: 72px;
column-gap: 128px;
}

.contact-detail > div, .contact-detail > form {
width: 50%;
}

form {
display: flex;
flex-direction: column;

padding: 64px 32px;
}

form h1 {
font-size: 32px;
text-align: center;
}


form button {
border: none;
}

form button:hover {
cursor: pointer;
}

.form-group {
display: grid;
color: #fff;
grid-template-columns: repeat(2, 1fr);
column-gap: 32px;
margin-top: 32px;
grid-template-areas:    "name subject"
"email phone"
"message message";
}

#input-name {
grid-area: name;
}

#input-subject {
grid-area: subject;
}

#input-email {
grid-area: email;
}

#input-phone {
grid-area: phone;
}

#input-message {
grid-area: message;
}

.input-group {
display: flex;
flex-direction: column;
margin-bottom: 32px;
}

.input-group label {
font-weight: 700;
margin-bottom: 16px;
font-size: 24px;
}

.input-group input {
border: none;
outline: none;
border-bottom: 1px solid black;
font-size: 20px;
}

.input-group input:focus {
border-bottom: 2px solid #7f00ff;
}

footer {
padding: 16px 128px;
background-color: #333333;
color: white;
display: flex;
justify-content: space-between;
align-items: center;
}

footer p {
color: white;
width: 50%;
}

.social-icon {
display: flex;
gap: 32px;
}

@media only screen and (max-width: 1200px) {
.example-detail {
gap: 24px;
}

.contact-detail {
gap: 24px;
}

.form-group {
display: flex;
flex-direction: column;
}
}

@media only screen and (max-width: 992px) {
#header, #footer {
padding: 16px 32px;
}

section {
padding: 64px 32px;
}

#landing {
flex-direction: column-reverse;
justify-content: center;
align-items: center;
text-align: center;
}

#landing > div {
width: 100%;
}

#about {
flex-direction: column;
text-align: center;
justify-content: center;
align-items: center;
}

#about > div {
width: 100%;
}

.example-detail {
gap: 16px;
}

.contact-detail {
flex-direction: column;
justify-content: center;
align-items: center;
row-gap: 64px;
}

.contact-detail form, .contact-detail > div {
width: 100%;
}
}

#books {
    text-align:center;
    width: 80%;
    margin: 50px auto;
    background-color: rgba(51, 51, 51, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.books-header {
    text-align: center;
    margin-bottom: 30px;
    color: #fff;
}

.books-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.book-item {
    width: calc(30% - 20px);
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #555;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    background-color: #444;
    transition: transform 0.3s ease-in-out;
}

/* New styles for small screens */
@media screen and (max-width: 800px) {
    .books-list {
        justify-content: center;
    }

    .book-item {
        width: calc(80% - 20px); /* Adjust the width for smaller screens */
    }
}

.book-item:hover {
    transform: scale(1.05);
}

.book-item img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.book-item h2 {
    font-size: 20px;
    margin-top: 15px;
    margin-bottom: 10px;
    color: #fff;
}

.book-item p {
    font-size: 16px;
    margin: 10px 0;
    color: #ccc;
}

.book-item a {
    display: inline-block;
    background-color: #7f00ff;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.book-item a:hover {
    background-color: red;
}



label {
    font-size: 18px;
    color: #fff; /* Dark gray text color */
    margin-bottom: 8px;
}

select {
    padding: 12px;
    font-size: 16px;
    border: 1px solid #6c757d; /* Medium gray border color */
    border-radius: 8px;
    margin-bottom: 20px;
    appearance: none;
    background-color: #fff;
    color: #333;
    transition: border-color 0.3s, box-shadow 0.3s;
}

select:focus {
    outline: none;
    border-color: #007bff; /* Blue border color on focus */
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
}



/* CSS for dropdown menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background-color: transparent;
        color: white;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown-content {
        position: absolute;
        top: 100%; /* Adjust the distance below the navbar */
        display: none;
        width: 100%; /* Make the dropdown full-width */
    }

    @media screen and (max-width: 800px) {
        .dropdown-content {
            position: absolute;
            top: 100%; /* Adjust the distance below the navbar */
            left: 0;
            display: none;
        }

        .dropdown-content a {
            text-align: center;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            left: -100px;
        }
    }

    .navbar {
        display: flex;
        align-items: center;
    }

    .form {
        display: flex;
        align-items: center;
    }

    .form input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 5px; /* Adjust the margin as needed */
    }

    .form button {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

