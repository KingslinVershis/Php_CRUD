<?php

include "connect.php";

if (isset($_POST['update'])) {
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Gender = $_POST['Gender'];
    $Id = $_POST['Id'];

    
    $sql = "UPDATE `user_details` SET `First_name` = '$First_name', `Last_name` = '$Last_name', `Email` = '$Email', `Password` = '$Password', `Gender` = '$Gender' WHERE `Id` = '$Id'";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "<span style=color:#FFC700;font-size:30px;padding:20px>Record Updated Successfully...!</span>";
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
?>
<html>
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
  font-size:20px;

}
form {
    width: 350px;
    margin: 0 auto; 
    padding:30px;
    background-color:#F7EED3;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="radio"] {
    padding: 10px;
    margin-top:20px;
    border: 1px solid #ccc;
    border-radius: 4px;

}


input[type="radio"] {
    margin-right: 7px;
    position: relative;
    left:17px;
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
        <h2>USER UPDATE</h2>
        <form action="" method="post">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="First_name" value="<?php echo htmlspecialchars($First_name); ?>"><br>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="Last_name" value="<?php echo htmlspecialchars($Last_name); ?>"><br>
    
            <label for="mail">Email:</label>
            <input type="email" id="mail" name="Email" value="<?php echo htmlspecialchars($Email); ?>"><br>
                 
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="Password" value="<?php echo htmlspecialchars($Password); ?>"><br>
                 
            <label for="gender">Gender:</label>
            <input type="radio" id="male" name="Gender" value="male" <?php if ($Gender == 'male') { echo "checked"; } ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="Gender" value="female" <?php if ($Gender == 'female') { echo "checked"; } ?>>
            <label for="female">Female</label><br>
                 
            <input type="hidden" name="Id" value="<?php echo htmlspecialchars($Id); ?>">
            <input type="submit" name="update" value="UPDATE">
            <button><a href="table.php">VIEW TABLE</a></button>
        </form>
    </body>
</html>
<?php    
    } else {
        header('Location: table.php');
        exit();
    }
}
?>
