document.addEventListener("DOMContentLoaded", () => {
    const setupButton = document.getElementById("setup-btn");
    const confirmationDialog = document.getElementById("confirmation-dialog");
    const confirmSetupButton = document.getElementById("confirm-setup-btn");
    const cancelSetupButton = document.getElementById("cancel-setup-btn");

    setupButton.addEventListener("click", () => {
        confirmationDialog.classList.add("visible");
    });

    cancelSetupButton.addEventListener("click", () => {
        confirmationDialog.classList.remove("visible");
    });

    confirmSetupButton.addEventListener("click", async () => {
        confirmationDialog.classList.remove("visible");

        try {
            const response = await fetch("/dashboard/php/setup.php", {
                method: "POST"
            });
            const result = await response.text();
            alert(result);
        } catch (error) {
            alert("Setup failed: " + error.message);
        }
    });
});

window.addEventListener('load', function () {
    const loadingBar = document.getElementById('loading-bar');
    loadingBar.style.width = '100%';

    setTimeout(() => {
        loadingBar.style.width = '0';
    }, 500);
});
