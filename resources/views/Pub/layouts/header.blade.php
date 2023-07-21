<!--== Start Preloader Content ==-->
<div class="preloader-wrap">
    <div class="preloader">
        <div class="dog-head"></div>
        <div class="dog-body"></div>
    </div>
</div>
<!--== End Preloader Content ==-->

<!--== Start Header Wrapper ==-->
<header class="header-area header-default" data-bg-img="assets/img/photos/header-bg.webp">
    <div class="container">
        @include('Pub.layouts.alerts')
        <div class="row no-gutter align-items-center position-relative">
            <div class="col-12">
                <div class="header-align">
                    <div class="header-align-start">
                        <div class="header-logo-area">
                            <a href="index.blade.php">
                                <img class="logo-main" src="/assets/img/logo-light.webp" alt="Logo"/>
                            </a>
                        </div>
                    </div>
                    <div class="header-align-center">
                        <div class="header-navigation-area position-relative">
                            <ul class="main-menu nav">
                                <li class="has-submenu"><a href="{{route('home')}}"><span>Home</span></a>
                                </li>
                                <li><a href="about-us.blade.php"><span>About</span></a></li>
                                <li class="has-submenu position-static"><a href="#/"><span>Shop</span></a>
                                    <ul class="submenu-nav submenu-nav-mega column-3">
                                        <li class="mega-menu-item"><a href="#/"
                                                                      class="mega-title"><span>Shop Layout</span></a>
                                            <ul>
                                                <li><a href="{{route('products.index')}}"><span>Shop Products</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item"><a href="#/"
                                                                      class="mega-title"><span>Others Pages</span></a>
                                            <ul>
                                                <li><a href="shop-cart.blade.php"><span>Shopping Cart</span></a></li>
                                                <li><a href="shop-checkout.blade.php"><span>Checkout</span></a></li>
                                                <li><a href="shop-wishlist.blade.php"><span>Wishlist</span></a></li>
                                                <li><a href="shop-compare.blade.php"><span>Compare</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="#/"><span>Blog</span></a>
                                    <ul class="submenu-nav submenu-nav-mega">
                                        <li class="mega-menu-item"><a href="#/" class="mega-title">Blog Layout</a>
                                            <ul>
                                                <li><a href="blog-grid.blade.php">Blog Grid</a></li>
                                                <li><a href="blog.blade.php">Blog Left Sidebar</a></li>
                                                <li><a href="blog-right-sidebar.blade.php">Blog Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item"><a href="#/" class="mega-title">Single Blog</a>
                                            <ul>
                                                <li><a href="blog-details-no-sidebar.blade.php">Blog Details</a></li>
                                                <li><a href="blog-details.blade.php">Blog Details Left Sidebar</a></li>
                                                <li><a href="blog-details-right-sidebar.blade.php">Blog Details Right
                                                        Sidebar</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="#/"><span>Pages</span></a>
                                    <ul class="submenu-nav">
                                        <li><a href="account.blade.php"><span>Account</span></a></li>
                                        <li><a href="{{route('login.index')}}"><span>Login</span></a></li>
                                        <li><a href="{{route('register.index')}}"><span>Register</span></a></li>
                                        <li id="logoutMenuItem"></li>
                                        <!-- Пустой элемент, в который мы будем добавлять пункт "Logout" -->

                                    </ul>
                                </li>
                                <li><a href="#"><span>Contact</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-align-end">
                        <div class="header-action-area">
                            <div class="shopping-search">
                                <button class="shopping-search-btn" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch"><i
                                        class="pe-7s-search icon"></i></button>
                            </div>
                            <div class="shopping-account">
                                <a class="shopping-account-btn" href="{{route('login.index')}}">
                                    <i class="pe-7s-users icon"></i>
                                </a>
                            </div>
                            <div class="shopping-wishlist">
                                <a class="shopping-wishlist-btn" href="shop-wishlist.blade.php">
                                    <i class="pe-7s-like icon"></i>
                                </a>
                            </div>

                            <div class="shopping-cart">
                                <button class="shopping-cart-btn" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#AsideOffcanvasCart" aria-controls="AsideOffcanvasCart">
                                    <i class="pe-7s-shopbag icon"></i>
                                    <sup class="shop-count">2</sup>
                                </button>
                            </div>

                            <button class="btn-menu" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                                <i class="pe-7s-menu"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<!--== End Header Wrapper ==-->