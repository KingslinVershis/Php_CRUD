<?php

    include "connect.php";

    if(isset($_GET['Id'])){
        $Id = $_GET['Id'];

       
        $sql = "DELETE FROM `user_details` WHERE `Id` = '$Id'";

        $result = $conn->query($sql);

        if($result == TRUE){
            echo "<span style=color:red;font-size:30px;padding:20px>Record Deleted Successfully....!</span>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>
