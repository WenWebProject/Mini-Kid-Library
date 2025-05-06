<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buch_PHP.Document</title>
</head>   

<body>
<p>/* POST method, to insert new book into Table-"Buch" in Database */ </p>
<form action = "" method="POST"> 
  <label> New Record: </label> <br>
  <input type="text" id="Book_Name" name= "Book_Name" placeholder = "Book_Name" required> <br>
  <input type="text" id="Publisher" name= "Publisher" placeholder = "Publisher" required> <br>
  <input type="number" id="Publish_Year" name= "Publish_Year" placeholder = "Publish_Year" required> <br>
  <input type="submit" name="btTable" value="Submit">
</form>

<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "test";

//create connection
$conn = new mysqli($host, $username, $password, $database);

//Check connection
if($conn->connect_error) {
  die("Connection failed:" . $conn->connect_error);
} else {
    echo "Connected successfully!";
}
 
//check if the form is submitted
if(isset($_POST["btTable"])
   AND isset($_POST["Book_Name"])
   AND isset($_POST["Publisher"]) 
   AND isset($_POST["Publish_Year"])) {

    //Get the form values
    $Value2 = $_POST["Book_Name"];
    $Value3 = $_POST["Publisher"];
    $Value4 = $_POST["Publish_Year"];

    //prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Buch(Book_Name, Publisher, Publish_Year) VALUES(?,?,?)");
    //bind parameters
    $stmt->bind_param("ssi", $Value2, $Value3, $Value4); //"ssi" means string, string, integer

    //Execute the statement
    if ($stmt->execute()) {        
      echo "New record is successfully inserted into Table-Buch!";
    }
} else {
    echo "Error:" ;
} 
?>
</form>
<p>Refresh and show the Table-Buch:</p> 
<form method="GET">
<button name="Refresh"> Refresh </button>
<button name="Deduplication"> Deduplication </button>
</form>
<table>
    <tr>
        <th>Book_ID: </th>
        <th>Book_Name:</th>
        <th>Publisher: </th>
        <th>Publish_Year: </th>
    </tr>

<?php
if(isset($_GET["Refresh"])){
// Query to select all records from UserInfo-Table
$query = "SELECT * FROM Buch";
// Execute the query
$result = $conn->query($query);
// Check if any records are found
  if($result->num_rows >0) {
    //output data of each row
    while($row = $result->fetch_assoc()){
     echo "<tr>";
     echo "<td>". $row["Book_ID"]."</td>"; 
     echo "<td>". $row["Book_Name"]."</td>"; 
     echo "<td>". $row["Publisher"]."</td>";
     echo "<td>". $row["Publish_Year"]."</td>";
     echo "</tr>";
  }
  } else {
    echo "0 results";
  }
} else{    
}
// Remove the duplicate Input/item in UserInfo-Table
if(isset($_GET["Deduplication"])){
    $query = "
    DELETE FROM Buch
    WHERE Book_ID NOT IN(
     SELECT * FROM (
     SELECT MIN(Book_ID)
     FROM Buch
     GROUP BY Book_Name, Publisher, Publish_Year
     ) AS temp
    );
    ";
    // run the query and check if it is successful
    if($conn->query($query)===TRUE){
    echo "Duplicate rows deleted successfully!";
    } else {
        echo "Error deleting duplicates:" . $conn->error;}
}
?>
</table>

<h3>Write an SQL query to create a newbook-Table </h3>
<?php 
//Load the SQL file
$sql = file_get_contents("newbook-Table.sql");

if($sql === false) {
    die('Error reading SQL file.');
}

// Execute the SQL file
if($conn->multi_query($sql)) {
    echo "New table created successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>

</body>
</html>