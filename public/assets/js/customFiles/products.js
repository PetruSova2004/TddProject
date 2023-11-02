async function fetchData() {
    try {
        const customToken = localStorage.getItem('customToken');

        const responseToken = await fetch('/api/getCookie/Token', {
            method: 'GET',
            headers: {
                'guestToken': customToken,
            }
        });
        const dataToken = await responseToken.json();

        let CookieToken = false;
        if (dataToken.status === true) {
            CookieToken = true;
        }

        const queryString = window.location.search.substring(1);
        const responseProducts = await fetch('/api/getProducts?' + queryString, {
            method: 'GET',
            headers: {
                'guestToken': customToken,
            }
        });
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
            productImage.alt = 'Image-HasTech';
            productImage.classList.add('custom-image');


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
            productPrice.textContent = "$" + product.price;

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

            wishlistButton.addEventListener('click', async () => {
                await addToWishlist(product.id, 1);
            });

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

async function categories() {
    const categoryListContainer = document.querySelector('.category-list');
    const customToken = localStorage.getItem('customToken');

    fetch('/api/categoryAll', {
        method: 'GET',
        headers: {
            'guestToken': customToken,
        }
    })
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
}
categories();

async function tags() {
    // Получаем контейнер для тегов
    const tagsContainer = document.querySelector('.sidebar-tags ul');
    const token = await getCustomToken();

// Отправляем AJAX-запрос к API и обновляем теги
    fetch('/api/popularTags', {
        method: 'GET',
        headers: {
            'guestToken': token,
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            // Проверяем, успешен ли запрос
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Преобразуем ответ в JSON
        })
        .then(data => {
            // Очищаем текущие теги в контейнере
            tagsContainer.innerHTML = '';

            // Обновляем список тегов
            data.data.tags.forEach(tag => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '/products?tag=' + tag.title;
                a.textContent = tag.title;

                li.appendChild(a);
                tagsContainer.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Ошибка при загрузке тегов', error);
        });

}
tags();

document.getElementById('searchButton').addEventListener('click', function (event) {
    event.preventDefault(); // Отмена отправки формы

    let searchValue = document.getElementById('searchInput').value;
    let currentUrl = window.location.href;

    let urlWithoutSearch = removeURLParameter(currentUrl, 'search');

    // Добавление GET-параметра к URL
    let newUrl;
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
    let urlParts = url.split('?');
    if (urlParts.length >= 2) {
        let prefix = encodeURIComponent(parameter) + '=';
        let parameters = urlParts[1].split('&');

        for (let i = parameters.length - 1; i >= 0; i--) {
            if (parameters[i].lastIndexOf(prefix, 0) !== -1) {
                parameters.splice(i, 1);
            }
        }

        return urlParts[0] + (parameters.length > 0 ? '?' + parameters.join('&') : '');
    }

    return url;
}
