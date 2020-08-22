<?php
include("header.php");

$db=database_connection();

if(isset($_POST['apply'])) {
    $sql =" INSERT INTO workout_members (id, workout, member) VALUES
            (default,".$_POST['id'].",$active_user_id)";
    sqlQuery($db, $sql);
}

if(isset($_POST['delete'])) {
    $quit_workout=$_POST['id'];
    $sql =" DELETE FROM workout_members WHERE workout='$quit_workout' AND member='$active_user_id'";
    sqlQuery($db, $sql);
}

$sql = "SELECT w.id, w.start_time, w.end_time, w.name AS workout, u.name AS first_name, u.surname, d.name AS day 
            FROM workout w 
                INNER JOIN day d ON w.day=d.id 
                INNER JOIN user u ON w.coach=u.id
                LEFT JOIN workout_members wm ON wm.workout=w.id
                WHERE wm.workout NOT IN (SELECT wm1.workout FROM workout_members wm1 
                    INNER JOIN workout_members wm2 ON wm1.workout=wm2.workout 
                    WHERE wm1.member!=wm2.member AND wm1.member='$active_user_id' GROUP BY workout) 
                AND wm.member NOT IN (SELECT wm1.member FROM workout_members wm1 
                    WHERE wm1.member='$active_user_id' GROUP BY wm1.member) 
                OR wm.workout IS NULL 
                GROUP BY w.id
                ORDER BY d.id";

$sql_apply = "SELECT w.id AS id, w.start_time, w.end_time, w.name AS workout, u.name AS first_name, u.surname, d.name AS day 
                FROM workout w 
                    INNER JOIN day d ON w.day=d.id 
                    INNER JOIN user u ON w.coach=u.id 
                    INNER JOIN workout_members wm ON wm.workout=w.id 
                    WHERE wm.member='$active_user_id'
                    ORDER BY d.id;";

$result = sqlQuery($db, $sql);
$result_user = sqlQuery($db, $sql_apply);

?>

<table style="width: 100%">
    <tr>
        <td class="adjust"></td>
        <td>
            <table style="width: 100%">
                <caption>My Workout Schedule</caption>
                <tr>
                    <th>Workout</th>
                    <th>Coach</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>

                </tr>

                <?php
                if (mysqli_num_rows($result_user) > 0) {
                    while($row_user = mysqli_fetch_assoc($result_user)) {
                        echo '<tr>
                                        <td>'.$row_user['workout'].'</td>
                                        <td>'.$row_user['first_name']." ".$row_user['surname'].'</td>
                                        <td>'.$row_user['day'].'</td>
                                        <td>'.$row_user['start_time'].'</td>
                                        <td>'.$row_user['end_time'].'</td>
                                        <td>
                                            <form method="post" action="member.php">
                                                <input type="submit" name="delete" value="DELETE">
                                                <input type="hidden" name="id" value="'.$row_user['id'].'">
                                            </form>
                                        </td>
                                  </tr>';
                    }
                }
                ?>

            </table>
        </td>
        <td class="adjust"></td>
    </tr>


    <tr>
        <td class="adjust"></td>
        <td>
            <table style="width: 100%">
                <caption>Apply for another Workout</caption>
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
                        echo '<tr>
                                        <td>'.$row['workout'].'</td>
                                        <td>'.$row['first_name']." ".$row['surname'].'</td>
                                        <td>'.$row['day'].'</td>
                                        <td>'.$row['start_time'].'</td>
                                        <td>'.$row['end_time'].'</td>
                                        
                                        <td>
                                            <form method="post" action="member.php">
                                                <input type="submit" name="apply" value="APPLY">
                                                <input type="hidden" name="id" value="'.$row['id'].'">
                                            </form>
                                        </td>
                                  </tr>';
                    }
                }
                ?>

            </table>
        </td>
        <td class="adjust"></td>
    </tr>
</table>
<?php
close_db_connection($db);
include("footer.php");
?>