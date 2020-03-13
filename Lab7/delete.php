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
        $pid=$_REQUEST['pid'];
        $_SESSION['pid']=$pid;
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
	<h3>Delete Product:</h3>
	<form method="post">          
        <input type="submit" name="button2"
                class="button" value="Back" /> <br>
                <h3>Slected Product:</h3>
                <h4>Product ID:</h4><?php echo $pid; ?> <br>
                <h4>Product Name:</h4><?php echo $name; ?> <br>
                <h4>Quantity:</h4><?php echo $quantity; ?> <br>
                <br>
                Are you sure this product?
        <input type="submit" name="button1"
                class="button" value="Delete" /> <br>
    </form> 

    <?php
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        function button2() { 
            header('location:welcome2.php');
            exit();
        } 
        function button1() { 
            $pid="";
            $pid=$_SESSION['pid'];
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

            $sql = "DELETE FROM MyProducts WHERE pid=$pid";

            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
            $conn->close();

            header('location:welcome2.php');
            exit();
        }
    ?> 
	
</body>
</html>