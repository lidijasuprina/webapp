<?php

function database_connection(){
    $conn = mysqli_connect('localhost', 'administrator_sra_fit', 'srafitctrl', 'sra_fit_db');
    if(!$conn) die("ERROR: There is a problem with database connection: ".mysqli_connect_error());
    return $conn;
}

function sqlQuery($conn, $sql){
    $result=mysqli_query($conn,$sql);
    if(mysqli_error($conn)!=="")echo "ERROR: There is a problem with query: ".$sql;
    return $result;
}

function close_db_connection($conn){
    mysqli_close($conn);
}

?>