<?php
include '/dashboard/php/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create License - ZenLicenses</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/dashboard/css/create.css">
</head>
<body>
<div class="sidebar">
    <ul>
        <li><a href="/dashboard/start.php"><i class="fas fa-home"></i> Home</a></li>
        <hr>
        <li class="category">Admin</li>
        <li class="active"><a href="/dashboard/licenses/create.php"><i class="fas fa-plus-circle"></i> Create License</a></li>
        <li><a href="/dashboard/licenses/list.php"><i class="fas fa-list"></i> List Licenses</a></li>
        <li><a href="/dashboard/system/config.php"><i class="fas fa-cogs"></i> Configuration</a></li>
        <li><a href="/dashboard/system/setup.php"><i class="fas fa-tools"></i> Setup</a></li>
        <li><a href="/dashboard/system/informations.php"><i class="fas fa-info-circle"></i> Informations</a></li>
    </ul>
</div>

<div id="loading-bar"></div>

<main class="container">
    <header>
        <h1>Create License</h1>
    </header>
    <section class="form-section" id="form-section">
        <form id="license-form">
            <label for="expire-date">Expire Date (Type "*" if you want the license to not have an expiry date)</label>
            <input type="text" id="expire-date" name="expire-date" placeholder="YYYY-MM-DD">
            <span class="error-message" id="expire-date-error">This field is required</span>

            <label for="owner">Owner</label>
            <input type="text" id="owner" name="owner" placeholder="Name of the license owner">
            <span class="error-message" id="owner-error">This field is required</span>

            <label for="discord">Discord</label>
            <input type="text" id="discord" name="discord" placeholder="Discord of the license owner">
            <span class="error-message" id="discord-error">This field is required</span>

            <label for="product">Product</label>
            <input type="text" id="product" name="product" placeholder="Plugin name">
            <span class="error-message" id="product-error">This field is required</span>

            <label for="allowed-ips">Allowed IPs</label>
            <input type="text" id="allowed-ips" name="allowed-ips" placeholder="00.00.00.00">
            <span class="error-message" id="allowed-ips-error">This field is required</span>

            <label for="allowed-ports">Allowed Ports</label>
            <input type="text" id="allowed-ports" name="allowed-ports" placeholder="19132">
            <span class="error-message" id="allowed-ports-error">This field is required</span>

            <input type="hidden" id="key" name="key">

            <button type="submit" id="submit-btn" disabled>Submit</button>
        </form>
    </section>

    <section class="form-section hidden" id="key-display">
        <label for="generated-key">Generated Key</label>
        <div class="key-container">
            <input type="text" id="generated-key" readonly>
            <button id="copy-btn"><i class="far fa-copy"></i></button>
            <span id="copy-confirm" class="hidden"><i class="fas fa-check"></i></span>
        </div>
        <div id="key-insert-status"></div>
        <div id="error-message" style="color: red;"></div>
    </section>
</main>

<footer>
    <p>&copy; 2024 <a href="https://www.zenaria.eu" target="_blank">Zenaria</a></p>
    <div class="footer-icons">
        <a href="https://discord.com" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="mailto:info@zenaria.eu"><i class="fas fa-envelope"></i></a>
    </div>
</footer>

<script src="/dashboard/js/create.js"></script>
</body>
</html>
