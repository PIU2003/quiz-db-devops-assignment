<?php
session_start();
if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    if ($password == '123') {
        $_SESSION['admin'] = true;
        header("location: adminhome.php");
    }
    else {
        echo  "<script> alert('wrong password');</script>";
    }
}
?>




<html>
	<head>
		<title>Quiz-db Admin</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<main>
		<div class="container">
				<div class="header-content">
					<h1>Quiz-db</h1>
					<div class="buttons">
						<a href="index.php" class="start">Home</a>
					</div>
				</div>
				<div class="admin-login">
					<h2>Admin Login</h2>
					<form method="POST" action="">
						<p>
							<label>Password</label>
							<input type="password" name="password" required="">
						</p>
						<p>
							<input type="submit" name="submit" value="Login" class="admin-btn">
						</p>
					</form>
				</div>


		</main>

		<footer>
			<div class="container">
				Copyright @ Quiz-db
			</div>
		</footer>

	</body>
</html>