<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
    <div class="auto-container">
        <h2>Checkout</h2>
        <ul class="page-breadcrumb">
            <li><a href="index.php?action=home">home</a></li>
            <li>Checkout</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Checkout Page-->
<div class="checkout-page">
    <div class="auto-container">

        <!--Default Links-->
        <?php if (empty($_SESSION['idCustomer'])) : ?>
            <ul class="default-links">
                <li>Nếu bạn chưa có tài khoản: <a href="index.php?action=register-account">Đăng ký</a></li>
            </ul>
        <?php endif; ?>
        <!--Billing Details-->
        <div class="billing-details">
            <div class="shop-form">
                <form method="post" action="index.php?action=checkout&act=orderPlace">
                    <div class="row clearfix">
                        <div class="col-lg-7 col-md-12 col-sm-12">

                            <div class="title-box">
                                <h2>Chi tiết thanh toán</h2>
                            </div>
                            <div class="billing-inner">
                                <?php if (isset($_SESSION['idCustomer'])) {
                                    $user = new user();
                                    $result = $user->getInfoByCustomerId($_SESSION['idCustomer']);
                                    $fname = $result['ho'];
                                    $lname = $result['ten'];
                                    $address = $result['diachi'];
                                    $zip = $result['zip'];
                                ?>
                                    <div class="row clearfix">
                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">Họ <sup>*</sup></div>
                                            <input type="text" name="fname" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") {
                                                                                        echo $_POST['fname'];
                                                                                    } else {
                                                                                        echo $fname;
                                                                                    } ?>" placeholder="Họ">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['fnameErrorCheckout']; ?></span>
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">Tên <sup>*</sup></div>
                                            <input type="text" name="lname" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") {
                                                                                        echo $_POST['lname'];
                                                                                    } else {
                                                                                        echo $lname;
                                                                                    } ?>" placeholder="Tên">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['lnameErrorCheckout']; ?></span>
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">Tên công ty </div>
                                            <input type="text" name="companyName" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace")
                                                                                                echo $_POST['companyName']
                                                                                            ?>" placeholder="Tên công ty">
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">Địa chỉ <sup>*</sup></div>
                                            <input type="text" name="address1" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") {
                                                                                            echo $_POST['address1'];
                                                                                        } else {
                                                                                            echo $address;
                                                                                        }

                                                                                        ?>" placeholder="Địa chỉ">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['address1ErrorCheckout']; ?></span>
                                            
                                            <input class="address-two" type="text" name="address2" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace")
                                                                                                                echo $_POST['address2']
                                                                                                            ?>" placeholder="Căn hộ, Đơn vị phù hợp, vv (tùy chọn)">
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">Tỉnh / Thành phố <sup>*</sup></div>
                                            <input type="text" name="city" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace")
                                                                                        echo $_POST['city']
                                                                                    ?>" placeholder="Tỉnh / Thành phố ">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['cityErrorCheckout']; ?></span>
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">Khu vực / Quốc gia <sup>*</sup> </div>
                                            <select name="country">
                                                <option value="null">Chọn một tùy chọn</option>
                                                <option value="Việt Name">Việt Nam</option>
                                            </select>
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['countryErrorCheckout']; ?></span>
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">Mã bưu điện / Zip <sup>*</sup></div>
                                            <input type="text" name="code" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") {
                                                                                        echo $_POST['code'];
                                                                                    } else {
                                                                                        echo $zip;
                                                                                    }
                                                                                    ?>" placeholder="Mã bưu điện / Zip">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['codeErrorCheckout']; ?></span>
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">Địa chỉ email <sup>*</sup></div>
                                            <input type="text" name="email" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") {
                                                                                        echo $_POST['email'];
                                                                                    } else {
                                                                                        echo $_SESSION['email'];
                                                                                    }

                                                                                    ?>" placeholder="Địa chỉ email">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['emailErrorCheckout']; ?></span>
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">Số điện thoại <sup>*</sup></div>
                                            <input type="text" name="phone" value="<?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") {
                                                                                        echo $_POST['phone'];
                                                                                    } else {
                                                                                        echo $_SESSION['phone'];
                                                                                    }

                                                                                    ?>" placeholder="Số điện thoại">
                                            <span class="error text-danger"><?php if (isset($_GET['act']) && $_GET['act'] == "orderPlace") echo $_SESSION['phoneErrorCheckout']; ?></span>
                                        </div>

                                        <div class="form-group title-box col-md-12 col-xs-12">
                                            <h2>Gửi đến một địa chỉ khác</h2>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">Ghi chú đặt hàng</div>
                                            <textarea name="note" placeholder="Lưu ý về đơn đặt hàng của bạn. ví dụ. lưu ý đặc biệt cho giao hàng"></textarea>
                                        </div>

                                    </div>
                                <?php } else { ?>
                                    <div class="row clearfix">
                                        <h1>Bạn cần đăng nhập để tiến hành thanh toán</h1>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <div class="title-box">
                                <h2>Hóa đơn của bạn</h2>
                            </div>
                            <div class="shop-order-box">
                                <!-- <ul class="order-list">
                                    <li>Sản phẩm<span>Đơn giá</span></li>
                                    <?php for ($i = 0; $i < count($_SESSION['productCart']); $i++) { ?>
                                        <li><?php echo $_SESSION['productCart'][$i]['ten'] ?><span>$<?php echo $_SESSION['productCart'][$i]['dongia'] ?></span></li>
                                    <?php } ?>
                                    <li>Subtotal<span class="dark">$65.00</span></li>
                                    <li>Shipping And Handling<span>Free Shipping</span></li>
                                    <li class="total">TOTAL<span class="dark">$65.00</span></li>
                                </ul> -->

                                <div>
                                    <table class="table table-hover" style="font-size: 15px">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($_SESSION['productCart']); $i++) { ?>
                                                <tr>
                                                    <th><?php echo $_SESSION['productCart'][$i]['ten'] ?></th>
                                                    <th><?php echo $_SESSION['productCart'][$i]['soluong'] ?></th>
                                                    <th>$<?php echo $_SESSION['productCart'][$i]['dongia'] ?></th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Thành tiền</th>
                                                <th></th>
                                                <th>$<?php
                                                        $total = new productCart();
                                                        echo $total->tongTien()
                                                        ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!--Place Order-->
                                <div class="place-order">
                                    <!-- Payment Options-->
                                    <!-- <div class="payment-options">
                                        <ul>
                                            <li>
                                                <div class="radio-option">
                                                    <input type="radio" name="payment-group" id="payment-2">
                                                    <label for="payment-2"><strong>Direct Bank Transfer</strong>
                                                        <span class="small-text">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio-option">
                                                    <input type="radio" name="payment-group" id="payment-1" checked>
                                                    <label for="payment-1"><strong>Cheque Payment</strong>
                                                        <span class="small-text">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</span>
                                                    </label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="radio-option">
                                                    <input type="radio" name="payment-group" id="payment-3">
                                                    <label for="payment-3"><strong>Paypal</strong><img src="assets/images/resource/paypall.jpg" alt="" /> <a href="index.php?action=404" class="what-paypall">What is PayPal?</a></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <?php if (isset($_SESSION['idCustomer'])) { ?>
                                        <button class="theme-btn order-btn">Đặt hàng</button>
                                    <?php } ?>
                                </div>
                                <!--End Place Order-->

                            </div>


                        </div>
                    </div>
                </form>
            </div>
        </div><!--End Billing Details-->
    </div>
</div>