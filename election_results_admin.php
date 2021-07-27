<html>

<head>
    <title>ADMIN PANEL</title>
    <style>
    .container {
        width: 800px;
		height: 500px;
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

    table,
    tr,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
    }

    button {
        margin: 10px;
        padding: 5px;
        font-weight: bold;
        background-color: #ff474a;
        text-align: center;
        color: white;
    }


    button:hover {
        background: #a30003;
    }
 body {
       background-image: url("https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX34338611.jpg");
      background-size: 700px 700px;



    }
	
	img {
	border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 200px;
    height: 120px;
    position: relative;
    left: 0px;
	}
    </style>
</head>

<body>
    <div class="container">
	<img src="data:image/png;base64,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" alt="Trulli" width="30" height="30">
		
        <h2>ELECTION RESULTS</h2>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>Election</th>
                    <th>Description</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Results</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $election_id = NULL;
            $conn = mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
            mysqli_select_db($conn, "votes") or die("Cannot connect to database");
            $query = mysqli_query($conn, "SELECT  id,name,description, start_time, end_time FROM election ORDER BY start_time;");
            $exists = mysqli_num_rows($query);
            if ($exists) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['end_time'] . "</td>";
                    echo "<td><button type='button' class='vote' onclick='findWinner(".$row['id'].")'>Result</button></td>";
                }
            }
            ?>
            </tbody>
        </table>

        <h2 id="result"></h2>
    </div>
    <script>
    function findWinner(election_id) {
        fetch("election_results.php?eid=" + election_id)
            .then(response => response.json())
            .then(data => {
                if (data.completed) {
                    let h2 = document.getElementById('result');
                    h2.innerHTML = '';
                    h2.innerHTML = `Winner: ${data["winner"]} of ${data["party"]} party`;
                    h2.focus();
                }
            });
    }
    </script>
</body>

</html>