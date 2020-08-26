<?php
include("header.php");

$db=database_connection();
$error="";

$wm_id="default";
$workout="";
$coach="";
$day="";
$start_time="";
$end_time="";
$rs="";
$sql="";

if(isset($_POST['submit'])) {
    $workout = mysqli_real_escape_string($db, $_POST['workout']);
    $member = mysqli_real_escape_string($db, $_POST['member']);

    if(!empty($workout)&&!empty($member)) {
        $sql = "INSERT INTO workout_members
			(id, workout, member) VALUES
			('$wm_id', '$workout','$member')";
        if (sqlQuery($db, $sql)) {
            echo "New member is added to workout group successfully.";
            header("Location:coach_wm.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
}




?>

<form method="post" action="coach_wm.php">
    <input type="submit" name="coach_wm" value="BACK">
</form>


<form method="POST" action="add_new_wm.php">
    <table style="100%">
        <caption>Add new workout member</caption>
        <tbody>
        <tr>
            <td colspan="2" style="text-align:center;">
                <label class="error"><?php if($error!="")echo $error; ?></label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="workout"><strong>Workout (date and time):</strong></label>
            </td>
            <td>
                <select id="workout" name="workout">
                    <?php
                    $sql="SELECT w.id as workout_id, w.name as workout_name, start_time, d.name as day_name
                            FROM workout w INNER JOIN day d ON w.day=d.id";
                    $rs=sqlQuery($db,$sql);

                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_assoc($rs)) {
                            $workout_id=$row['workout_id'];
                            echo
                                '<option value="'.$workout_id.'">'.$row['workout_name']." (".
                                $row['day_name'].": ".$row['start_time'].')</option>';
                        }
                    }
                    ?>
                </select>
                *
            </td>
        </tr>

        <tr>
            <td>
                <label for="member"><strong>Member:</strong></label>
            </td>
            <td>
                <select id="member" name="member">
                    <?php
                    $sql="SELECT u.id AS member_id, u.name AS first_name, surname FROM user u WHERE user_type=3";
                    $rs=sqlQuery($db,$sql);

                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_assoc($rs)) {
                            $member=$row['member_id'];
                            echo
                                '<option value="'.$member.'">'.$row['first_name']." ".$row['surname'].'</option>';
                        }
                    }
                    ?>
                </select>
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


<?php
close_db_connection($db);
include("footer.php");
?>