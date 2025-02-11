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
 
$muscle_group = $_GET['muscle_group'];
echo "<h1>Fitness activities that work out " . $muscle_group . "</h1>";


// retrieve all fitness activities that match muscle_group
$sql = "SELECT fa_name, activity_type, activity_id 
        FROM sollas45.fitness_activity 
        WHERE primary_muscle_group = :muscle_group";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':muscle_group', $muscle_group, PDO::PARAM_INT); // bind the muscle_group parameter
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $workout) {
    echo "<p>" . ($workout['fa_name']) . " (" . ($workout['activity_type']) . ")</p>";

    // for each workout get the days it is scheduled for
    $sql= "SELECT day_name FROM sollas45.scheduled s
                 JOIN sollas45.workout_day wd ON s.workout_day_id = wd.workout_day_id
                 WHERE s.fitness_activity_id = :activity_id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':activity_id', $workout['activity_id'], PDO::PARAM_INT); // Bind the activity_id parameter
    $stmt->execute();
    $days = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // display the scheduled days for the workout
    echo "<p>scheduled on: ";
    foreach ($days as $day) {
        echo htmlspecialchars($day['day_name']) . " ";
    }
    echo "</p>";
}



?>


</body>
</html>

