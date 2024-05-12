document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.size-select').forEach(function(select) {
        select.addEventListener('change', function() {
            let selectedSize = this.value;
            fetch('/get-price?size=' + selectedSize)
                .then(response => response.json())
                .then(data => {
                    let price = data.price;
                    let cardBody = this.closest('.card-body');
                    cardBody.querySelector('.card-price').textContent = 'Price: $' + price;
                });
        });
    });

    document.querySelectorAll('.addToCart').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            let productId = this.dataset.productId;
            let sizeSelect = this.closest('.card-body').querySelector('.size-select');
            let size = sizeSelect ? sizeSelect.value : 'M';
            let price = sizeSelect ? sizeSelect.closest('.card-body').querySelector('.card-price').textContent.replace('Price: $', '') : '3.00';

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    size: size,
                    price: price
                })
            })
                .then(response => {
                    if (response.ok) {
                        updateCartState();
                    } else {
                        console.error('Error:', response.status);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
});

