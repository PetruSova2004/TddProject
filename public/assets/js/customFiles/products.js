async function addToCart(productId, quantity) {
    try {
        const responseToken = await fetch('/api/getCookie/Token');
        const dataToken = await responseToken.json();
        const token = dataToken.data.cookie;

        const response = await fetch('/api/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify({
                productId: productId,
                quantity: quantity
            })
        });
        const data = await response.json();

        // Обработайте полученные данные
        console.log(data); // Выведите данные в консоль или выполните другие действия с ними

        // Дополнительный код для обновления интерфейса, если требуется
    } catch (error) {
        console.log(error);
    }
}

async function fetchData() {
    try {
        const responseToken = await fetch('/api/getCookie/Token');
        const dataToken = await responseToken.json();

        let CookieToken = false;
        if (dataToken.status === true) {
            CookieToken = true;
        }

        const queryString = window.location.search.substring(1);
        const responseProducts = await fetch('/api/getProducts?' + queryString);
        const dataProducts = await responseProducts.json();

        const productContainer = document.querySelector('.col-12 .tab-content .row');

        // Обрабатываем полученные данные
        dataProducts.data.products.forEach(product => {
            // Создаем элементы и заполняем их значениями из данных товара
            const productItem = document.createElement('div');
            productItem.classList.add('col-sm-6', 'col-xl-4');

            const productWrapper = document.createElement('div');
            productWrapper.classList.add('product-item');

            const productThumb = document.createElement('div');
            productThumb.classList.add('product-thumb');

            const productLink = document.createElement('a');
            const url = "/product?id=" + product.id;

            productLink.href = url;

            const productImage = document.createElement('img');
            productImage.src = product.image_path;
            productImage.width = 270;
            productImage.height = 320;
            productImage.alt = 'Image-HasTech';

            const productInfo = document.createElement('div');
            productInfo.classList.add('product-info');

            const productName = document.createElement('h4');
            productName.classList.add('title');
            const productNameLink = document.createElement('a');
            productNameLink.href = url;
            productNameLink.textContent = product.title;
            productName.appendChild(productNameLink);

            const productPrices = document.createElement('div');
            productPrices.classList.add('prices');

            const productPrice = document.createElement('span');
            productPrice.classList.add('price');
            productPrice.textContent = product.price;

            // Добавляем элементы в контейнер товаров
            productPrices.appendChild(productPrice);
            productInfo.appendChild(productName);
            productInfo.appendChild(productPrices);
            productLink.appendChild(productImage);
            productThumb.appendChild(productLink);
            productWrapper.appendChild(productThumb);
            productWrapper.appendChild(productInfo);
            productItem.appendChild(productWrapper);
            productContainer.appendChild(productItem);

            // Добавляем кнопки "Wishlist", "Quick View" и "Product Cart"
            const productAction = document.createElement('div');
            productAction.classList.add('product-action');

            const wishlistButton = document.createElement('button');
            wishlistButton.type = 'button';
            wishlistButton.classList.add('btn-product-wishlist');
            wishlistButton.dataset.bsToggle = 'modal';
            wishlistButton.dataset.bsTarget = '#action-WishlistModal';
            wishlistButton.innerHTML = '<i class="pe-7s-like"></i>';

            const productActionLinks = document.createElement('div');
            productActionLinks.classList.add('product-action-links');


            const cartButton = document.createElement('button');
            cartButton.type = 'button';
            cartButton.classList.add('btn-product-cart');
            cartButton.dataset.bsToggle = 'modal';
            if (product.count > 0) {
                cartButton.dataset.bsTarget = '#action-CartAddModal';
            } else {
                cartButton.dataset.bsTarget = '#action-CartAddFailModal';
            }
            cartButton.innerHTML = '<i class="pe-7s-shopbag"></i>';
            cartButton.addEventListener('click', () => {
                addToCart(product.id, 1); // Вызываем функцию addToCart с передачей идентификатора товара и количества
            });

            const quickViewButton = document.createElement('button');
            quickViewButton.type = 'button';
            quickViewButton.classList.add('btn-product-quick-view');
            quickViewButton.dataset.bsToggle = 'modal';
            quickViewButton.dataset.bsTarget = '#action-QuickViewModal';
            quickViewButton.innerHTML = '<i class="pe-7s-look"></i>';

            if (CookieToken) {
                productActionLinks.appendChild(cartButton);
            }

            productActionLinks.appendChild(quickViewButton);
            productAction.appendChild(wishlistButton);
            productAction.appendChild(productActionLinks);
            productWrapper.appendChild(productAction);
        });
    } catch (error) {
        console.log(error);
    }
}

fetchData();



// Categories
// Получаем контейнер списка категорий
const categoryListContainer = document.querySelector('.category-list');

// Выполняем запрос к API
fetch('/api/categoryAll')
    .then(response => response.json())
    .then(data => {
        // Обрабатываем полученные данные
        data.data.categories.forEach(category => {
            // Создаем элементы и заполняем их значениями из данных категории
            const categoryItem = document.createElement('li');
            const categoryLink = document.createElement('a');
            categoryLink.href = `/products?category_id=${category.id}`;
            categoryLink.textContent = `${category.title} (${category.products_count})`;

            // Добавляем элементы в контейнер списка категорий
            categoryItem.appendChild(categoryLink);
            categoryListContainer.appendChild(categoryItem);
        });
    })
    .catch(error => console.log(error));

document.getElementById('searchButton').addEventListener('click', function (event) {
    event.preventDefault(); // Отмена отправки формы

    var searchValue = document.getElementById('searchInput').value;
    var currentUrl = window.location.href;

    var urlWithoutSearch = removeURLParameter(currentUrl, 'search');

    // Добавление GET-параметра к URL
    var newUrl;
    if (urlWithoutSearch.indexOf('?') !== -1) {
        // Проверяем, есть ли уже символ "?" в URL, чтобы определить, следует ли использовать знак "?" или "&" при добавлении нового параметра "search".
        newUrl = urlWithoutSearch + '&search=' + encodeURIComponent(searchValue);
    } else {
        newUrl = urlWithoutSearch + '?search=' + encodeURIComponent(searchValue);
    }
    // Затем мы перенаправляем пользователя на новый URL без прошлого параметра "search".

    window.location.href = newUrl; // Перезагрузка страницы
});

function removeURLParameter(url, parameter) {
    var urlParts = url.split('?');
    if (urlParts.length >= 2) {
        var prefix = encodeURIComponent(parameter) + '=';
        var parameters = urlParts[1].split('&');

        for (var i = parameters.length - 1; i >= 0; i--) {
            if (parameters[i].lastIndexOf(prefix, 0) !== -1) {
                parameters.splice(i, 1);
            }
        }

        return urlParts[0] + (parameters.length > 0 ? '?' + parameters.join('&') : '');
    }

    return url;
}