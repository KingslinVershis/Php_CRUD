<?php
include 'connect.php';  

if (isset($_POST['submit'])) {
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Gender = $_POST['Gender'];
    $Address = $_POST['Address'];
    $State = $_POST['State'];
    $Checkbox = isset($_POST['Checkbox']) ? $_POST['Checkbox'] : "Disagree";
    
    $Image = '';  

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $File_name = $_FILES["image"]["name"];
        $File_size = $_FILES["image"]["size"];
        $tmp_name = $_FILES["image"]["tmp_name"];

        $valid_image_extensions = ['jpg', 'jpeg', 'png'];
        $image_extension = strtolower(pathinfo($File_name, PATHINFO_EXTENSION));

        if (!in_array($image_extension, $valid_image_extensions)) {
            echo "Invalid image extension.";
        } 
        
        else if ($File_size > 1000000) {
            echo "File size exceeds 1MB.";
        } else {
    
            $newFileName = uniqid() . '.' . $image_extension;
            $targetDir = 'files/';
            $targetFilePath = $targetDir . $newFileName;

            
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $Image = $newFileName;  
            } else {
                echo "Error moving the uploaded file.";
            }
        }
    } else {
        echo "No image uploaded or an error occurred.";
    }

    
    $stmt = $conn->prepare("INSERT INTO `user_details` (`First_name`, `Last_name`, `Email`, `Password`, `Gender`, `Address`, `State`, `Agreement`, `Image`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $First_name, $Last_name, $Email, $Password, $Gender, $Address, $State, $Checkbox, $Image);

    if ($stmt->execute()) {
        echo "<script>alert('Record Inserted Successfully...!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER DETAILS</title>
</head>

<style>  
    h2{
        text-align:center;
        color:#C80036;
        letter-spacing:1px;
        text-decoration: underline;
    }  
    input{
    padding: 10px;
    margin-top: 10px;
    border-radius: 10px;
    margin-left:10px; 
    font-size:20px;   
} 

label{
    margin-top: 10px;
   margin-left: 10px;
  display:inline-block;
  text-align:right;
  font-size:21px;

}
form {
    width: 350px;
    margin: 0 auto; 
    padding:30px;
    background-color:#F7EED3;
}
#state{
    font-size:20px;
}
.input{
    padding: 10px;
    margin-top:20px;
    border: 1px solid #ccc;
    border-radius: 4px;

}
#image{
    position: relative;
    right:10px;
}

.check{
    width: 20px;
    height:15px;
}

.val{
    font-size:18px;
    position: relative;
    top:-2px;
    left:5px;
}

input[type="radio"] {
    margin-right: 7px;
    position: relative;
    left:17px;
}

input[type="textarea"]{
    padding:10px;
    height:60px;
    width:250px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top:25px;
    margin-left:-5px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
button {
    width: 100%;
    padding: 10px;
    margin-top:25px;
    margin-left:-5px;
    background-color: #E4003A;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
a{
    text-decoration:none;
    color:white;
    font-size:20px;
    cursor: pointer;
}

button:hover {
    background-color: #C80036;
}
</style>
<body>
    <h2>USER DETAILS</h2>

    <form action="main.php" method="post" enctype="multipart/form-data"> 
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="First_name" class="input" required><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="Last_name" class="input" required><br>
        
        <label for="mail">Email: </label>
        <input type="email" id="mail" name="Email" class="input" required><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="Password" class="input" required><br>

        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="Gender"  value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="Gender" value="female">
        <label for="female">Female</label><br>

        <label for="state">State:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <select id="state" name="State" class="input" required>
        <option value="">---SELECT---</option>
        <option value="Tamilnadu">Tamilnadu</option>
        <option value="Kerala">Kerala</option>
        <option value="Mumbai">Mumbai</option>
        </select><br>

        <label for="addr">Address:</label>
        <input type="textarea" id="addr" class="input" name="Address" required>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" value = "upload" accept=" .jpg, .png, .jpeg">

        <input type="checkbox" class="check" name="Checkbox" value="Agree"><span class="val">I Accept terms & conditions</span>

        <input type="submit" name="submit" value="SUBMIT">
        <button><a href="table.php">VIEW TABLE</a></button>
    </form>
</body>
</html>
