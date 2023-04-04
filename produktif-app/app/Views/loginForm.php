<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<link rel="stylesheet" href="<?=base_url('css\form.css'); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body>
	<script type="text/javascript">
		<?php if (session()->getFlashdata('msg')) { ?>
			toastr.msg("<?php echo session()->getFlashdata('msg'); ?>");
		<?php } ?>
	</script>
	<header>
		<h1>Login Bos</h1>
	</header>
	<main>
		<p><?= session()->getFlashdata('msg'); ?></p>
		<form method="POST" action="/">
			<fieldset>
				<label>Email</label>
				<input type="email" id="email" name="email" required value="<?php if (isset($_COOKIE['email'])) {
																				echo $_COOKIE['email'];
																			} ?>">
			</fieldset>
			<fieldset>
				<label>Password</label>
				<input type="password" id="password" name="password" required value="<?php if (isset($_COOKIE['password'])) {
																							echo $_COOKIE['password'];
																						} ?>">
			</fieldset>
			<?php if (isset($validation)) : ?>
				<?= $validation->ListErrors(); ?>
			<?php endif; ?>
			<input type="submit" value="Sign In">
			<input type="checkbox" name="rememberMe" id="rememberMe" <?php if (isset($_COOKIE['rememberMe'])) {
																			if ($_COOKIE['rememberMe'] == 'checked') {
																				echo 'checked';
																			};
																		} ?>>
			<label for="rememberMe" id="labelRememberMe">Remember me</label>
		</form>
		<p>Don't have an account? <a href="/register" style="text-decoration: none;">Register here!</a></p>
		<p><a href="/forgotPass" style="text-decoration: none;">Forgot password</a></p>
	</main>
	<footer>
		<p style="text-align: center;">&copy; 2023 My Website. All rights reserved.</p>
	</footer>
</body>

</html>