// Функция для получения данных о продуктах из API
async function fetchCartPageProducts(token) {
    try {
        const response = await fetch('/api/getCart', {
            headers: {
                Authorization: `Bearer ${token}`,
            }
        });
        const data = await response.json();

        const subTotalElement = document.getElementById('subtotalAmount');
        const discount = document.getElementById('discount');
        const totalElement = document.getElementById('totalAmount');


        if (data.data.totalPrice) {
            subTotalElement.textContent = "$" + data.data.totalPrice;
        } else {
            subTotalElement.textContent = "$" + 0;
        }

        if (data.data.discountPercent) {
            discount.textContent = "%" + data.data.discountPercent;
        } else {
            totalElement.textContent = "%" + 0;
        }

        if (data.data.priceWithDiscount) {
            totalElement.textContent = "$" + data.data.priceWithDiscount;
        } else {
            totalElement.textContent = "$" + 0;
        }



        return data.data.cart; // Предполагается, что API возвращает данные в виде массива объектов продуктов
    } catch (error) {
        console.error('Error fetching product data:', error);
        return [];
    }
}

// Функция для создания элементов продуктов и их добавления в таблицу
function buildCartPageProductElements(products, token) {
    const productTable = document.getElementById('cartTable');

    products.forEach((product) => {
        const productRow = document.createElement('tr');
        productRow.classList.add('tbody-item');

        productRow.innerHTML = `
      <td class="product-remove">
        <a class="remove" href="javascript:void(0)">×</a>
      </td>
      <td class="product-thumbnail">
        <div class="thumb">
          <a href="single-product.blade.php">
            <img src="${product.image_path}" width="75" height="75" alt="${product.title}">
          </a>
        </div>
      </td>
      <td class="product-name">
        <a class="title" href="single-product.blade.php">${product.title}</a>
      </td>
      <td class="product-price">
        <span class="price">$${product.price_x1}</span>
      </td>
      <td class="product-quantity">
        <div class="pro-qty">
          <input type="text" class="quantity" title="Quantity" value="${product.quantity}">
        </div>
      </td>
      <td class="product-subtotal">
        <span class="price">$${product.price_x1 * product.quantity}</span>
      </td>
    `;

        const removeButton = productRow.querySelector('.remove');
        // Добавляем обработчик события на клик по "x"
        removeButton.addEventListener('click', () => {
            // Выполняем POST-запрос к API
            const productId = product.product_id; // Предположим, что у продукта есть свойство "id"
            const quantity = product.quantity;
            sendPostRequest(token, productId, quantity);
        });

        productTable.appendChild(productRow);

    });
}

// Выполнение запроса и создание элементов продуктов при загрузке страницы
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const token = await getTokenFromCookie();
        const products = await fetchCartPageProducts(token);
        buildCartPageProductElements(products, token);
    } catch (error) {
        console.error('Error loading products:', error);
    }
});

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
        toggleCouponButton(hasCookie);
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

    } catch (error) {
        console.error('Error applying coupon:', error);
    }
}

var applyButton = document.querySelector('.btn-coupon');
applyButton.addEventListener('click', applyCoupon);

checkAndToggleCouponButton();
