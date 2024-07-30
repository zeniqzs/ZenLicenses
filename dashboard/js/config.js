document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('config-form');
    const testButton = document.getElementById('test-connection');
    const confirmButton = document.getElementById('confirm');
    const statusMessage = document.getElementById('connection-status');

    const inputs = form.querySelectorAll('input');
    const setButtonState = () => {
        const allFilled = Array.from(inputs).every(i => i.value.trim() !== '');
        testButton.disabled = !allFilled;
        confirmButton.disabled = !allFilled;
    };

    inputs.forEach(input => {
        input.addEventListener('input', setButtonState);
    });

    testButton.addEventListener('click', () => {
        statusMessage.classList.remove('hidden');
        statusMessage.textContent = "Testing connection...";
        statusMessage.style.color = 'yellow';

        const dbHost = document.getElementById('db-host').value;
        const dbName = document.getElementById('db-name').value;
        const dbUser = document.getElementById('db-user').value;
        const dbPassword = document.getElementById('db-password').value;

        fetch('/dashboard/php/test-connection.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ dbHost, dbName, dbUser, dbPassword })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                statusMessage.textContent = "Connection successful!";
                statusMessage.style.color = 'green';
            } else {
                statusMessage.textContent = `Connection failed: ${data.error}`;
                statusMessage.style.color = 'red';
            }
        })
        .catch(err => {
            statusMessage.textContent = `Connection failed: ${err.message}`;
            statusMessage.style.color = 'red';
        });
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const dbHost = document.getElementById('db-host').value;
        const dbName = document.getElementById('db-name').value;
        const dbUser = document.getElementById('db-user').value;
        const dbPassword = document.getElementById('db-password').value;

        fetch('/dashboard/php/update-config.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ dbHost, dbName, dbUser, dbPassword })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Configuration updated successfully!');
            } else {
                alert(`Failed to update configuration: ${data.error}`);
            }
        })
        .catch(err => {
            alert(`Failed to update configuration: ${err.message}`);
        });
    });
});

window.addEventListener('load', function () {
    const loadingBar = document.getElementById('loading-bar');
    loadingBar.style.width = '100%';

    setTimeout(() => {
        loadingBar.style.width = '0';
    }, 500);
});
