<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Manage Product(s):</h2>
	<form method="post">  
        <input type="submit" name="button1"
                    class="button" value="Log Out" /> <br>        
        <input type="submit" name="button2"
                class="button" value="View" /> 
    </form> 
	<?php
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        function button1() { 
            header('location:entryPage.php');
        	exit();
        } 
        function button2() { 
        	echo "<br>"."<br>";
        	echo "<h3>All Products:</h3>";

            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "myDB";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM MyProducts";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    echo "<table><tr><th>ProductID</th><th>ProductName</th><th>Quantity</th><th>Action</th></tr>";
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>".$row["pid"]."</td><td>".$row["name"]."</td><td>".$row["quantity"]."</td>"."<td>"."<a href='view.php?pid=".$row['pid']."'>View</a>"."/"."<a href='edit.php?pid=".$row['pid']."'>Edit</a>"."/"."<a href='delete.php?pid=".$row['pid']."'>Delete</a>"."</td></tr>";
			    }
			    echo "</table>";
			} else {
			    echo "0 results";
			}
			$conn->close();
        } 
    ?> 
	
</body>
</html>