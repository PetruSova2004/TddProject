<!DOCTYPE html>
<html lang="zxx">

@include('Pub.layouts.headerSettings')

<body>

<!--wrapper start-->
<div class="wrapper">

  @include('Pub.layouts.header')
  <main class="main-content">
    <!--== Start Faq Area Wrapper ==-->
    <section class="page-not-found-area">
      <div class="container pt--0 pb--0">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-6">
            <div class="page-not-found-wrap">
              <div class="page-not-found-content">
                <h3 class="not-found-text">404</h3>
                <h3 class="title">Page Cannot Be Found!</h3>
                <p class="desc">Seems like nothing was found at this location. Try something else or you can go back to the homepage following the button below!</p>
                <a class="btn-theme-border" href="index.blade.php">Back to home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Faq Area Wrapper ==-->
  </main>

  @include('Pub.layouts.footer')
</div>

@include('Pub.layouts.footerSettings')

</body>

</html>
