<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt5.Document</title>
    <link rel="stylesheet" href="style_Herbst.css">
</head> 

<body>
<header>
    <p>Welcome to the Mini-Kid Library!</p> 
</header>

<?php
//connect to my database:
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

<section style="background-image: linear-gradient(to right,lightgreen, beige);">
<h2>1. to search book information from Table-"books" and "publisher" in Database </h2>
<form action = "" method="POST"> 
  <label> Search by: </label>
  <input type="radio" id="Book_ID" name= "search" value = "Book_ID">&nbsp;Book ID 
  <input type="radio" id="Book_title" name= "search" value = "Book_title">&nbsp;Book Title 
  <input type="radio" id="Publisher_ID" name= "search" value = "Publisher_ID">&nbsp;Publisher ID 
  <input type="radio" id="Publisher_name" name= "search" value = "Publisher_name">&nbsp;Publisher Name 
  <input type="radio" id="Publishing_Year" name= "search" value = "Publishing_Year">&nbsp;Publishing Year <br>
  <input type="text" id="query" name= "query" placeholder = "Input your query" require> 
  <input type="submit" name="btSearch" value="Submit">
</form>

<?php
//check if the form is submitted
if(isset($_POST["query"]) AND isset($_POST["btSearch"])) {
    if($_POST["search"]=="Book_ID") {
       $Value1 = filter_var(trim($_POST['query']), FILTER_SANITIZE_NUMBER_INT);
    } elseif($_POST["search"]=="Book_title") {
       $Value2 = filter_var(trim($_POST['query']), FILTER_SANITIZE_STRING);
    } elseif($_POST["search"]=="Publisher_ID") {
       $Value3 = filter_var(trim($_POST['query']), FILTER_SANITIZE_NUMBER_INT);
    } elseif($_POST["search"]=="Publisher_name") {
       $Value4 = filter_var(trim($_POST['query']), FILTER_SANITIZE_STRING);
    } elseif($_POST["search"]=="Publishing_Year") {
       $Value5 = filter_var(trim($_POST['query']), FILTER_SANITIZE_NUMBER_INT);
    }
} else {
        echo "Enter your Query and submit it.";
    }
?>
<h3>The following is the searching result:</h3> 
<table class="search">
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
<br>
<button onclick="document.location='#section_Overview'" class="button"> to overview books </button>
</section>

<section style="background-image: linear-gradient(to right,lightblue, beige); ">
<h2>2. to insert new book into Table-books and -publisher in Database </h2>
<form action = "" method="POST"> 
  <label> New Record: </label> <br>
  <input type="text" id="Book_title" name= "Book_title" placeholder = "Book_title" required> <br>
  <textarea id="Book_description" name= "Book_description" rows="4" cols="50" placeholder="Description: less than 250 words" required></textarea><br>
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
 
  //prepare the SQL statement to insert the info
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
<br>
<button onclick="document.location='#section_Overview'" class="button"> to overview books </button>
</section>

<section style="background-image: linear-gradient(to right,lightpink, beige); ">
<h2>3. to update book information in Table-books and -publisher in Database </h2>
<form action = "" method="POST"> 
  <label> The book to be updated is with Book_ID: </label> 
  <input type="text" id="book_id" name= "book_id" placeholder = "Input Book_ID" require><br>
  <label> The information of its: </label>
  <input type="radio" id="Book_title" name= "change" value = "Book_title">&nbsp;Book Title 
  <input type="radio" id="Book_description" name= "change" value = "Book_description">&nbsp;Description 
  <input type="radio" id="Publishing_year" name= "change" value = "Publishing_year">&nbsp;Publishing Year 
  <input type="radio" id="Publisher_name" name= "change" value = "Publisher_name">&nbsp;Publisher Name <br>
  <label> should be updated into: </label>
  <input type="text" id="update" name= "update" placeholder = "Input update_Info" require> 
  <input type="submit" name="btUpdate" value="Update">
</form>

<?php 
//check if the form is submitted
if(isset($_POST["btUpdate"]) AND isset($_POST["book_id"]) AND isset($_POST["update"])){
    $Value1 = filter_var(trim($_POST['book_id']), FILTER_SANITIZE_NUMBER_INT);
    if($_POST["change"]=="Book_title"){
        $Value2 = filter_var(trim($_POST['update']), FILTER_SANITIZE_STRING);
        //prepare the SQL statement for update
       $stmt = $conn->prepare("UPDATE books SET title=? WHERE ID=? ;");
       //bind parameters
       $stmt->bind_param("si", $Value2, $Value1); //"s" for string, i for integer
      //Execute the statement
          if ($stmt->execute()) {  
           echo "New Book title is successfully updated into Table-books!<br>";
          }
    } elseif($_POST["change"]=="Book_description"){
        $Value3 = filter_var(trim($_POST['update']), FILTER_SANITIZE_STRING);
        //prepare the SQL statement for update
       $stmt = $conn->prepare("UPDATE books SET description=? WHERE ID=? ;");
       //bind parameters
       $stmt->bind_param("si", $Value3, $Value1); //"s" for string, i for integer
      //Execute the statement
          if ($stmt->execute()) {  
           echo "New Book description is successfully updated into Table-books!<br>";
          } 
    } elseif($_POST["change"]=="Publishing_year"){
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
    } elseif($_POST["change"]=="Publisher_name"){
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
<br>
<button onclick="document.location='#section_Overview'" class="button"> to overview books </button>
</section>

<section style="background-image: linear-gradient(to right,lightgrey, beige); ">
<h2>4. to delete one book record from Table-books in Database </h2>
<form action = "" method="POST"> 
  <label> The book to be deleted is with Book_ID: </label> 
  <input type="text" id="book_id" name= "book_id" placeholder = "Input Book_ID" require>
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
</section>

<div id="section_Overview">
<h1>Overview of current Table-"books" and -"publisher" </h1>
<form method="GET">
<button name="Refresh" class="button"> Refresh </button>
<button name="Deduplication" class="button"> Deduplication </button>
</form>

<table class="book">
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
</div>

<!--insert a to Top Button-->
<button onclick="topFunction()" id="toTop" title="Go to top">Go to Top</button>
<!--add JavaScript-->
<script>
  // Get the button
  let toTopButton = document.getElementById("toTop");
        
  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>


<footer>
<?php include "footer.php";?> 
</footer>

</body>
</html>