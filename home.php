<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
$query = "SELECT * FROM questions";
$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
$total = mysqli_num_rows($run);
?>

<html>
	<head>
		<title>Quiz-db</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<main>
		<div class="container">
				<div class="site-title">
					<h1>Quiz-db</h1>
					<div class="buttons">
						<a href="index.php" class="start">Home</a>
						<a href="admin.php" class="start">Admin Panel</a>
					</div>
				</div>
				<div class="quiz-info">
					<h2>Quiz Instructions</h2>
					<ul>
				    <li><strong>Number of questions: </strong><?php echo $total; ?></li>
				    <li><strong>Type: </strong>Multiple Choice</li>
				    <li><strong>Estimated time for each question: </strong><?php echo $total * 0.05 * 60; ?> seconds</li>
				     <li><strong>Score: </strong>   &nbsp; +1 point for each correct answer</li>
				</ul>
				<a href="question.php?n=1" class="start">Start Quiz</a>
				<a href="exit.php" class="add">Exit</a>
				</div>
			</div>
		</main>

			</div>
		</main>

		<footer>
			<div class="container">
				Copyright @ DAP
			</div>
		</footer>

	</body>
</html>
<?php unset($_SESSION['score']); ?>
<?php }
else {
	header("location: index.php");
}
?>