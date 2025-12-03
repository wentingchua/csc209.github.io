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
        div3.setAttribute("class", "row d-flex justify-content-between align-items-center")

        //Image
        var div4a = document.createElement("div");
        div4a.setAttribute("class", "col-md-2 col-lg-2 col-xl-2");
        var img = document.createElement("img")
        img.setAttribute("class", "img-fluid rounded-3");
        img.setAttribute("src", `../products/${product["category"]}/${product_id}.png`);
        div4a.appendChild(img);

        //Title & Description
        var div4b = document.createElement("div");
        div4b.setAttribute("class", "col-md-3 col-lg-3 col-xl-3");
        var title = document.createElement("p");
        title.setAttribute("class", "lead fw-normal mb-2");
        title.innerText = product["title"];
        var description = document.createElement("p");
        description.innerText = product["description"];
        div4b.appendChild(title);
        div4b.appendChild(description);

        //Quantity
        var div4c = document.createElement("div");
        div4c.setAttribute("class", "col-md-3 col-lg-3 col-xl-2 d-flex");
        var quantity = document.createElement("p");
        quantity.setAttribute("class", "lead fw-normal mb-2");
        if (product["quantity"] > product["stock"]) {
            quantity.setAttribute("style", "color: red")
            quantity.innerText = "Out of stock";
        }
        else {
            quantity.innerText = product["quantity"];
        }
        div4c.appendChild(quantity);

        //Price
        var div4d = document.createElement("div");
        div4d.setAttribute("class", "col-md-3 col-lg-2 col-xl-2 offset-lg-1");
        var price = document.createElement("h5");
        price.innerText = "$" + product["price"];
        div4d.appendChild(price);

        //Remove item
        var div4e = document.createElement("div")
        div4e.setAttribute("class", "col-md-3 col-lg-1 col-xl-2 text-end");
        var deleteBtn = document.createElement("button");
        deleteBtn.className = "btn btn-danger btn-sm";
        deleteBtn.innerText = "Remove";
        deleteBtn.setAttribute("onclick", `removeItemFromCart('${product["category"]}','${product_id}')`)
        div4e.appendChild(deleteBtn);

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
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (JSON.parse(this.responseText) == "Success") {
            console.log("Success")
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
    xhttp.open("POST", '../php/cart/makePayment.php');
    xhttp.send();
}

function showAlert(alert) {
    const alertDiv = document.getElementById("cartAlert");
    alertDiv.innerHTML = '';
    var alertBox = document.createElement("div");
    alertBox.setAttribute("class", "alert alert-danger");
    alertBox.innerText = alert;
    alertDiv.appendChild(alertBox);
}

function removeItemFromCart(category, product_id) {
    console.log("test")
    const xhttp = new XMLHttpRequest();
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