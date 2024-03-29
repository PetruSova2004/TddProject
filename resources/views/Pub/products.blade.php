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
                                    <li><a href="{{route('home')}}">Home</a></li>
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

                <div class="row justify-content-between">
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-product-single-style2-item">
                                    <div class="thumb">
                                        <a href="{{route('products.index')}}">
                                            <img src="assets/img/shop/banner/3.webp" width="870" height="247"
                                                 alt="Image-HasTech">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="sub-title">-25% Off </h5>
                                        <h5 class="title">Pet Food, Medicin & Shop With Us</h5>
                                        <a class="btn-theme-link" href="{{route('products.index')}}">Shop Now</a>
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

                            <div class="shop-widget shop-sidebar-category">
                                <h4 class="sidebar-title">Categories</h4>
                                <div class="sidebar-category">
                                    <ul class="category-list mb--0">
                                        <!-- Categories from api request below -->
                                    </ul>
                                </div>
                            </div>

                            <div class="blog-widget blog-sidebar-tags">
                                <h4 class="sidebar-title">Popular Tags</h4>
                                <div class="sidebar-tags">
                                    <ul class="tags-list mb--0">
                                        <li><a href="blog.blade.php">Pet</a></li>
                                        <li><a href="blog.blade.php">Animal</a></li>
                                        <li><a href="blog.blade.php">Dog</a></li>
                                        <li><a href="blog.blade.php">Pet Food</a></li>
                                        <li><a href="blog.blade.php">Dress</a></li>
                                        <li><a href="blog.blade.php">Food</a></li>
                                        <li><a href="blog.blade.php">Cat</a></li>
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
