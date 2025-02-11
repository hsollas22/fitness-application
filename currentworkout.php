<!DOCTYPE html>
<?php
if (!include('connect.php')) {
    die('Error finding connect file');
}
$dbh = ConnectDB();
?>

<html>
<body>

<?php

$userid = (int) $_GET['userid']; 

// Get user name
$sql = "SELECT user_name from sollas45.users where userid = $userid";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$userResult = $stmt->fetch(PDO::FETCH_ASSOC); 

echo "<h1> Current Workout for User " .$userResult['user_name'] . "</h1>";

$sql = "CALL fetch_current_workout($userid)";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// get names for each activityid 
echo "<h2>Workout Details:</h2>";
foreach ($workouts as $workout) {
    $activity_id = $workout['activity_id'];
    $sql = "SELECT fa_name FROM sollas45.fitness_activity WHERE activity_id = $activity_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    
    $names = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($names as $name) {
        echo "" . ($name['fa_name']) . "<br>";
    }
}

?>

</body>
</html>
