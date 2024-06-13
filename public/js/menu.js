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
                    cardBody.querySelector('.addToCart').dataset.price = price;
                });
        });
    });

    document.querySelectorAll('.addToCart').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            let productId = this.dataset.productId;
            let productType = this.dataset.productType;
            let sizeSelect = this.closest('.card-body').querySelector('.size-select');
            let size = sizeSelect ? sizeSelect.value : null;
            let price = this.dataset.price;
            let userIdMeta = document.querySelector('meta[name="user-id"]');
            let userId = userIdMeta ? userIdMeta.getAttribute('content') : null;

            let requestData = {
                product_id: productId,
                size: size,
                price: price,
            };

            if (userId) {
                requestData.user_id = userId;
            }

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(requestData)
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

    document.getElementById('logout-button').addEventListener('click', function() {
        let userIdMeta = document.querySelector('meta[name="user-id"]');
        if (userIdMeta) {
            userIdMeta.remove();
        }
        document.getElementById('logout-form').submit();
    });
});

