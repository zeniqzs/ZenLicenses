document.addEventListener('DOMContentLoaded', () => {
    fetch('/dashboard/php/informations.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('ipv4').textContent = data.ipv4 || 'N/A';
            document.getElementById('ipv6').textContent = data.ipv6 || 'N/A';
            document.getElementById('isp').textContent = data.isp || 'N/A';
            document.getElementById('ram').textContent = data.ram || 'N/A';
            document.getElementById('storage').textContent = data.storage || 'N/A';
            document.getElementById('cores').textContent = data.cores || 'N/A';
            document.getElementById('software').textContent = data.software || 'N/A';
        })
        .catch(error => console.error('Error fetching system information:', error));
});

window.addEventListener('load', function () {
    const loadingBar = document.getElementById('loading-bar');
    loadingBar.style.width = '100%';

    setTimeout(() => {
        loadingBar.style.width = '0';
    }, 500);
});
