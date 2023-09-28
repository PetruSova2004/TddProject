async function getCountries() {
    try {
        var token = await getTokenFromCookie();
        var response = await fetch('/api/getCountries', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        var data = await response.json();
        var countries = data.data.countries;

        if (data.status === true) {
            countries.forEach(function (country) {
                var option = document.createElement("option");
                option.text = country.name;
                document.getElementById("country").appendChild(option);
            });
        } else {
            return false;
        }
    } catch (error) {
        console.log(error)
        throw error;
    }

}

async function getCookie(cookieName) {
    var apiUrl = '/api/getCookie/' + cookieName;

    try {
        var response = await fetch(apiUrl);
        var data = await response.json();
        var cookieValue = data.data.cookie;

        if (cookieValue) {
            return cookieValue;
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

async function getCoupon() {
    var apiUrl = 'api/getCoupon';
    var token = await getTokenFromCookie();

    try {
        var response = await fetch(apiUrl, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        var data = await response.json();

        if (data.status === true) {
            return true;
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

function toggleCouponButton(hasCookie) {
    var applyButton = document.getElementById('cardId');
    if (hasCookie) {
        if (applyButton) {
            applyButton.style.display = 'none';
        }
    } else {
        if (applyButton) {
            applyButton.style.display = 'block';
        }
    }
}

async function checkAndToggleCouponButton() {
    try {
        const hasCookie = await getCoupon();
        await toggleCouponButton(hasCookie);
    } catch (error) {
        console.error('Error checking coupon:', error);
    }
}

async function applyCoupon() {
    try {
        // Получаем значение токена куки
        var token = await getTokenFromCookie();

        // Получаем значение из поля "Coupon code"
        var couponCode = document.querySelector('input[name="Coupon code"]').value;

        const cookieName = 'Coupon';
        const hasCookie = await getCookie(cookieName);

        if (hasCookie) {
            alert('You already have a coupon');
        } else {
            // Выполняем POST-запрос на API
            const response = await fetch('/api/applyCoupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${token}`,
                },
                body: JSON.stringify({code: couponCode}), // Отправляем код купона
            });

            // Проверяем успешность запроса
            if (response.ok) {
                var data = await response.json();
                var discount = data.data.discount;
                alert("You activated the coupon successfully, your discount for all products is " + discount + "%");
                window.location.reload();
            } else {
                alert('Failed to apply coupon')
                console.error('Failed to apply coupon:', response.status, response.statusText);
                window.location.reload();
            }
        }

    } catch (error) {
        console.error('Error applying coupon:', error);
    }
}

async function getCartItems() {
    var apiUrl = '/api/getCart';

    try {
        var token = await getTokenFromCookie();
        var response = await fetch(apiUrl, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        var data = await response.json();

        if (data.status === true) {
            cart = data.data.cart;
            totalPrice = data.data.totalPrice;
            priceWithDiscount = data.data.priceWithDiscount;
            discount = data.data.discountPercent;

            await displayProductDetails(cart, totalPrice, priceWithDiscount, discount);
        }
    } catch (error) {
        console.error('Error getting cart items:', error);
        throw error;
    }
}

async function displayProductDetails(cartItems, subTotal, total, discount) {
    try {
        const tableBody = document.querySelector('.table-body');

        cartItems.forEach((cartItem) => {
            let itemPrice = cartItem.price_x1 * cartItem.quantity;
            const row = document.createElement('tr');
            row.className = 'cart-item';

            const productNameCell = document.createElement('td');
            productNameCell.className = 'product-name';
            productNameCell.textContent = `${cartItem.title} × ${cartItem.quantity}`;

            const productPriceCell = document.createElement('td');
            productPriceCell.className = 'product-total';
            productPriceCell.textContent = '£' + itemPrice;

            row.appendChild(productNameCell);
            row.appendChild(productPriceCell);

            tableBody.appendChild(row);
        });

        const subtotalElement = document.getElementById("subtotal");
        subtotalElement.textContent = "£" + subTotal;

        if (discount) {
            const discountElement = document.getElementById("discount");
            discountElement.textContent = "%" + discount;
        } else {
            const discountElement = document.getElementById("discount");
            discountElement.textContent = "%" + 0;
        }

        if (total) {
            const totalElement = document.getElementById("total");
            totalElement.textContent = "£" + total;
        } else {
            const totalElement = document.getElementById("total");
            totalElement.textContent = "£" + subTotal;
        }

    } catch (error) {
        console.error('Error displaying product details:', error);
    }
}


async function addOrder() {
    try {
        // Получим токен из cookie
        const token = await getTokenFromCookie();

        const placeOrderButton = document.getElementById('placeOrderButton');

        const totalElement = document.getElementById("subtotal");
        const price = parseInt(totalElement.textContent.slice(1));

        const discountElement = document.getElementById("discount");
        const discount = parseInt(discountElement.textContent.slice(1));

        placeOrderButton.disabled = true;

        // Соберем данные из полей формы
        const formData = {
            firstname: document.getElementById('f_name').value,
            lastname: document.getElementById('l_name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            discount: discount,
            price: price,
            company: document.getElementById('com_name').value,
            country: document.getElementById('country').value,
            address: document.getElementById('address').value,
            city: document.getElementById('city').value,
            zip: document.getElementById('zip').value,
        };

        // Отправим запрос к API
        const response = await fetch("/api/placeOrder", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();
        if (data.status === true) {
            await alert('Your order has been successfully added, and waiting for confirmation on email');
            window.location.href = "/";
        } else {
            console.log(data);
            // alert('Validation Error')
            // window.location.reload();
        }
    } catch (error) {
        console.error('Error:', error);
    }
}


getCartItems()

// Найти кнопку "Apply coupon" и добавить обработчик события на клик
var applyButton = document.querySelector('.btn-coupon');
applyButton.addEventListener('click', applyCoupon);

checkAndToggleCouponButton();
getCountries()

const placeOrderButton = document.getElementById('placeOrderButton');
placeOrderButton.addEventListener('click', addOrder);





