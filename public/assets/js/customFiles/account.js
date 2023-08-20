async function fetchUserDataAndReplaceName() {
    // Замените 'URL_ВАШЕГО_API' на фактический URL вашего API
    const apiUrl = '/api/getUser';
    const authToken = await getTokenFromCookie(); // Замените на ваш токен

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
            'Authorization': `Bearer ${authToken}` // Добавляем токен в заголовок
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const tableBody = document.querySelector('.table tbody');

            // Очистка текущего содержимого таблицы
            tableBody.innerHTML = '';

            // Заполнение таблицы данными
            data.data.orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
          <td>${order.id}</td>
          <td>${order.created_at}</td>
          <td>${order.status}</td>
          <td>$${order.price}</td>
          <td><a href="shop-cart.blade.php" class="check-btn sqr-btn">View</a></td>
        `;
                tableBody.appendChild(row);
            });

        })
        .catch(error => {
            console.error('Ошибка при получении данных:', error);
        });
}

fetchAndFillTable();

fetchUserDataAndReplaceName();
