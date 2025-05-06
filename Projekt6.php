<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Image.Document</title>
    <link rel="stylesheet" href="style_Herbst.css">
    
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


<h3>to insert new image into Table-images in Database </h3>
<!-- This is a POST form to upload images -->
<form method="post" enctype="multipart/form-data">
        <input type="file" name="img" required /><br><br>
        <button type="submit" name="submit-img">Store Image</button>
</form>

<?php
// to uplaod one image into Table-images in Database
if (isset($_POST['submit-img']))
{
    $type = ['image/jpg', 'image/png', 'image/jpeg'];  //Image types allowed
    
    $img = $_FILES['img']; //Fetch files 

    if (in_array($img['type'], $type)) //Check if file type is allowed
    {       
        $file_tmp_name = $_FILES['img']['tmp_name']; //Temporary file location
        $file_name = $_FILES['img']['name']; //original file name
        $file_path = "images/".$file_name; //Destination path
        
        if (move_uploaded_file($file_tmp_name, $file_path)) //move image into folder "images"
        {
            $sql = "INSERT INTO images (File_name, File_path) VALUES (?,?)";
            $insert_img = $conn->prepare($sql);
            $insert_img->bind_param("ss", $file_name, $file_path);

            if ($insert_img->execute()) //Execute the query to store image info
            {
                echo "<script>alert('image upload successfully!')</script>";
            }
            else
            {
                echo "Image upload failed:" . $insert_img->error;
            }
        }
        else
        {
            echo "Failed to upload file.";
        }
    }
    else
    {
        echo "<br>Please upload an image(jpg, png, jpeg)";
    }           
}
?>

<h3>to Display images from the Database</h3>

<?php
// Assuming the above connection is already established

// Write the query to fetch the image you want (let's say with id = 1)
$sql = "SELECT file_name, file_path FROM images";
$result = $conn->query($sql);

// Check if an image was found
if($result->num_rows > 0) {
    // Output the data of the image
   while($row = $result->fetch_assoc()){
    $file_name = $row['file_name'];
    $file_path = $row['file_path']; // path to the image
    ?>
    
    <div class="gallery">
            <a href="<?php echo $file_path; ?>" target="_blank">
                <img src="<?php echo $file_path;?>"  alt="<?php echo $file_name; ?>" >
            </a>
            <div class="description"><?php echo htmlspecialchars($file_name); ?></div>
    </div>
  
<?php
   }
}

$conn->close(); // Close the database connection
?>



</body>
</html>