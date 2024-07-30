<?php
session_start();
include 'dashboard/php/dbconfig.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: /dashboard/start.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM password WHERE password = ?");
    $stmt->bind_param("s", $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        header("Location: /dashboard/start.php");
        exit();
    } else {
        $error = "Wrong Password!";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ZenLicenses</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #2b2a6e, #7b1fa2);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 12px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
            text-align: center;
            position: relative;
        }

        .container h1 {
            margin-top: 0;
            color: #d3aef0;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .password-container {
            margin-top: 20px;
            position: relative;
        }

        .password-container input {
            padding: 15px;
            padding-left: 50px;
            border: 1px solid #5a2d81;
            border-radius: 8px;
            background: #444;
            color: #fff;
            font-size: 18px;
            width: 100%;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s, background-color 0.3s, box-shadow 0.3s;
        }

        .password-container input:focus {
            border-color: #d3aef0;
            background-color: #555;
        }

        .password-container .icon,
        .password-container .separator {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #d3aef0;
        }

        .password-container .icon {
            left: 15px;
            font-size: 22px;
        }

        .password-container .separator {
            left: 40px;
            font-size: 22px;
        }

        .password-container.error input {
            border-color: #FF0000;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }

        .password-container.error .icon,
        .password-container.error .separator {
            color: #FF0000;
        }

        .error-message {
            color: #FF0000;
            margin-top: 15px;
            font-size: 16px;
        }

        button {
            background-color: #d3aef0;
            border: none;
            border-radius: 8px;
            color: #fff;
            padding: 15px;
            font-size: 18px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background-color: #b17dce;
            transform: scale(1.05);
        }

        footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #fff;
            z-index: 1;
        }

        footer p {
            margin: 0;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }

        footer a {
            color: #d3aef0;
            text-decoration: none;
            font-weight: 500;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .footer-icons {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .footer-icons a {
            color: #d3aef0;
            font-size: 28px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-icons a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>ZenLicenses</h1>
    <form action="" method="post">
        <div class="password-container <?php if (!empty($error)) echo 'error'; ?>">
            <i class="fas fa-lock icon"></i>
            <span class="separator">|</span>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <button type="submit">Login</button>
    </form>
</div>
<footer>
    <p>&copy; 2024 <a href="https://www.zenaria.eu" target="_blank">Zenaria</a></p>
    <div class="footer-icons">
        <a href="https://discord.com" target="_blank" title="Discord"><i class="fab fa-discord"></i></a>
        <a href="mailto:info@zenaria.eu" title="Email"><i class="fas fa-envelope"></i></a>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
