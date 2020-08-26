<?php
include("header.php");

$db=database_connection();

$sql = "SELECT w.start_time, w.end_time, w.name AS workout, u.name AS first_name, u.surname, d.name AS day 
            FROM workout w 
            INNER JOIN day d ON w.day=d.id 
            INNER JOIN user u ON w.coach=u.id 
            ORDER BY d.id;";

$result = mysqli_query($db, $sql);

?>


<p>Sports and Recreational Association FIT was founded in order to organize, promote, develop and improve the
    entire sport and sports recreation in the City of Petrinja and the area of Sisačko-moslavačka County.</p>
<br>
<img src="images/background.jpg" alt="Working out" style="width: 100%">
<hr>
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
            echo '<tr>
                            <td>'.$row['workout'].'</td>
                            <td>'.$row['first_name']." ".$row['surname'].'</td>
                            <td>'.$row['day'].'</td>
                            <td>'.$row['start_time'].'</td>
                            <td>'.$row['end_time'].'</td>
                      </tr>';
        }
    }
    ?>

</table>

<?php
close_db_connection($db);
include("footer.php");
?>