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



 $sql =  "select userid, user_name FROM sollas45.users ORDER BY userid asc";
 $stmt = $dbh->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();



 foreach ($users as $user) {
    echo "<a href='newWorkout.php?userid=" . $user['userid'] . "'>User: " . ($user['user_name']) . " ( " . ($user['userid']) . ")</a><br>";
}



?>

</body>

</html>