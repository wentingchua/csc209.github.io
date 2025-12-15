function makeDropdown(productCategories, isAdmin, isLogin) {
    const dropdown = document.getElementById("categoryDropdown");
    dropdown.innerHTML = '';
    const ulWrapper = document.createElement("ul");
    ulWrapper.setAttribute("class", "dropdown-menu");
    for (let i = 0; i < productCategories.length; i++) {
        const linkWrapper = document.createElement("li");
        const aWrapper = document.createElement("a");
        aWrapper.setAttribute("class", "dropdown-item");
        aWrapper.setAttribute("onclick", `handleCategorySelect(${JSON.stringify(productCategories)}, '${productCategories[i]}', ${isAdmin}, ${isLogin})`)
        aWrapper.innerText = productCategories[i]
        linkWrapper.appendChild(aWrapper);
        ulWrapper.appendChild(linkWrapper);
    }
    dropdown.appendChild(ulWrapper);
}

function makeButtonGroup(productCategories, isAdmin, isLogin) {
    const buttons = document.getElementById("categoryButtons");
    buttons.innerHTML = '';
    for (let i = 0; i < productCategories.length; i++) {
        const button = document.createElement("button");
        button.setAttribute("id", `categoryButton-${productCategories[i]}`)
        button.setAttribute("class", "btn btn-secondary");
        button.setAttribute("type", "button");
        button.innerText = productCategories[i];
        button.setAttribute("onclick", `handleCategorySelect(${JSON.stringify(productCategories)}, '${productCategories[i]}', ${isAdmin}, ${isLogin})`)
        buttons.appendChild(button);
    }
}

function changeButtonColor(productCategories, selectedCategory) {
    for (let i = 0; i < productCategories.length; i++) {
        const categoryButton = document.getElementById(`categoryButton-${productCategories[i]}`)
        if (productCategories[i] == selectedCategory) {
            categoryButton.setAttribute("class", "btn btn-primary")
        } else {
            categoryButton.setAttribute("class", "btn btn-secondary")
        }
    }
}

function handleCategorySelect(productCategories, category, isAdmin, isLogin) {
    changeButtonColor(productCategories, category);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        products = JSON.parse(this.responseText)
        makeProductCards(category, products, isAdmin, isLogin)
    }
    xhttp.open("GET", `php/homePage/products.php?category=${category}`, true);
    xhttp.send()
}

function makeProductCards(category, products, isAdmin, isLogin) {
    const productDiv = document.getElementById("productCards");
    productDiv.innerHTML = '';

    // row container
    const row = document.createElement("div");
    row.setAttribute("class", "row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4");

    for (const product_id in products) {
        var product = products[product_id];

        // col wrapper
        const col = document.createElement("div");
        col.setAttribute("class", "col");

        // card wrapper
        const cardWrapper = document.createElement("div");
        cardWrapper.setAttribute("id", `${product_id}`)
        cardWrapper.setAttribute("class", "card h-100"); // h-100 so cards equal height
        cardWrapper.setAttribute("style", "width: 100%;");

        const img = document.createElement("img");
        img.setAttribute("class", "card-img-top");
        img.setAttribute("id", `img-${product_id}`)
        img.setAttribute("width", 250)
        img.setAttribute("height", 250)
        img.setAttribute("style", "object-fit: cover")
        img.setAttribute("src", `products/${category}/${product["image_path"]}`)

        const cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");

        const cardTitle = document.createElement("h5");
        cardTitle.innerText = product["title"];

        const cardPrice = document.createElement("h6");
        cardPrice.innerText = "$" + product["price"];

        const cardStock = document.createElement("h6");
        if (product["stock"] == 0) {
            cardStock.innerText = "OUT OF STOCK";
            cardStock.setAttribute("style", "color: red")
        } else {
            cardStock.innerText = "Stock: " + product["stock"];
        }

        const cardDescription = document.createElement("p");
        cardDescription.innerText = product["description"];

        const linkToDetail = document.createElement("a");
        linkToDetail.setAttribute("class", "btn btn-primary me-2");
        linkToDetail.innerText = "View more";

        const addToCart = document.createElement("a");
        if (isLogin) {
            if (product["stock"] == 0) {
                addToCart.setAttribute("class", "btn btn-success disabled");
                addToCart.setAttribute("title", "Product is out of stock");
                addToCart.innerText = "Out of stock";
            } else {
                addToCart.setAttribute("class", "btn btn-success");
                addToCart.setAttribute("onclick", `animateAddCart('${product_id}'); handleAddToCart('${category}', '${product_id}')`);
                addToCart.innerText = "Add to cart";
            }
        } else {
            addToCart.setAttribute("class", "btn btn-success disabled");
            addToCart.setAttribute("title", "Log in to add to cart");
            addToCart.innerText = "Log in first";
        }
        // addToCart.innerText = "Add to cart";

        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardPrice);
        cardBody.appendChild(cardStock);
        cardBody.appendChild(cardDescription);
        // cardBody.appendChild(linkToDetail);
        if (!isAdmin) {
            cardBody.appendChild(addToCart);
            new bootstrap.Tooltip(addToCart);
        }
        cardWrapper.appendChild(img);
        cardWrapper.appendChild(cardBody);

        col.appendChild(cardWrapper);
        row.appendChild(col);
    }

    productDiv.appendChild(row);
}

//This is for the dropdown that appears in the 'New Product Modal'
function makeDropdownForNewProduct(productCategories) {
    const dropdown = document.getElementById("categoryDropdownNewProduct");
    dropdown.innerHTML = '';
    const ulWrapper = document.createElement("ul");
    ulWrapper.setAttribute("class", "dropdown-menu");
    for (let i = 0; i < productCategories.length; i++) {
        const linkWrapper = document.createElement("li");
        const aWrapper = document.createElement("a");
        aWrapper.setAttribute("class", "dropdown-item");
        aWrapper.setAttribute("onclick", `handleCategorySelectedNewProduct('${productCategories[i]}')`)
        aWrapper.innerText = productCategories[i]
        linkWrapper.appendChild(aWrapper);
        ulWrapper.appendChild(linkWrapper);
    }
    const linkWrapper = document.createElement("li");
    const aWrapper = document.createElement("a");
    aWrapper.setAttribute("class", "dropdown-item");
    aWrapper.setAttribute("onclick", `handleCategorySelectedNewProduct('Create new category')`)
    aWrapper.innerText = "Create new category"
    linkWrapper.appendChild(aWrapper);
    ulWrapper.appendChild(linkWrapper);
    dropdown.appendChild(ulWrapper);
}

function handleCategorySelectedNewProduct(category) {
    const dropdownButton = document.getElementById("dropdownButtonNewProduct");
    dropdownButton.innerText = category;
    if (category == "Create new category") {
        document.getElementById("category").value = "";
    } else {
        document.getElementById("category").value = category;
    }
}

function animateAddCart(product_id) {
    const parent = document.getElementById(product_id);
    const ori_img = document.getElementById("img-" + product_id);
    const cart = document.getElementById("cartIcon");

    //Create clone of image
    const cloned = ori_img.cloneNode(true);
    cloned.id = product_id + "-clone";
    cloned.style.position = "absolute"; //Make clone appear on highest layer
    cloned.style.zIndex = "9999";

    parent.appendChild(cloned);

    const ori_img_pos = ori_img.getBoundingClientRect(); //Returns position of element relative to view port
    const parent_pos = parent.getBoundingClientRect();
    const cart_pos = cart.getBoundingClientRect();

    let startX = ori_img_pos.left - parent_pos.left;
    let startY = ori_img_pos.top - parent_pos.top;

    cloned.style.left = startX + "px";
    cloned.style.top = startY + "px";

    const endX = cart_pos.left - parent_pos.left;
    const endY = cart_pos.top - parent_pos.top;

    const totalFrames = 120;
    let frame = 0;

    const roc_x = (endX - startX) / totalFrames;
    const roc_y = (endY - startY) / totalFrames;

    let width = ori_img.width;
    let height = ori_img.height;

    const shrinkRate = 0.98;

    const animation = setInterval(() => {
        frame++;

        startX += roc_x;
        startY += roc_y;

        width *= shrinkRate;
        height *= shrinkRate;

        cloned.style.left = startX + "px";
        cloned.style.top = startY + "px";
        cloned.style.width = width + "px";
        cloned.style.height = height + "px";

        if (frame >= totalFrames) {
            clearInterval(animation);
            cloned.remove();
        }
    },);
}

function handleAddToCart(category, product_id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const resp = this.responseText.trim();
        if (resp === "Add Success") {
            console.log("Add to cart success")
        } else {
            console.error("Add to cart failed", resp);
        }
    };
    const params = new URLSearchParams();
    params.append('category', category);
    params.append('product_id', product_id);
    params.append('user_id', userId);
    xhttp.open("POST", "php/homePage/addToCart.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params.toString());
}