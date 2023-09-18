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
              <h2 class="title">Wishlist</h2>
              <nav class="breadcrumb-area">
                <ul class="breadcrumb">
                  <li><a href="{{route('home')}}">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Wishlist</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Wishlist Area Wrapper ==-->
    <section class="shopping-wishlist-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="shopping-wishlist-form table-responsive">
              <form action="#" method="post">
                <table class="table text-center">
                  <thead>
                    <tr>
                      <th class="product-remove">&nbsp;</th>
                      <th class="product-thumbnail">&nbsp;</th>
                      <th class="product-name">Product name</th>
                      <th class="product-price">Unit price</th>
                      <th class="product-stock-status">Stock status</th>
                      <th class="product-add-to-cart">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Wishlist Area Wrapper ==-->
  </main>

  @include('Pub.layouts.footer')
</div>

@include('Pub.layouts.footerSettings')
<script src="/assets/js/customFiles/shop-wishlist.js"></script>

</body>

</html>
