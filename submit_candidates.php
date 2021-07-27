<?php 
	session_start();
	if($_SESSION['user']){
		$user=$_SESSION['user'];
	}
	else{
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
        if(count($_POST) < 2)
        {
            echo '<script>alert("Select atleast 2 candidates!!")</script>';
			echo '<script>window.location.assign("voter.php");</script>';
        }
        $candidates = array();
        foreach($_POST as $id=>$status)
        {
            array_push($candidates, $id);
        }
        $eid = $_SESSION['election_id'];
		$conn=mysqli_connect("34.126.191.48:3306", "root","pass4root") or die(mysqli_error($conn)); 
		mysqli_select_db($conn,"votes") or die("Cannot connect to database"); 
		$result = mysqli_query($conn,"UPDATE candidates SET election_id = ".$eid." WHERE id IN (".implode(',', $candidates).");");
		if(!$result)
		{
			echo '<script>alert("There occurred an error");window.location.assign("start_election.php");</script>';
		}
		else
		{
			echo '<script>alert("Election Saved!! Voters can now vote");window.location.assign("home_admin.php");</script>';
		}
	}
	else
	{
		header("location:home_admin.php");
	}
?>