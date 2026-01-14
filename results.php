<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	?>
	<?php if(!isset($_SESSION['score'])) {
		header("location: question.php?n=1");
	}
	?>
<html>
	<head>
		<title>Quiz-db</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<main>
			<div class= "container">
				<div class="header-content">
					<h1>Quiz-db</h1>
					<div class="buttons">
						<a href="index.php" class="start">Home</a>
						<a href="admin.php" class="start">Admin Panel</a>
					</div>
				</div>
			<h2>Congratulations!</h2> 
				<p>You have successfully completed the test</p>
				<p>Total points: <?php if (isset($_SESSION['score'])) {
echo $_SESSION['score']; 
}; ?> </p>
				<h3>Question Review:</h3>
				<div class="question-review">
					<?php
					if (isset($_SESSION['answers'])) {
						foreach ($_SESSION['answers'] as $answer) {
							$status = $answer['is_correct'] ? 'Correct' : 'Incorrect';
							$class = $answer['is_correct'] ? 'correct' : 'incorrect';
							echo "<div class='review-item $class'>";
							echo "<p><strong>Question " . $answer['qno'] . ":</strong> " . $answer['question'] . "</p>";
							echo "<p>Your answer: " . $answer['user_answer'] . "</p>";
							if (!$answer['is_correct']) {
								echo "<p>Correct answer: " . $answer['correct_answer'] . "</p>";
							}
							echo "<p>Status: $status</p>";
							echo "</div>";
						}
					}
					?>
				</div>
		<a href="question.php?n=1" class="start">Start Again</a>
		<a href="home.php" class="start">Go Home</a>
		<?php if (isset($_SESSION['score']) && isset($_SESSION['answers']) && $_SESSION['score'] == count($_SESSION['answers'])) { ?>
		<div id="congrats-balloon">🎉 Congratulations! All answers correct! 🎉</div>
		<?php } ?>
		</div>
		</main>
		</body>
		</html>

		<?php 
		$score = $_SESSION['score'];
		$email = $_SESSION['email'];
		$query = "UPDATE users SET score = '$score' WHERE email = '$email'";
		$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
 		?>


<?php unset($_SESSION['score']); ?>
<?php unset($_SESSION['time_up']); ?>
<?php unset($_SESSION['start_time']); ?>
<?php unset($_SESSION['answers']); ?>
<?php unset($_SESSION['quiz']); ?>
<?php }
else {
	header("location: home.php");
}
?>

