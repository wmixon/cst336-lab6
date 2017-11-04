<?php
session_start();

    if (!isset($_SESSION['username'])) {
        
        header("Location: index.php");
        
    }
    include 'database.php';
    $conn = getDatabaseConnection();
  
function getUserInfo() {
    global $conn;
    
    $sql = "SELECT * 
            FROM User
            WHERE id = " . $_GET['userId']; 
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($record);
    
    return $record;

}


 if (isset($_GET['updateUser'])) { //checks whether admin has submitted form.
     
     //echo "Form has been submitted!";
     
     $sql = "UPDATE User
             SET firstName = :fName,
                 lastName  = :lName,
                 email = :email,
                 phone = :phone,
                 role = :role,
                 deptId = :deptId
             WHERE id = :id";
     $np = array();
     
    $np[':fName'] = $_GET['firstName'];
    $np[':lName'] = $_GET['lastName'];
    $np[':email'] = $_GET['email'];
    $np[':phone'] = $_GET['phone'];
    $np[':role'] = $_GET['role'];
    $np[':deptId'] = $_GET['deptId'];
    $np[':id'] = $_GET['userId'];  
     
     $stmt = $conn->prepare($sql);
     $stmt->execute($np);
     
     echo "<div id='box'> Record has been updated! </div>";
     
 }


 if (isset($_GET['userId'])) {
     
    $userInfo = getUserInfo(); 
     
     
 }



?>


<!DOCTYPE html>
<html>
    <head>
        <title> Update User </title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>

        <h1> Tech Checkout System: Updating User's Info </h1>
        <br>
        <div id="box">
        <form method="GET">
            <input type="hidden" name="userId" value="<?=$userInfo['id']?>" />
            First Name:<input type="text" name="firstName" value="<?=$userInfo['firstName']?>" />
            <br />
            Last Name:<input type="text" name="lastName" value="<?=$userInfo['lastName']?>"/>
            <br/>
            Email: <input type= "email" name ="email" value="<?=$userInfo['email']?>"/>
            <br/>
            Phone Number: <input type ="text" name= "phone" value="<?=$userInfo['phone']?>"/>
            <br />
           Role: 
           <select name="role">
                <option value=""> - Select One - </option>
                <option value="Staff"  <?=($userInfo['role']=='Staff')?" selected":"" ?>  >Staff</option>
                <option value="Student" <?=($userInfo['role']=='Student')?" selected":"" ?>  >Student</option>
                <option value="Faculty" <?=($userInfo['role']=='Faculty')?" selected":"" ?>>Faculty</option>
            </select>
            <br />
            Department: 
            <select name="deptId">
                <option value="" > Select One </option>
                <?php
                    
                    $departments = departmentList();
                    
                    foreach($departments as $department) {
                       echo "<option value='".$department['id']."' ";
                       echo ($userInfo['deptId']==$department['id'])?" selected":"";
                       echo "> " . $department['name']  . "</option>";  
                    }
                    
                    
                ?>
            </select>
            <input type="submit" value="Update User" name="updateUser">
        </form>
        <br>
        <form action="admin.php">
                
                <input type="submit" value="Home" />
                
            </form>
        </div>
    </body>
</html>