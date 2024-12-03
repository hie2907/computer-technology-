async function compareAndUpdateDb() {
    let products = JSON.parse(localStorage.getItem("products")) || [];
    let csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    try {
        let response = await fetch("/cart-item", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(products),
        });

        if (response.ok) {
            console.log("Cart items compared and updated with DB successfully");
        } else {
            console.error("Failed to compare and update cart items with DB");
        }
    } catch (error) {
        console.error(
            "Error comparing and updating cart items with DB:",
            error
        );
    }
}

function isUserLoggedIn() {
    return !!document.querySelector('meta[name="csrf-token"]'); // Kiểm tra nếu có CSRF token
}

// Thêm hoặc cập nhật sản phẩm trong Local Storage và trả về sản phẩm cập nhật
function addProductToLocalStorage(
    productId,
    productName,
    mainImage,
    qty,
    price
) {
    let products = JSON.parse(localStorage.getItem("products")) || [];
    const existingProductIndex = products.findIndex(
        (product) => product.name === productName && product.image === mainImage
    );

    if (existingProductIndex !== -1) {
        // Sản phẩm đã tồn tại, cập nhật số lượng
        products[existingProductIndex].quantity =
            parseInt(products[existingProductIndex].quantity) + parseInt(qty);
        console.log(
            "Updated product quantity in Local Storage:",
            products[existingProductIndex]
        );
        localStorage.setItem("products", JSON.stringify(products)); // Cập nhật lại Local Storage
        if (isUserLoggedIn()) {
            compareAndUpdateDb(); // So sánh và cập nhật với DB
        }
        return products[existingProductIndex];
    } else {
        // Sản phẩm chưa tồn tại, thêm mới
        const product = {
            productId: productId,
            name: productName,
            image: mainImage,
            quantity: qty,
            price: price,
        };
        products.push(product);
        console.log("Adding new product to Local Storage:", product);
        localStorage.setItem("products", JSON.stringify(products));
        updateCartUI(
            products[existingProductIndex] || products[products.length - 1]
        );
        if (isUserLoggedIn()) {
            compareAndUpdateDb(); // So sánh và cập nhật với DB
        }
    }
    // uploadCartItems();
    // return products[existingProductIndex] || product;
}

// Cập nhật giao diện giỏ hàng
function updateCartUI(product) {
    const cartList = document.querySelector(".cart-list");
    let cartItem = cartList.querySelector(`[data-id='${product.productId}']`);

    if (cartItem) {
        // Nếu sản phẩm đã tồn tại trong DOM, cập nhật số lượng
        const qtyElement = cartItem.querySelector(".qty");
        qtyElement.textContent = `${product.quantity}x`;
    } else {
        // Nếu sản phẩm chưa tồn tại trong DOM, thêm mới
        const cartItemTemplate = document.getElementById("cart-item-template");
        const clone = cartItemTemplate.content.cloneNode(true);
        clone.querySelector(".cart-item-img").src = product.image;
        clone.querySelector(".product-name a").textContent = product.name;
        clone.querySelector(".qty").textContent = `${product.quantity}x`;
        clone.querySelector(".price").textContent = `${product.price} đ`;

        // Gắn ID duy nhất cho phần tử
        const productWidget = clone.querySelector(".product-widget");
        productWidget.setAttribute("data-id", product.productId);

        // Gắn sự kiện xóa sản phẩm
        productWidget
            .querySelector(".delete")
            .addEventListener("click", function () {
                console.log("Deleting product:", product);

                // Xóa sản phẩm khỏi Local Storage
                let products =
                    JSON.parse(localStorage.getItem("products")) || [];
                products = products.filter(
                    (p) => p.productId !== product.productId
                );
                localStorage.setItem("products", JSON.stringify(products));

                // Xóa phần tử khỏi DOM
                this.closest(".product-widget").remove();

                // Cập nhật tổng số lượng và hiển thị lại
                updateCartSummary(products);
                updateCartQty();
                if (isUserLoggedIn()) {
                    compareAndUpdateDb(); // So sánh và cập nhật với DB
                }
            });

        cartList.appendChild(clone);
    }

    updateCartQty();
}
async function syncCartItems() {
    let products = JSON.parse(localStorage.getItem("products")) || [];
    console.log("Local products:", products);

    try {
        // Lấy CSRF token từ meta tag
        let csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        console.log("CSRF Token:", csrfToken);

        let response = await fetch("/cart-item", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(products),
        });

        console.log("Response status:", response.status);
        console.log("Response headers:", [...response.headers.entries()]);

        if (response.ok) {
            let serverCartItems = await response.json();
            console.log("Server cart items:", serverCartItems);

            let localProductIds = products.map((product) => product.productId);

            // Cập nhật local storage từ dữ liệu server
            serverCartItems.forEach((item) => {
                let localProduct = products.find(
                    (product) => product.productId === item.productId
                );
                if (localProduct) {
                    if (localProduct.quantity !== item.quantity) {
                        localProduct.quantity = item.quantity;
                    }
                } else {
                    products.push({
                        productId: item.productId,
                        name: item.name,
                        image: item.image,
                        quantity: item.quantity,
                        price: item.price,
                    });
                }
            });

            // Cập nhật local storage
            localStorage.setItem("products", JSON.stringify(products));
            console.log("Cart items synced successfully");
        } else {
            let errorText = await response.text();
            console.error(
                "Failed to sync cart items. Response text:",
                errorText
            );
        }
    } catch (error) {
        console.error("Error syncing cart items:", error);
    }
}
document
    .getElementById("login-form")
    .addEventListener("submit", async (event) => {
        event.preventDefault(); // Ngăn chặn form submit mặc định

        console.log("Form submitted"); // Ghi nhật ký khi form được submit

        let form = event.target;
        let formData = new FormData(form);

        let csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"); // Lấy CSRF token từ meta tag
        console.log("CSRF Token for login:", csrfToken); // Ghi nhật ký CSRF token cho đăng nhập

        let response = await fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken, // Thêm CSRF token vào headers
            },
            body: formData,
        });

        console.log("Login response status:", response.status); // Ghi nhật ký trạng thái phản hồi
        console.log("Login response headers:", [...response.headers.entries()]); // Ghi nhật ký headers phản hồi

        if (response.ok) {
            let result = await response.json();
            console.log("Response from server:", result); // Ghi nhật ký phản hồi từ server
            if (result.success) {
                console.log("Calling syncCartItems"); // Ghi nhật ký trước khi gọi syncCartItems
                await syncCartItems(); // Đồng bộ hóa giỏ hàng sau khi đăng nhập
                window.location.href = result.redirect; // Điều hướng sau khi đăng nhập thành công
            } else {
                console.error(result.error);
            }
        } else {
            console.error("Failed to login");
        }
    });

// Cập nhật tổng số lượng sản phẩm trong giỏ hàng
function updateCartQty() {
    let products = JSON.parse(localStorage.getItem("products")) || [];
    let totalQty = products.reduce(
        (sum, product) => sum + parseInt(product.quantity),
        0
    );
    document.querySelector(".cart-qty").textContent = totalQty;

    let subtotal = products.reduce(
        (sum, product) =>
            sum +
            product.quantity * parseFloat(product.price.replace(/,/g, "")),
        0
    );
    document.querySelector(
        ".cart-summary small"
    ).textContent = `${products.length} Item(s) selected`;
    document.querySelector(
        ".cart-summary h5"
    ).textContent = `SUBTOTAL: ${subtotal.toLocaleString()} đ`;
}

// Hiển thị các sản phẩm trong giỏ hàng
function displayCartItems() {
    const cartList = document.querySelector(".cart-list");
    const cartItemTemplate = document.getElementById("cart-item-template");
    let products = JSON.parse(localStorage.getItem("products")) || [];

    products.forEach((product, index) => {
        const clone = cartItemTemplate.content.cloneNode(true);
        // Gán id duy nhất cho mỗi phần tử
        clone.querySelector(".cart-item-img").src = product.image;
        clone.querySelector(".product-name a").textContent = product.name;
        clone.querySelector(".qty").textContent = product.quantity + "x";
        clone.querySelector(".price").textContent = product.price + " đ";

        // Gắn ID duy nhất cho phần tử
        clone
            .querySelector(".product-widget")
            .setAttribute("data-id", product.productId);

        // Gắn sự kiện xóa sản phẩm
        clone.querySelector(".delete").addEventListener("click", function () {
            // Xóa sản phẩm khỏi Local Storage
            products = products.filter(
                (p) => p.productId !== product.productId
            );
            localStorage.setItem("products", JSON.stringify(products));

            // Xóa phần tử khỏi DOM
            this.closest(".product-widget").remove();

            // Cập nhật tổng cộng và hiển thị lại
            updateCartSummary(products);
            updateCartQty();

            if (isUserLoggedIn()) {
                compareAndUpdateDb(); // So sánh và cập nhật với DB
            }
        });

        cartList.appendChild(clone);
    });

    updateCartSummary(products);
    updateCartQty();
}

// Cập nhật tổng tiền giỏ hàng
function updateCartSummary(products) {
    let subtotal = 0;
    products.forEach((product) => {
        subtotal +=
            product.quantity * parseFloat(product.price.replace(/,/g, ""));
    });
    document.querySelector(
        ".cart-summary small"
    ).textContent = `${products.length} Item(s) selected`;
    document.querySelector(
        ".cart-summary h5"
    ).textContent = `SUBTOTAL: ${subtotal.toLocaleString()} đ`;
}
