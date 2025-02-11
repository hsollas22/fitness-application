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
echo "<h1>Information on User " . $userid . "</h1>";

// Get user name
    $sql = "SELECT user_name from sollas45.users where userid = $userid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $userResult = $stmt->fetch(PDO::FETCH_ASSOC); 

    echo "<div>Username: ". $userResult['user_name'] . "</div>";

// Get last workout
    $sql = "SELECT last_workout_day($userid)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $lastWorkoutDayResult = $stmt->fetchColumn(); 

    $sql = "SELECT get_muscles_worked($lastWorkoutDayResult)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $lastMuscles= $stmt->fetchColumn();

    $sql = "SELECT day_name from sollas45.workout_day where workout_day_id = $lastWorkoutDayResult";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $lastDayName = $stmt->fetchColumn(); 

    echo "<div>Last Workout Day: ". $lastDayName . " - " . $lastMuscles. "</div>";

// Get next workout
    $sql = "SELECT next_workout_day($userid)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $nextWorkoutDayResult = $stmt->fetchColumn();

    $sql = "SELECT get_muscles_worked($nextWorkoutDayResult)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $nextMuscles= $stmt->fetchColumn();

    $sql = "SELECT day_name from sollas45.workout_day where workout_day_id = $nextWorkoutDayResult";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $nextDayName = $stmt->fetchColumn(); 

    echo "<div> Next Workout Day: " . $nextDayName . " - " . $nextMuscles .  "</div>"; 


?>


</body>



</html>

