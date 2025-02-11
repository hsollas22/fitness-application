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
// get users 
$sql =  "SELECT userid, user_name FROM sollas45.users ORDER BY userid asc";
$stmt = $dbh->prepare($sql);
$stmt->execute();


$users = $stmt->fetchAll();


$action_url = 'currentworkout.php'; 

echo '<form action="' . $action_url . '" method="GET">';

// dropdown with userids
echo 'Select User: <select name="userid">';

// loop through each user and create an option
foreach ($users as $user) {
    echo '<option value="' . $user['userid'] . '">' . $user['user_name'] . ' ' . $user['userid'] . '</option>';

}
echo '</select><br>';
echo '<input type="submit">';
echo '</form>';

?>
</body>
</html>