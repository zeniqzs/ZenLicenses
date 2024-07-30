<?php
include '/dashboard/php/auth.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenLicenses - Configuration</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/dashboard/css/config.css">
</head>
<body>
<div class="sidebar">
    <ul>
        <li><a href="/dashboard/start.php"><i class="fas fa-home"></i> Home</a></li>
        <hr>
        <li class="category">Licenses</li>
        <li><a href="/dashboard/licenses/create.php"><i class="fas fa-plus-circle"></i> Create License</a></li>
        <li><a href="/dashboard/licenses/list.php"><i class="fas fa-list"></i> List Licenses</a></li>
        <li class="active"><a href="/dashboard/system/config.php"><i class="fas fa-cogs"></i> Configuration</a></li>
        <li><a href="/dashboard/system/setup.php"><i class="fas fa-tools"></i> Setup</a></li>
        <li><a href="/dashboard/system/informations.php"><i class="fas fa-info-circle"></i> Informations</a></li>
    </ul>
</div>

<div id="loading-bar"></div>

<main class="container">
    <header>
        <h1>Configuration</h1>
        <p>Setup your database connection.</p>
    </header>
    <section>
        <form class="form-section" id="config-form">
            <div class="form-group">
                <label for="db-host">Database Host</label>
                <input type="text" id="db-host" name="db-host" placeholder="Enter Database Host" required>
            </div>
            <div class="form-group">
                <label for="db-name">Database Name</label>
                <input type="text" id="db-name" name="db-name" placeholder="Enter Database Name" required>
            </div>
            <div class="form-group">
                <label for="db-user">User</label>
                <input type="text" id="db-user" name="db-user" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="db-password">User Password</label>
                <input type="password" id="db-password" name="db-password" placeholder="Enter Password" required>
            </div>
            <div class="form-actions">
                <button type="button" id="test-connection" disabled>Test Connection</button>
                <button type="submit" id="confirm" disabled>Confirm</button>
            </div>
            <p id="connection-status" class="hidden"></p>
        </form>
    </section>
</main>

<footer>
    <p>&copy; 2024 <a href="https://www.zenaria.eu" target="_blank">Zenaria</a></p>
    <div class="footer-icons">
        <a href="https://discord.com" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="mailto:info@zenaria.eu"><i class="fas fa-envelope"></i></a>
    </div>
</footer>

<script src="/dashboard/js/config.js"></script>
</body>
</html>
