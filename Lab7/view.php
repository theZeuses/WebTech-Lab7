<?php
session_start();
$pid=$_REQUEST['pid'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
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
	<h3>Product Details:</h3>
	<form method="post">          
        <input type="submit" name="button1"
                class="button" value="Back" /> <br>
                <h3>Slected Product:</h3>
                <h4>Product ID:</h4><?php echo $pid; ?> <br>
                <h4>Product Name:</h4><?php echo $name; ?> <br>
                <h4>Quantity:</h4><?php echo $quantity; ?> <br>
                <br>
    </form> 

    <?php
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        function button1() { 
        	if($_SESSION['user']==1){
        		header('location:welcome2.php');
            	exit();
        	}
        	else{
        		header('location:entryPage.php');
            	exit();
        	}
        }
               
    ?> 
</body>
</html>