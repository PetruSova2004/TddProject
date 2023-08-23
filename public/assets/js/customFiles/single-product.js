const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const apiUrl = '/api/getProduct';

// Добавляем значение id в URL API
const apiWithParams = `${apiUrl}?id=${id}`;

fetch(apiWithParams, {
    method: 'GET',
    headers: {
        'guestToken': localStorage.getItem('customToken'),
    },
})
    .then(response => response.json())
    .then(data => {
        const productTitle = document.querySelector('.main-title');
        const productPrice = document.querySelector('.price');

        // Обновляем данные в шаблоне с использованием полученных данных
        productTitle.textContent = data.data.product.title;
        productPrice.textContent = `$${data.data.product.price}`;

        const ratingBoxWrap = document.querySelector('.rating-box-wrap');

        // Создаем новый параграф со значениями из БД
        const p = `<p>${data.data.product.description}</p>`;

        // Добавляем параграф внутри .rating-box-wrap
        ratingBoxWrap.insertAdjacentHTML('afterend', p)


        const reviewStatus = document.querySelector('.review-status');
        const viewsElement = reviewStatus.querySelector('a');

        // Views
        viewsElement.textContent = `(${data.data.product.views} Views)`;

        const categoriesElement = document.querySelector('.product-single-meta li span + a');

        // Обновляем текстовое содержимое в элементе DOM
        categoriesElement.textContent = data.data.product.category_title;

    })
    .catch(error => {
        // Обработка ошибок
    });
