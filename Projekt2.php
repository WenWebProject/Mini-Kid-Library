<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt2.Document</title>
    
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


<h3>to insert new book into Table-books and -publisher in Database </h3>
<form action = "" method="POST"> 
  <label> New Record: </label> <br>
  <input type="text" id="Book_title" name= "Book_title" placeholder = "Book_title" required> <br>
  <input type="text" id="Book_description" name= "Book_description" placeholder = "Description" required> <br>
  <input type="number" id="Publishing_year" name= "Publishing_year" placeholder = "Publishing_year" required> <br>
  <input type="text" id="Publisher_name" name= "Publisher_name" placeholder = "Publisher_name" required> <br>
  <input type="submit" name="btTable" value="Submit">
</form>


<?php 
//check if the form is submitted
if(isset($_POST["btTable"])
   AND isset($_POST["Book_title"])
   AND isset($_POST["Book_description"]) 
   AND isset($_POST["Publishing_year"])
   AND isset($_POST["Publisher_name"])) {

    //Sanitize and validate form data, Get the form values
    $Value2 = filter_var(trim($_POST['Book_title']), FILTER_SANITIZE_STRING);
    $Value3 = filter_var(trim($_POST['Book_description']), FILTER_SANITIZE_STRING);
    $Value4 = filter_var(trim($_POST['Publishing_year']), FILTER_SANITIZE_NUMBER_INT);
    $Value5 = filter_var(trim($_POST['Publisher_name']), FILTER_SANITIZE_STRING);

    //check if $Value5 already in Table-publisher:Wenn Ja, return P.ID; Wenn Nein, insert as to get new P.ID
      $query = "SELECT ID FROM publisher WHERE publisher_name = '".$Value5."'";
      $result = $conn->query($query);
      $row = $result->fetch_assoc();
      
    if (!$row) {
     //prepare the SQL statement for insert
      $stmt1 = $conn->prepare("INSERT INTO publisher(publisher_name) VALUES(?)");
     //bind parameters
      $stmt1->bind_param("s", $Value5); //"s" means string
     //Execute the statement
         if ($stmt1->execute()) {  
          $Value6 = $stmt1->insert_id;      
          echo "New record is successfully inserted into Table-publisher!<br>"; 
          
        }
    } else{
      $Value6 = $row['ID'];
    }
 
 
  //prepare the SQL statement
  $stmt2 = $conn->prepare("INSERT INTO books(title, description, publishing_year, publisher_id) VALUES(?,?,?,?)");
  //bind parameters
  $stmt2->bind_param("ssii", $Value2, $Value3, $Value4, $Value6); //"ssis" means string, string, integer

  //Execute the statement
  if ($stmt2->execute()) {        
    echo "New record is successfully inserted into Table-books!<br>"; 
    
  }

} else {
    echo "Please Input Information of the new Book in the Formular above" ;
} 

?>


<h3>Overview of Table-"books" and -"publisher" </h3>
<form method="GET">
<button name="Refresh"> Refresh </button>
<button name="Deduplication"> Deduplication </button>
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

// Remove the duplicate Input/item in Table-books and -publisher
if(isset($_GET["Deduplication"])){
    $query1 = "
    DELETE FROM books
    WHERE ID NOT IN(
     SELECT * FROM (
     SELECT MIN(ID)
     FROM books
     GROUP BY title, publishing_year
     ) AS temp
    );
    ";
    $query2 = "
    DELETE FROM publisher
    WHERE ID NOT IN(
     SELECT * FROM (
     SELECT MIN(ID)
     FROM publisher
     GROUP BY publisher_name
     ) AS temp
    );
    ";
    // run the query and check if it is successful
    if($conn->query($query1)===TRUE AND $conn->query($query2)===TRUE){
    echo "Duplicate rows deleted successfully!";
    } else {
        echo "Error deleting duplicates:" . $conn->error;}
}
?>
</table>

</body>
</html>