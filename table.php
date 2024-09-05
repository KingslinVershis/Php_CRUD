<?php 

include "connect.php";

$sql = "SELECT * FROM `user_details`";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table View</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body{
        margin-top:100px;
        width: auto;
        border: 3px solid gray;
        padding: 10px;
    }
    th, td {
      border-bottom: 1px solid #ddd;
    }
    td{
        font-size:20px;
        padding:10px;
    }
    th{
        font-size:22px;
        padding:10px;
        background-color:#FFBE98;
    }
    h2{
        text-align:center;
        text-decoration:underline;
        
    }
    a{
        text-decoration:none;
    }
    .btn-info{
        color:#A1D6B2;
    }
    .btn-danger{
        color:#FF6969;
    }
    .btn-info:hover{
        color:#0D7C66;
    }
    .btn-danger:hover{
        color:red;
    }
</style>
<body>
    
    <div class="container">

    <h2>USER DATA</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Gender</th>
                <th>State</th>
                <th>Address</th>
                <th>Agreement</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['Id']); ?></td>
                <td><?php echo htmlspecialchars($row['First_name']); ?></td>
                <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                <td><?php echo htmlspecialchars($row['Password']); ?></td>
                <td><?php echo htmlspecialchars($row['Gender']); ?></td>
                <td><?php echo htmlspecialchars($row['State']); ?></td>
                <td><?php echo htmlspecialchars($row['Address']); ?></td>
                <td><?php echo htmlspecialchars($row['Agreement']); ?></td>
                <td><img src="files/<?php echo htmlspecialchars($row['Image']); ?>" style="width:150px; height:100px;" alt=""></td>
                <td>
                    <a class="btn btn-info" href="update.php?Id=<?php echo $row['Id']; ?>">Edit</a>
                    &nbsp;<a class="btn btn-danger" href="delete.php?Id=<?php echo $row['Id']; ?>">Delete</a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    </div>

</body>

</html>
