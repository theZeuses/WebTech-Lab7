<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$pid="";
		if($_SERVER["REQUEST_METHOD"] != "POST"){
			$pid=$_REQUEST['pid'];
			$_SESSION['pid']=$pid;
		}		
		$pid=$_SESSION['pid'];
		$name=$quantity="";
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

        $sql = "SELECT * FROM MyProducts WHERE pid=$pid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $name=$row["name"];
                $quantity=$row["quantity"];
            }
            
        } else {
            echo "Error fetching record: " . $conn->error;
        }
        $conn->close();
    ?>
	
    <?php
    	if ($_SERVER["REQUEST_METHOD"] == "POST"){
    		$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "myDB";
			
			if(isset($_POST["name"])&&isset($_POST["quantity"])){
				$name=$_POST["name"];
				$quantity=$_POST["quantity"];
				$pid=$_SESSION['pid'];

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}

				$sql = "UPDATE MyProducts SET name='$name',quantity=$quantity WHERE pid=$pid";

				if ($conn->query($sql) === TRUE) {
				    echo "Record updated successfully";
				} else {
				    echo "Error updating record: " . $conn->error;
				}
				$conn->close();
			}			
    	}
    ?>
    <h2>Edit Product:</h2>
	<form method="post">          
        <input type="submit" name="button1"
                class="button" value="Back" /> 
    </form> 
    <br>
    <h3>Selected Product:</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    	<h4>ID:</h4><?php echo $pid; ?><br>
    	<h4>Name:</h4><br><input type="text" name="name" value="<?php echo $name; ?>"><br>
    	<h4>Quantity:</h4><br><input type="number" name="quantity" value="<?php echo $quantity; ?>"><br>
    	<input type="submit" name="submit" value="Update"><br>
    </form>
	<?php
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        function button1() { 
            header('location:welcome2.php');
        	exit();
        } 
    ?> 
	
</body>
</html>