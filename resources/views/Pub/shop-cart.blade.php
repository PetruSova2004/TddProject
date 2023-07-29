<!DOCTYPE html>
<html lang="zxx">

@include('Pub.layouts.headerSettings')
<body>

<!--wrapper start-->
<div class="wrapper">

  @include('Pub.layouts.header')

  <main class="main-content">
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="assets/img/photos/bg1.webp">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <div class="page-header-content">
              <h2 class="title">Cart</h2>
              <nav class="breadcrumb-area">
                <ul class="breadcrumb">
                  <li><a href="index.blade.php">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Cart</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="shopping-cart-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="shopping-cart-form table-responsive">
              <form action="#" method="post">
                <table class="table text-center">
                  <thead>
                    <tr>
                      <th class="product-remove">&nbsp;</th>
                      <th class="product-thumbnail">&nbsp;</th>
                      <th class="product-name">Product</th>
                      <th class="product-price">Price</th>
                      <th class="product-quantity">Quantity</th>
                      <th class="product-subtotal">Total</th>
                    </tr>
                  </thead>
                  <tbody id="cartTable">

                    <tr class="tbody-item-actions">
                      <td colspan="6">
                        <button type="submit" class="btn-update-cart disabled" disabled>Update cart</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="coupon-wrap">
              <h4 class="title">Coupon</h4>
              <p class="desc">Enter your coupon code if you have one.</p>
              <input type="text" class="form-control" placeholder="Coupon code">
              <button type="button" class="btn-coupon">Apply coupon</button>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="cart-totals-wrap">
              <h2 class="title">Cart totals</h2>
              <table>
                <tbody>
                  <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td>
                      <span id="subtotalAmount" class="amount">$499.00</span>
                    </td>
                  </tr>
                  <tr class="shipping-totals">
                    <th>Shipping</th>
                    <td>
                      <ul class="shipping-list">
                        <li class="radio">
                          <input type="radio" name="shipping" id="radio1" checked>
                          <label for="radio1">Flat rate: <span>$3.00</span></label>
                        </li>
                        <li class="radio">
                          <input type="radio" name="shipping" id="radio2">
                          <label for="radio2">Free shipping</label>
                        </li>
                        <li class="radio">
                          <input type="radio" name="shipping" id="radio3">
                          <label for="radio3">Local pickup</label>
                        </li>
                      </ul>
                      <p class="destination">Shipping to <strong>USA</strong>.</p>
                      <a href="javascript:void(0)" class="btn-shipping-address">Change address</a>
                    </td>
                  </tr>
                  <tr class="order-total">
                    <th>Total</th>
                    <td>
                      <span id="totalAmount" class="amount">$504.00</span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="text-end">
                <a href="shop-checkout.blade.php" class="checkout-button">Proceed to checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Blog Area Wrapper ==-->
  </main>

  @include('Pub.layouts.footer')
</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')

<script>

    // Функция для получения данных о продуктах из API
    async function fetchCartPageProducts(token) {
        try {
            const response = await fetch('/api/getCart', {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            });
            const data = await response.json();

            const subtotalElement = document.getElementById('totalAmount');
            if (data.data.totalPrice) {
                subtotalElement.textContent = "$" + data.data.totalPrice;
            } else  {
                subtotalElement.textContent = "$" + 0;
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

            // Получаем ссылку на элемент "x"
            const removeButton = productRow.querySelector('.remove');
            // Добавляем обработчик события на клик по "x"
            removeButton.addEventListener('click', () => {
                // Выполняем POST-запрос к API
                const productId = product.product_id; // Предположим, что у продукта есть свойство "id"
                sendPostRequest(token, productId);
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

</script>

</body>

</html>
