<table style="margin: auto;">
    <thead>
        <tr>
            <th>Election</th>
            <th>Description</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $conn = mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
            mysqli_select_db($conn, "votes") or die("Cannot connect to database");
            $query = mysqli_query($conn, "SELECT  id,name,description, start_time, end_time FROM election;");
            $exists = mysqli_num_rows($query);
            if ($exists) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['end_time'] . "</td>";
                    echo "<td><a href='add_elections.php?eid=".$row['id']."'>Select</a></td></tr>";
                }
            }
            ?>
    </tbody>
</table>