<table style="margin: auto;">
    <thead>
        <tr>
            <th>Select</th>
            <th>Name</th>
            <th>Age</th>
            <th>Party</th>
        </tr>
    </thead>
    <tbody>
        <form action="submit_candidates.php" method="POST">
            <?php
            $conn = mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
            mysqli_select_db($conn, "votes") or die("Cannot connect to database");
            $query = mysqli_query($conn, "SELECT  id,name,age,partyname,election_id FROM candidates;");
            $exists = mysqli_num_rows($query);
            if ($exists) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    if(!$row['election_id'])
                    {
                        echo "<td><input type='checkbox' name='".$row['id']."'/> </td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['partyname'] . "</td></tr>";
                }
            }
            ?>
            <tr>
                <td colspan="4" style="text-align: center;"><input type="submit" value="START ELECTION"
                        class="button" />
            </tr>
        </form>
    </tbody>
</table>