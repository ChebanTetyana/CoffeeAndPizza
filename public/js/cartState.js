document.addEventListener('DOMContentLoaded', function () {
    updateCartState();
});

function updateCartState() {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            document.getElementById('cartCount').textContent = data.count;
        });
}
