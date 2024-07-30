<?php
include '/dashboard/php/auth.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informationen | ZenLicenses</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/dashboard/css/informations.css">
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
        <li><a href="/dashboard/system/setup.php"><i class="fas fa-tools"></i> Setup</a></li>
        <li class="active"><a href="/dashboard/system/informations.html"><i class="fas fa-info-circle"></i> Informations</a></li>
    </ul>
</div>

<div id="loading-bar"></div>

<main class="container">
    <header>
        <h1>Informations</h1>
        <p>View Informations about your System and about the Panel.</p>
    </header>
    <section>
        <h2>System Informations</h2>
        <div id="info-container">
            <div class="info-card">
                <h3>IPv4</h3>
                <p class="hidden-key" id="ipv4">Loading...</p>
            </div>
            <div class="info-card">
                <h3>IPv6</h3>
                <p class="hidden-key" id="ipv6">Loading...</p>
            </div>
            <div class="info-card">
                <h3>ISP</h3>
                <p id="isp">Loading...</p>
            </div>
            <div class="info-card">
                <h3>RAM</h3>
                <p id="ram">Loading...</p>
            </div>
            <div class="info-card">
                <h3>Storage</h3>
                <p id="storage">Loading...</p>
            </div>
            <div class="info-card">
                <h3>Cores</h3>
                <p id="cores">Loading...</p>
            </div>
            <div class="info-card">
                <h3>Software</h3>
                <p id="software">Loading...</p>
            </div>
            <div class="info-card">
                <h3>Panel Version</h3>
                <p id="version">1.0</p>
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

<script src="/dashboard/js/informations.js"></script>
</body>
</html>
