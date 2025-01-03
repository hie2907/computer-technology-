$(document).ready(function () {
    window.filterProducts = function () {
        var category_ids = [];
        var brand_ids = [];
        var price_min = parseFloat($("#price-min").val());
        var price_max = parseFloat($("#price-max").val());
        var sort_option = $("#sort-select").val();
        var display_count = $("#display-select").val();

        $(".category-checkbox:checked").each(function () {
            category_ids.push(parseInt($(this).val()));
        });

        $(".brand-checkbox:checked").each(function () {
            brand_ids.push(parseInt($(this).val()));
        });

        console.log(
            "Sending request:",
            category_ids,
            brand_ids,
            price_min,
            price_max,
            sort_option,
            display_count
        ); // Log request data

        $.ajax({
            url: "/category/filter-product",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                category_ids: category_ids,
                brand_ids: brand_ids,
                price_min: price_min,
                price_max: price_max,
                sort_option: sort_option,
                display_count: display_count,
            },
            success: function (response) {
                console.log("Received response:", response); // Log response data
                $("#product-list").html(response.html);
                attachProductEventHandlers();
            },

            error: function (xhr, status, error) {
                console.log("AJAX error:", status, error);
                console.log(xhr.responseText);
            },
        });
    };

    $(".category-checkbox, .brand-checkbox").change(function () {
        filterProducts();
    });
    $("#price-min, #price-max").on("input", function () {
        filterProducts();
    });
    $("#sort-select, #display-select").change(function () {
        filterProducts();
    });

    function attachProductEventHandlers() {
        $(".product").on("click", function (event) {
            // Nếu không nhấp vào nút add to cart, điều hướng đến trang chi tiết sản phẩm
            if (!$(event.target).closest(".add-to-cart-btn").length) {
                window.location = $(this).data("href");
            }
        });
        $(".product-widget").on("click", function (event) {
            window.location = $(this).data("href");
        });

        $(".product").on("mouseover", function () {
            $(this).css("cursor", "pointer");
        });
        $(".product-widget").on("mouseover", function () {
            $(this).css("cursor", "pointer");
        });
        $(".add-to-cart-btn-product").on("click", function (event) {
            event.preventDefault();
            const productElement = $(this).closest(".product");
            const productName = productElement
                .find(".cart-product-name")
                .text()
                .trim();
            const productPrice = productElement
                .find(".cart-product-price")
                .text()
                .trim()
                .split(" ")[0];
            const productImage = productElement
                .find(".homeproduct")
                .attr("src");
            const productId = parseInt(
                productElement.data("product-list-id"),
                10
            );
            const product = addProductToLocalStorage(
                productId,
                productName,
                productImage,
                1,
                productPrice
            );
            updateCartUI(product);
        });
    }

    attachProductEventHandlers();
});
