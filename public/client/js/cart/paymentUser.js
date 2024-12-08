document.addEventListener("DOMContentLoaded", function () {
    const selectedProducts =
        JSON.parse(localStorage.getItem("selectedProducts")) || [];
    const orderProductsContainer = document.querySelector(".order-products");
    let total = 0;

    selectedProducts.forEach((product) => {
        const productElement = document.createElement("div");
        productElement.classList.add("order-col");

        const productHTML = `
<div>${product.quantity}x ${product.name}</div>
<div>${(product.quantity * parseFloat(product.price)).toLocaleString()}đ
</div>`;

        productElement.innerHTML = productHTML;
        orderProductsContainer.appendChild(productElement);

        total += product.quantity * parseFloat(product.price);
    });

    document.querySelector(
        ".order-total"
    ).textContent = `${total.toLocaleString()}đ`;

    //add to db
    document
        .querySelector(".order-submit")
        .addEventListener("click", function () {
            const orderData = {
                name: document.querySelector('input[name="payment-name"]')
                    .value,
                email: document.querySelector('input[name="payment-email"]')
                    .value,
                location: document.querySelector(
                    'input[name="payment-address"]'
                ).value,
                phone: document.querySelector('input[name="payment-tel"]')
                    .value,
                note: document.querySelector('textarea[name="payment-note"]')
                    .value,
                products: selectedProducts,
                total: total,
            };

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
            fetch("/cart/postpayment", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify(orderData),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Đặt hàng thành công!");
                        // localStorage.removeItem("selectedProducts");
                        window.location.href = "/";
                    } else {
                        alert("Có lỗi xảy ra, vui lòng thử lại.");
                    }
                });
        });

    $(document).ready(function () {
        $('input[name="paymentMethod"]').change(function () {
            if ($(this).val() === "zalopay") {
                $.ajax({
                    url: "/cart/bank-payment",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({ paymentMethod: "zalopay" }),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (data) {
                        if (data.order_url) {
                            window.location.href = data.order_url;
                        } else {
                            console.error("Payment failed", data);
                        }
                    },
                    error: function (error) {
                        console.error("Error:", error);
                    },
                });
            } else if ($(this).val() === "paypal") {
                // handle paypal
            }
        });
    });
});
