document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('license-container');
    const errorMessageContainer = document.getElementById('error-message');
    const searchInput = document.getElementById('search-input');
    let licenses = [];

    fetch('/dashboard/php/list.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                licenses = data.licenses;
                displayLicenses(licenses);
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError('An error occurred: ' + error.message);
        });

    function displayLicenses(licensesToShow) {
        container.innerHTML = '';
        licensesToShow.forEach(license => {
            const card = document.createElement('div');
            card.className = 'license-card';

            card.innerHTML = `
                <h2>ID: ${license.id}</h2>
                <hr>
                <p><strong>Discord:</strong> ${license.discord}</p>
                <p><strong>Owner:</strong> ${license.owner}</p>
                <p><strong>Allowed IPs:</strong> ${license.allowed_ips}</p>
                <p><strong>Allowed Ports:</strong> ${license.allowed_ports}</p>
                <p><strong>Product:</strong> ${license.product}</p>
                <p><strong>Expire Date:</strong> ${license.expire_date}</p>
                <p><strong>Creation Date:</strong> ${license.creation_date}</p>
                <p><strong>Key:</strong> <span class="hidden-key">${license.key}</span></p>
            `;

            const keyElement = card.querySelector('.hidden-key');
            keyElement.addEventListener('click', () => {
                keyElement.classList.toggle('visible-key');
            });

            container.appendChild(card);
        });
    }

    function showError(message) {
        errorMessageContainer.textContent = message;
        errorMessageContainer.classList.add('show');
        setTimeout(() => {
            errorMessageContainer.classList.remove('show');
        }, 5000);
    }

    searchInput.addEventListener('keyup', () => {
        const query = searchInput.value.toLowerCase();
        const filteredLicenses = licenses.filter(license =>
            license.id.toLowerCase().includes(query)
        );
        displayLicenses(filteredLicenses);
    });
});

window.addEventListener('load', function () {
    const loadingBar = document.getElementById('loading-bar');
    loadingBar.style.width = '100%';

    setTimeout(() => {
        loadingBar.style.width = '0';
    }, 500);
});
