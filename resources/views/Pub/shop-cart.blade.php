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
                                    <li><a href="{{route('home')}}">Home</a></li>
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

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="coupon-wrap" id="cardId">
                            <h4 class="title">Coupon</h4>
                            <p class="desc">Enter your coupon code if you have one.</p>
                            <input type="text" class="form-control" placeholder="Coupon code" name="Coupon code">
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
                                        <span id="subtotalAmount" class="amount"></span>
                                    </td>
                                </tr>
                                <tr class="shipping-totals">
                                    <th>Discount</th>
                                    <td>
                                        <span id="discount" class="amount"></span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td>
                                        <span id="totalAmount" class="amount"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <a href="{{route('checkout.index')}}" class="checkout-button">Proceed to checkout</a>
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

<script src="/assets/js/customFiles/shop-cart.js"></script>

</body>

</html>
