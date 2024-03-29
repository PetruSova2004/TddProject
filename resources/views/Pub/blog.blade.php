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
    <section class="blog-area blog-inner-area">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-xl-8">
            <div class="row" id="blogContainer">
              <div class="col-md-6 col-lg-4 col-xl-6" >
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
                    <h4 class="title"><a href="blog-details.blade.php">Lorem ipsum dolor sit amet conse adipis.</a></h4>
                    <a class="btn-theme btn-sm" href="blog-details.blade.php">Read More</a>
                  </div>
                </div>
                <!--== End Blog Item ==-->
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="blog-sidebar" id="blogSidebar">
              <div class="blog-sidebar-search">
                <div class="sidebar-search-form">
                  <form action="#">
                    <input type="search" placeholder="Search Here">
                    <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
                </div>
              </div>

              <div class="blog-widget blog-sidebar-category">
                <h4 class="sidebar-title">Popular Categories</h4>
                <div class="sidebar-category">
                  <ul class="category-list">

                  </ul>
                </div>
              </div>

              <div class="blog-widget blog-sidebar-post" id="recentBlogs">
                <h4 class="sidebar-title">Recent Posts</h4>
                <div class="sidebar-post">

                </div>
              </div>

              <div class="blog-widget blog-sidebar-tags">
                <h4 class="sidebar-title">Popular Tags</h4>
                <div class="sidebar-tags">
                  <ul class="tags-list mb--0">

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

<!--=======================Javascript============================-->
@include('Pub.layouts.footerSettings')
<script src="/assets/js/customFiles/blogs.js"></script>
<script src="/assets/js/customFiles/blog-sidebar.js"></script>
</body>

</html>
