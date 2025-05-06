<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt1.Document</title>
    
</head> 

<body>
<h2>to search book information from Table-"books" and "publisher" in Database </h2>
<form action = "" method="GET"> 
  <label> Search by: </label> <br>
  <input type="radio" id="Book_ID" name= "search" value = "Book_ID">&nbsp;Book ID <br>
  <input type="radio" id="Book_title" name= "search" value = "Book_title">&nbsp;Book Title <br>
  <input type="radio" id="Publisher_ID" name= "search" value = "Publisher_ID">&nbsp;Publisher ID <br>
  <input type="radio" id="Publisher_name" name= "search" value = "Publisher_name">&nbsp;Publisher Name <br>
  <input type="radio" id="Publishing_Year" name= "search" value = "Publishing_Year">&nbsp;Publishing Year <br>
  <input type="text" id="query" name= "query" placeholder = "Input your query" require> <br>
  <input type="submit" name="btSearch" value="Submit">
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
if(isset($_GET["query"]) AND isset($_GET["btSearch"])) {
    if($_GET["search"]=="Book_ID") {
       $Value1 = $_GET["query"];
    } elseif($_GET["search"]=="Book_title") {
       $Value2 = $_GET["query"];
    } elseif($_GET["search"]=="Publisher_ID") {
       $Value3 = $_GET["query"];
    } elseif($_GET["search"]=="Publisher_name") {
       $Value4 = $_GET["query"];
    } elseif($_GET["search"]=="Publishing_Year") {
       $Value5 = $_GET["query"];
    }
} else {
        echo "Enter your Query and submit it.";
    }

?>

<h3>Show the Query from Table-Books and Table-Publisher:</h3> 
<table>
    <tr>
        <th>Book_ID: </th>
        <th>Book_Title:</th>
        <th>Book_Description:</th>
        <th>Publishing_Year: </th>
        <th>Publisher_ID: </th>
        <th>Publisher_name: </th>
    </tr>

<?php
if(isset($Value1)){
  // Query to select records from the joined 2 Tables -books and -publisher
  $query = "SELECT B.ID, B.title, B.description, B.publishing_year, B.publisher_id, P.publisher_name
          FROM books B, publisher P
          WHERE B.publisher_id = P.ID AND B.ID = $Value1";
  // Execute the query
  $result = $conn->query($query);
  if($result->num_rows >0) {
    //output data of each row
    while($row = $result->fetch_assoc()){
     echo "<tr>";
     echo "<td>". $row["ID"]."</td>"; 
     echo "<td>". $row["title"]."</td>"; 
     echo "<td>". $row["description"]."</td>";
     echo "<td>". $row["publishing_year"]."</td>";
     echo "<td>". $row["publisher_id"]."</td>";
     echo "<td>". $row["publisher_name"]."</td>";
     echo "</tr>";
    }
  } else {
    echo "0 results";
  }
} elseif(isset($Value2)){
  // Query to select records from the joined 2 Tables -books and -publisher
  $query = "SELECT B.ID, B.title, B.description, B.publishing_year, B.publisher_id, P.publisher_name
          FROM books B, publisher P
          WHERE B.publisher_id = P.ID AND B.title = '".$Value2."'";
  // Execute the query
  $result = $conn->query($query);
  if($result->num_rows >0) {
    //output data of each row
    while($row = $result->fetch_assoc()){
     echo "<tr>";
     echo "<td>". $row["ID"]."</td>"; 
     echo "<td>". $row["title"]."</td>"; 
     echo "<td>". $row["description"]."</td>";
     echo "<td>". $row["publishing_year"]."</td>";
     echo "<td>". $row["publisher_id"]."</td>";
     echo "<td>". $row["publisher_name"]."</td>";
     echo "</tr>";
    }
  } else {
    echo "0 results";
  }
} elseif(isset($Value3)){
    // Query to select records from the joined 2 Tables -books and -publisher
    $query = "SELECT B.ID, B.title, B.description, B.publishing_year, B.publisher_id, P.publisher_name
            FROM books B, publisher P
            WHERE B.publisher_id = P.ID AND B.publisher_id = $Value3";
    // Execute the query
    $result = $conn->query($query);
    if($result->num_rows >0) {
      //output data of each row
      while($row = $result->fetch_assoc()){
       echo "<tr>";
       echo "<td>". $row["ID"]."</td>"; 
       echo "<td>". $row["title"]."</td>"; 
       echo "<td>". $row["description"]."</td>";
       echo "<td>". $row["publishing_year"]."</td>";
       echo "<td>". $row["publisher_id"]."</td>";
       echo "<td>". $row["publisher_name"]."</td>";
       echo "</tr>";
      }
    } else {
      echo "0 results";
    }
} elseif(isset($Value4)){
  // Query to select records from the joined 2 Tables -books and -publisher
  $query = "SELECT B.ID, B.title, B.description, B.publishing_year, B.publisher_id, P.publisher_name
          FROM books B, publisher P
          WHERE B.publisher_id = P.ID AND P.publisher_name = '".$Value4."'";
  // Execute the query
  $result = $conn->query($query);
  if($result->num_rows >0) {
    //output data of each row
    while($row = $result->fetch_assoc()){
     echo "<tr>";
     echo "<td>". $row["ID"]."</td>"; 
     echo "<td>". $row["title"]."</td>"; 
     echo "<td>". $row["description"]."</td>";
     echo "<td>". $row["publishing_year"]."</td>";
     echo "<td>". $row["publisher_id"]."</td>";
     echo "<td>". $row["publisher_name"]."</td>";
     echo "</tr>";
    }
  } else {
    echo "0 results";
  }
} elseif(isset($Value5)){
    // Query to select records from the joined 2 Tables -books and -publisher
    $query = "SELECT B.ID, B.title, B.description, B.publishing_year, B.publisher_id, P.publisher_name
            FROM books B, publisher P
            WHERE B.publisher_id = P.ID AND B.publishing_year = $Value5";
    // Execute the query
    $result = $conn->query($query);
    if($result->num_rows >0) {
      //output data of each row
      while($row = $result->fetch_assoc()){
       echo "<tr>";
       echo "<td>". $row["ID"]."</td>"; 
       echo "<td>". $row["title"]."</td>"; 
       echo "<td>". $row["description"]."</td>";
       echo "<td>". $row["publishing_year"]."</td>";
       echo "<td>". $row["publisher_id"]."</td>";
       echo "<td>". $row["publisher_name"]."</td>";
       echo "</tr>";
      }
    } else {
      echo "0 results";
    }
} else {
    echo "Your query is not in database";
}   
?>
</table>

</body>
</html>