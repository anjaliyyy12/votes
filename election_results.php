<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if(!isset($_GET['eid']))
        {
            echo json_encode(['error'=>'election id not given']);
            exit();
        }
        $eid = $_GET['eid'];
        $user_count = 0;
        $vote_count = 0;
        $conn = mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
        mysqli_select_db($conn, "votes") or die("Cannot connect to database");
        $users = mysqli_query($conn, "SELECT count(*) as total FROM users;");
        if($users)
        {
            $data = mysqli_fetch_assoc($users);
            $user_count = $data['total']-1;
        }
        $total_votes = mysqli_query($conn, "SELECT count(*) as total_votes FROM votes WHERE election_id=$eid;");
        if($total_votes)
        {
            $data = mysqli_fetch_assoc($total_votes);
            $vote_count = $data['total_votes'];
        }
        $election = mysqli_query($conn, "SELECT end_time FROM election WHERE id='$eid'");
        if($election)
        {
            $data = mysqli_fetch_assoc($election);
            $end_time = $data['end_time'];
        }
        if($vote_count == 0)
        {
            echo json_encode(['completed'=>false]);
            exit();
        }
        if($vote_count < $user_count && strtotime($data['end_time']) > time())
        {
            echo json_encode(['completed'=>false]);
            exit();
        }
        else
        {
            $SQL = "SELECT cd.name AS name, cd.partyname AS partyname FROM candidates cd WHERE cd.id = (SELECT candidate_id FROM votes WHERE election_id = '$eid' GROUP BY candidate_id ORDER BY count(voter_id) DESC LIMIT 1);";
            $winner = mysqli_query($conn, $SQL);
            if($winner)
            {
                $data = mysqli_fetch_assoc($winner);
                if($data == NULL)
                {
                    echo json_encode(['completed'=>false]);
                    exit();
                }
                $winner = $data['name'];
                $partyname = $data['partyname'];
                echo json_encode(['completed'=>true, 'winner'=>$winner, 'party'=>$partyname]);
                exit();
            }
        }
    }
    else
    {
        header("location:index.php");
    }
?>