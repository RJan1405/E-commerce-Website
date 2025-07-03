$(document).ready(function () {
    // Increment button
    $('.increment-btn').off('click').on('click', function (e) {
        e.preventDefault();
        console.log("Increment button clicked");

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        } else {
            $(this).closest('.product_data').find('.message').text("Maximum quantity reached.").fadeIn().delay(2000).fadeOut();
        }
    });

    // Decrement button
    $('.decrement-btn').off('click').on('click', function (e) {
        e.preventDefault();
        console.log("Decrement button clicked");

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        } else {
            $(this).closest('.product_data').find('.message').text("Minimum quantity reached.").fadeIn().delay(2000).fadeOut();
        }
    });

    // Add to cart button
    $('.addToCartBtn').off('click').on('click', function (e) {
        e.preventDefault();
        console.log("Add to cart button clicked");

        var button = $(this);
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();

        // Prevent multiple submissions
        if (button.prop('disabled')) {
            return; // If the button is already disabled, do nothing
        }

        // Disable the button
        button.prop('disabled', true);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                console.log(response); // Log the overall response
                if (response == 201) {
                    swal({
                        text: "Product added to cart",
                        icon: "success",
                    });
                } else if (response == "existing") {
                    swal({
                        text: "Already in cart",
                        icon: "info",
                    });
                } else if (response == 401) {
                    swal({
                        text: "You must be logged in to add products to cart",
                        icon: "warning",
                    });
                } else if (response == 500) {
                    swal({
                        text: "Something went wrong",
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error details:", xhr.responseText);
                alert("Request failed: " + xhr.status + " - " + error);
            },
            complete: function () {
                // Re-enable the button
                button.prop('disabled', false);
            }
        });
    });

    // Update quantity button
    $(document).on('click', '.updateQty', function () {
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                // Handle response if needed
            }
        });
    });

    // Delete item button
    $(document).on('click', '.deleteItem', function (e) {
        e.preventDefault();
        console.log("Product Removed");

        // Assuming cart_id is stored in a data attribute
        var cart_id = $(this).val(); // Use data attribute instead of .val()

        // Define button as the clicked element
        var button = $(this);

        // Prevent multiple submissions
        if (button.prop('disabled')) {
            return; // If the button is already disabled, do nothing
        }

        // Disable the button immediately
        button.prop('disabled', true);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                console.log(response); // Log the overall response
                if (response == 200) {
                    swal({
                        text: "Product successfully removed from cart",
                        icon: "success",
                    });
                    // Reload the cart section
                    $('#mycart').load(location.href + " #mycart"); // Load the updated cart from the server
                } else {
                    swal({
                        text: response,
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error details:", xhr.responseText);
                alert("Request failed: " + xhr.status + " - " + error);
            },
            complete: function () {
                // Re-enable the button after the request completes
                button.prop('disabled', false);
            }
        });
    });



   

});
