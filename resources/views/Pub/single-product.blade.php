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
                  <li><a href="index.blade.php">Home</a></li>
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

    <!--== Start Product Single Area Wrapper ==-->
    <section class="product-area product-single-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="product-single-item">
              <div class="row">
                <div class="col-lg-6">
                  <!--== Start Product Thumbnail Area ==-->
                  <div class="product-single-thumb">
                    <div class="swiper single-product-thumb single-product-thumb-slider">
                      <div class="swiper-wrapper">
                        <div class="swiper-slide">
                          <a class="lightbox-image" data-fancybox="gallery" href="/assets/img/shop/product-single/1.webp">
                            <img src="/assets/img/shop/product-single/1.webp" width="570" height="675" alt="Image-HasTech">
                          </a>
                        </div>
                        <div class="swiper-slide">
                          <a class="lightbox-image" data-fancybox="gallery" href="/assets/img/shop/product-single/2.webp">
                            <img src="/assets/img/shop/product-single/2.webp" width="570" height="675" alt="Image-HasTech">
                          </a>
                        </div>
                        <div class="swiper-slide">
                          <a class="lightbox-image" data-fancybox="gallery" href="/assets/img/shop/product-single/3.webp">
                            <img src="/assets/img/shop/product-single/3.webp" width="570" height="675" alt="Image-HasTech">
                          </a>
                        </div>
                        <div class="swiper-slide">
                          <a class="lightbox-image" data-fancybox="gallery" href="/assets/img/shop/product-single/4.webp">
                            <img src="/assets/img/shop/product-single/4.webp" width="570" height="675" alt="Image-HasTech">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="product-single-swiper-wrap position-relative">
                      <div class="swiper single-product-nav single-product-nav-slider">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <img src="/assets/img/shop/product-single/nav1.webp" width="127" height="127" alt="Image-HasTech">
                          </div>
                          <div class="swiper-slide">
                            <img src="/assets/img/shop/product-single/nav2.webp" width="127" height="127" alt="Image-HasTech">
                          </div>
                          <div class="swiper-slide">
                            <img src="/assets/img/shop/product-single/nav3.webp" width="127" height="127" alt="Image-HasTech">
                          </div>
                          <div class="swiper-slide">
                            <img src="/assets/img/shop/product-single/nav4.webp" width="127" height="127" alt="Image-HasTech">
                          </div>
                        </div>
                      </div>
                      <!--== Add Swiper Arrows ==-->
                      <div class="single-swiper-btn-wrap">
                        <div class="swiper-btn-prev">
                          <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="swiper-btn-next">
                          <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End Product Thumbnail Area ==-->
                </div>
                <div class="col-lg-6">
                  <!--== Start Product Info Area ==-->
                  <div class="product-single-info">
                    <h3 class="main-title"></h3>
                    <div class="prices">
                      <span class="price"></span>
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
                        <a></a>
                      </div>
                    </div> <br>
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
                        <button id="addToCartButton" type="button" class="btn-product-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                            Add To Cart
                        </button>
                        <button type="button" class="btn-product-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                          <i class="pe-7s-like"></i>
                        </button>
                      <button type="button" class="btn-product-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                        <i class="pe-7s-look"></i>
                      </button>
                    </div>
                    <div class="product-review-tabs-content">
                      <ul class="nav product-tab-nav" id="ReviewTab" role="tablist">
                        <li role="presentation">
                          <a class="active" id="information-tab" data-bs-toggle="pill" href="#information" role="tab" aria-controls="information" aria-selected="true">Information</a>
                        </li>
                        <li role="presentation">
                          <a id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
                        </li>
                        <li role="presentation">
                          <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (05)</a>
                        </li>
                      </ul>
                      <div class="tab-content product-tab-content" id="ReviewTabContent">
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                          <div class="product-information">
                            <p>Lorem ipsum dolor sit amet, consectetur adipis elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nol exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptateLorem ipsum dolor sit amet col adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                          <div class="product-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipis elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nol exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptateLorem ipsum dolor sit amet col adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                          <div class="product-review-content">
                            <div class="comment-author">
                              <div class="comment-thumb">
                                <img src="/assets/img/shop/avatar.webp" width="60" height="60" alt="Image-HasTech">
                              </div>
                              <div class="comment-content">
                                <div class="rating-box">
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                </div>
                                <h4 class="title"><span>Admin</span> - April 8, 2022</h4>
                                <p class="desc">Donec venenatis euismod turpis sed dapibus. Maecenas augue augue, iaculis id dui eget, ultricies sagittis purus. Praesent sed blandit mauris. Pellentesque non auctor dolor.</p>
                              </div>
                            </div>
                            <div class="comment-form-content">
                              <h4 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#comment-widgetId-1">Add Reviwe</h4>
                              <div id="comment-widgetId-1" class="collapse collapse-body">
                                <div class="review-comment-form">
                                  <form action="#">
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="form-group">
                                          <label for="ReviewComment" class="form-label">Your review *</label>
                                          <textarea id="ReviewComment" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="form-group">
                                          <label for="Reviewname" class="form-label">Name *</label>
                                          <input id="Reviewname" class="form-control" type="text">
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="form-group">
                                          <label for="Reviewemail" class="form-label">Email *</label>
                                          <input id="Reviewemail" class="form-control" type="email">
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group mb--0">
                                          <button type="submit">Submit</button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End Product Info Area ==-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Product Single Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-default-area">
      <div class="container pt--0">
        <div class="row">
          <div class="col-12">
            <div class="section-title shape-center text-center">
              <h5 class="sub-title">Best PRODUCT</h5>
              <h2 class="title">Related Products</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="product-thumb">
                <a href="single-product.html">
                  <img src="/assets/img/shop/5.webp" width="270" height="320" alt="Image-HasTech">
                </a>
              </div>
              <div class="product-info">
                <h4 class="title"><a href="single-product.html">Fusion Backpack</a></h4>
                <div class="prices">
                  <span class="price">$45.00</span>
                </div>
              </div>
              <div class="product-action">
                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                  <i class="pe-7s-like"></i>
                </button>
                <div class="product-action-links">
                  <button type="button" class="btn-product-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                    <i class="pe-7s-shopbag"></i>
                  </button>
                  <button type="button" class="btn-product-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                    <i class="pe-7s-look"></i>
                  </button>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="product-thumb">
                <a href="single-product.html">
                  <img src="/assets/img/shop/6.webp" width="270" height="320" alt="Image-HasTech">
                </a>
              </div>
              <div class="product-info">
                <h4 class="title"><a href="single-product.html">Savvy Shoulder Tote</a></h4>
                <div class="prices">
                  <span class="price">$30.00</span>
                </div>
              </div>
              <div class="product-action">
                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                  <i class="pe-7s-like"></i>
                </button>
                <div class="product-action-links">
                  <button type="button" class="btn-product-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                    <i class="pe-7s-shopbag"></i>
                  </button>
                  <button type="button" class="btn-product-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                    <i class="pe-7s-look"></i>
                  </button>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="product-thumb">
                <a href="single-product.html">
                  <img src="/assets/img/shop/7.webp" width="270" height="320" alt="Image-HasTech">
                </a>
              </div>
              <div class="product-info">
                <h4 class="title"><a href="single-product.html">Voyage Yoga Bag</a></h4>
                <div class="prices">
                  <span class="price">$39.00</span>
                </div>
              </div>
              <div class="product-action">
                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                  <i class="pe-7s-like"></i>
                </button>
                <div class="product-action-links">
                  <button type="button" class="btn-product-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                    <i class="pe-7s-shopbag"></i>
                  </button>
                  <button type="button" class="btn-product-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                    <i class="pe-7s-look"></i>
                  </button>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="product-thumb">
                <a href="single-product.html">
                  <img src="/assets/img/shop/8.webp" width="270" height="320" alt="Image-HasTech">
                </a>
              </div>
              <div class="product-info">
                <h4 class="title"><a href="single-product.html">Wayfarer Messenger Bag</a></h4>
                <div class="prices">
                  <span class="price">$50.00</span>
                </div>
              </div>
              <div class="product-action">
                <button type="button" class="btn-product-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                  <i class="pe-7s-like"></i>
                </button>
                <div class="product-action-links">
                  <button type="button" class="btn-product-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                    <i class="pe-7s-shopbag"></i>
                  </button>
                  <button type="button" class="btn-product-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
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
  </main>

  @include('Pub.layouts.footer')

</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')

<script src="/assets/js/customFiles/single-product.js"></script>


</body>

</html>
