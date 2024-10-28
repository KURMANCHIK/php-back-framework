<style>
    :root {
        font-size: 62.5%;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }

    header {
        font-size: 30px;
    }

    a,
    a:visited {
        color: darkgreen;
    }

    footer {
        top: 100vh;
        position: sticky;
        text-align: center;
        font-size: 16px;
        height: 50px;
    }

    h1 {
        font-size: 32px;
    }

    p {
        font-size: 24px;
    }

    .registration__error {
        background-color: green;
        padding: 5px;
        margin: 15px;
        font-size: 20px;
    }
    body {
    background-color: #0d0d0d;
    color: #ffffff;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

    header {
        background-color: #1a1a1a;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-bottom: 2px solid #00ffcc;
    }

    header div, nav ul {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        text-decoration: none;
        color: #00ffcc;
        transition: color 0.3s;
    }

    nav ul li a:hover {
        color: #ffcc00;
    }

    h1, h2 {
        color: #00ffcc;
        text-shadow: 0 0 10px rgba(0, 255, 204, 0.7);
    }

    p {
        line-height: 1.6;
        margin: 10px 0;
    }

    form {
        background-color: #1a1a1a;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 255, 204, 0.5);
        margin-bottom: 20px;
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        color: #00ffcc;
    }

    input[type="email"], input[type="text"], textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #00ffcc;
        border-radius: 5px;
        background-color: #0d0d0d;
        color: #ffffff;
    }

    input[type="email"]:focus, input[type="text"]:focus, textarea:focus {
        border-color: #ffcc00;
        outline: none;
    }

    button {
        background-color: #00ffcc;
        color: #000000;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 15px;
    }

    button:hover {
        background-color: #ffcc00;
    }

    .registration__error {
        color: #ff3333;
        background-color: rgba(255, 51, 51, 0.1);
        border: 1px solid #ff3333;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }

    details {
        background-color: #1a1a1a;
        padding: 10px;
        border-radius: 5px;
    }

    hr {
        border: 1px solid #00ffcc;
        margin: 20px 0;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        color: #00ffcc;
        text-decoration: none;
        text-align: center;
    }

    a:hover {
        color: #ffcc00;
    }
</style>