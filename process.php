<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
   
	$_SESSION['score'] = 0;
    
	$newtime = time();
	if ( $newtime > $_SESSION['time_up']) {
		echo "<script>alert('time up');
		window.location.href='results.php';</script>";
	} else {
		// Process all answers
		$query1 = "SELECT * FROM questions ORDER BY qno";
		$run = mysqli_query($conn , $query1) or die(mysqli_error($conn));
		$answers = array();
		while ($row = mysqli_fetch_array($run)) {
			$qno = $row['qno'];
			$correct_answer = $row['correct_answer'];
			$question_text = $row['question'];
			$user_answer = isset($_SESSION['answers'][$qno]) ? $_SESSION['answers'][$qno] : '';
			
			if ($correct_answer == $user_answer) {
				$_SESSION['score']++;
			}
			
			$answers[] = array(
				'qno' => $qno,
				'question' => $question_text,
				'user_answer' => $user_answer,
				'correct_answer' => $correct_answer,
				'is_correct' => ($correct_answer == $user_answer)
			);
		}
		$_SESSION['answers'] = $answers;
		
		header("location: results.php");
	}
}
else {
	header("location: home.php");
}
?>