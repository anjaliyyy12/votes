<html>

<head>
    <title>VOTING PAGE</title>
    <style>
    .container {
        width: 500px;
		height: 300px;
        padding: 4% 4% 4%;
        margin: auto;
        box-shadow: 10px 10px 5px #888888;
        background-color: #FFDDDD;
        text-align: center;
        position: relative;
        top: 50px;
        vertical-align: middle;
    }

    h3 {
        color: #1f00a8;
        font-family: helvetica;
    }

    a {
        color: #f00f53;
        text-decoration: none;
        align-content: right;
    }

    button {
        padding: 5px;
        font-weight: bold;
        background-color: #ff474a;
        text-align: center;
        color: white;
    }

    table,
    tr {
        border: 1px solid black;
        border-collapse: collapse;
    }

    tr {
        margin: 10px;
    }

    th,
    td {
        padding: 20px;
    }

    button:hover {
        background: #a30003;
    }

    body {
        background-image: url("https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX34338611.jpg");
      background-size: 700px 700px;
    }
    </style>
</head>
<?php
session_start();
if ($_SESSION['user']) {
    $user = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
} else {
    header("location:index.php");
}
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $eid = $_GET['eid'];
    $conn = mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
    mysqli_select_db($conn, "votes") or die("Cannot connect to database");
    $candidates = mysqli_query($conn, "SELECT id,name,age,partyname FROM candidates WHERE election_id = " . $eid . ";");
    if (!$candidates) {
        echo '<script>alert("There occurred an error");window.location.assign("home.php");</script>';
    }
    $election = mysqli_query($conn, "SELECT name FROM election where id=" . $eid . ";");
    if (!$election) {
        echo '<script>alert("There occurred an error");window.location.assign("home.php");</script>';
    }
} else {
    header("location:home.php");
}
?>

<body>
    <div class="container">
        <h2>
            <?php
            if (mysqli_num_rows($election)) {
                while ($row = mysqli_fetch_array($election)) {
                    echo "ELECTIONS: " . $row['name'];
                }
            }
            ?>
        </h2>
        <table style="margin: auto;">
            <?php
            if (mysqli_num_rows($candidates)) {
                while ($row = mysqli_fetch_array($candidates)) {
                    echo "<tr>";
                    echo "<td><h4 id='name_" . $row['id'] . "'>" . $row['name'] . "</h4></td>";
                    echo "<td><h4>" . $row['partyname'] . "</h4></td>";
                    echo "<td><button type='button' class='vote' onclick='submitVote(" . $row['id'] . ")'>VOTE</button></td></tr>";
                }
            }
            ?>
        </table>
    </div>
    <script>
    function submitVote(candidate_id) {
        let candidate_name = document.getElementById('name_' + candidate_id).innerHTML;
        let status = confirm("Do you want to submit your vote for " + candidate_name + "?");
        if (!status) {
            return;
        }
        let formData = new FormData();
        let election_id = <?php echo $eid; ?>;
        let voter_id = <?php echo $user_id; ?>;
        formData.append('election_id', election_id);
        formData.append('voter_id', voter_id);
        formData.append('candidate_id', candidate_id);
        fetch('save_vote.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    alert("Vote submitted successfully");
                    window.location.assign('home.php');
                }
            }).catch(err => {
                alert("There occurred an error while saving your vote");
                window.location.assign('home.php');
            });
    }
    </script>
</body>

</html>