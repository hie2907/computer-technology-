document.addEventListener("DOMContentLoaded", function () {
    const addToCartBtn = document.getElementById("add-to-cart-btn");
    const productId = parseInt(
        document
            .querySelector(".product-details")
            .getAttribute("data-product-id")
    );
    if (addToCartBtn) {
        addToCartBtn.addEventListener("click", function () {
            const productName = document
                .getElementById("product-name")
                .textContent.trim();
            const mainImage = document.querySelector(
                "#product-main-img .product-preview img"
            ).src;
            const qty = parseInt(
                document.getElementById("product-qty").value,
                10
            );
            const price = document
                .getElementById("product-price")
                .textContent.trim()
                .split(" ")[0];
            // const productId = "{{$products->productId}}";
            const product = addProductToLocalStorage(
                productId,
                productName,
                mainImage,
                qty,
                price
            );
            updateCartUI(product);
        });
    } else {
        console.error("Add to Cart button not found");
    }
});
