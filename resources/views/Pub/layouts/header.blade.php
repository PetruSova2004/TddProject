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
        <div class="row no-gutter align-items-center position-relative">
            <div class="col-12">
                <div class="header-align">
                    <div class="header-align-start">
                        <div class="header-logo-area">
                            <a href="{{route('home')}}">
                                <img class="logo-main" src="/assets/img/logo-light.webp" alt="Logo"/>
                            </a>
                        </div>
                    </div>
                    <div class="header-align-center">
                        <div class="header-navigation-area position-relative">
                            <ul class="main-menu nav">
                                <li class="has-submenu"><a href="{{route('home')}}"><span>Home</span></a>
                                </li>
                                <li><a href="{{route('about.index')}}"><span>About</span></a></li>
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
                                                <li><a href="{{route('cart.index')}}"><span>Shopping Cart</span></a>
                                                </li>
                                                <li><a href="/checkout"><span>Checkout</span></a></li>
                                                <li><a href="{{route('wishlist.index')}}"><span>Wishlist</span></a></li>
                                                <li><a href="{{route('compare.index')}}"><span>Compare</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="#/"><span>Blog</span></a>
                                    <ul class="submenu-nav submenu-nav-mega">
                                        <li class="mega-menu-item"><a href="#/" class="mega-title">Blog Layout</a>
                                            <ul>
                                                <li><a href="{{route('blog.index')}}">Blogs</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item"><a href="#/" class="mega-title">Single Blog</a>
                                            <ul>
                                                <li><a href="{{route('blogDetails.index')}}">Blog Details</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="#/"><span>Pages</span></a>
                                    <ul class="submenu-nav">
                                        <li><a href="/account"><span>Account</span></a></li>
                                        <li><a href="/login"><span>Login</span></a></li>
                                        <li><a href="/register"><span>Register</span></a></li>
                                        <li id="logoutMenuItem"></li>
                                        <!-- Пустой элемент, в который мы будем добавлять пункт "Logout" -->

                                    </ul>
                                </li>
                                <li><a href="{{route('contact.index')}}"><span>Contact</span></a></li>
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
                                <a class="shopping-wishlist-btn" href="{{route('wishlist.index')}}">
                                    <i class="pe-7s-like icon"></i>
                                </a>
                            </div>

                            <div class="shopping-cart">
                                <button class="shopping-cart-btn" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#AsideOffcanvasCart" aria-controls="AsideOffcanvasCart">
                                    <i class="pe-7s-shopbag icon"></i>
                                    <sup class="shop-count"></sup>
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
            @include('Pub.layouts.alerts')
        </div>
    </div>



</header>

<!--== End Header Wrapper ==-->
