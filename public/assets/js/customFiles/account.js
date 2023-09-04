async function fetchUserDataAndReplaceName() {
    const apiUrl = '/api/getUser';
    const authToken = await getTokenFromCookie();

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${authToken}` // Добавляем токен в заголовок
        }
    })
        .then(response => response.json())
        .then(data => {
            // Получаем данные из API
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

            // Заполняем поля данными
            displayNameInput.value = data.data.name;
            emailInput.value = data.data.email;

        })
        .catch(error => {
            console.error('Ошибка при получении данных:', error);
        });

    const logoutLink = document.querySelector('.logout');
    if (logoutLink) {
        logoutLink.addEventListener('click', function (event) {
            event.preventDefault(); // Предотвращаем действие по умолчанию (переход по ссылке)
            logout(); // Вызываем функцию logout()
        });
    }
}

// Функция для получения данных с API и заполнения таблицы
async function fetchAndFillTable() {
    const authToken = await getTokenFromCookie(); // Замените на ваш токен

    // Замените 'URL_ВАШЕГО_API' на фактический URL вашего API
    fetch('/api/getOrder', {
        headers: {
            'Authorization': `Bearer ${authToken}`, // Добавляем токен в заголовок
        }
    })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('.table tbody');

            // Очистка текущего содержимого таблицы
            tableBody.innerHTML = '';

            // Заполнение таблицы данными
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

// Получите форму и элементы ввода
const profileForm = document.getElementById('profileForm');
const submitButton = document.getElementById('submitButton');

// Обработчик отправки формы
profileForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Получите значения полей формы
    const name = document.getElementById('display-name').value;
    const password = document.getElementById('new-pwd').value;
    const passwordConfirmation = document.getElementById('confirm-pwd').value;

    const authToken = await getTokenFromCookie();

    // Создайте объект с данными для отправки на сервер
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


fetchAndFillTable();

fetchUserDataAndReplaceName();
