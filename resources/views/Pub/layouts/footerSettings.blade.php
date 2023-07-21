<!--=== jQuery Modernizr Min Js ===-->
<script src="/assets/js/modernizr.js"></script>
<!--=== jQuery Min Js ===-->
<script src="/assets/js/jquery-main.js"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="/assets/js/jquery-migrate.js"></script>
<!--=== jQuery Popper Min Js ===-->
<script src="/assets/js/popper.min.js"></script>
<!--=== jQuery Bootstrap Min Js ===-->
<script src="/assets/js/bootstrap.min.js"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="/assets/js/swiper.min.js"></script>
<!--=== jQuery Fancybox Min Js ===-->
<script src="/assets/js/fancybox.min.js"></script>
<!--=== jQuery Countdown Min Js ===-->
<script src="/assets/js/countdown.js"></script>
<!--=== jQuery Isotope Min Js ===-->
<script src="/assets/js/isotope.pkgd.min.js"></script>
<!--=== jQuery Range Slider Min Js ===-->
<script src="/assets/js/ion.rangeSlider.min.js"></script>

<!--=== jQuery Custom Js ===-->
<script src="/assets/js/custom.js"></script>

<script>
    // Проверка наличия значения в куках

    // Define the function to make the API request and fetch products using the access token
    async function fetchProducts(accessToken) {
        try {
            const response = await fetch('http://127.0.0.1:8001/api/getCart', {
                headers: {
                    Authorization: `Bearer ${accessToken}`,
                },
            });
            const data = await response.json();
            return data.data.cart;
        } catch (error) {
            console.error('Error fetching product data:', error);
            return [];
        }
    }

    // Define the function to build HTML elements using the product data
    function buildProductElements(products) {
        const productListElement = document.querySelector('.aside-cart-product-list');
        products.forEach((product) => {
            const productElement = document.createElement('li');
            productElement.classList.add('aside-product-list-item');

            productElement.innerHTML = `
      <a href="#/" class="remove">×</a>
      <a href="single-product.html">
        <img src="${product.image_path}" width="90" height="110" alt="${product.title}">
        <span class="product-title">${product.title}</span>
      </a>
      <span class="product-price">${product.quantity} × £${product.price-x1}</span>
    `;

            productListElement.appendChild(productElement);
        });
    }

    // Define the main handleMenu function that takes the access token as a parameter
    async function handleMenu() {
        var accessToken = await getTokenFromCookie();

        if (accessToken) {
            // Если мы авторизированны
            var registerItem = document.querySelector('a[href="{{route('register.index')}}"]');
            var loginItem = document.querySelector('a[href="{{route('login.index')}}"]');
            var accountItem = document.querySelector('a[href="account.blade.php"]');

            if (registerItem) {
                registerItem.parentElement.remove();
            }
            if (loginItem) {
                loginItem.parentElement.remove();
            }
            if (accountItem) {
                accountItem.parentElement.remove();
            }

            // Добавляем пункт меню "Logout"
            var logoutMenuItem = document.createElement('li');
            logoutMenuItem.innerHTML = '<a href="#" onclick="logout()"><span>Logout</span></a>';

            var menu = document.querySelector('#logoutMenuItem');
            menu.appendChild(logoutMenuItem);
        } else {
            var shoppingCartElement = document.querySelector('.shopping-cart-btn');

            if (shoppingCartElement) {
                shoppingCartElement.parentElement.remove();
            }
        }
    }
    handleMenu();


    async function logout() {
        var accessToken = await getTokenFromCookie();

        var xhr = new XMLHttpRequest();
        var tokenName = 'Token';
        xhr.open('POST', '/api/deleteCookie/' + tokenName, true);
        xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    handleMenu(); // Remove the "Logout" menu item after successful logout
                    window.location.reload(); // Reload the page after logout
                } else {
                    console.error('Error in request: ' + xhr.status);
                }
            }
        };
        xhr.send();
    }


    async function getTokenFromCookie() {
        var cookieName = 'Token';
        var apiUrl = '/api/getCookie/' + cookieName;

        try {
            var response = await fetch(apiUrl);
            var data = await response.json();
            var cookieValue = data.data.cookie;

            if (cookieValue) {
                return cookieValue;
            } else {
                console.log('getTokenFromCookieFalse');
                return false;
            }
        } catch (error) {
            if (error.message === '400') {
                console.log("An error occurred:", error);
            }
            throw error;
        }
    }


</script>



