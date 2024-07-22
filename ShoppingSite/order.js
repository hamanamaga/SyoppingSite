document.addEventListener('DOMContentLoaded', function () {
    const billingAddressSelect = document.getElementById('addressee');
    const billingAddressFields = document.getElementById('billingAddress');
    const newCardRadio = document.getElementById('newCard');
    const newCardFields = document.getElementById('newCardFields');
    const payLaterRadio = document.getElementById('payLater');
    const payLaterFields = document.getElementById('payLaterFields');

    billingAddressSelect.addEventListener('change', function () {
        if (this.value === 'その他住所を入力') {
            billingAddressFields.classList.remove('hidden');
            Array.from(billingAddressFields.querySelectorAll('input, select')).forEach(input => {
                if (input.id !== 'billing_building') {
                    input.required = true;
                }
            });
        } else {
            billingAddressFields.classList.add('hidden');
            Array.from(billingAddressFields.querySelectorAll('input, select')).forEach(input => input.required = false);
        }
    });

    newCardRadio.addEventListener('change', function () {
        if (this.checked) {
            newCardFields.classList.remove('hidden');
            Array.from(newCardFields.querySelectorAll('input')).forEach(input => input.required = true);
            payLaterFields.classList.add('hidden');
            Array.from(payLaterFields.querySelectorAll('input')).forEach(input => input.required = false);
        }
    });

    payLaterRadio.addEventListener('change', function () {
        if (this.checked) {
            payLaterFields.classList.remove('hidden');
            Array.from(payLaterFields.querySelectorAll('input')).forEach(input => input.required = true);
            newCardFields.classList.add('hidden');
            Array.from(newCardFields.querySelectorAll('input')).forEach(input => input.required = false);
        }
    });

    document.getElementById('orderForm').addEventListener('submit', function (event) {
        const inputs = this.querySelectorAll('input[pattern]');
        inputs.forEach(input => {
            if (input.validity.patternMismatch) {
                const errorMessage = input.getAttribute('data-error-message');
                input.setCustomValidity(errorMessage);
            } else {
                input.setCustomValidity('');
            }
        });
    });

    const inputs = document.querySelectorAll('input[pattern]');
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            if (this.validity.patternMismatch) {
                const errorMessage = this.getAttribute('data-error-message');
                this.setCustomValidity(errorMessage);
            } else {
                this.setCustomValidity('');
            }
        });
    });
});