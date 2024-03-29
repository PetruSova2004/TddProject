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
              <h2 class="title">Blog</h2>
              <nav class="breadcrumb-area">
                <ul class="breadcrumb">
                  <li><a href="{{route('home')}}">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Blog</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="blog-details-area">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-xl-8">
            <div class="blog-details-content-wrap">
              <div class="blog-details-item">
                <div class="blog-details-thumb">
                  <img src="/assets/img/blog/details1.webp" width="700" height="400" alt="Image-HasTech">
                </div>
                <div class="blog-details-content">
                  <div class="meta">
                    <ul>
                      <li class="author-info"><span>By:</span> <a href="blog.blade.php">Admin</a></li>
                      <li class="post-date"><a href="blog.blade.php">Sep 24,2022</a></li>
                    </ul>
                  </div>
                  <h3 class="main-title">Lorem Ipsum is siamply dumyte the printing and typese.</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididu ut laboref et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisnisi aliq ex ea commodo consequat. Duis aute irure dolor in reprehend in voluptate velit esse cillum doloreo eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui deseruntl mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusanti doloremque laudantium, totam rem aperiam.</p>
                  <blockquote>
                    <div class="inner-content">
                      <p>Lorem ipsum dolor sit amet, conse ctetuadipi elit, sed do eiusmod tempor incidi labore et dolore magna aliqua.</p>
                      <img class="inner-shape" src="/assets/img/icons/quote2.webp" width="111" height="81" alt="Image-HasTech">
                    </div>
                  </blockquote>
                  <h3 class="main-title sub-title">It is a long established fact that.</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehendein voluptate velit esse cillum dolore eu fugiat nulla pariatur. Exceptsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,</p>
                  <p>totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dict sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asperna aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptate sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius </p>
                  <div class="blog-details-footer">
                    <div class="tage-list">
                      <span>Tags:</span>
                      <a href="blog.blade.php">Pet</a>
                      <a href="blog.blade.php">Animal</a>
                      <a href="blog.blade.php">Dog</a>
                    </div>
                    <div class="social-icons">
                      <span>Share:</span>
                      <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
                      <a href="https://dribbble.com/" target="_blank" rel="noopener"><i class="fa fa-dribbble"></i></a>
                      <a href="https://www.pinterest.com/" target="_blank" rel="noopener"><i class="fa fa-pinterest-p"></i></a>
                      <a href="https://twitter.com/" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <!--== Start Comment View Item ==-->
              <div class="comment-view-area">
                <h4 class="title-main">Comments (03)</h4>
                <div class="comment-view-content">
                  <div class="single-comment">
                    <div class="author-pic">
                      <a href="blog.blade.php"><img src="/assets/img/blog/author1.webp" width="120" height="120" alt="Image-HasTech"></a>
                    </div>
                    <div class="author-info">
                      <h4 class="title"><a href="blog.blade.php">Monroe Bond</a></h4>
                      <h6 class="comment-date"><a href="blog.blade.php">21 July 2021</a></h6>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teml incidid ut labore et dolor magna aliqua. Ut enim ad minim veniam, quis nostru exercita ullamc laboris nisi ut aliquip ex ea comm consequat.</p>
                      <a class="comment-reply" href="#/">Reply <i class="fa fa-arrow-right"></i></a>
                    </div>
                  </div>
                  <div class="single-comment reply-comment">
                    <div class="author-pic">
                      <a href="blog.blade.php"><img src="/assets/img/blog/author2.webp" width="120" height="120" alt="Image-HasTech"></a>
                    </div>
                    <div class="author-info">
                      <h4 class="title"><a href="blog.blade.php">Audrina Finn</a></h4>
                      <h6 class="comment-date"><a href="blog.blade.php">21 July 2021</a></h6>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teml incidid ut labore et dolor magna aliqua. Ut enimlk ad minim veniam, quis nostru exercita.</p>
                      <a class="comment-reply" href="#/">Reply <i class="fa fa-arrow-right"></i></a>
                    </div>
                  </div>
                  <div class="single-comment mb--0">
                    <div class="author-pic">
                      <a href="blog.blade.php"><img src="/assets/img/blog/author3.webp" width="120" height="120" alt="Image-HasTech"></a>
                    </div>
                    <div class="author-info">
                      <h4 class="title"><a href="blog.blade.php">Gregorio Meier</a></h4>
                      <h6 class="comment-date"><a href="blog.blade.php">21 July 2021</a></h6>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teml incidid ut labore et dolor magna aliqua. Ut enim ad minim veniam, quis nostru exercita ullamc laboris nisi ut aliquip ex ea comm consequat.</p>
                      <a class="comment-reply" href="#/">Reply <i class="fa fa-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!--== End Comment View Item ==-->

              <!--== Start Comment Item ==-->
              <div class="comment-form-area">
                <h4 class="title-main">Leave a Comments</h4>
                <div class="comment-form">
                  <form action="#">
                    <div class="row ">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input class="form-control" type="text" placeholder="Name *">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input class="form-control" type="email" placeholder="Email *">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <input class="form-control" type="text" placeholder="Subject (Optinal)">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group mb--0">
                          <textarea class="form-control" placeholder="Message"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group mb--0">
                          <button type="submit" class="btn-theme">Send Comments</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!--== End Comment Item ==-->
            </div>
          </div>
          <div class="col-xl-4">
            <div class="blog-sidebar">
              <div class="blog-sidebar-search">
                <div class="sidebar-search-form">
                  <form action="#">
                    <input type="search" placeholder="Search Here">
                    <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
                </div>
              </div>

              <div class="blog-widget blog-sidebar-category">
                <h4 class="sidebar-title">Popular Categoris</h4>
                <div class="sidebar-category">
                  <ul class="category-list">
                    <li><a href="blog.blade.php">Accesasories  <span>(6)</span></a></li>
                    <li><a href="blog.blade.php">Computer  <span>(4)</span></a></li>
                    <li><a href="blog.blade.php">Covid-19 <span>(2)</span></a></li>
                    <li><a href="blog.blade.php">Electronics <span>(12)</span></a></li>
                    <li><a href="blog.blade.php">Furniture <span>(9)</span></a></li>
                  </ul>
                </div>
              </div>

              <div class="blog-widget blog-sidebar-post">
                <h4 class="sidebar-title">Recent Posts</h4>
                <div class="sidebar-post">
                  <div class="single-post">
                    <div class="post-thumb">
                      <a href="blog-details.blade.php"><img src="/assets/img/blog/s1.webp" width="65" height="68" alt="Image-HasTech"></a>
                    </div>
                    <div class="post-content">
                      <span class="date"><a href="blog.blade.php">Sep 24,2022</a></span>
                      <h6 class="title"><a href="blog-details.blade.php">Lorem ipsum dolor sit amet conse adipis.</a></h6>
                    </div>
                  </div>
                  <div class="single-post">
                    <div class="post-thumb">
                      <a href="blog-details.blade.php"><img src="/assets/img/blog/s2.webp" width="65" height="68" alt="Image-HasTech"></a>
                    </div>
                    <div class="post-content">
                      <span class="date"><a href="blog.blade.php">Sep 24,2022</a></span>
                      <h6 class="title"><a href="blog-details.blade.php">Nicholas K Spring 2022 Runway.</a></h6>
                    </div>
                  </div>
                  <div class="single-post">
                    <div class="post-thumb">
                      <a href="blog-details.blade.php"><img src="/assets/img/blog/s3.webp" width="65" height="68" alt="Image-HasTech"></a>
                    </div>
                    <div class="post-content">
                      <span class="date"><a href="blog.blade.php">Sep 24,2022</a></span>
                      <h6 class="title"><a href="blog-details.blade.php">Celebrity Daughter Opens About Upto.</a></h6>
                    </div>
                  </div>
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
    <!--== End Blog Area Wrapper ==-->
  </main>

  @include('Pub.layouts.footer')
</div>

@include('Pub.layouts.footerSettings')

</body>

</html>
