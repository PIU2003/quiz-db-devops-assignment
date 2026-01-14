<?php 
session_start();
include "connection.php";
if (isset($_SESSION['admin'])) {

if (isset($_GET['delete'])) {
    $qid = $_GET['delete'];
    $query = "DELETE FROM questions WHERE qid = '$qid'";
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        // Renumber qno after deletion
        $query2 = "SET @num := 0; UPDATE questions SET qno = (@num := @num + 1) ORDER BY qid;";
        mysqli_multi_query($conn, $query2);
        echo "<script>alert('Question deleted successfully'); window.location.href='allquestions.php';</script>";
    } else {
        echo "<script>alert('Error deleting question');</script>";
    }
}

$query = "SELECT * FROM questions ORDER BY qno";
$run = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html>
	<head>
		<title>All Questions</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<main>
			<div class="container">
				<div class="header-content">
					<h1>All Questions</h1>
					<div class="buttons">
						<a href="adminhome.php" class="start">Dashboard</a>
						<a href="add.php" class="start">Add Question</a>
					</div>
				</div>
				<div class="admin-questions-list">
					<h2>All Questions</h2>
					<?php
					while ($row = mysqli_fetch_array($run)) {
						echo "<div class='question-item'>";
						echo "<div class='question-header'>";
						echo "<h3>Question " . $row['qno'] . "</h3>";
						echo "<a href='allquestions.php?delete=" . $row['qid'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this question?\")'>Delete</a>";
						echo "</div>";
						echo "<div class='question-content'>";
						echo "<p class='question-text'><strong>" . $row['question'] . "</strong></p>";
						echo "<div class='choices'>";
						echo "<p><span class='choice-label'>A:</span> " . $row['ans1'] . "</p>";
						echo "<p><span class='choice-label'>B:</span> " . $row['ans2'] . "</p>";
						echo "<p><span class='choice-label'>C:</span> " . $row['ans3'] . "</p>";
						echo "<p><span class='choice-label'>D:</span> " . $row['ans4'] . "</p>";
						echo "</div>";
						echo "<p class='correct-answer'>Correct Answer: <strong>" . strtoupper($row['correct_answer']) . "</strong></p>";
						echo "</div>";
						echo "</div>";
					}
					?>
				</div>
			</div>
		</main>
	</body>
</html>

<?php 
}
else {
	header("location: admin.php");
}
?>