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
    <div class="ps-container">

        <div class="ps-tracuu">
            <div class="titleTH">
                <h3 style="font-weight: 700;">Tra Cứu Mã Vận Đơn</h3>
                <img src="images/devider.png">
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                </div>
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 " style="padding-bottom: 30px;">
                    <form id="tracuu" class="ps-subscribe__form" method="POST"
                    >
                    <input required id="inputtracuu" class="form-control" type="text" name="ladingCode"
                           placeholder="Nhập mã vận đơn…">
                    <button style="background-color: #ff6c00;">Tra Cứu</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12 ">
                </div>
            </div>

        </div>
        <?php include "listkienhang.php"; ?>
    </div>
</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
<script>

</script>
</body>
</html>