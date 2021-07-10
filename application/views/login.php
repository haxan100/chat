<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/login/fonts/icomoon/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/login/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/login/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/login/css/style.css">
	<title>Login SSO - ENB</title>
</head>

<body>



	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-6 order-md-2">
					<img src="<?= base_url() ?>/assets/login/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
				</div>
				<div class="col-md-6 contents">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mb-4">
								<h3>Sign In to <strong>Menu</strong></h3>
								<p class="mb-4">SSo - Admin</p>
							</div>
							<div class="form-group first">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username">

							</div>
							<div class="form-group last mb-4">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password">

							</div>

							<div class="d-flex mb-5 align-items-center">
								<label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
									<input type="checkbox" checked="checked" />
									<div class="control__indicator"></div>
								</label>
							</div>

							<input type="submit" value="Log In" id="btnLogin" class="btn text-white btn-block btn-primary">

							<p class="text">Belum punya Akun? , <a href="<?= base_url() ?>register" class="link-primary text-center">register</a></p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>


	<script src="<?= base_url() ?>/assets/login/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>/assets/login/js/popper.min.js"></script>
	<script src="<?= base_url() ?>/assets/login/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>/assets/login/js/main.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
<script>
	$(document).ready(function() {

		$('#btnLogin').click(function(e) {
			var username = $('#username').val();
			var password = $('#password').val();
			$.ajax({
				type: "post",
				url: "<?= base_url() ?>/Chat/process_login",
				data: {
					username,
					password
				},
				dataType: "json",
				success: function(e) {
					console.log(e)
					if (e.status) {
						Swal.fire(
							'Good job!',
							e.pesan,
							'success'
						)
						setTimeout(() => {
							location.href = '<?= base_url() ?>Chat/Menu';
						}, 1000);
					} else {
						Swal.fire(
							'Sorry!',
							e.pesan,
							'error'
						)
					}
				}
			});

		});

	});
</script>

</html>
