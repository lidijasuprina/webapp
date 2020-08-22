<?php
include("header.php");

$db=database_connection();
$error="";

$workout_id="default";
$workout="";
$coach="";
$day="";
$start_time="";
$end_time="";
$rs="";
$sql="";

if(isset($_POST['submit'])) {
    $workout = mysqli_real_escape_string($db, $_POST['workout']);
    $coach = mysqli_real_escape_string($db, $_POST['coach']);
    $day=mysqli_real_escape_string($db,$_POST['day']);
    $start_time=mysqli_real_escape_string($db,$_POST['start_time']);
    $end_time=mysqli_real_escape_string($db,$_POST['end_time']);

    if(!empty($workout)&&!empty($coach)&&!empty($day)&&!empty($start_time)&&!empty($end_time)) {
        $sql = "INSERT INTO workout
			(id, name, start_time, end_time, coach, day) VALUES
			($workout_id, '$workout','$start_time','$end_time', '$coach','$day')";
        if (sqlQuery($db, $sql)) {
            echo "New workout is added to schedule successfully";
            header("Location:coach.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
}




?>


    <form method="post" action="coach.php">
        <input type="submit" name="coach_wm" value="BACK">
    </form>

<table>
    <tr>
        <td class="adjust"></td>
        <td>
            <form method="POST" action="add_new_workout.php">
                <table style="width: 100%">
                    <caption>Add new workout</caption>
                    <tbody>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <label class="error"><?php if($error!="")echo $error; ?></label>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="new" value="<?php if(!empty($workout_id))echo $workout_id;else echo 1;?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td class="left">
                            <label for="workout"><strong>Workout:</strong></label>
                        </td>
                        <td>
                            <input name="workout" id="workout" type="text" size="50" required autofocus/>
                            *
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="coach"><strong>Coach:</strong></label>
                        </td>
                        <td>
                            <select id="coach" name="coach">
                                <?php
                                $sql="SELECT id as user_id, user.name as first_name, surname FROM user where user_type=2";
                                $rs=sqlQuery($db,$sql);

                                if (mysqli_num_rows($rs) > 0) {
                                    while ($row = mysqli_fetch_assoc($rs)) {
                                        $coach=$row['user_id'];
                                        echo
                                            '<option value="'.$coach.'">'.$row['first_name']." ".$row['surname'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                            *
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="day"><strong>Day:</strong></label>
                        </td>
                        <td>
                            <select id="day" name="day">
                                <?php
                                $sql="SELECT id as day_id, day.name as day FROM day";
                                $rs=sqlQuery($db,$sql);

                                if (mysqli_num_rows($rs) > 0) {
                                    while ($row = mysqli_fetch_assoc($rs)) {
                                        $day=$row['day_id'];
                                        echo
                                            '<option value="'.$day.'">'.$row['day'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                            *
                        </td>
                    </tr>

                    <tr>
                        <td class="left">
                            <label for="start_time"><strong>Start time: </strong></label>
                        </td>
                        <td>
                            <input type="time" id="start_time" name="start_time" required>
                            *
                        </td>
                    </tr>

                    <tr>
                        <td class="left">
                            <label for="end_time"><strong>End time: </strong></label>
                        </td>
                        <td>
                            <input type="time" id="end_time" name="end_time" required>
                            *
                        </td>
                    </tr>

                    <tr>
                        <td  style="text-align: center">
                            * required field
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            <input name="submit" type="submit" value="SAVE"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </td>
        <td class="adjust"></td>
    </tr>
</table>

<?php
close_db_connection($db);
include("footer.php");
?>