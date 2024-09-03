<?php
    include "connect.php";
 
    if(isset($_POST['submit'])){
        $First_name = $_POST['First_name'];
        $Last_name = $_POST['Last_name'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $Gender = $_POST['Gender'];

        $sql = "INSERT INTO `user_details` (`First_name`, `Last_name`, `Email`, `Password`, `Gender`) VALUES ('$First_name', '$Last_name', '$Email', '$Password', '$Gender')";

        $result = $conn->query($sql);

        if($result === TRUE){
            echo "<span style=color:green;font-size:30px;padding:20px>New Record Created Successfully...!</span>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

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
    <h2>USER DETAILS</h2>

    <form action="" method="POST"> 
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="First_name" required><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="Last_name" required><br>
        
        <label for="mail">Email: </label>
        <input type="email" id="mail" name="Email" required><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="Password" required><br>

        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="Gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="Gender" value="female">
        <label for="female">Female</label><br>

        <input type="submit" name="submit" value="SUBMIT">
        <button><a href="table.php">VIEW TABLE</a></button>
    </form>
</body>
</html>
