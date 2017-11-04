<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function userList(){
    include './database.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT * FROM User ORDER BY lastName ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
    return($records);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page </title>
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete this user?");
            }
        </script>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>

            <h1> Admin Main </h1>
            <div id="box">
                
            <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
            
            <form action="addUser.php">
                
                <input type="submit" value="Add new user" />
                
            </form>
            <br>
            <form action="logout.php">
                
                <input type="submit" value="Logout!" />
                
            </form>
            
            
            <br />
            <table style="width:100%">
            <tr>
                <td><b>ID</b></td>
                <td><b>First Name</b></td>
                <td><b>Last Name</b></td>
                <td><b>Update</b></td>
                <td><b>Delete</b></td>
            </tr>
            <?php
            
             $users = userList();
             
             foreach($users as $user) {
                 
                 
                 echo "<tr><td>" . $user['id']  . "</td><td>" . $user['firstName'] . "</td><td>" . $user['lastName'];
                 
                 echo "</td><td>" . "[<a href='updateUser.php?userId=" . $user['id'] . "'> Update </a>]";
                 echo "</td><td>" ."[<a onclick='return confirmDelete()' href='deleteUser.php?userId=".$user['id']."'> Delete </a>] <br />" . "</td></tr>";
                 
             }
             
             
             
             ?>
             </div>
            
    </body>
</html>