<?php 
session_start();
if (isset($_SESSION['admin'])) {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Quiz-db Admin Dashboard</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<main>
			<div class="container">
				<div class="header-content">
					<h1>Quiz-db Admin</h1>
					<div class="buttons">
						<a href="index.php" class="start">Home</a>
						<a href="admin.php" class="start">Logout</a>
					</div>
				</div>
				
				<div class="admin-dashboard">
					<h2>Admin Options</h2>
					<div class="admin-options">
						<div class="admin-card">
							<h3>Add Question</h3>
							<p>Create new quiz questions with multiple choices</p>
							<a href="add.php" class="admin-btn">Add Question</a>
						</div>
						<div class="admin-card">
							<h3>Manage Questions</h3>
							<p>View, edit, or delete existing questions</p>
							<a href="allquestions.php" class="admin-btn">View Questions</a>
						</div>
					</div>
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