<?php
include '/dashboard/php/auth.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - ZenLicenses</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/dashboard/css/setup.css">
</head>
<body>
<div class="sidebar">
    <ul>
        <li><a href="/dashboard/start.php"><i class="fas fa-home"></i> Home</a></li>
        <hr>
        <li class="category">Admin</li>
        <li><a href="/dashboard/licenses/create.php"><i class="fas fa-plus-circle"></i> Create License</a></li>
        <li><a href="/dashboard/licenses/list.php"><i class="fas fa-list"></i> List Licenses</a></li>
        <li><a href="/dashboard/system/config.php"><i class="fas fa-cogs"></i> Configuration</a></li>
        <li class="active"><a href="/dashboard/system/setup.php"><i class="fas fa-tools"></i> Setup</a></li>
        <li><a href="/dashboard/system/informations.php"><i class="fas fa-info-circle"></i> Informations</a></li>
    </ul>
</div>

<div id="loading-bar"></div>

<main class="container">
    <header>
        <h1>Setup</h1>
    </header>
    <section class="form-section">
        <div class="setup-container">
            <h2>Setup Database</h2>
            <p>Follow the instructions to set up the database for ZenLicenses.</p>
            <button id="setup-btn" class="animated-button">Setup</button>
        </div>
    </section>
</main>

<div id="confirmation-dialog" class="hidden">
    <div class="dialog-content">
        <h2>Confirm Setup</h2>
        <p>Are you sure you want to proceed with the setup?</p>
        <button id="confirm-setup-btn" class="dialog-button">Yes</button>
        <button id="cancel-setup-btn" class="dialog-button">No</button>
    </div>
</div>

<footer>
    <p>&copy; 2024 <a href="https://www.zenaria.eu" target="_blank">Zenaria</a></p>
    <div class="footer-icons">
        <a href="https://discord.com" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="mailto:info@zenaria.eu"><i class="fas fa-envelope"></i></a>
    </div>
</footer>

<script src="/dashboard/js/setup.js"></script>
</body>
</html>
