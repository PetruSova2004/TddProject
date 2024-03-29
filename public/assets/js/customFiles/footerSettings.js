// Define the function to make the API request and fetch products using the access token
async function fetchCartProducts(accessToken) {
    try {
        const response = await fetch('/api/getCart', {
            headers: {
                Authorization: `Bearer ${accessToken}`,
            },
        });
        const data = await response.json();

        const subtotalElement = document.querySelector('.cart-total .amount');
        if (subtotalElement) {
            if (data.data.count > 0) {
                subtotalElement.textContent = `£${data.data.totalPrice}`; // Обновляем значение на странице
            } else {
                subtotalElement.textContent = `£0`; // Обновляем значение на странице
            }
        }

        const count = document.querySelector('.shopping-cart-btn .shop-count');
        if (data.data.count) {
            count.textContent = data.data.count;
        } else {
            count.textContent = 0;
        }

        return data.data.cart;
    } catch (error) {
        console.error('Error fetching get-cart-product data:', error);
        return [];
    }
}

function buildProductElements(products, accessToken) {
    const productListElement = document.querySelector('.aside-cart-product-list');
    products.forEach((product) => {
        const productElement = document.createElement('li');
        productElement.classList.add('aside-product-list-item');

        productElement.innerHTML = `
      <a href="#/" class="remove">×</a>
      <a href="/product?id=${product.product_id}">
        <img src="${product.image_path}" width="90" height="110" alt="${product.title}">
        <span class="product-title">${product.title}</span>
      </a>
      <span class="product-price">${product.quantity} × £${product.price_x1}</span>
    `;

        // Получаем ссылку на элемент "x"
        const removeButton = productElement.querySelector('.remove');
        // Добавляем обработчик события на клик по "x"
        removeButton.addEventListener('click', () => {
            // Выполняем POST-запрос к API
            const productId = product.product_id; // Предположим, что у продукта есть свойство "id"
            const quantity = product.quantity;
            sendPostRequest(accessToken, productId, quantity);
        });

        productListElement.appendChild(productElement);
    });
}

// Функция для отправки POST-запроса к API
async function sendPostRequest(token, productId, quantity) {
    try {
        const response = await fetch('/api/cart/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({productId: productId, quantity: quantity}),
        });
        if (response.ok) {
            // Здесь можно добавить код, который выполнится в случае успешного запроса
            console.log('Post request successful!');
        } else {
            // Здесь можно обработать ошибку, если запрос не был успешным
            console.error('Post request failed:', response.status, response.statusText);
        }
    } catch (error) {
        console.error('Error sending post request:', error);
    }
}


// Define the main handleMenu function that takes the access token as a parameter
async function handleMenu() {
    var accessToken = await getTokenFromCookie();

    if (accessToken) {
        // Если мы авторизированны
        var registerItem = document.querySelector('a[href="/register"]');
        var loginItem = document.querySelector('a[href="/login"]');

        if (registerItem) {
            registerItem.parentElement.remove();
        }
        if (loginItem) {
            loginItem.parentElement.remove();
        }

        try {
            const products = await fetchCartProducts(accessToken);
            buildProductElements(products, accessToken);
        } catch (error) {
            console.error('Error fetching cart-products:', error);
        }

        // Добавляем пункт меню "Logout"
        var logoutMenuItem = document.createElement('li');
        logoutMenuItem.innerHTML = '<a href="#" onclick="logout()"><span>Logout</span></a>';

        var menu = document.querySelector('#logoutMenuItem');
        menu.appendChild(logoutMenuItem);
    } else {
        var shoppingCartElement = document.querySelector('.shopping-cart-btn');
        var checkoutItem = document.querySelector('a[href="/checkout"]')
        var accountItem = document.querySelector('a[href="/account"]');

        if (shoppingCartElement) {
            shoppingCartElement.parentElement.remove();
        }
        if (checkoutItem) {
            checkoutItem.parentElement.remove();
        }
        if (accountItem) {
            accountItem.parentElement.remove();
        }
    }
}


async function logout() {
    try {
        var accessToken = await getTokenFromCookie();

        const logoutResponse = await fetch(`/api/logout`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${accessToken}`,
            },
        });
        if (logoutResponse.ok) {
            handleMenu(); // Remove the "Logout" menu item after successful logout
            window.location.href = '/';
        } else {
            console.log(logoutResponse)
        }
    } catch (error) {
        console.error('Error in request:', error);
    }
}


async function getTokenFromCookie() {
    const customToken = localStorage.getItem('customToken');

    var cookieName = 'Token';
    var apiUrl = '/api/getCookie/' + cookieName;

    try {
        var response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'guestToken': customToken,
            }
        });
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

async function applyCustomToken() {
    try {
        var apiUrl = '/api/generateToken';

        var response = await fetch(apiUrl, {
            method: 'POST',
        });
        var data = await response.json();
        var tokenValue = data.data.token;

        if (tokenValue) {
            return tokenValue;
        } else {
            return false;
        }
    } catch (error) {
        if (error.message === '400') {
            console.log("An error occurred:", error);
        }
        throw error;
    }
}

async function checkToken(accessToken) {
    try {
        if (accessToken) {
            const checkResponse = await fetch(`/api/verifyToken`, {
                method: 'POST',
                headers: {
                    'guestToken': `${accessToken}`,
                },
            });
            if (checkResponse.ok) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (error) {
        console.error('Error in request:', error);
    }
}

let isFetchingToken = false;

async function getCustomToken() {
    if (isFetchingToken) {
        await waitForTokenFetch(); // Ожидаем завершения текущего запроса
        return localStorage.getItem('customToken');
    }

    const localToken = localStorage.getItem('customToken');
    if (localToken) {
        const verifiedToken = await checkToken(localToken);
        if (verifiedToken) {
            return localToken;
        } else {
            isFetchingToken = true;
            localStorage.removeItem('customToken');
            const token = await applyCustomToken();
            localStorage.setItem('customToken', token);
            isFetchingToken = false;
            return token;
        }
    } else {
        isFetchingToken = true;
        const token = await applyCustomToken();
        localStorage.setItem('customToken', token);
        isFetchingToken = false;
        return token;
    }
}

let tokenFetchPromise = Promise.resolve(); // Инициализируем промис, который будет использован для ожидания завершения запроса

async function waitForTokenFetch() {
    await tokenFetchPromise; // Ожидаем завершения текущего запроса
}

async function updateTokenFetchPromise(promise) {
    await waitForTokenFetch(); // Ожидаем завершения предыдущего запроса
    tokenFetchPromise = promise; // Устанавливаем новый промис ожидания
}

async function addToCart(productId, quantity = 1) {
    try {
        const token = await getTokenFromCookie();
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

async function addToWishlist(productId) {
    try {
        const token = localStorage.getItem('customToken');
        const response = await fetch('/api/addToWishlist', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'guestToken': token
            },
            body: JSON.stringify({
                productId: productId,
            })
        });
        const data = await response.json();
        console.log(data);

    } catch (error) {
        // console.log(error);
    }
}

getCustomToken();
handleMenu();

