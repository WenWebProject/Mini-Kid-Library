<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt3.Document</title>
    
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

<h3>to update book information in Table-books and -publisher in Database </h3>
<form action = "" method="POST"> 
  <label> The book to be updated is with Book_ID: </label> 
  <input type="text" id="book_id" name= "book_id" placeholder = "Input Book_ID" require><br>
  <label> The information of its: </label><br>
  <input type="radio" id="Book_title" name= "search" value = "Book_title">&nbsp;Book Title <br>
  <input type="radio" id="Book_description" name= "search" value = "Book_description">&nbsp;Description <br>
  <input type="radio" id="Publishing_year" name= "search" value = "Publishing_year">&nbsp;Publishing Year <br>
  <input type="radio" id="Publisher_name" name= "search" value = "Publisher_name">&nbsp;Publisher Name <br>
  <label> should be updated into: </label>
  <input type="text" id="update" name= "update" placeholder = "Input update_Info" require> 
  <input type="submit" name="btUpdate" value="Update">
</form>

<?php 
//check if the form is submitted
if(isset($_POST["btUpdate"]) AND isset($_POST["book_id"]) AND isset($_POST["update"])){
    $Value1 = filter_var(trim($_POST['book_id']), FILTER_SANITIZE_NUMBER_INT);
    if($_POST["search"]=="Book_title"){
        $Value2 = filter_var(trim($_POST['update']), FILTER_SANITIZE_STRING);
        //prepare the SQL statement for update
       $stmt = $conn->prepare("UPDATE books SET title=? WHERE ID=? ;");
       //bind parameters
       $stmt->bind_param("si", $Value2, $Value1); //"s" for string, i for integer
      //Execute the statement
          if ($stmt->execute()) {  
           echo "New Book title is successfully updated into Table-books!<br>";
          }
    } elseif($_POST["search"]=="Book_description"){
        $Value3 = filter_var(trim($_POST['update']), FILTER_SANITIZE_STRING);
        //prepare the SQL statement for update
       $stmt = $conn->prepare("UPDATE books SET description=? WHERE ID=? ;");
       //bind parameters
       $stmt->bind_param("si", $Value3, $Value1); //"s" for string, i for integer
      //Execute the statement
          if ($stmt->execute()) {  
           echo "New Book description is successfully updated into Table-books!<br>";
          } 
    } elseif($_POST["search"]=="Publishing_year"){
        $Value4 = filter_var(trim($_POST['update']), FILTER_SANITIZE_NUMBER_INT);
        //prepare the SQL statement for update
       $stmt = $conn->prepare("UPDATE books SET publishing_year=? WHERE ID=?");
       //bind parameters
       $stmt->bind_param("ii", $Value4, $Value1); //i for integer
      //Execute the statement
          if ($stmt->execute()) {  
           echo "New publishing year is successfully updated into Table-books!<br>";
          } else {
            echo "Error updating year: " . $stmt->error;
          }
    } elseif($_POST["search"]=="Publisher_name"){
        $Value5 = filter_var(trim($_POST['update']), FILTER_SANITIZE_STRING);
        //prepare the SQL statement for update
        $stmt = $conn->prepare("UPDATE publisher SET publisher_name=? WHERE ID=(SELECT publisher_id FROM books WHERE ID=?)");
       //bind parameters
       $stmt->bind_param("si", $Value5, $Value1); //"s" for string, i for integer
      //Execute the statement
          if ($stmt->execute()) {  
           echo "New publisher name is successfully updated into Table-publisher!<br>";
          } 
    }
} else {
    echo "All fields are required!";
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