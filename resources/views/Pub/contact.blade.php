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
              <h2 class="title">Contact Us</h2>
              <nav class="breadcrumb-area">
                <ul class="breadcrumb">
                  <li><a href="{{route('home')}}">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Contact Us</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Contact Area Wrapper ==-->
    <section class="contact-area contact-inner-area">
      <div class="container">
        <div class="row contact-page-wrapper">
          <div class="col-xl-5">
            <h4 class="contact-page-title">We Are Here! <br>Please Contact Us.</h4>
            <div class="contact-info-wrap">
              <div class="contact-info">
                <div class="row">
                  <div class="col-12 col-lg-6 col-xl-12">
                    <div class="info-item">
                      <div class="icon">
                        <img src="/assets/img/icons/c1.webp" alt="Image-HasTech">
                      </div>
                      <div class="info">
                        <h5 class="title">Address:</h5>
                        <p>Your address goes here.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-12">
                    <div class="info-item">
                      <div class="icon">
                        <img src="/assets/img/icons/c2.webp" alt="Image-HasTech">
                      </div>
                      <div class="info">
                        <h5 class="title">Phone:</h5>
                        <p>
                          <a href="tel://+00123456789">+00 123 456 789</a><br>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-12">
                    <div class="info-item">
                      <div class="icon">
                        <img src="/assets/img/icons/c3.webp" alt="Image-HasTech">
                      </div>
                      <div class="info">
                        <h5 class="title">Email:</h5>
                        <p>
                          <a href="mailto://demo@example.com">demo@example.com</a><br>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-7">
            <h4 class="contact-page-title page-title-style2">Send A Quest</h4>
            <div class="contact-form-wrap">
              <!--== Start Contact Form ==-->
              <div class="contact-form">
                <form id="contact-form" action="https://whizthemes.com/mail-php/raju/arden/mail.php" method="POST">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" type="text" name="con_name" placeholder="Name *">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" type="email" name="con_email" placeholder="Email *">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <input class="form-control" type="text" placeholder="Subject (Optinal)">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb--0">
                        <textarea class="form-control" name="con_message" placeholder="Message"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb--0">
                        <button class="btn-theme" type="submit">Send Message</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!--== End Contact Form ==-->

              <!--== Message Notification ==-->
              <div class="form-message"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Contact Area Wrapper ==-->
  </main>

  @include('Pub.layouts.footer')
</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')
</body>

</html>
