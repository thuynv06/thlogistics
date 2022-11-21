<?php
require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->
<body class="ps-loading">
<?php include 'header.php'; ?>
<main class="ps-main">
    <div class="ps-blog-grid pt-80 pb-80">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 "></div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="ps-post--detail">
                        <div class="ps-post__header">
                            <h3 class="ps-post__title">Xin Chào, <?php echo $checkCookie['fullname'] ?></h3>
                        </div>
                        <div class="ps-post__content">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                <table id="tableShoeIndex" class="table-responsive">
                                    <tr style="min-width:100px">
                                        <th>Họ tên</th>
                                        <td><?php echo $checkCookie['fullname'] ?></td>
                                    </tr>
                                    <tr style="min-width:100px">
                                        <th>D.O.B</th>
                                        <td><?php echo $checkCookie['dob'] ?></td>

                                    </tr>
                                    <tr style="min-width:100px">
                                        <th>Địa Chỉ</th>
                                        <td><?php echo $checkCookie['address'] ?></td>
                                    </tr>
                                    <tr style="min-width:100px">
                                        <th>Email</th>
                                        <td><?php echo $checkCookie['email'] ?></td>
                                    </tr>
                                    <tr style="min-width:100px">
                                        <th>SĐT</th>
                                        <td><?php echo $checkCookie['phone'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 "></div>
                </div>
            </div>
        </div>

</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
</body>
</html>
