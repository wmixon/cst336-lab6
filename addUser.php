<?php

include 'database.php';
$conn = getDatabaseConnection();

if (isset($_GET['addUser'])) {  //the add form has been submitted

    $sql = "INSERT INTO User
             (firstName, lastName, email, role, phone, deptId) 
             VALUES
             (:fName, :lName, :email, :role, :phone, :deptId)";
    $np = array();
    
    //echo "$sql";
    
    $np[':fName'] = $_GET['firstName'];
    $np[':lName'] = $_GET['lastName'];
    $np[':email'] = $_GET['email'];
    $np[':phone'] = $_GET['phone'];
    $np[':role'] = $_GET['role'];
    $np[':deptId'] = $_GET['deptId'];
    
    $stmt=$conn->prepare($sql);
    $stmt->execute($np);
    
    echo "<div id='box'> User was added! </div>";
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Add new user</title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>

            <h1> Tech Checkout System: Adding a New User </h1>
            <br>
            <div id="box">
            <form method="GET">
                First Name:<input type="text" name="firstName" />
                <br />
                Last Name:<input type="text" name="lastName"/>
                <br/>
                Email: <input type= "email" name ="email"/>
                <br/>
                Phone Number: <input type ="text" name= "phone"/>
                <br />
               Role: 
               <select name="role">
                    <option value=""> - Select One - </option>
                    <option value="Staff">Staff</option>
                    <option value="Student">Student</option>
                    <option value="Faculty">Faculty</option>
                </select>
                <br />
                Department: 
                <select name="deptId">
                    <option value="" > Select One </option>
                    
                    <?php
                    
                    $departments = departmentList();
                    
                    foreach($departments as $department) {
                       echo "<option value='".$department['id']."'> " . $department['name']  . "</option>";  
                    }
                    
                    
                    ?>
                    
                </select>
                <input type="submit" value="Add User" name="addUser">
            </form>
            <br>
            <form action="admin.php">
                
                <input type="submit" value="Home" />
                
            </form>
        </div>
    </body>
</html>