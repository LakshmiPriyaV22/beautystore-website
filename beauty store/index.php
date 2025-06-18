<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beauty Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url("store1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .top-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 40px;
            text-align: center;
        }

        h1 {
            color: #b30059;
            text-shadow: 2px 2px 5px #00000099;
            font-size: 3rem;
            font-family: 'Playfair Display', serif;
            margin-bottom: 30px;
        }

        .center-links {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        a {
            font-size: 1.2rem;
            color: white;
            background-color: #ff7591;
            border: 2px solid white;
            border-radius: 30px;
            padding: 12px 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        a:hover {
            background-color: #d13a58;
            color: #ffe4e1;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="top-container">
        <h1>BEAUTY STORE</h1>
        <div class="center-links">
            <a href="signin.php">Sign In</a>
            <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
