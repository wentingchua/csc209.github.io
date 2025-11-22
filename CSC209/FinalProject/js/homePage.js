function makeDropdown(productCategories) {
    const dropdown = document.getElementById("categoryDropdown");
    dropdown.innerHTML = '';
    const ulWrapper = document.createElement("ul");
    ulWrapper.setAttribute("class", "dropdown-menu");
    for (let i = 0; i < productCategories.length; i++) {
        const linkWrapper = document.createElement("li");
        const aWrapper = document.createElement("a");
        aWrapper.setAttribute("class", "dropdown-item");
        aWrapper.setAttribute("onclick", `handleCategorySelect('${productCategories[i]}')`)
        aWrapper.innerText = productCategories[i]
        linkWrapper.appendChild(aWrapper);
        ulWrapper.appendChild(linkWrapper);
    }
    dropdown.appendChild(ulWrapper);
}

function handleCategorySelect(category) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        products = JSON.parse(this.responseText)
        makeProductCards(category, products)
    }
    xhttp.open("GET", `php/homePage/products.php?category=${category}`, true);
    xhttp.send()
}

function makeProductCards(category, products) {
    const productDiv = document.getElementById("productCards");
    productDiv.innerHTML = '';

    // row container
    const row = document.createElement("div");
    row.setAttribute("class", "row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4");

    for (const product_key in products) {
        var product = products[product_key];

        // col wrapper
        const col = document.createElement("div");
        col.setAttribute("class", "col");

        // card wrapper
        const cardWrapper = document.createElement("div");
        cardWrapper.setAttribute("class", "card h-100"); // h-100 so cards equal height
        cardWrapper.setAttribute("style", "width: 100%;");

        const img = document.createElement("img");
        img.setAttribute("class", "card-img-top");
        img.setAttribute("src", `products/${category}/${product_key}.png`);

        const cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");

        const cardTitle = document.createElement("h5");
        cardTitle.innerText = product["title"];

        const cardPrice = document.createElement("h6");
        cardPrice.innerText = "$" + product["price"];

        const cardStock = document.createElement("h6");
        cardStock.innerText = "Stock: " + product["stock"];

        const cardDescription = document.createElement("p");
        cardDescription.innerText = product["description"];

        const linkToDetail = document.createElement("a");
        linkToDetail.setAttribute("class", "btn btn-primary me-2");
        linkToDetail.innerText = "View more";

        const addToCart = document.createElement("a");
        addToCart.setAttribute("class", "btn btn-success");
        addToCart.innerText = "Add to cart";

        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardPrice);
        cardBody.appendChild(cardStock);
        cardBody.appendChild(cardDescription);
        cardBody.appendChild(linkToDetail);
        cardBody.appendChild(addToCart);

        cardWrapper.appendChild(img);
        cardWrapper.appendChild(cardBody);

        col.appendChild(cardWrapper);
        row.appendChild(col);
    }

    productDiv.appendChild(row);
}

function handleAddToCartButtonPressed() {
    
}

