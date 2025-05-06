<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt4.Document</title>
    
</head> 

<body>

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
?>

<h3>to delete one book from Table-books in Database </h3>
<form action = "" method="POST"> 
  <label> The book to be deleted is with Book_ID: </label> 
  <input type="text" id="book_id" name= "book_id" placeholder = "Input Book_ID" require><br>
  <input type="submit" name="btDel" value="Delete">
</form>

<?php 
//check if the form is submitted
if(isset($_POST["btDel"]) AND isset($_POST["book_id"])){
    $Value1 = filter_var(trim($_POST['book_id']), FILTER_SANITIZE_NUMBER_INT);
    //prepare the SQL statement to delete a book with book_id from Table-books
    $stmt = $conn->prepare("DELETE FROM books WHERE ID=? ;");
    //bind parameters
    $stmt->bind_param("i", $Value1); // i for integer
    //Execute the statement
     if ($stmt->execute()) {  
      echo "The Book is successfully deleted from Table-books!<br>";
     }

} else {
      echo "Book_ID is required!";
  }
?>

<h3> Overview of current Table-books and -publisher </h3>
<form method="GET">
<button name="Refresh"> Refresh </button>
</form>

<table>
    <tr>
        <th>Book_ID: </th>
        <th>Book_Name:</th>
        <th>Description:</th>
        <th>Publishing_year: </th>
        <th>Publisher_name: </th>
    </tr>

<?php
if(isset($_GET["Refresh"])){
// Query to select all records from Table-Books and -publisher
$query = "SELECT B.ID, B.title, B.description, B.publishing_year, B.publisher_id, P.publisher_name
            FROM books B, publisher P
            WHERE B.publisher_id = P.ID;";
// Execute the query
$result = $conn->query($query);
// Check if any records are found
  if($result->num_rows >0) {
    //output data of each row
    while($row = $result->fetch_assoc()){
     echo "<tr>";
     echo "<td>". $row["ID"]."</td>"; 
     echo "<td>". $row["title"]."</td>"; 
     echo "<td>". $row["description"]."</td>";
     echo "<td>". $row["publishing_year"]."</td>";
     echo "<td>". $row["publisher_name"]."</td>";
     echo "</tr>";
  }
  } else {
    echo "0 results";
  }
} else{    
}
?>
</table>
</body>
</html>