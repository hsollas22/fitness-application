<!DOCTYPE html>
<?php
//Connect to the database 

if(!include('connect.php')){
    die('error finding connect file');
}

$dbh = ConnectDB();
?>


<html>
    
<body>
<h1> All Users </h1>
<?php
 $sql =  "select userid FROM sollas45.users ORDER BY userid asc";
 $stmt = $dbh->prepare($sql);
 $stmt->execute();


$users = $stmt->fetchAll();


foreach ($users as $user) {
    echo "<a href='workoutinfo.php?userid=" . $user['userid'] . "'>User: " . $user['userid'] . "</a><br>";
}

 ?>

<a href="main.html">Back to Main Page</a>

</body>

</html>