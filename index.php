<html>

<head>
    <title>ONLINE VOTING SYSTEM</title>
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

    p {
        font-family: sans-serif;
        font-weight: bold;
        font-size: 30px;
    }
	

    button {
        width: 200px;
        margin: 10px;
        padding: 10px;
        font-weight: bold;
        background-color: #428BCA;
        text-align: center;
        color: white;
		position: relative;
		top: 0px;
        font-family: verdana;
        text-decoration: none;
    }

    button:hover {
        background: #CF4647;
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
        <?php
			echo ("<p><MARQUEE BEHAVIOR=ALTERNATE ><B>ONLINE VOTING SYSTEM</B> </MARQUEE></p>"); ?>
		<img src="data:image/png;base64,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" alt="Trulli" width="30" height="30">
		
       <br> <button type="button" onclick="location.href='login.php'">USER LOGIN</button><br/>

        <button type="button" onclick="location.href='register.php'">REGISTER</button>
		
		

        <html>

        <head>
        </head>

        </html>
		
		
		