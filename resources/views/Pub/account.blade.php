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
                            <h2 class="title">Account</h2>
                            <nav class="breadcrumb-area">
                                <ul class="breadcrumb">
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Wrapper ==-->
        <section class="my-account-area">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="myaccount-page-wrapper">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <nav>
                                        <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab"
                                                    data-bs-target="#dashboad" type="button" role="tab"
                                                    aria-controls="dashboad" aria-selected="true">Dashboard
                                            </button>
                                            <button class="nav-link" id="orders-tab" data-bs-toggle="tab"
                                                    data-bs-target="#orders" type="button" role="tab"
                                                    aria-controls="orders" aria-selected="false"> Orders
                                            </button>
                                            <button class="nav-link" id="download-tab" data-bs-toggle="tab"
                                                    data-bs-target="#download" type="button" role="tab"
                                                    aria-controls="download" aria-selected="false">Coupons
                                            </button>
                                            <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab"
                                                    data-bs-target="#payment-method" type="button" role="tab"
                                                    aria-controls="payment-method" aria-selected="false">Payment Method
                                            </button>

                                            <button class="nav-link" id="account-info-tab" data-bs-toggle="tab"
                                                    data-bs-target="#account-info" type="button" role="tab"
                                                    aria-controls="account-info" aria-selected="false">Account Details
                                            </button>
                                            <button class="nav-link" onclick="logout()" type="button">Logout</button>
                                        </div>
                                    </nav>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel"
                                             aria-labelledby="dashboad-tab">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <strong></strong> (If Not <strong></strong><a href="#"
                                                                                                            class="logout">
                                                            Logout</a>)</p>
                                                </div>
                                                <p>From your account dashboard. you can easily check & view your recent
                                                    orders, manage your shipping and billing addresses and edit your
                                                    password and account details.</p>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="orders" role="tabpanel"
                                             aria-labelledby="orders-tab">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Customer Email</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="download" role="tabpanel"
                                             aria-labelledby="download-tab">
                                            <div class="myaccount-content">
                                                <h3>Coupons</h3>
                                                <h5>P.S: You can hold only two coupons at the same time</h5>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Discount</th>
                                                            <th>Date</th>
                                                            <th>Expired</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="coupon-table-body">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="payment-method" role="tabpanel"
                                             aria-labelledby="payment-method-tab">
                                            <div class="myaccount-content">
                                                <h3>Payment Method</h3>
                                                <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="address-edit" role="tabpanel"
                                             aria-labelledby="address-edit-tab">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                <address>
                                                    <p class="name"><strong></strong></p>
                                                    <p class="address"></p>
                                                    <p class="mobile"></p>
                                                </address>
                                                <a href="#/" class="check-btn sqr-btn"><i class="fa fa-edit"></i> Edit Address</a>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="account-info" role="tabpanel"
                                             aria-labelledby="account-info-tab">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">

                                                    <form id="profileForm" action="{{route('api.updateProfile')}}">
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">Display
                                                                Name</label>
                                                            <input type="text" id="display-name" name="name"/>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Address</label>
                                                            <input type="email" id="email" name="email" readonly/>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="address" class="required">Address</label>
                                                            <input type="text" id="address" name="address"/>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="phone" class="required">Phone</label>
                                                            <input type="text" id="phone" name="phone"/>
                                                        </div>

                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Current
                                                                    Password</label>
                                                                <input type="password" id="current-pwd"
                                                                       name="old_password"/>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">New
                                                                            Password</label>
                                                                        <input type="password" id="new-pwd"
                                                                               name="password"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Confirm
                                                                            Password</label>
                                                                        <input type="password" id="confirm-pwd"
                                                                               name="password_confirmation"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button id="submitButton" type="submit"
                                                                    class="check-btn sqr-btn">Save
                                                                Changes
                                                            </button>
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
                </div>
            </div>
        </section>
        <!--== End My Account Wrapper ==-->

        <!--== Start Feature Area Wrapper ==-->
        <div class="feature-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f1.webp" width="46" height="34"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">Free Shipping</h5>
                                <p>Capped at $39 per order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f2.webp" width="43" height="34"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">Card Payments</h5>
                                <p>12 Months Installments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f3.webp" width="39" height="39"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">Easy Returns</h5>
                                <p>Shop With Confidence</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature-icon-box">
                            <div class="icon-box">
                                <img class="icon-img" src="/assets/img/icons/f4.webp" width="36" height="39"
                                     alt="Icon-HasTech">
                            </div>
                            <div class="content">
                                <h5 class="title">24/7 Support</h5>
                                <p>Contact 24 hours everyday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Feature Area Wrapper ==-->
    </main>

    @include('Pub.layouts.footer')
</div>

<!--=======================Javascript============================-->

@include('Pub.layouts.footerSettings')

<script src="/assets/js/customFiles/account.js"></script>

</body>

</html>
