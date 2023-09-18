async function fetchData() {
    const token = localStorage.getItem('customToken')
    fetch('/api/getWishlist', {
        headers: {
            'guestToken': token,
        }
    })
        .then(response => response.json())
        .then(async data => {
            await populateTableWithData(data.data.wishlist);
        })
        .catch(error => {
            console.error('Произошла ошибка при запросе к API:', error);
        });
}

async function populateTableWithData(data) {
    const tbody = document.querySelector('.table tbody');

    data.forEach(item => {
        const row = document.createElement('tr');

        row.innerHTML = `
      <td class="product-remove">
        <a class="remove" href="javascript:void(0)">×</a>
      </td>
      <td class="product-thumbnail">
        <div class="thumb">
          <a href="single-product.blade.php">
            <img src="${item.image_path}" width="59" height="58" alt="Image-HasTech">
          </a>
        </div>
      </td>
      <td class="product-name">
        <a class="title" href="single-product.blade.php">${item.title}</a>
      </td>
      <td class="product-price">
        <span class="price">$${item.price.toFixed(2)}</span>
      </td>
      <td class="product-stock-status">
        <span class="wishlist-in-stock">${item.in_stock === 'Yes' ? 'In Stock' : 'Out of Stock'}</span>
      </td>
      <td class="product-add-to-cart">
        <a class="btn-shop-cart">Add to Cart</a>
      </td>
    `;

        const removeLink = row.querySelector('.remove');
        removeLink.addEventListener('click', async () => {
            // Вызовите функцию, которая отправляет запрос к API
            await sendRequestToDeleteItem(item.id); // Предположим, что у вас есть свойство "id" для каждого элемента в списке
        });

        const cartLink = row.querySelector('.btn-shop-cart');
        cartLink.type = 'button';
        cartLink.classList.add('btn-product-cart');
        cartLink.dataset.bsToggle = 'modal';
        if (item.in_stock === 'Yes') {
            cartLink.dataset.bsTarget = '#action-CartAddModal';
        } else {
            cartLink.dataset.bsTarget = '#action-CartAddFailModal';

        }

        cartLink.addEventListener('click', async function() {
            await addToCart(item.id);
        })

        tbody.appendChild(row);
    });
}


async function sendRequestToDeleteItem(itemId) {
    const token = localStorage.getItem('customToken');
    try {
        const response = await fetch(`/api/deleteProductFromWishlist?productId=` + itemId, {
            method: 'DELETE',
            headers: {
                'guestToken': token,
            },
        });
        const data = await response.json();

        if (data.status === true) {
            alert('Product has been successfully deleted');
            window.location.reload();
        } else {
            console.log(data)
            alert('Something goes wrong')
        }
    } catch (error) {
        console.error('Произошла ошибка при отправке запроса:', error);
    }
}


fetchData();


