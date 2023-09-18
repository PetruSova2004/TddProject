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
    .then(async data => {
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

        const linkElement = document.createElement('a');
        linkElement.href = '/products?category_id=' + data.data.product.category_id;
        linkElement.textContent = data.data.product.category_title;

        categoriesElement.textContent = '';
        categoriesElement.appendChild(linkElement);

        await fetchCategories(data.data.product.category_id);
        await fetchReviews();

    })
    .catch(error => {
        console.log(error)
    });


const addToCartButton = document.getElementById('addToCartButton');
const addToWishlistButton = document.getElementById('addToWishlistButton');

addToWishlistButton.addEventListener('click', async function() {
   await addToWishlist(id);
});

// Добавьте обработчик события клика
addToCartButton.addEventListener('click', function () {
    // Получите идентификатор товара
    const productId = id; // Замените на реальный идентификатор товара

    // Получите количество товара
    const quantityInput = document.querySelector('.pro-qty input');
    const quantity = parseInt(quantityInput.value, 10);


    addToCart(productId, quantity);
});

document.addEventListener('DOMContentLoaded', async function () {
    const reviewForm = document.getElementById('reviewForm')
    const token = await getTokenFromCookie();

    reviewForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!token) {
            alert('You should be authorized')
            window.location.reload();
        }
        e.preventDefault();
        const name = document.getElementById('name');
        const comment = document.getElementById('comment');
        const email = document.getElementById('email');

        const rating = $("#rating").val();

        const data = {
            name: name.value,
            email: email.value,
            comment: comment.value,
            rating: rating,
            product_id: id,
        };

        const ApiUrl = '/api/applyReview';

        fetch(ApiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((responseData) => {
                if (responseData.status === true) {
                    console.log(responseData);
                    alert('Your review has been successfully added');
                    window.location.reload();
                } else {
                    alert('Something goes wrong');
                    // window.location.reload();
                }
            })
            .catch((error) => {
                // Обработайте ошибку здесь
                console.error('Ошибка:', error);
            });
    });
});

async function fetchReviews() {
    const reviewUrl = '/api/getProductReviews?product_id=' + id;
    const token = localStorage.getItem('customToken');

    fetch(reviewUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'guestToken': token,
        },
    })
        .then((response) => response.json())
        .then((responseData) => {
            const reviewCountElement = document.getElementById('review-count');

            if (responseData.status === true) {

                reviewCountElement.textContent = responseData.data.count;
                displayReviews(responseData.data.reviews)
            } else {
                reviewCountElement.textContent = 0;
            }

        })
        .catch((error) => {
            // Обработайте ошибку здесь
            console.error('Ошибка:', error);
        });
}

function displayReviews(reviewsData) {
    const reviewContainer = document.getElementById('reviewContent');
    const reviewForm = document.getElementById('reviewForm');

    reviewContainer.innerHTML = '';

    reviewsData.forEach(review => {
        const authorElement = document.createElement('div');
        authorElement.classList.add('comment-author');

        let ratingHTML = '';
        for (let i = 1; i <= review.rating; i++) {
            ratingHTML += '&#9733;'; // Добавляем золотую звезду в HTML
        }

        authorElement.innerHTML = `
            <div class="comment-thumb">
              <img src="/assets/img/shop/avatar.webp" width="60"
                    height="60" alt="Image-HasTech">
            </div>
            <div class="comment-content">
               <div class="rating-box">
                   <i>${ratingHTML}</i>
               </div>
               <h4><span>${review.email}</span> - ${review.uploaded_time}</h4>
               <p class="desc">${review.comment}</p>
            </div>
        `;

        reviewContainer.appendChild(authorElement);
    });
    reviewContainer.appendChild(reviewForm);

}

async function fetchCategories(category) {
    const limit = 4;
    const apiURL = "/api/getProducts?category_id=" + category + "&limit=" + limit;

    const response = await fetch(apiURL, {
        method: 'GET',
        headers: {
            'guestToken': localStorage.getItem('customToken')
        },
    });

    if (!response.ok) {
        throw new Error('Request to another API failed');
    }

    const data = await response.json();
    const rows = document.querySelectorAll('.row');
    const productContainer = rows[6];
    const CookieToken = await getTokenFromCookie();


    data.data.products.forEach(product => {
        // Создаем элементы и заполняем их значениями из данных товара
        const productItem = document.createElement('div');
        productItem.classList.add('col-sm-6', 'col-lg-3');

        const productWrapper = document.createElement('div');
        productWrapper.classList.add('product-item');

        const productThumb = document.createElement('div');
        productThumb.classList.add('product-thumb');

        const productLink = document.createElement('a');
        const url = "/product?id=" + product.id;

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
}


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
