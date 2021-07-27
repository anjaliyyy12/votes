<table style="margin: auto;">
    <thead>
        <tr>
            <th>Election</th>
            <th>Description</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Vote</th>
            <th>Results</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $election_id = NULL;
        $user_id = $_SESSION['user_id'];
        $conn = mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
        mysqli_select_db($conn, "votes") or die("Cannot connect to database");
        $election = mysqli_query($conn, "SELECT election_id FROM votes WHERE voter_id='$user_id';");
        if ($data = mysqli_fetch_assoc($election)) {
            $election_id = $data['election_id'];
        }
        $query = mysqli_query($conn, "SELECT  id,name,description, start_time, end_time FROM election ORDER BY start_time;");
        $exists = mysqli_num_rows($query);
        if ($exists) {
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                if ($row['id'] == $election_id) {
                    echo "<td>VOTED</td>";
                    echo "<td><button type='button' class='vote' onclick='findWinner(" . $row['id'] . ")'>Result</button></td>";
                } else if (strtotime($row['start_time']) >= time()) {
                    echo "<td colspan='2'>UPCOMING</td>";
                } else if (strtotime($row['end_time']) <= time()) {
                    echo "<td colspan='2'>EXPIRED</td>";
                } else {
                    echo "<td colspan='2'><a href='start_voting.php?eid=" . $row['id'] . "'>Vote</a></td></tr>";
                }
            }
        }
        ?>
    </tbody>
</table>
<h2 id="result"></h2>
<script>
function findWinner(election_id) {
    fetch("election_results.php?eid=" + election_id)
        .then(response => response.json())
        .then(data => {
            if (data.completed) {
                document.getElementById('result').innerHTML = `Winner: ${data["winner"]} of ${data["party"]} party`;
                document.getElementById('result').focus();
            } else {
                alert("Election is still live. Results will be available after the election ends");
            }
        });
}
</script>