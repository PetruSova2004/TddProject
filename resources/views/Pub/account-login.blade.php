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
                            <h2 class="title">Login</h2>
                            <nav class="breadcrumb-area">
                                <ul class="breadcrumb">
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Area Wrapper ==-->
        <section class="account-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="login-form-content">
                            <form id="urlForm" action="{{route('api.login')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Email address <span class="required">*</span></label>
                                            <input id="email" name="email" class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password">Password <span class="required">*</span></label>
                                            <input id="password" name="password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                            <input type="submit" class="btn-register" onclick="login()" value="Login">
                                            <a href="{{route('google.redirect')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="26"
                                                     fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End My Account Area Wrapper ==-->

        <!--== Start Feature Area Wrapper ==-->
        <div class="feature-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f1.webp" width="46" height="34"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">Free Shipping</h5>
                                <p>Capped at $39 per order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f2.webp" width="43" height="34"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">Card Payments</h5>
                                <p>12 Months Installments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f3.webp" width="39" height="39"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">Easy Returns</h5>
                                <p>Shop With Confidence</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f4.webp" width="36" height="39"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">24/7 Support</h5>
                                <p>Contact 24 hours everyday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Feature Area Wrapper ==-->
    </main>

    @include('Pub.layouts.footer')

    <!--== Scroll Top Button ==-->
    <div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>

    <!--== Start Product Quick Wishlist Modal ==-->
    <aside class="product-action-modal modal fade" id="action-WishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-action-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="pe-7s-close"></i>
                        </button>
                        <div class="modal-action-messages">
                            <i class="pe-7s-check"></i> Added to wishlist successfully!
                        </div>
                        <div class="modal-action-product">
                            <div class="thumb">
                                <img src="/assets/img/shop/modal1.webp" alt="Organic Food Juice" width="466"
                                     height="320">
                            </div>
                            <h4 class="product-name"><a href="single-product.blade.php">Joust Duffle Bag</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Product Quick Wishlist Modal ==-->

    <!--== Start Product Quick Add Cart Modal ==-->
    <aside class="product-action-modal modal fade" id="action-CartAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-action-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="pe-7s-close"></i>
                        </button>
                        <div class="modal-action-messages">
                            <i class="pe-7s-check"></i> Added to cart successfully!
                        </div>
                        <div class="modal-action-product">
                            <div class="thumb">
                                <img src="/assets/img/shop/modal1.webp" alt="Organic Food Juice" width="466"
                                     height="320">
                            </div>
                            <h4 class="product-name"><a href="single-product.blade.php">Joust Duffle Bag</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Product Quick Add Cart Modal ==-->

    <!--== Start Product Quick View Modal ==-->
    <aside class="product-cart-view-modal modal fade" id="action-QuickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-quick-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <span class="pe-7s-close"></span>
                        </button>
                        <div class="container pt--0 pb--0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--== Start Product Thumbnail Area ==-->
                                    <div class="product-single-thumb">
                                        <img src="/assets/img/shop/quick-view1.webp" width="544" height="560"
                                             alt="Image-HasTech">
                                    </div>
                                    <!--== End Product Thumbnail Area ==-->
                                </div>
                                <div class="col-lg-6">
                                    <!--== Start Product Info Area ==-->
                                    <div class="product-single-info">
                                        <h3 class="main-title">Joust Duffle Bag</h3>
                                        <div class="prices">
                                            <span class="price">$20.19</span>
                                        </div>
                                        <div class="rating-box-wrap">
                                            <div class="rating-box">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="review-status">
                                                <a href="javascript:void(0)">(5 Customer Review)</a>
                                            </div>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipis elit, sed do eiusmod tempor
                                            incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nol
                                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                                            aute irure dolor in reprehenderit in voluptate</p>
                                        <div class="product-single-meta">
                                            <ul>
                                                <li><span>SKU:</span> Ch-256xl</li>
                                                <li><span>Categories:</span>
                                                    <a href="products.blade.php">Pet Food. eCommerce</a>
                                                </li>
                                                <li><span>Tags:</span>
                                                    <a href="products.blade.php">Petfood. Pet</a>,
                                                    <a href="products.blade.php">Animal.</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-quick-action">
                                            <div class="qty-wrap">
                                                <div class="pro-qty">
                                                    <input type="text" title="Quantity" value="01">
                                                </div>
                                            </div>
                                            <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                                    data-bs-target="#action-CartAddModal">
                                                Add To Cart
                                            </button>
                                            <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                                    data-bs-target="#action-WishlistModal">
                                                <i class="pe-7s-like"></i>
                                            </button>
                                            <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                                    data-bs-target="#action-QuickViewModal">
                                                <i class="pe-7s-look"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--== End Product Info Area ==-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Product Quick View Modal ==-->

    <!--== Start Aside Cart ==-->
    <aside class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasCart"
           aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h1 class="d-none" id="offcanvasRightLabel">Shopping Cart</h1>
            <button class="btn-aside-cart-close" data-bs-dismiss="offcanvas" aria-label="Close">Shopping Cart <i
                    class="fa fa-chevron-right"></i></button>
        </div>
        <div class="offcanvas-body">
            <ul class="aside-cart-product-list">
                <li class="aside-product-list-item">
                    <a href="#/" class="remove">×</a>
                    <a href="single-product.blade.php">
                        <img src="/assets/img/shop/product-mini/1.webp" width="90" height="110" alt="Image-HasTech">
                        <span class="product-title">Leather Mens Slipper</span>
                    </a>
                    <span class="product-price">1 × £69.99</span>
                </li>
                <li class="aside-product-list-item">
                    <a href="#/" class="remove">×</a>
                    <a href="single-product.blade.php">
                        <img src="/assets/img/shop/product-mini/2.webp" width="90" height="110" alt="Image-HasTech">
                        <span class="product-title">Quickiin Mens shoes</span>
                    </a>
                    <span class="product-price">1 × £20.00</span>
                </li>
            </ul>
            <p class="cart-total"><span>Subtotal:</span><span class="amount">£89.99</span></p>
            <a class="btn-total" href="shop-cart.blade.php">View cart</a>
            <a class="btn-total" href="shop-checkout.blade.php">Checkout</a>
            <a class="d-block text-end lh-1" href="shop-checkout.blade.php"><img src="/assets/img/photos/paypal.webp"
                                                                                 width="133" height="26"
                                                                                 alt="Has-image"></a>
        </div>
    </aside>
    <!--== End Aside Cart ==-->

    <!--== Start Aside Search Form ==-->
    <aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch"
           aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="pe-7s-close"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="container pt--0 pb--0">
                <div class="search-box-form-wrap">
                    <div class="search-note">
                        <p>Start typing and press Enter to search</p>
                    </div>
                    <form action="#" method="post">
                        <div class="search-form position-relative">
                            <label for="search-input" class="visually-hidden">Search</label>
                            <input id="search-input" type="search" class="form-control"
                                   placeholder="Search entire store…">
                            <button class="search-button"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Aside Search Form ==-->

    <!--== Start Aside Menu ==-->
    <aside class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu"
           aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h1 class="d-none" id="offcanvasExampleLabel">Aside Menu</h1>
            <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i
                    class="fa fa-chevron-left"></i></button>
        </div>
        <div class="offcanvas-body">
            <nav id="offcanvasNav" class="offcanvas-menu-nav">
                <ul>
                    <li class="offcanvas-nav-parent">
                        <a class="offcanvas-nav-item" href="javascript:void(0)">Home</a>
                        <ul>
                            <li><a href="{{route('home')}}"><span>Home One</span></a></li>
                        </ul>
                    </li>

                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="about-us.blade.php">About</a>
                    </li>

                    <li class="offcanvas-nav-parent">
                        <a class="offcanvas-nav-item" href="javascript:void(0)">Shop</a>
                        <ul>
                            <li>
                                <a class="offcanvas-nav-item" href="javascript:void(0)">Shop Layouts</a>
                                <ul>
                                    <li><a href="shop-three-columns.blade.php"><span>Shop 3 Column</span></a></li>
                                    <li><a href="shop-four-columns.blade.php"><span>Shop 4 Column</span></a></li>
                                    <li><a href="shop-left-sidebar.blade.php"><span>Shop Left Sidebar</span></a></li>
                                    <li><a href="products.blade.php"><span>Shop Right Sidebar</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="offcanvas-nav-item" href="javascript:void(0)">Single Product</a>
                                <ul>
                                    <li><a href="single-normal-product.blade.php"><span>Single Product Normal</span></a>
                                    </li>
                                    <li><a href="single-product.blade.php"><span>Single Product Variable</span></a></li>
                                    <li><a href="single-group-product.blade.php"><span>Single Product Group</span></a>
                                    </li>
                                    <li>
                                        <a href="single-affiliate-product.blade.php"><span>Single Product Affiliate</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="offcanvas-nav-item" href="javascript:void(0)">Others Pages</a>
                                <ul>
                                    <li><a href="shop-cart.blade.php"><span>Shopping Cart</span></a></li>
                                    <li><a href="shop-checkout.blade.php"><span>Checkout</span></a></li>
                                    <li><a href="shop-wishlist.blade.php"><span>Wishlist</span></a></li>
                                    <li><a href="shop-compare.blade.php"><span>Compare</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="offcanvas-nav-parent">
                        <a class="offcanvas-nav-item" href="javascript:void(0)">Blog</a>
                        <ul>
                            <li>
                                <a class="offcanvas-nav-item" href="javascript:void(0)">Blog Layout</a>
                                <ul>
                                    <li><a href="blog-grid.blade.php">Blog Grid</a></li>
                                    <li><a href="blog.blade.php">Blog Left Sidebar</a></li>
                                    <li><a href="blog.blade.php">Blog Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="offcanvas-nav-item" href="javascript:void(0)">Single Blog</a>
                                <ul>
                                    <li><a href="blog-details-no-sidebar.blade.php">Blog Details</a></li>
                                    <li><a href="blog-details.blade.php">Blog Details Left Sidebar</a></li>
                                    <li><a href="blog-details.blade.php">Blog Details Right Sidebar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="offcanvas-nav-parent">
                        <a class="offcanvas-nav-item" href="javascript:void(0)">Pages</a>
                        <ul>
                            <li><a href="account.blade.php"><span>Account</span></a></li>
                            <li><a href="account-login.html"><span>Login</span></a></li>
                            <li><a href="account-register.blade.php"><span>Register</span></a></li>
                            <li><a href="../errors/404.blade.php"><span>Page Not Found</span></a></li>
                        </ul>
                    </li>

                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="contact.blade.php">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!--== End Aside Menu ==-->
</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')

<script src="/assets/js/customFiles/account-login.js"></script>


</body>

</html>
