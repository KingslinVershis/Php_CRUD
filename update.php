<?php

include "connect.php";

if (isset($_POST['update'])) {
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Gender = $_POST['Gender'];
    $Id = $_POST['Id'];
    $Address = $_POST['Address'];
    $State = $_POST['State'];
    $Checkbox = isset($_POST['Checkbox']) ? $_POST['Checkbox'] : "Disagree";


    $oldImage = isset($_POST['old_image']) ? $_POST['old_image'] : null;
    $uploadDir = 'files/';  
    
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === 0) {
        $File_name = $_FILES["Image"]["name"];
        $File_size = $_FILES["Image"]["size"];
        $tmp_name = $_FILES["Image"]["tmp_name"];

        $valid_image_extensions = ['jpg', 'jpeg', 'png'];
        $image_extension = strtolower(pathinfo($File_name, PATHINFO_EXTENSION));

        if (!in_array($image_extension, $valid_image_extensions)) {
            echo "Invalid image extension.";
        } elseif ($File_size > 5000000) {  
            echo "File size exceeds 1MB.";
        } else {
            $newFileName = uniqid() . '.' . $image_extension;
            $targetFilePath = $uploadDir . $newFileName;

            
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $Image = $newFileName;  
            } else {
                echo "Error moving the uploaded file.";
            }
        }
    } else {
        $Image = $oldImage;
    }

    $sql = "UPDATE `user_details` SET 
                `First_name` = '$First_name', 
                `Last_name` = '$Last_name', 
                `Email` = '$Email', 
                `Password` = '$Password', 
                `Gender` = '$Gender', 
                `Address` = '$Address', 
                `State` = '$State', 
                `Agreement` = '$Checkbox', 
                `Image` = '$Image' 
            WHERE `Id` = '$Id'";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        //
        echo "<script>alert('Record Updated Successfully...!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];

    $sql = "SELECT * FROM `user_details` WHERE `Id` = '$Id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $First_name = $row['First_name'];
        $Last_name = $row['Last_name'];
        $Email = $row['Email'];
        $Password = $row['Password'];
        $Gender = $row['Gender'];
        $Id = $row['Id'];
        $State = $row['State'];
        $Address = $row['Address'];
        $Checkbox = $row['Agreement'];
        $Image = $row['Image'];
    } else {
        header('Location: table.php');
        exit();
    }
}
?>

<html>
    <style>  
        h2 {
            text-align: center;
            color: #C80036;
            letter-spacing: 1px;
            text-decoration: underline;
        }  
        input {
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
            margin-left: 10px;
            font-size: 20px;   
        } 
        label {
            margin-top: 10px;
            margin-left: 10px;
            display: inline-block;
            text-align: right;
            font-size: 21px;
        }
        form {
            width: 350px;
            margin: 0 auto; 
            padding: 30px;
            background-color: #F7EED3;
        }
        #state {
            font-size: 20px;
        }
        .input {
            padding: 10px;
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #image {
            position: relative;
            right: 10px;
        }
        .check {
            width: 20px;
            height: 15px;
        }
        .val {
            font-size: 18px;
            position: relative;
            top: -2px;
            left: 5px;
        }
        input[type="radio"] {
            margin-right: 7px;
            position: relative;
            left: 17px;
        }
        input[type="textarea"] {
            padding: 10px;
            height: 60px;
            width: 250px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 25px;
            margin-left: -5px;
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
            margin-top: 25px;
            margin-left: -5px;
            background-color: #E4003A;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #C80036;
        }
    </style>
    <body>
        <h2>USER UPDATE</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="First_name" value="<?php echo htmlspecialchars($First_name); ?>"><br>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="Last_name" value="<?php echo htmlspecialchars($Last_name); ?>"><br>
    
            <label for="mail">Email:</label>
            <input type="email" id="mail" name="Email" value="<?php echo htmlspecialchars($Email); ?>"><br>
                 
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="Password" value="<?php echo htmlspecialchars($Password); ?>"><br>
                 
            <label for="gender">Gender:</label>
            <input type="radio" id="male" name="Gender" value="male" <?php if ($Gender == 'male') echo "checked"; ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="Gender" value="female" <?php if ($Gender == 'female') echo "checked"; ?>>
            <label for="female">Female</label><br>
            
            <label for="state">State:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select id="state" name="State" class="input">
                <option value="">---SELECT---</option>
                <option value="Tamilnadu" <?php if ($State == 'Tamilnadu') echo 'selected'; ?>>Tamilnadu</option>
                <option value="Kerala" <?php if ($State == 'Kerala') echo 'selected'; ?>>Kerala</option>
                <option value="Mumbai" <?php if ($State == 'Mumbai') echo 'selected'; ?>>Mumbai</option>
            </select><br>

            <label for="addr">Address:</label>
            <textarea id="addr" class="input" name="Address"><?php echo htmlspecialchars($Address); ?></textarea><br>

            <label for="image">Image:</label>
            <input type="file" id="image" name="Image"><br>

            <input type="checkbox" class="check" name="Checkbox" value="Agree" <?php if ($Checkbox == 'Agree') echo "checked"; ?>>
            <span class="val">I Accept terms & conditions</span>

            <input type="hidden" name="Id" value="<?php echo htmlspecialchars($Id);?>">
            <input type="submit" name="update" value="UPDATE">
            <button><a href="table.php">VIEW TABLE</a></button>
        </form>
    </body>
</html>
