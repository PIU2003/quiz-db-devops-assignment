<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	
	// Handle navigation and answer saving
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$action = $_POST['action'];
		$current_qno = $_SESSION['quiz'];
		$selected_choice = isset($_POST['choice']) ? $_POST['choice'] : '';
		
		// Save answer
		if (!isset($_SESSION['answers'])) {
			$_SESSION['answers'] = array();
		}
		$_SESSION['answers'][$current_qno] = $selected_choice;
		
		if ($action == 'next') {
			$next_qno = $current_qno + 1;
			header("location: question.php?n=$next_qno");
			exit();
		} elseif ($action == 'back') {
			$prev_qno = $current_qno - 1;
			header("location: question.php?n=$prev_qno");
			exit();
		} elseif ($action == 'submit') {
			header("location: process.php");
			exit();
		}
	}
	
	if (isset($_GET['n']) && is_numeric($_GET['n'])) {
	        $qno = $_GET['n'];
	        $_SESSION['quiz'] = $qno;
	        if ($qno == 1) {
	        	$_SESSION['answers'] = array(); // Reset answers
	        }
	        }
	        else {
	        	if (!isset($_SESSION['quiz'])) {
	        		$_SESSION['quiz'] = 1;
	        	}
	        	header('location: question.php?n='.$_SESSION['quiz']);
	        } 
			$query = "SELECT * FROM questions WHERE qno = '$qno'" ;
			$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
			if (mysqli_num_rows($run) > 0) {
				$row = mysqli_fetch_array($run);
				$question = $row['question'];
				$ans1 = $row['ans1'];
				$ans2 = $row['ans2'];
				$ans3 = $row['ans3'];
				$ans4 = $row['ans4'];
				$correct_answer = $row['correct_answer'];
				$checkqsn = "SELECT * FROM questions" ;
				$runcheck = mysqli_query($conn , $checkqsn) or die(mysqli_error($conn));
				$countqsn = mysqli_num_rows($runcheck);
				$time = time();
				$_SESSION['start_time'] = $time;
				$allowed_time = $countqsn * 0.05;
				$_SESSION['time_up'] = $_SESSION['start_time'] + ($allowed_time * 60) ;
			}
			else {
				echo "<script> alert('something went wrong');
			window.location.href = 'home.php'; </script> " ;
			}

?>
<?php 
$total = "SELECT * FROM questions ";
$run = mysqli_query($conn , $total) or die(mysqli_error($conn));
$totalqn = mysqli_num_rows($run);

?>
<html>
	<head>
		<title>Quiz-db</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script>
			function setAction(act) {
				document.getElementById('action').value = act;
				document.forms[0].submit();
			}
		</script>
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
				<div class= "current">Question <?php echo $qno; ?> of <?php echo $totalqn; ?></div>
				<p class="question"><?php echo $question; ?></p>
				<form method="post" action="">
					<ul class="choices">
					   <li><input name="choice" type="radio" value="a" <?php if (isset($_SESSION['answers'][$qno]) && $_SESSION['answers'][$qno] == 'a') echo 'checked'; ?>><?php echo $ans1; ?></li>
					   <li><input name="choice" type="radio" value="b" <?php if (isset($_SESSION['answers'][$qno]) && $_SESSION['answers'][$qno] == 'b') echo 'checked'; ?>><?php echo $ans2; ?></li>
					   <li><input name="choice" type="radio" value="c" <?php if (isset($_SESSION['answers'][$qno]) && $_SESSION['answers'][$qno] == 'c') echo 'checked'; ?>><?php echo $ans3; ?></li>
					   <li><input name="choice" type="radio" value="d" <?php if (isset($_SESSION['answers'][$qno]) && $_SESSION['answers'][$qno] == 'd') echo 'checked'; ?>><?php echo $ans4; ?></li>
					 
					</ul>
					<input type="hidden" name="action" id="action" value="">
					<div class="nav-buttons">
						<?php if ($qno > 1) { ?>
							<button type="button" onclick="setAction('back')" class="nav-button">Back</button>
						<?php } else { ?>
							<div></div> <!-- Placeholder for spacing -->
						<?php } ?>
						<?php if ($qno < $totalqn) { ?>
							<button type="button" onclick="setAction('next')" class="nav-button">Next</button>
						<?php } else { ?>
							<button type="button" onclick="setAction('submit')" class="nav-button">Submit Quiz</button>
						<?php } ?>
					</div>
					<br>
					<br>
					<a href="results.php" class="start">Stop Quiz</a>
				</form>
			</div>
		</main>
</body>
</html>

<?php } 
else {
	header("location: home.php");
}
?>
?>