<?php
include("header.php");

$db=database_connection();

if(isset($_POST['delete'])) {
    $sql =" DELETE FROM workout_members WHERE id='".$_POST['id']."' ";
    sqlQuery($db, $sql);
}

$sql = "SELECT wm.id AS wo_mem_id, w.id AS w_id, w.name AS w_name, w.start_time AS start_time, d.name AS d_name,
            u.name AS first_name, u.surname AS surname FROM workout_members wm
            INNER JOIN workout w ON wm.workout=w.id 
            INNER JOIN day d ON w.day=d.id
            INNER JOIN user u ON wm.member=u.id";

$result = sqlQuery($db, $sql);

?>

<form method="post" action="coach.php">
    <input type="submit" name="coach" value="WORKOUT SCHEDULE">
</form>


<table style="width:100%">
    <caption>Workout Schedule</caption>
    <tr>
        <th>Workout (Day and Time)</th>
        <th>Member</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $wm_id=$row['wo_mem_id'];
            echo '<tr>
                            <td>'.$row['w_name'].' ('.$row['d_name'].': '.$row['start_time'].')</td>
                            <td>'.$row['first_name']." ".$row['surname'].'</td>                               
                            <td>
                                <form method="post" action="coach_wm.php">
                                    <input type="submit" name="delete" value="DELETE">
                                    <input type="hidden" name="id" value="'.$wm_id.'">
                                </form>
                            </td>
                      </tr>';
        }
        echo'
            <tr>
                <td>
                    <form method="post" action="add_new_wm.php">
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