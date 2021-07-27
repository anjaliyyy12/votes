<?php

    $response = array('error'=>false);
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
		$conn=mysqli_connect("34.126.191.48:3306","root","pass4root") or die(mysqli_error($conn));
		mysqli_select_db($conn,"votes") or die("Cannot connect to database");
		$voter_id = mysqli_real_escape_string($conn,$_POST['voter_id']);
		$election_id    = mysqli_real_escape_string($conn,$_POST['election_id']);
		$candidate_id = mysqli_real_escape_string($conn,$_POST['candidate_id']);
        $SQL =  "INSERT INTO votes (voter_id, election_id, candidate_id) VALUES('$voter_id', '$election_id', '$candidate_id');";
        $query=mysqli_query($conn,$SQL);
        if($query)
        {
            $vote_id = mysqli_insert_id($conn);
            $db_hash = mysqli_query($conn, "SELECT time_of_vote FROM votes WHERE id=$vote_id");
            if($db_hash)
            {
                while($obj = mysqli_fetch_object($db_hash))
                {
                    $time_of_vote = $obj->time_of_vote;
                }
                $hash = sha1("$voter_id-$election_id-$candidate_id:$time_of_vote");
                if(!mysqli_query($conn, "UPDATE votes SET vote_hash= '$hash' WHERE id='$vote_id';"))
                {
                    $response['error'] = true;
                }
            }
            else{
                $response['error'] = true;
            }
        }	
    }
    else
    {
        $response['error'] = true;
    }
    header('Content-type: application/json');
    echo json_encode($response);