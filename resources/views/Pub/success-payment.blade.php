<!DOCTYPE html>
<html lang="zxx">

@include('Pub.layouts.headerSettings')


<body>

<!--wrapper start-->
<div class="wrapper">

  <main class="main-content">
    <!--== Start Faq Area Wrapper ==-->
    <section class="page-not-found-area">
      <div class="container pt--0 pb--0">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-6">
            <div class="page-not-found-wrap">
              <div class="page-not-found-content">
                <h3 class="not-found-text"></h3>
                <h3 class="title">Your payment was successful</h3>
                <a class="btn-theme-border" href="{{route('home')}}">Back to home</a>
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

<script src="/assets/js/customFiles/payment-success.js"></script>

</body>

</html>
