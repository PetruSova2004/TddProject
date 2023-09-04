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


const addToCartButton = document.getElementById('addToCartButton');

// Добавьте обработчик события клика
addToCartButton.addEventListener('click', function () {
    // Получите идентификатор товара
    const productId = id; // Замените на реальный идентификатор товара

    // Получите количество товара
    const quantityInput = document.querySelector('.pro-qty input');
    const quantity = parseInt(quantityInput.value, 10);


    addToCart(productId, quantity);
});

async function addToCart(productId, quantity) {
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

        console.log(data);

    } catch (error) {
        console.log(error);
    }
}
