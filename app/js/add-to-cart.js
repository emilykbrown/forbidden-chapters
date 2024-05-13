sdocument.addEventListener("DOMContentLoaded", function() {
    var buyNowBtn = document.getElementById("buyNowBtn");
    var addToCartBtn = document.getElementById("addToCartBtn");
    var loginModal = document.getElementById("login_modal");

    buyNowBtn.addEventListener("click", function(event) {
        event.preventDefault();
        if (isLoggedIn()) {
            window.location.href = "#"; 
        } else {
            openLoginModal();
        }
    });

    addToCartBtn.addEventListener("click", function(event) {
        event.preventDefault();
        if (isLoggedIn()) {
            // Your Add to Cart logic here
        } else {
            openLoginModal();
        }
    });

    function isLoggedIn() {
        // Your logic to check if the user is logged in
    }

    function openLoginModal() {
        // Your code to open the login modal
    }
});
