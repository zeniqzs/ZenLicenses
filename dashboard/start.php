<?php
include 'php/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenLicenses</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="sidebar">
    <ul>
        <li class="active"><a href="/dashboard/start.php"><i class="fas fa-home"></i> Home</a></li>
        <hr>
        <li class="category">Admin</li>
        <li><a href="/dashboard/licenses/create.php"><i class="fas fa-plus-circle"></i> Create License</a></li>
        <li><a href="/dashboard/licenses/list.php"><i class="fas fa-list"></i> List Licenses</a></li>
        <li><a href="/dashboard/system/config.php"><i class="fas fa-cogs"></i> Configuration</a></li>
        <li><a href="/dashboard/system/setup.php"><i class="fas fa-tools"></i> Setup</a></li>
        <li><a href="/dashboard/system/informations.php"><i class="fas fa-info-circle"></i> Informations</a></li>
    </ul>
</div>

<div id="loading-bar"></div>

<main class="container">
    <header>
        <h1>ZenLicenses</h1>
        <p>Your solution for managing licenses efficiently.</p>
    </header>
    <section>
        <h2>Welcome to ZenLicenses</h2>
        <div class="guide-container">
            <h3>GUIDE</h3>
            <p>Watch the Full GUIDE Video on <a href="https://www.youtube.com/channel/UC8YVSAcmNAlrLFtNJmKVFlQ">YouTube</a></p>
        </div>
        <div class="contact-support">
            <h3>Contact & Support</h3>
            <p>If you need assistance, feel free to reach out to us via Discord or Email.</p>
            <div class="support-buttons">
                <a href="https://discord.com" target="_blank" class="support-btn discord-btn"><i class="fab fa-discord"></i> Discord</a>
                <a href="mailto:info@zenaria.eu" class="support-btn email-btn"><i class="fas fa-envelope"></i> Email</a>
            </div>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 <a href="https://www.zenaria.eu" target="_blank">Zenaria</a></p>
    <div class="footer-icons">
        <a href="https://discord.com" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="mailto:info@zenaria.eu"><i class="fas fa-envelope"></i></a>
    </div>
</footer>

<script src="js/index.js"></script>
</body>
</html>
