document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('license-form');
    const submitBtn = document.getElementById('submit-btn');
    const formSection = document.getElementById('form-section');
    const keyDisplay = document.getElementById('key-display');
    const generatedKeyInput = document.getElementById('generated-key');
    const copyBtn = document.getElementById('copy-btn');
    const copyConfirm = document.getElementById('copy-confirm');
    const keyField = document.getElementById('key');
    const keyInsertStatus = document.getElementById('key-insert-status');
    const errorMessage = document.getElementById('error-message');

    const requiredFields = Array.from(form.querySelectorAll('input:not(#generated-key):not(#key)'));

    requiredFields.forEach(field => {
        field.addEventListener('input', () => {
            const allFilled = requiredFields.every(input => input.value.trim() !== '');
            submitBtn.disabled = !allFilled;
        });

        field.addEventListener('focus', () => {
            field.classList.remove('invalid');
            const errorElement = document.getElementById(`${field.id}-error`);
            if (errorElement) errorElement.style.display = 'none';
        });

        field.addEventListener('blur', () => {
            if (field.value.trim() === '') {
                field.classList.add('invalid');
                const errorElement = document.getElementById(`${field.id}-error`);
                if (errorElement) errorElement.style.display = 'block';
            }
        });
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const allFilled = requiredFields.every(input => input.value.trim() !== '');
        if (!allFilled) {
            requiredFields.forEach(field => {
                if (field.value.trim() === '') {
                    field.classList.add('invalid');
                    const errorElement = document.getElementById(`${field.id}-error`);
                    if (errorElement) errorElement.style.display = 'block';
                }
            });
            return;
        }

        const generatedKey = generateKey();
        generatedKeyInput.value = generatedKey;
        keyField.value = generatedKey;

        formSection.classList.add('fade-out');
        formSection.addEventListener('animationend', () => {
            formSection.classList.add('hidden');
            keyDisplay.classList.remove('hidden');
            keyDisplay.classList.add('fade-in');
        }, { once: true });

        submitForm();
    });

    copyBtn.addEventListener('click', () => {
        generatedKeyInput.select();
        document.execCommand('copy');
        copyBtn.classList.add('hidden');
        copyConfirm.classList.add('show');
        setTimeout(() => {
            copyConfirm.classList.remove('show');
            copyBtn.classList.remove('hidden');
        }, 2000);
    });

    function generateKey() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let key = '';
        for (let i = 0; i < 12; i++) {
            if (i > 0 && i % 4 === 0) key += '-';
            key += chars[Math.floor(Math.random() * chars.length)];
        }
        return key;
    }

    function submitForm() {
        const formData = new FormData(form);
        fetch('/dashboard/php/insert.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(responseText => {
            try {
                const data = JSON.parse(responseText);
                if (data.success) {
                    console.log("License created successfully:", data.key);
                    keyInsertStatus.textContent = "Key insert success: true";
                    keyInsertStatus.style.color = 'green';
                    errorMessage.textContent = '';
                } else {
                    console.error("Error creating license:", data.message);
                    keyInsertStatus.textContent = "Key insert success: false";
                    keyInsertStatus.style.color = 'red';
                    errorMessage.textContent = data.message;
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                console.error("Response Text:", responseText);
                keyInsertStatus.textContent = "Key insert success: false";
                keyInsertStatus.style.color = 'red';
                errorMessage.textContent = responseText;
            }
        })
        .catch(error => {
            console.error("Error:", error);
            keyInsertStatus.textContent = "Key insert success: false";
            keyInsertStatus.style.color = 'red';
            errorMessage.textContent = error.message;
        });
    }

    window.addEventListener('load', function () {
        const loadingBar = document.getElementById('loading-bar');
        loadingBar.style.width = '100%';

        setTimeout(() => {
            loadingBar.style.width = '0';
        }, 500);
    });
});
