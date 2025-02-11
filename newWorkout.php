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

<?php

$userid = $_GET['userid'];


// Get user's name 
$sql = "SELECT user_name from sollas45.users where userid = $userid";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$userResult = $stmt->fetch(PDO::FETCH_ASSOC); 

echo "<div>Building workout for ". $userResult['user_name'] . "</div>";


$sql = "CALL build_workout($userid, next_workout_day($userid))";
$stmt = $dbh->prepare($sql);
$stmt->execute(); 
$recordsAdded = $stmt->rowCount();


if($recordsAdded <= 1){
    echo "<div> A workout has already been added for today. A new one will not be created.</div>";
} 
else {
    echo "<div>" . $recordsAdded . " workout records successfully added for today.</div>";
}





?>

</body>
</html>