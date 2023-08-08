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
                            <h2 class="title">Products</h2>
                            <nav class="breadcrumb-area">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Products</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="product-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-top-bar">
                            <div class="shop-top-left">
                                <p class="pagination-line"><a href="shop.html">12</a> Product Found of <a
                                        href="shop.html">30</a></p>
                            </div>
                            <div class="shop-top-center">
                                <nav class="product-nav">
                                    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i class="fa fa-th"></i>
                                        </button>
                                        <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                class="fa fa-list"></i></button>
                                        <button class="nav-link" id="nav-grid2-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid2" type="button" role="tab"
                                                aria-controls="nav-grid2" aria-selected="false"><i
                                                class="fa fa-th-large"></i></button>
                                    </div>
                                </nav>
                            </div>
                            <div class="shop-top-right">
                                <div class="shop-sort">
                                    <span>Sort By :</span>
                                    <select class="form-select" aria-label="Sort select example">
                                        <option selected>Default</option>
                                        <option value="1">Popularity</option>
                                        <option value="2">Average Rating</option>
                                        <option value="3">Newsness</option>
                                        <option value="4">Price Low to High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-product-single-style2-item">
                                    <div class="thumb">
                                        <a href="shop.html">
                                            <img src="assets/img/shop/banner/3.webp" width="870" height="247"
                                                 alt="Image-HasTech">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="sub-title">-25% Off </h5>
                                        <h5 class="title">Pet Food, Medicin & Shop With Us</h5>
                                        <a class="btn-theme-link" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                         aria-labelledby="nav-grid-tab">
                                        <div class="row">
                                            <!--Foreach Products from api request below-->
                                        </div>
                                        <div class="col-12">
                                            <div class="pagination-items pagination-items-style1">
                                                <ul class="pagination mb--0">
                                                    <li><a class="active" href="shop.html">1</a></li>
                                                    <li><a href="shop-four-columns.html">2</a></li>
                                                    <li><a href="shop-three-columns.html">3</a></li>
                                                    <li><a href="shop.html" class="icon"><i
                                                                class="fa fa-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                         aria-labelledby="nav-list-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <!--== Start Product Item ==-->
                                                <div class="product-item product-list-item">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="product-thumb">
                                                                <a href="single-product.html">
                                                                    <img src="assets/img/shop/col2-1.webp" width="420"
                                                                         height="320" alt="Image-HasTech">
                                                                </a>
                                                                <div class="product-action">
                                                                    <button type="button" class="btn-product-wishlist"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#action-WishlistModal">
                                                                        <i class="pe-7s-like"></i>
                                                                    </button>
                                                                    <div class="product-action-links">
                                                                        <button type="button"
                                                                                class="btn-product-quick-view"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#action-QuickViewModal">
                                                                            <i class="pe-7s-look"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--== End prPduct Item ==-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="shop-sidebar">
                            <div class="shop-sidebar-search">
                                <div class="sidebar-search-form">
                                    <form id="searchForm" action="#">
                                        <input id="searchInput" type="search" placeholder="Search Here">
                                        <button id="searchButton" type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="shop-widget shop-sidebar-price-range">
                                <h4 class="sidebar-title">Price Filter</h4>
                                <div class="sidebar-price-range">
                                    <input type="text" class="js-range-slider" name="my_range" value=""
                                           data-type="double" data-min="0" data-max="3000" data-from="300"
                                           data-to="2500"/>
                                </div>
                            </div>

                            <div class="shop-widget shop-sidebar-category">
                                <h4 class="sidebar-title">Categories</h4>
                                <div class="sidebar-category">
                                    <ul class="category-list mb--0">
                                        <!-- Categories from api request below -->
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-widget shop-sidebar-color">
                                <h4 class="sidebar-title">Color</h4>
                                <div class="sidebar-color">
                                    <div class="color-list">
                                        <div data-bg-color="#ffd868"></div>
                                        <div class="active" data-bg-color="#721b65"></div>
                                        <div data-bg-color="#dd117e"></div>
                                        <div data-bg-color="#0aa5d2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-widget shop-sidebar-size">
                                <h4 class="sidebar-title">Size</h4>
                                <div class="sidebar-size">
                                    <div class="size-list">
                                        <div>S</div>
                                        <div class="active">M</div>
                                        <div>L</div>
                                        <div>XL</div>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-widget shop-sidebar-tags">
                                <h4 class="sidebar-title">Tags</h4>
                                <div class="sidebar-tags">
                                    <ul class="tags-list mb--0">
                                        <li><a href="shop.html">Fashion</a></li>
                                        <li><a href="shop.html">Organic</a></li>
                                        <li><a href="shop.html">Old Fashion</a></li>
                                        <li><a href="shop.html">Men</a></li>
                                        <li><a href="shop.html">Fashion</a></li>
                                        <li><a href="shop.html">Dress</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->
    </main>

    @include('Pub.layouts.footer')


</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')

<script src="/assets/js/customFiles/products.js"></script>

</body>

</html>
