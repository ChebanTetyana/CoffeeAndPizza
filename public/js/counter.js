document.addEventListener('DOMContentLoaded', function() {
        let decreaseButtons = document.querySelectorAll('.decrease-btn');
        let increaseButtons = document.querySelectorAll('.increase-btn');

        decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let countElement = this.nextElementSibling;
            let count = parseInt(countElement.textContent);
            if (count > 1) {
                count--;
                countElement.textContent = count;
                updateTotalPrice(id, count);
                updateTotalOrderPrice();
            }
        });
    });

    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let countElement = this.previousElementSibling;
            let count = parseInt(countElement.textContent);
            count++;
            countElement.textContent = count;
            updateTotalPrice(id, count);
            updateTotalOrderPrice();
        });
    });

    function updateTotalPrice(id, count) {
        let pricePerItemElement = document.querySelector(`[data-id="${id}"].price-per-item`);
        let totalPriceElement = document.querySelector(`[data-id="${id}"].total-price`);

        if (pricePerItemElement && totalPriceElement) {
            let pricePerItem = parseFloat(pricePerItemElement.textContent.replace(/[^\d.]/g, ''));
            totalPriceElement.textContent = (pricePerItem * count).toFixed(2);
        }
    }

    function updateTotalOrderPrice() {
        let totalPriceElements = document.querySelectorAll('.total-price');
        let totalPrice = Array.from(totalPriceElements).reduce((sum, element) => {
            return sum + parseFloat(element.textContent.replace(/[^\d.]/g, ''));
        }, 0);

        document.getElementById('totalPrice').textContent = 'Total price: ' + totalPrice.toFixed(2);
    }
});

