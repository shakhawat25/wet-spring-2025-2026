const TAX_RATE = 5;

const originalPriceInput = document.getElementById('original-price');
const discountPercentInput = document.getElementById('discount-percent');
const finalPriceInput = document.getElementById('final-price');
const taxRateDisplay = document.getElementById('tax-rate');

const priceError = document.getElementById('price-error');
const discountError = document.getElementById('discount-error');

let budgetDealAlertShown = false;

taxRateDisplay.textContent = TAX_RATE;

function updateFinalPrice() {
    let originalPrice = Number(originalPriceInput.value);
    let discountPercent = Number(discountPercentInput.value);

    if (Number.isNaN(originalPrice)) {
        originalPrice = 0;
    }

    if (Number.isNaN(discountPercent)) {
        discountPercent = 0;
    }

    priceError.textContent = '';
    discountError.textContent = '';

    if (originalPrice < 0) {
        originalPrice = 0;
        originalPriceInput.value = 0;
        priceError.textContent = 'Original price cannot be less than 0.';
    }

    if (discountPercent < 0) {
        discountPercent = 0;
        discountPercentInput.value = 0;
        discountError.textContent = 'Discount percentage cannot be less than 0.';
    }

    if (discountPercent > 100) {
        discountPercent = 100;
        discountPercentInput.value = 100;
        discountError.textContent = 'Discount percentage cannot exceed 100.';
    }

    const discountAmount = (originalPrice * discountPercent) / 100;
    const priceAfterDiscount = originalPrice - discountAmount;
    const taxAmount = (priceAfterDiscount * TAX_RATE) / 100;
    const finalPrice = priceAfterDiscount + taxAmount;

    finalPriceInput.value = `৳${finalPrice.toFixed(2)}`;

    if (finalPrice < 500 && originalPrice > 0 && !budgetDealAlertShown) {
        alert('Congratulations! You unlocked a Budget Deal.');
        budgetDealAlertShown = true;
    }

    if (finalPrice >= 500 || originalPrice === 0) {
        budgetDealAlertShown = false;
    }
}

originalPriceInput.addEventListener('input', updateFinalPrice);
discountPercentInput.addEventListener('input', updateFinalPrice);

updateFinalPrice();