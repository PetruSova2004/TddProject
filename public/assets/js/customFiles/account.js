async function fetchUserDataAndReplaceName() {
    const apiUrl = '/api/getUser';
    const authToken = await getTokenFromCookie();

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${authToken}`,
        }
    })
        .then(response => response.json())
        .then(data => {
            const newName = data.data.name;

            // Заменяем текст на странице
            const welcomeText = document.querySelector('.welcome p');
            if (welcomeText) {
                const strongTags = welcomeText.getElementsByTagName('strong');
                if (strongTags.length >= 2) {
                    // Заменяем оба места имени
                    strongTags[0].textContent = newName;
                    strongTags[1].textContent = newName;
                }
            }

            const displayNameInput = document.getElementById("display-name");
            const emailInput = document.getElementById("email");

            displayNameInput.value = data.data.name;
            emailInput.value = data.data.email;

        })
        .catch(error => {
            console.error('Ошибка при получении данных:', error);
        });

    const logoutLink = document.querySelector('.logout');
    if (logoutLink) {
        logoutLink.addEventListener('click', function (event) {
            event.preventDefault();
            logout();
        });
    }
}

async function fetchAndFillOrdersTable() {
    const authToken = await getTokenFromCookie();

    fetch('/api/getOrder', {
        headers: {
            'Authorization': `Bearer ${authToken}`,
        }
    })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('.table tbody');

            tableBody.innerHTML = '';

            data.data.orders.forEach(order => {
                const row = document.createElement('tr');
                let statusContent;
                let additionalCellContent = '';

                if (order.status === 'Approved') {
                    statusContent = `
                <form onsubmit="payment('${order.id}')" method="post">

                    <input type="hidden" value="${order.id}" name="order">
                    <button type="submit" class="check-btn sqr-btn">Go to the payment</button>
                </form>
            `;
                } else if (order.status === 'Pending') {
                    statusContent = `
                <a href="https://mail.google.com/" class="check-btn sqr-btn">Confirm on Email</a>
            `;
                } else if (order.status === 'Canceled') {
                    statusContent = 'Canceled';
                } else if (order.status === 'Paid') {
                    statusContent = 'Paid';
                }

                if (order.status !== 'Canceled') {
                    additionalCellContent = `
                <td>${order.email}</td>
                <td>${order.created_at}</td>
                <td>${order.status}</td>
                <td>$${order.price}</td>
            `;
                } else {
                    additionalCellContent = `
                <td>${order.email}</td>
                <td>${order.created_at}</td>
                <td>${order.status}</td>
                <td>$${order.price}</td>
            `;
                }

                row.innerHTML = `
            ${additionalCellContent}
            <td>${statusContent}</td>
        `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Ошибка при получении данных:', error);
        });
}

async function payment(OrderData) {
    // Предотвращение отправки формы по умолчанию
    event.preventDefault();

    const token = await getTokenFromCookie();
    const apiUrl = '/api/payment';

    const requestData = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        // Дополнительные данные, если необходимо
        body: JSON.stringify({
            order: OrderData,
        })
    };

    try {
        const response = await fetch(apiUrl, requestData);
        const data = await response.json();

        window.location.href = data.data.redirect;
        // Дополнительные действия по обработке успешного ответа
    } catch (error) {
        console.error('Error:', error);
        // Обработайте ошибку
    }
}

const profileForm = document.getElementById('profileForm');

profileForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Получите значения полей формы
    const name = document.getElementById('display-name').value;
    const password = document.getElementById('new-pwd').value;
    const passwordConfirmation = document.getElementById('confirm-pwd').value;

    const authToken = await getTokenFromCookie();

    const data = {
        name: name,
        password: password,
        password_confirmation: passwordConfirmation,
    };

    const apiUrl = '/api/updateProfile';

    fetch(apiUrl, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken,
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((responseData) => {
            if (responseData.status === true) {
                console.log(responseData);
                alert('Data has been successfully changed');
                window.location.reload();
            } else {
                alert('Something goes wrong');
                window.location.reload();
            }
        })
        .catch((error) => {
            // Обработайте ошибку здесь
            console.error('Ошибка:', error);
        });
});


// Функция для выполнения запроса к API и обновления данных на странице
async function fetchAndDisplayCoupons() {
    const token = await getTokenFromCookie();

    fetch('/api/getCoupon', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
        }
    })
        .then(response => response.json())
        .then(data => {
            const couponTableBody = document.getElementById('coupon-table-body');
            couponTableBody.innerHTML = '';

            data.data.coupons.forEach(coupon => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${coupon.code}</td>
                    <td>%${coupon.discount_percent}</td>
                    <td>${coupon.created_at}</td>
                    <td>${coupon.expired ? 'Yes' : 'No'}</td>
                    <td>
                        <a href="#/" class="check-btn sqr-btn" id="deleteButton-${coupon.code}">
                            <i class="fa fa-cloud-download"></i> Delete Coupon
                        </a>
                    </td>
    `;
                couponTableBody.appendChild(row);

                const deleteButton = document.getElementById(`deleteButton-${coupon.code}`);
                deleteButton.addEventListener('click', async function (event) {
                    event.preventDefault(); // Prevent the default link behavior
                    const couponCode = coupon.code; // Get the coupon code
                    await deleteCoupon(couponCode); // Call your deleteCoupon function with the coupon code
                });
            });
        })
        .catch(error => {
            console.error('Ошибка при выполнении запроса к API:', error);
        });
    // Вызываем функцию для загрузки данных о купонах при загрузке страницы
}

async function deleteCoupon(code) {
    const token = await getTokenFromCookie();
    const data = {
        code: code,
    };

    fetch('/api/deleteCoupon', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token,
        },
        body: JSON.stringify(data),

    })
        .then(response => response.json())
        .then(data => {
            if (data.status === true) {
                alert('Coupon has been successfully deleted');
                window.location.reload();
            }else {
                alert('Something goes wrong');
                window.location.reload();
            }

        })
        .catch(error => {
            // Обработка ошибок
            console.error('Ошибка при выполнении запроса:', error);
        });
}

fetchAndDisplayCoupons()
fetchAndFillOrdersTable();
fetchUserDataAndReplaceName();
