<?php
include("header.php");

$db=database_connection();

if(isset($_POST['delete'])) {
    $sql =" DELETE FROM workout WHERE id='".$_POST['id']."' ";
    sqlQuery($db, $sql);
}

$sql = "SELECT w.id AS workout_id, w.start_time, w.end_time, w.name AS workout, u.name AS first_name, u.surname, d.name AS day 
            FROM workout w 
                INNER JOIN day d ON w.day=d.id 
                INNER JOIN user u ON w.coach=u.id 
                    ORDER BY d.id";

$result = sqlQuery($db, $sql);

?>

<form method="post" action="coach_wm.php">
    <input type="submit" name="edit" value="WORKOUT MEMBERS">
</form>


<table style="width:100%">
    <caption>Workout Schedule</caption>
    <tr>
        <th>Workout</th>
        <th>Coach</th>
        <th>Day</th>
        <th>Start Time</th>
        <th>End Time</th>

    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $workout_id=$row['workout_id'];
            echo '<tr>
                            <td>'.$row['workout'].'</td>
                            <td>'.$row['first_name']." ".$row['surname'].'</td>
                            <td>'.$row['day'].'</td>
                            <td>'.$row['start_time'].'</td>
                            <td>'.$row['end_time'].'</td>
                            
                            <td>
                                <form method="post" action="edit.php?work_id='.$workout_id.'">
                                    <input type="submit" name="edit" value="EDIT">
                                    <input type="hidden" name="id" value="'.$workout_id.'">
                                </form>
                            </td>
                            
                            <td>
                                <form method="post" action="coach.php">
                                    <input type="submit" name="delete" value="DELETE">
                                    <input type="hidden" name="id" value="'.$row['workout_id'].'">
                                </form>
                            </td>
                      </tr>';
        }
        echo'
            <tr>
                <td>
                    <form method="post" action="add_new_workout.php">
                        <input type="submit" name="add_new" value="ADD NEW">
                    </form>
                </td>
            </tr>
        ';
    }
    ?>

</table>


<?php
close_db_connection($db);
include("footer.php");
?>