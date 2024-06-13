document.addEventListener('DOMContentLoaded', function() {
    configureToastr();
    setupCreateOrderButton();

    const observer = new MutationObserver(toggleCreateOrderButton);
    const targetNode = document.querySelector('.table tbody');
    if (targetNode) {
        observer.observe(targetNode, { childList: true, subtree: true });
    }

    function configureToastr() {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "2000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
    }

    function setupCreateOrderButton() {
        let createOrderButton = document.getElementById('createOrderButton');
        toggleCreateOrderButton();

        createOrderButton.addEventListener('click', function() {
            createOrder();
        });
    }

    function toggleCreateOrderButton() {
        let createOrderButton = document.getElementById('createOrderButton');
        if (document.querySelectorAll('.count').length > 0) {
            createOrderButton.style.display = 'block';
        } else {
            createOrderButton.style.display = 'none';
        }
    }

    function createOrder() {
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let cartItems = [];
        let totalPrice = 0;
        let items = document.querySelectorAll('.table tbody tr');

        items.forEach(item => {
            let count = parseInt(item.querySelector('.count').textContent.trim());
            let price = parseInt(item.querySelector('.price-per-item').textContent.trim());
            let id = item.dataset.id;
            let name = item.querySelector('#productName').dataset.name;
            let productType = item.dataset.product_type;

            cartItems.push({
                id: id,
                count: count,
                price: price,
                product_type: productType,
                name: name
            });
        });

        cartItems.forEach(item => {
            totalPrice += item.price * item.count;
        });

        fetch('/order/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                cartItems: cartItems,
                totalPrice: totalPrice
            })
        })
            .then(response => response.json())
            .then(data => {
                displayOrderDetails(data, cartItems, totalPrice);
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Error creating order: ' + error.message, 'Error', {
                    closeButton: true,
                    progressBar: true
                });
            });
    }

    function displayOrderDetails(data, cartItems, totalPrice) {
        let orderDetailsDiv = document.getElementById('orderDetails');
        let orderDetails = `
            <p>Order ID: ${data.order_id}</p>
            <p>Total Price: $${totalPrice.toFixed(2)}</p>
            <ul>
        `;
        cartItems.forEach(item => {
            orderDetails += `<li>${item.name} - ${item.count} x $${item.price.toFixed(2)}</li>`;
        });
        orderDetails += `</ul>`;

        orderDetailsDiv.innerHTML = orderDetails;

        let modalOkButton = document.getElementById('modalOkButton');
        modalOkButton.addEventListener('click', function() {
            $('#orderModal').modal('hide');
                toastr.success('Your order has been successfully placed!', 'Success', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000,
                    extendedTimeOut: 2000
                });

            setTimeout(function() {
                window.location.reload();
            }, 5000);
        });
    }
});
