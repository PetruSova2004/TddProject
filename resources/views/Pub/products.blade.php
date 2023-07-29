<!DOCTYPE html>
<html lang="zxx">
@include('Pub.layouts.headerSettings')

<body>

<!--wrapper start-->
<div class="wrapper">

    @include('Pub.layouts.header')

    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg1.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title">Products</h2>
                            <nav class="breadcrumb-area">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Products</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="product-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-top-bar">
                            <div class="shop-top-left">
                                <p class="pagination-line"><a href="shop.html">12</a> Product Found of <a
                                        href="shop.html">30</a></p>
                            </div>
                            <div class="shop-top-center">
                                <nav class="product-nav">
                                    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i class="fa fa-th"></i>
                                        </button>
                                        <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                class="fa fa-list"></i></button>
                                        <button class="nav-link" id="nav-grid2-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid2" type="button" role="tab"
                                                aria-controls="nav-grid2" aria-selected="false"><i
                                                class="fa fa-th-large"></i></button>
                                    </div>
                                </nav>
                            </div>
                            <div class="shop-top-right">
                                <div class="shop-sort">
                                    <span>Sort By :</span>
                                    <select class="form-select" aria-label="Sort select example">
                                        <option selected>Default</option>
                                        <option value="1">Popularity</option>
                                        <option value="2">Average Rating</option>
                                        <option value="3">Newsness</option>
                                        <option value="4">Price Low to High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-product-single-style2-item">
                                    <div class="thumb">
                                        <a href="shop.html">
                                            <img src="assets/img/shop/banner/3.webp" width="870" height="247"
                                                 alt="Image-HasTech">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="sub-title">-25% Off </h5>
                                        <h5 class="title">Pet Food, Medicin & Shop With Us</h5>
                                        <a class="btn-theme-link" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                         aria-labelledby="nav-grid-tab">
                                        <div class="row">
                                            <!--Foreach Products from api request below-->
                                        </div>
                                        <div class="col-12">
                                            <div class="pagination-items pagination-items-style1">
                                                <ul class="pagination mb--0">
                                                    <li><a class="active" href="shop.html">1</a></li>
                                                    <li><a href="shop-four-columns.html">2</a></li>
                                                    <li><a href="shop-three-columns.html">3</a></li>
                                                    <li><a href="shop.html" class="icon"><i
                                                                class="fa fa-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                         aria-labelledby="nav-list-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <!--== Start Product Item ==-->
                                                <div class="product-item product-list-item">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="product-thumb">
                                                                <a href="single-product.html">
                                                                    <img src="assets/img/shop/col2-1.webp" width="420"
                                                                         height="320" alt="Image-HasTech">
                                                                </a>
                                                                <div class="product-action">
                                                                    <button type="button" class="btn-product-wishlist"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#action-WishlistModal">
                                                                        <i class="pe-7s-like"></i>
                                                                    </button>
                                                                    <div class="product-action-links">
                                                                        <button type="button"
                                                                                class="btn-product-quick-view"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#action-QuickViewModal">
                                                                            <i class="pe-7s-look"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--== End prPduct Item ==-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="shop-sidebar">
                            <div class="shop-sidebar-search">
                                <div class="sidebar-search-form">
                                    <form id="searchForm" action="#">
                                        <input id="searchInput" type="search" placeholder="Search Here">
                                        <button id="searchButton" type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="shop-widget shop-sidebar-price-range">
                                <h4 class="sidebar-title">Price Filter</h4>
                                <div class="sidebar-price-range">
                                    <input type="text" class="js-range-slider" name="my_range" value=""
                                           data-type="double" data-min="0" data-max="3000" data-from="300"
                                           data-to="2500"/>
                                </div>
                            </div>

                            <div class="shop-widget shop-sidebar-category">
                                <h4 class="sidebar-title">Categories</h4>
                                <div class="sidebar-category">
                                    <ul class="category-list mb--0">
                                        <!-- Categories from api request below -->
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-widget shop-sidebar-color">
                                <h4 class="sidebar-title">Color</h4>
                                <div class="sidebar-color">
                                    <div class="color-list">
                                        <div data-bg-color="#ffd868"></div>
                                        <div class="active" data-bg-color="#721b65"></div>
                                        <div data-bg-color="#dd117e"></div>
                                        <div data-bg-color="#0aa5d2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-widget shop-sidebar-size">
                                <h4 class="sidebar-title">Size</h4>
                                <div class="sidebar-size">
                                    <div class="size-list">
                                        <div>S</div>
                                        <div class="active">M</div>
                                        <div>L</div>
                                        <div>XL</div>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-widget shop-sidebar-tags">
                                <h4 class="sidebar-title">Tags</h4>
                                <div class="sidebar-tags">
                                    <ul class="tags-list mb--0">
                                        <li><a href="shop.html">Fashion</a></li>
                                        <li><a href="shop.html">Organic</a></li>
                                        <li><a href="shop.html">Old Fashion</a></li>
                                        <li><a href="shop.html">Men</a></li>
                                        <li><a href="shop.html">Fashion</a></li>
                                        <li><a href="shop.html">Dress</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->
    </main>

    @include('Pub.layouts.footer')


</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')

<script>
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
                const url = "{{ route('product.show') }}?id=" + product.id;

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
</script>


<script> // Categories
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


</script>

<script>
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
</script>

</body>

</html>
