<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css\form.css">
</head>

<body>
<header>
		<h1>Reset Password -_-</h1>
	</header>
	<main>
		<form method="POST" action="/resetPass">
			<?php csrf_field(); ?>
			<fieldset>
				<label>Email</label>
				<input type="email" id="email" name="email" required>
			</fieldset>
			<fieldset>
				<label>Nama Ibu</label>
				<input type="text" id="namaIbu" name="namaIbu" required>
			</fieldset>
			<fieldset>
				<label>Password</label>
				<input type="password" id="password" name="password" required>
			</fieldset>
			<fieldset>
				<label>Confirm Password</label>
				<input type="password" id="passwordConfirm" name="passwordConfirm" required>
			</fieldset>
			<?php if (isset($validation)) : ?>
                <?= $validation->ListErrors(); ?>
            <?php endif; ?>
			<input type="submit" value="Reset">
		</form>	
		<a href="dashboard"><button id="cancel">Cancel</button></a>
	</main>
	<footer>
		<p style="text-align: center;">&copy; 2023 My Website. All rights reserved.</p>
	</footer>
</body>

</html>