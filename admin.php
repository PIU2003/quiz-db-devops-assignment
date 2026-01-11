
	else {
		echo  "<script> alert('wrong password');</script>";
	}
}


?>



<html>
	<head>
		<title>quiz-db</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1>quiz-db</h1>
				<a href="index.php" class="start">Home</a>

			</div>
		</header>

		<main>
		<div class="container">
				<h2>Enter Password</h2>
				<form method="POST" action="">
				<input type="password" name="password" required="" >
				<input type="submit" name="submit" value="send"> 

			</div>


		</main>

		<footer>
			<div class="container">
				Copyright @ quiz-db
			</div>
		</footer>

	</body>
</html>