<!DOCTYPE html>
<html lang="zxx">

@include('Pub.layouts.headerSettings')
<body>

<!--wrapper start-->
<div class="wrapper">

    @include('Pub.layouts.header')

    <main class="main-content">
        <!--== Start Hero Area Wrapper ==-->
        <section class="home-slider-area">
            <div class="swiper home-slider-container default-slider-container">
                <div class="swiper-wrapper home-slider-wrapper slider-default">
                    <div class="swiper-slide">
                        <div class="slider-content-area" data-bg-img="assets/img/slider/slider-bg.webp">
                            <div class="container">
                                <div class="slider-container">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="slider-content">
                                                <div class="content">
                                                    <div class="sub-title-box">
                                                        <h5 class="sub-title">Up To 40% Off</h5>
                                                    </div>
                                                    <div class="title-box">
                                                        <h2 class="title">A Greate Meal With Your Pet</h2>
                                                    </div>
                                                    <div class="btn-box">
                                                        <a class="btn-theme text-dark" href={{route('products.index')}}>Shop
                                                            Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="slider-thumb mousemove">
                                                <div class="thumb">
                                                    <img src="/assets/img/slider/slider-01.webp" width="585"
                                                         height="579" alt="Image-HasTech">
                                                    <div class="shape-one"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider-content-two-area" data-bg-img="assets/img/slider/slider-02.webp">
                            <div class="container">
                                <div class="slider-container">
                                    <div class="row justify-content-sm-end justify-content-center align-items-center">
                                        <div class="col-sm-8 col-md-6">
                                            <div class="slider-content">
                                                <div class="content">
                                                    <div class="sub-title-box">
                                                        <h5 class="sub-title">100% Genue Products</h5>
                                                    </div>
                                                    <div class="title-box">
                                                        <h2 class="title">This Food Best Your Pet</h2>
                                                    </div>
                                                    <div class="desc-box">
                                                        <p class="desc">Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit, seddo do eiusmod tempor incidid ut
                                                            labore.</p>
                                                    </div>
                                                    <div class="btn-box">
                                                        <a class="btn-theme text-dark" href="products.blade.php">Shop
                                                            Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="home-overlay"></div>
                        </div>
                    </div>
                </div>

                <!--== Add Swiper Arrows ==-->
                <div class="swiper-btn-wrap">
                    <div class="swiper-btn-prev">
                        <i class="pe-7s-angle-left"></i>
                    </div>
                    <div class="swiper-btn-next">
                        <i class="pe-7s-angle-right"></i>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Hero Area Wrapper ==-->

        <!--== Start Product Category Area Wrapper ==-->
        <section class="product-area product-category-area bg-color-f2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title shape-center text-center">
                            <h5 class="sub-title">TRENDING CATEGORIES</h5>
                            <h2 class="title">Shop By Category</h2>
                        </div>
                    </div>
                </div>
                <div id="categories-container"
                     class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-gutter-43">
                </div>
            </div>
        </section>
        <!--== End Product Category Area Wrapper ==-->

        <!--== Start Product Banner Area Wrapper ==-->
        <section class="product-area product-banner-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner-product-single-item">
                            <div class="thumb">
                                <a href="products.blade.php">
                                    <img src="/assets/img/shop/banner/1.webp" width="570" height="300"
                                         alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="sub-title">50% Off</h5>
                                <h5 class="title">Dog Food</h5>
                                <a class="btn-theme btn-theme-color btn-sm" href="products.blade.php">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner-product-single-item">
                            <div class="thumb">
                                <a href="products.blade.php">
                                    <img src="/assets/img/shop/banner/2.webp" width="570" height="300"
                                         alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="sub-title">50% Off</h5>
                                <h5 class="title">Cat Food</h5>
                                <a class="btn-theme btn-theme-color btn-sm" href="products.blade.php">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Banner Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="product-area product-default-area">
            <div class="container pt--0">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title mb-45 mb-sm-20 shape-center text-center">
                            <h5 class="sub-title">Best PRODUCT</h5>
                            <h2 class="title">New Collection</h2>
                        </div>
                        <div class="isotope-filter">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".filter_new">New</button>
                            <button data-filter=".filter_best_sellers">Best Sellers</button>
                            <button data-filter=".filter_featured">Featured</button>
                            <button data-filter=".filter_on_sall">On Sall</button>
                        </div>
                    </div>
                </div>
                <div class="row isotope-grid">
                    <div class="col-sm-6 col-lg-3 isotope-item filter_best_sellers filter_on_sall">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/category/x1pOvQni64Po9BugwMhvxnkEv5uGYPe6fVQfSPuU.jpg" width="270" height="320"
                                         alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">The Special One</a></h4>
                                <div class="prices">
                                    <span class="price">$20000000</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_new filter_featured">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/2.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Endeavor Daytripa</a></h4>
                                <div class="prices">
                                    <span class="price">$33.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_best_sellers filter_on_sall">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/3.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Impulse Duffle</a></h4>
                                <div class="prices">
                                    <span class="price">$65.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_new filter_featured">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/4.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Driven Backpack</a></h4>
                                <div class="prices">
                                    <span class="price">$25.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_best_sellers filter_on_sall">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/5.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Fusion Backpack</a></h4>
                                <div class="prices">
                                    <span class="price">$45.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_new filter_featured">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/6.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Savvy Shoulder Tote</a></h4>
                                <div class="prices">
                                    <span class="price">$30.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_best_sellers filter_on_sall">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/7.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Voyage Yoga Bag</a></h4>
                                <div class="prices">
                                    <span class="price">$39.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-3 isotope-item filter_new filter_featured">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="single-product.blade.php">
                                    <img src="/assets/img/shop/8.webp" width="270" height="320" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="single-product.blade.php">Wayfarer Messenger Bag</a></h4>
                                <div class="prices">
                                    <span class="price">$50.00</span>
                                </div>
                            </div>
                            <div class="product-action">
                                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal">
                                    <i class="pe-7s-like"></i>
                                </button>
                                <div class="product-action-links">
                                    <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">
                                        <i class="pe-7s-shopbag"></i>
                                    </button>
                                    <button type="button" class="btn-product-quick-view" data-bs-toggle="modal"
                                            data-bs-target="#action-QuickViewModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->

        <!--== Start Divider Area Wrapper ==-->
        <section class="bg-theme-color position-relative z-index-1">
            <div class="container-fluid p--0">
                <div class="row divider-style1">
                    <div class="col-lg-3 col-xl-4">
                        <div class="divider-thumb divider-thumb-left">
                            <img src="/assets/img/photos/divider1.webp" width="351" height="435" alt="Image-HasTech">
                            <div class="shape-circle"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="divider-content text-center">
                            <h5 class="sub-title">Save 50% Off</h5>
                            <h2 class="title">Best Deal Offer</h2>
                            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore etlop.</p>
                            <a class="btn-theme text-dark" href="products.blade.php">Shop Now</a>
                            <img class="shape-object" src="/assets/img/shape/object1.webp" width="316" height="302"
                                 alt="Image-HasTech">
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4">
                        <div class="divider-thumb divider-thumb-right">
                            <img src="/assets/img/photos/divider2.webp" width="488" height="447" alt="Image-HasTech">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Divider Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="product-area daily-product-area bg-color-f2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title shape-center text-center">
                            <h5 class="sub-title">Trending Productts</h5>
                            <h2 class="title">Deal Of The Day</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <!--== Start Product Item ==-->
                        <div class="product-item daily-product-item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="product-thumb">
                                        <a href="single-product.blade.php">
                                            <img src="/assets/img/shop/9.webp" width="270" height="320"
                                                 alt="Image-HasTech">
                                        </a>
                                        <div class="product-action">
                                            <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                                    data-bs-target="#action-WishlistModal">
                                                <i class="pe-7s-like"></i>
                                            </button>
                                            <div class="product-action-links">
                                                <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                                        data-bs-target="#action-CartAddModal">
                                                    <i class="pe-7s-shopbag"></i>
                                                </button>
                                                <button type="button" class="btn-product-quick-view"
                                                        data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                                    <i class="pe-7s-look"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="product-info">
                                        <div class="ht-countdown-wrap">
                                            <span class="countdown-title">End In:</span>
                                            <div class="ht-countdown ht-countdown-style1" data-date="1/10/2022"></div>
                                        </div>
                                        <h4 class="title"><a href="single-product.blade.php">Joust Duffle Bag</a></h4>
                                        <div class="prices">
                                            <span class="price">$20.19</span>
                                        </div>
                                        <div class="product-feature-list">
                                            <ul>
                                                <li><span>Predecessor :</span> None.</li>
                                                <li><span>Support Type :</span> Neutral.</li>
                                                <li><span>Cushioning :</span> High Energizing.</li>
                                                <li><span>Total Weight :</span> 300gm</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                    <div class="col-12 col-sm-6">
                        <!--== Start Product Item ==-->
                        <div class="product-item daily-product-item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="product-thumb">
                                        <a href="single-product.blade.php">
                                            <img src="/assets/img/shop/10.webp" width="270" height="320"
                                                 alt="Image-HasTech">
                                        </a>
                                        <div class="product-action">
                                            <button type="button" class="btn-product-wishlist" data-bs-toggle="modal"
                                                    data-bs-target="#action-WishlistModal">
                                                <i class="pe-7s-like"></i>
                                            </button>
                                            <div class="product-action-links">
                                                <button type="button" class="btn-product-cart" data-bs-toggle="modal"
                                                        data-bs-target="#action-CartAddModal">
                                                    <i class="pe-7s-shopbag"></i>
                                                </button>
                                                <button type="button" class="btn-product-quick-view"
                                                        data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                                    <i class="pe-7s-look"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="product-info">
                                        <div class="ht-countdown-wrap">
                                            <span class="countdown-title">End In:</span>
                                            <div class="ht-countdown ht-countdown-style1" data-date="1/10/2022"></div>
                                        </div>
                                        <h4 class="title"><a href="single-product.blade.php">Wayfarer Messenger Bag</a>
                                        </h4>
                                        <div class="prices">
                                            <span class="price">$40.19</span>
                                        </div>
                                        <div class="product-feature-list">
                                            <ul>
                                                <li><span>Predecessor :</span> None.</li>
                                                <li><span>Support Type :</span> Neutral.</li>
                                                <li><span>Cushioning :</span> High Energizing.</li>
                                                <li><span>Total Weight :</span> 300gm</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->

        <!--== Start About Area Wrapper ==-->
        <section class="about-area">
            <div class="container">
                <div class="about-item position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="about-content">
                                <div class="section-title shape-left">
                                    <h5 class="sub-title">Best PRODUCT</h5>
                                    <h2 class="title">Best Pet Food</h2>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehenderit in voluptate</p>
                                <p>Velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata
                                    non proident, sunt in culpa qui officia deserun mollit anim id est laborum. Sed ut
                                    perspiciatis unde omnis iste natus error.</p>
                                <a class="btn-theme" href="products.blade.php">Shop Now</a>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="about-thumb">
                                <img src="/assets/img/about/1.webp" width="569" height="577" alt="Image-HasTech">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End About Area Wrapper ==-->

        <!--== Start Blog Area Wrapper ==-->
        <section class="blog-area blog-default-area">
            <div class="container pt--0">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title shape-center text-center">
                            <h5 class="sub-title">TRENDING CATEGORIES</h5>
                            <h2 class="title">Shop By Category</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <!--== Start Blog Item ==-->
                        <div class="post-item">
                            <div class="thumb">
                                <a href="blog-details.blade.php">
                                    <img src="/assets/img/blog/1.webp" width="350" height="250" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="content">
                                <div class="meta">
                                    <ul>
                                        <li class="author-info"><span>By:</span> <a href="blog.blade.php">Admin</a></li>
                                        <li class="post-date"><a href="blog.blade.php">Sep 24,2022</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.blade.php">Lorem ipsum dolor sit amet conse
                                        adipis.</a></h4>
                                <a class="btn-theme btn-sm" href="blog-details.blade.php">Read More</a>
                            </div>
                        </div>
                        <!--== End Blog Item ==-->
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <!--== Start Blog Item ==-->
                        <div class="post-item">
                            <div class="thumb">
                                <a href="blog-details.blade.php">
                                    <img src="/assets/img/blog/2.webp" width="350" height="250" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="content">
                                <div class="meta">
                                    <ul>
                                        <li class="author-info"><span>By:</span> <a href="blog.blade.php">Admin</a></li>
                                        <li class="post-date"><a href="blog.blade.php">Sep 24,2022</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.blade.php">It is a long established fact that a
                                        reader will.</a></h4>
                                <a class="btn-theme btn-sm" href="blog-details.blade.php">Read More</a>
                            </div>
                        </div>
                        <!--== End Blog Item ==-->
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <!--== Start Blog Item ==-->
                        <div class="post-item">
                            <div class="thumb">
                                <a href="blog-details.blade.php">
                                    <img src="/assets/img/blog/3.webp" width="350" height="250" alt="Image-HasTech">
                                </a>
                            </div>
                            <div class="content">
                                <div class="meta">
                                    <ul>
                                        <li class="author-info"><span>By:</span> <a href="blog.blade.php">Admin</a></li>
                                        <li class="post-date"><a href="blog.blade.php">Sep 24,2022</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.blade.php">fashions fade, style is eternal About
                                        Upto.</a></h4>
                                <a class="btn-theme btn-sm" href="blog-details.blade.php">Read More</a>
                            </div>
                        </div>
                        <!--== End Blog Item ==-->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>


<script src="/assets/js/customFiles/index.js"></script>

</body>

</html>
