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
                            <h2 class="title">Checkout</h2>
                            <nav class="breadcrumb-area">
                                <ul class="breadcrumb">
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Shopping Checkout Area Wrapper ==-->
        <section class="shopping-checkout-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="checkout-page-coupon-wrap">
                            <!--== Start Checkout Coupon Accordion ==-->
                            <div class="coupon-accordion" id="CouponAccordion">
                                <div class="card" id="cardId">
                                    <h3>
                                        <i class="fa fa-info-circle"></i>
                                        Have a Coupon?
                                        <a href="#/" data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                            here to enter your code</a>
                                    </h3>
                                    <div id="couponaccordion" class="collapse" data-bs-parent="#CouponAccordion">
                                        <div class="card-body">
                                            <div class="apply-coupon-wrap">
                                                <p>If you have a coupon code, please apply it below.</p>

                                                <form action="#" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text"
                                                                       name="Coupon code" placeholder="Coupon code">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn-coupon">Apply coupon
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--== End Checkout Coupon Accordion ==-->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <!--== Start Billing Accordion ==-->
                        <div class="checkout-billing-details-wrap">
                            <h2 class="title">Billing details</h2>
                            <div class="billing-form-wrap">

                                <form action="{{route('api.placeOrder')}}" method="post" id="urlForm">
                                    @method('POST')
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="f_name">First name <abbr class="required"
                                                                                     title="required">*</abbr></label>
                                                <input id="f_name" type="text" class="form-control" name="firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="l_name">Last name <abbr class="required"
                                                                                    title="required">*</abbr></label>
                                                <input id="l_name" type="text" class="form-control" name="lastname">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="com_name">Company name (optional)</label>
                                                <input id="com_name" type="text" class="form-control" name="company">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="country">Country <abbr class="required"
                                                                                   title="required">*</abbr></label>
                                                <select id="country" class="form-control" name="country">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="street-address">Street address <abbr class="required"
                                                                                                 title="required">*</abbr></label>
                                                <input id="address" type="text" class="form-control"
                                                       placeholder="House number and street name" name="address">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="town">Town / City <abbr class="required"
                                                                                    title="required">*</abbr></label>
                                                <input id="city" type="text" class="form-control" name="city">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pz-code">Postcode / ZIP</label>
                                                <input id="zip" type="text" class="form-control" name="zip">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input id="phone" type="text" class="form-control" name="phone">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" data-margin-bottom="30">
                                                <label for="email">Email address <abbr class="required"
                                                                                       title="required">*</abbr></label>
                                                <input id="email" type="text" class="form-control" name="email">
                                            </div>
                                        </div>
                                        <div id="CheckoutBillingAccordion2" class="col-md-12">
                                            <div class="checkout-box" data-margin-bottom="25" data-bs-toggle="collapse"
                                                 data-bs-target="#CheckoutTwo" aria-expanded="false" role="toolbar">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input visually-hidden"
                                                           id="ship-to-different-address">
                                                    <label class="custom-control-label" for="ship-to-different-address">Ship
                                                        to a different address?</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb--0">
                                                <label for="order-notes">Order notes (optional)</label>
                                                <input id="order-notes" class="form-control"
                                                       placeholder="Notes about your order, e.g. special notes for delivery.">
                                            </div>
                                        </div>
                                    </div>
                                    <a href="account.blade.php" class="btn-place-order">Place order</a>
                                </form>
                            </div>
                        </div>
                        <!--== End Billing Accordion ==-->
                    </div>
                    <div class="col-lg-6">
                        <!--== Start Order Details Accordion ==-->
                        <div class="checkout-order-details-wrap">
                            <div class="order-details-table-wrap table-responsive">
                                <h2 class="title mb-25">Your order</h2>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-body">
                                    </tbody>
                                    <tfoot class="table-foot">
                                    <tr class="cart-subtotal">
                                        <th id="subTotalTitle">Subtotal</th>
                                        <td id="subtotal"></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Discount</th>
                                        <td id="discount"></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td id="total"></td>
                                    </tr>
                                    </tfoot>
                                </table>

                                <div class="shop-payment-method">
                                    <div id="PaymentMethodAccordion">
                                        <div class="card">
                                            <div class="card-header" id="check_payments">
                                                <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemOne"
                                                    aria-controls="itemOne" aria-expanded="true">Direct bank
                                                    transfer</h5>
                                            </div>
                                            <div id="itemOne" class="collapse show" aria-labelledby="check_payments"
                                                 data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order will not be
                                                        shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="check_payments2">
                                                <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemTwo"
                                                    aria-controls="itemTwo" aria-expanded="false">Check payments</h5>
                                            </div>
                                            <div id="itemTwo" class="collapse" aria-labelledby="check_payments2"
                                                 data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="check_payments3">
                                                <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemThree"
                                                    aria-controls="itemTwo" aria-expanded="false">Cash on delivery</h5>
                                            </div>
                                            <div id="itemThree" class="collapse" aria-labelledby="check_payments3"
                                                 data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="check_payments4">
                                                <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemFour"
                                                    aria-controls="itemTwo" aria-expanded="false">PayPal Express
                                                    Checkout</h5>
                                            </div>
                                            <div id="itemFour" class="collapse" aria-labelledby="check_payments4"
                                                 data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t
                                                        have a PayPal account.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="p-text">Your personal data will be used to process your order, support
                                        your experience throughout this website, and for other purposes described in our
                                        <a href="#/">privacy policy.</a></p>
                                    <div class="agree-policy">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="privacy"
                                                   class="custom-control-input visually-hidden">
                                            <label for="privacy" class="custom-control-label">I have read and agree to
                                                the website terms and conditions <span class="required">*</span></label>
                                        </div>
                                    </div>
                                    <button id="placeOrderButton" class="btn-place-order">Place Order</button>
                                </div>
                            </div>
                        </div>
                        <!--== End Order Details Accordion ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Shopping Checkout Area Wrapper ==-->
    </main>

    @include('Pub.layouts.footer')
</div>

@include('Pub.layouts.footerSettings')

<script src="/assets/js/customFiles/shop-checkout.js"></script>

</body>

</html>
