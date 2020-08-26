<?php
include("header.php");
$db=database_connection();

$w_id=$_REQUEST["work_id"];


$sql = "select w.id as workout_id, w.start_time, w.end_time, w.name as workout, u.name as first_name, u.surname, d.name as day, d.id as dayId, u.id as userId
 from workout w 
inner join day d on w.day=d.id inner join user u on w.coach=u.id order by d.id";

$result = sqlQuery($db, $sql);

if(isset($_POST['submit'])) {

    $workout = mysqli_real_escape_string($db, $_POST['workout']);
    $coach = mysqli_real_escape_string($db, $_POST['coach']);
    $day = mysqli_real_escape_string($db, $_POST['day']);
    $start_time = mysqli_real_escape_string($db, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($db, $_POST['end_time']);

    if (!empty($workout) && !empty($coach) && !empty($day) && !empty($start_time) && !empty($end_time)) {

        $sql_update = "UPDATE  workout SET
			    name='$workout',
			    start_time='$start_time',
			    end_time='$end_time',
			    coach=$coach,
			    day=$day
			    WHERE id=$w_id";

        if (sqlQuery($db, $sql_update)) {
            echo "Workout is successfully updated.";
        } else {
            echo "Error: " . $sql_update . "<br>" . mysqli_error($db);
        }

        echo "<meta http-equiv='refresh' content='0'>";
    }
}




$error="";
$workout="";
$coach="";
$day="";
$start_time="";
$end_time="";
$rs="";
$sql="";
$result_coach="";

?>

<form method="post" action="coach.php">
    <input type="submit" name="coach" value="BACK">
</form>


<form method="POST" action="edit.php?work_id=<?php echo $w_id ?>">
    <table style="width: 100%">
        <caption>Edit workout schedule</caption>
        <tbody>

        <tr>
            <th>Workout</th>
            <th>Coach</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center">
                <label class="error"><?php if($error!="")echo $error; ?></label>
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <input type="hidden" name="new" value="<?php if(!empty($workout_id))echo $workout_id;else echo 1;?>"/>
            </td>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                if ($row['workout_id'] == $w_id) {
                    echo '<tr>
                            <td><input name="workout" id="workout" type="text" value="' . $row['workout'] . '" required></td>';
                    echo '<td><select id="coach" name="coach">';
                    $sql_coach = "SELECT u.id as user_id, u.name as first_name, u.surname as surname FROM user u where user_type=2";
                    $result_coach = sqlQuery($db, $sql_coach);

                    if (mysqli_num_rows($result_coach) > 0) {
                        while ($row_coach = mysqli_fetch_assoc($result_coach)) {
                            if ($row['userId'] == $row_coach['user_id']) {
                                echo
                                    '<option value="' . $row_coach['user_id'] . '" selected>' . $row_coach['first_name'] . " " . $row_coach['surname'] . '</option>';
                            } else {
                                echo
                                    '<option value="' . $row_coach['user_id'] . '">' . $row_coach['first_name'] . " " . $row_coach['surname'] . '</option>';
                            }
                        }
                    }
                    echo '</select></td>';
                    //-----------------------------
                    echo '<td><select id="day" name="day">';
                    $sql_day = "SELECT id as day_id, day.name as day FROM day";
                    $rl = sqlQuery($db, $sql_day);

                    if (mysqli_num_rows($rl) > 0) {
                        while ($row_day = mysqli_fetch_assoc($rl)) {
                            $day = $row_day['day_id'];
                            if ($row['dayId'] == $day) {
                                echo
                                    '<option value="' . $day . '" selected>' . $row_day['day'] . '</option>';
                            } else {
                                echo
                                    '<option value="' . $day . '">' . $row_day['day'] . '</option>';
                            }
                        }
                    }
                    echo '</select></td>';

                    echo '<td><input type="time" id="start_time" name="start_time" value="' . $row['start_time'] . '" required></td>';
                    echo '<td><input type="time" id="end_time" name="end_time" value="' . $row['end_time'] . '" required></td>
                     
                        <td>
                            <input name="submit" type="submit" value="SAVE">
                        </td>
                      </tr>';
                } else {
                    echo '<tr>
                            <td>' . $row['workout'] . '</td>
                            <td>' . $row['first_name'] . " " . $row['surname'] . '</td>
                            <td>' . $row['day'] . '</td>
                            <td>' . $row['start_time'] . '</td>
                            <td>' . $row['end_time'] . '</td>

                          
                        </tr>';
                }
            }
        }
        ?>

        </tbody>
    </table>
</form>


<?php
close_db_connection($db);
include("footer.php");
?>