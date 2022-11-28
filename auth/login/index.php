<?php
	require_once("../../backend/auth.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Đăng Nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container" style="font-family:FontAwesome">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section" style="font-family:FontAwesome">Đăng Nhập</h2>
					
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Welcome to TH Logistics</h2>
								<p>Bạn chưa có tài khoản?</p>
								<a href="../register/index.php" class="btn btn-white btn-outline-white">Đăng Ký</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4" style="font-family:FontAwesome">Đăng Nhập</h3>
			      		</div>
						  
<!--								<div class="w-100">-->
<!--									<p class="social-media d-flex justify-content-end">-->
<!--										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>-->
<!--										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>-->
<!--									</p>-->
<!--								</div>-->
								
			      	</div>
							<form method="POST" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Tài khoàn</label>
			      			<input minlength="5" maxlength="20" name="username" type="text" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Mật khẩu</label>
		              <input minlength="8" maxlength="50" name="password" type="password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button name="submit" type="submit" class="form-control btn btn-primary submit px-3">Đăng Nhập</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Ghi nhớ tôi
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="../../index.php">Về Trang Chủ</a>
									</div>
		            </div>	
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<?php
		if(isset($_POST['submit'])){
			$run = Auth::login($_POST['username'],$_POST['password']);
			if($run)
				header("Location: ../../index.php");
			else
				echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác');
				window.location.href='../login/index.php';</script>";
		}
	?>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

