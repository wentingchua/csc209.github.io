function getCartInfo(user_id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        productsInCart = JSON.parse(this.responseText);
        makeCartCards(productsInCart);
    }
    xhttp.open("GET", `../php/cart/getProductsInCart.php?user_id=${user_id}`, true);
    xhttp.send()
}

function makeCartCards(productsInCart) {
    const cart = document.getElementById("cart-section");
    cart.innerHTML = '';

    for (const product_id in productsInCart) {
        var product = productsInCart[product_id];

        var div1 = document.createElement("div");
        div1.setAttribute("class", "card rounded-3 mb-4");

        var div2 = document.createElement("div");
        div2.setAttribute("class", "card-body p-4");

        var div3 = document.createElement("div");
        div3.setAttribute("class", "row d-flex justify-content-between align-items-center");

        // Checkbox
        var div4z = document.createElement("div");
        div4z.setAttribute("class", "col-md-1 d-flex align-items-center");
        var formCheck = document.createElement("div");
        formCheck.setAttribute("class", "form-check m-0");
        var checkbox = document.createElement("input");
        checkbox.setAttribute("id", `checkbox-${product_id}`)
        checkbox.setAttribute("class", "form-check-input");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("onchange", `handleSelectProduct('${product["category"]}', '${product_id}', ${product["quantity"]}, ${product["price"]})`)
        if (product["quantity"] > product["stock"]) {
            checkbox.setAttribute("disabled", "");
            formCheck.setAttribute("data-toggle", "tooltip");
            formCheck.setAttribute("title", "Item is out of stock");
        }
        formCheck.appendChild(checkbox);
        div4z.appendChild(formCheck);

        // Image
        var div4a = document.createElement("div");
        div4a.setAttribute("class", "col-md-2");
        var img = document.createElement("img");
        img.setAttribute("class", "img-fluid rounded-3");
        img.setAttribute("width", 200)
        img.setAttribute("height", 200)
        img.setAttribute("style", "object-fit: cover")
        img.setAttribute("src", `../products/${product["category"]}/${product["image_path"]}`);
        div4a.appendChild(img);

        // Title & Description
        var div4b = document.createElement("div");
        div4b.setAttribute("class", "col-md-3");
        var title = document.createElement("p");
        title.setAttribute("class", "lead fw-normal mb-2");
        title.innerText = product["title"];
        var description = document.createElement("p");
        description.innerText = product["description"];
        div4b.appendChild(title);
        div4b.appendChild(description);

        // Quantity
        var div4c = document.createElement("div");
        div4c.setAttribute("class", "col-md-2 d-flex align-items-center");
        var quantity = document.createElement("p");
        quantity.setAttribute("class", "lead fw-normal mb-2");
        if (product["quantity"] > product["stock"]) {
            quantity.style.color = "red";
            quantity.innerText = "Out of stock";
        } else {
            quantity.innerText = product["quantity"];
        }
        div4c.appendChild(quantity);

        // Price
        var div4d = document.createElement("div");
        div4d.setAttribute("class", "col-md-2");
        var price = document.createElement("h5");
        price.innerText = "$" + product["price"];
        div4d.appendChild(price);

        // Remove button
        var div4e = document.createElement("div");
        div4e.setAttribute("class", "col-md-2");
        var deleteBtn = document.createElement("button");
        deleteBtn.className = "btn btn-danger btn-sm";
        deleteBtn.innerText = "Remove";
        deleteBtn.setAttribute("onclick",
            `removeItemFromCart('${product["category"]}','${product_id}', ${product["quantity"]}, ${product["price"]})`
        );
        div4e.appendChild(deleteBtn);

        div3.appendChild(div4z);
        div3.appendChild(div4a);
        div3.appendChild(div4b);
        div3.appendChild(div4c);
        div3.appendChild(div4d);
        div3.appendChild(div4e);

        div2.appendChild(div3);
        div1.appendChild(div2);
        cart.appendChild(div1);
    }
}

function handlePaymentButtonPressed() {
    if (nr_selected == 0) {
        showAlert("Select items to checkout.")
    }
    var totalStr = document.getElementById("totalAmount")
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", '../php/cart/makePayment.php');
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.onload = function () {
        if (JSON.parse(this.responseText) == "Success") {
            console.log("Success")
            selected_products = {};
            nr_selected = 0;
            total = 0;
            totalStr.innerText = `Total amount: $${total}`
            getCartInfo(user_id);
        } else if (JSON.parse(this.responseText) == "Empty cart") {
            showAlert("Cart is empty. Please add items to cart.")
        } else {
            console.log("Fail")
            // showAlert(JSON.parse(this.responseText))
            showAlert(`The following items cannot be checked out as they are out of stock: ${JSON.parse(this.responseText)}`)
            getCartInfo(user_id);
        }
    }
    xhttp.send(JSON.stringify(selected_products));
}

function showAlert(alert) {
    const alertDiv = document.getElementById("cartAlert");
    alertDiv.innerHTML = '';
    var alertBox = document.createElement("div");
    alertBox.setAttribute("class", "alert alert-danger");
    alertBox.innerText = alert;
    alertDiv.appendChild(alertBox);
}

function removeItemFromCart(category, product_id, quantity, price) {
    const xhttp = new XMLHttpRequest();
    handleSelectProduct(category, product_id, quantity, price, true)
    xhttp.onload = function () {
        if (JSON.parse(this.responseText) == "Success") {
            console.log("Success")
            getCartInfo(user_id);
        } else {
            console.log("Fail")
        }
    }
    xhttp.open("POST", `../php/cart/removeItem.php?category=${category}&product_id=${product_id}`);
    xhttp.send();
}

function handleSelectProduct(category, product_id, quantity, price, forceDeduct=false) {
    var checkbox = document.getElementById(`checkbox-${product_id}`)
    var totalStr = document.getElementById("totalAmount")
    if (checkbox.checked && !forceDeduct) {
        nr_selected++;
        total += price * quantity;
        totalStr.innerText = `Total amount: $${total}`
        if (!selected_products[category]) {
            selected_products[category] = {};
        }
        selected_products[category][product_id] = quantity;
        console.log(selected_products);
    } else {
        nr_selected--;
        total -= price * quantity;
        totalStr.innerText = `Total amount: $${total}`
        delete selected_products[category][product_id];
        console.log(selected_products);
    }
}