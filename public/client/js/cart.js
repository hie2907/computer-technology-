document.addEventListener("DOMContentLoaded", function () {
    displayCartItems();

    function displayCartItems() {
        const cartItemsContainer = document.getElementById("cart-items");
        const products = JSON.parse(localStorage.getItem("products")) || [];
        let subtotal = 0;

        products.forEach((product) => {
            const productElement = document.createElement("div");
            productElement.classList.add("product-cart");

            const productHTML = `
                <input type="checkbox" class="product-checkbox" data-id="${
                    product.productId
                }">
                <img src="${product.image}" alt="${
                product.name
            }" class="product-image-cart">

                <div class="product-info-cart">
                    <a href="#" class="product-name-cart">${product.name}</a>
                    <div class="sku-cart">SKU: ${product.productId}</div>
                    <div class="price-cart">
                        <span class="current-price-cart-old">${parseFloat(
                            product.price
                        ).toLocaleString()}đ</span>
                        <span class="original-price-cart">3.990.000đ</span>
                    </div>
                    <div style="display: flex; align-items: center; margin-top: 8px;">
                        <div class="quantity-controls-cart">
                            <button class="quantity-btn-cart" onclick="updateQuantity('${
                                product.productId
                            }', -1)">-</button>
                            <input type="text" value="${
                                product.quantity
                            }" class="quantity-input-cart" readonly>
                            <button class="quantity-btn-cart" onclick="updateQuantity('${
                                product.productId
                            }', 1)">+</button>
                        </div>
                        <a href="#" class="delete-btn-cart" onclick="deleteProduct('${
                            product.productId
                        }')">Xóa</a>
                    </div>
                </div>

                <div class="price-column-cart">
                    <div class="price-label-cart">Thành tiền</div>
                    <div class="current-price-cart-new">${(
                        product.quantity * parseFloat(product.price)
                    ).toLocaleString()}đ</div>
                </div>
            `;

            productElement.innerHTML = productHTML;
            cartItemsContainer.appendChild(productElement);

            subtotal += product.quantity * parseFloat(product.price);
        });

        document.getElementById(
            "subtotal"
        ).textContent = `${subtotal.toLocaleString()}đ`;
        document.getElementById(
            "total-price"
        ).textContent = `${subtotal.toLocaleString()}đ`;

        document.getElementById("select-all").checked = true;
        // Tích tất cả các sản phẩm checkbox
        document.querySelectorAll(".product-checkbox").forEach((checkbox) => {
            checkbox.checked = true;
        });

        // Cập nhật tổng tiền khi trang được tải lại
        updateTotalPrice();

        // Lắng nghe sự kiện thay đổi trên các checkbox để cập nhật tổng tiền
        document.querySelectorAll(".product-checkbox").forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                updateTotalPrice();
            });
        });

        // Lắng nghe sự kiện click trên checkbox của company-cart để tick tất cả checkbox của product-checkbox
        document
            .getElementById("select-all")
            .addEventListener("change", function () {
                const checkboxes =
                    document.querySelectorAll(".product-checkbox");
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
                updateTotalPrice(); // Cập nhật tổng tiền khi chọn/bỏ chọn tất cả
            });

        document
            .getElementById("delete-all")
            .addEventListener("click", function (event) {
                event.preventDefault();
                localStorage.removeItem("products");
                location.reload();
            });
    }
    // Hàm cập nhật tổng tiền
    function updateTotalPrice() {
        let products = JSON.parse(localStorage.getItem("products")) || [];
        let subtotal = 0;

        document.querySelectorAll(".product-checkbox").forEach((checkbox) => {
            if (checkbox.checked) {
                const productId = checkbox.dataset.id;
                const product = products.find(
                    (product) =>
                        product.productId.toString() === productId.toString()
                );
                if (product) {
                    subtotal += product.quantity * parseFloat(product.price);
                }
            }
        });

        document.getElementById(
            "subtotal"
        ).textContent = `${subtotal.toLocaleString()}đ`;
        document.getElementById(
            "total-price"
        ).textContent = `${subtotal.toLocaleString()}đ`;
    }

    window.updateQuantity = function (productId, change) {
        let products = JSON.parse(localStorage.getItem("products")) || [];
        console.log("Products:", products);
        console.log("Updating product with ID:", productId);

        const productIndex = products.findIndex(
            (product) => product.productId.toString() === productId.toString()
        );
        console.log("Product index:", productIndex);

        if (productIndex !== -1) {
            products[productIndex].quantity = Math.max(
                1,
                products[productIndex].quantity + change
            );
            console.log(
                "Updated product quantity:",
                products[productIndex].quantity
            );
            localStorage.setItem("products", JSON.stringify(products));
            if (isUserLoggedIn()) {
                compareAndUpdateDb(); // So sánh và cập nhật với DB
            }
            updateTotalPrice(); // Cập nhật tổng tiền khi thay đổi số lượng
            location.reload();
        }
    };
    window.deleteProduct = function (productId) {
        let products = JSON.parse(localStorage.getItem("products")) || [];
        console.log("Products:", products);
        console.log("Deleting product with ID:", productId);

        products = products.filter(
            (product) => product.productId.toString() !== productId.toString()
        );
        console.log("Updated products:", products);

        localStorage.setItem("products", JSON.stringify(products));
        if (isUserLoggedIn()) {
            compareAndUpdateDb(); // So sánh và cập nhật với DB
        }
        updateTotalPrice(); // Cập nhật tổng tiền khi thay đổi số lượng
        location.reload();
    };

    // Gui sang payment
    const products = JSON.parse(localStorage.getItem("products")) || [];
    document
        .querySelector(".checkout-btn-cart")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            let selectedProducts = [];
            document
                .querySelectorAll(".product-checkbox:checked")
                .forEach((checkbox) => {
                    const productId = checkbox.dataset.id;
                    const product = products.find(
                        (product) =>
                            product.productId.toString() ===
                            productId.toString()
                    );
                    if (product) {
                        selectedProducts.push(product);
                        console.log("Selected product:", product);
                    }
                });

            localStorage.setItem(
                "selectedProducts",
                JSON.stringify(selectedProducts)
            );

            if (isUserLoggedIn()) {
                window.location.href = "/cart/payment"; // Thay thế bằng route của bạn nếu cần thiết
            } else {
                window.location.href = "/user-login"; // Thay thế bằng route của bạn nếu cần thiết
            }
        });
});
