<?php
include("header.php");
$db=database_connection();

if(session_id()=="")session_start();

$current=basename($_SERVER["PHP_SELF"]);
$path=$_SERVER['REQUEST_URI'];
$active_user=0;
$active_user_type=-1;


if(isset($_SESSION['active_user'])){
    $active_user=$_SESSION['active_user'];
    $active_user_email=$_SESSION['active_user_email'];
    $active_user_type=$_SESSION['active_user_type'];
    $active_user_id=$_SESSION["active_user_id"];
}

if(isset($_GET['logout'])){
    unset($_SESSION["active_user"]);
    unset($_SESSION['active_user_email']);
    unset($_SESSION["active_user_type"]);
    unset($_SESSION["active_user_id"]);
    session_destroy();
    header("Location:index.php");
}

$error= "";
if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['password']);

    $salted=$password.$email;
    $hashed=hash('sha512', $salted);

    if(!empty($email)&&!empty($password)){
        $sql="SELECT id, user_type, name, surname FROM user WHERE email='$email' AND password='$hashed'";
        $rs=sqlQuery($db,$sql);

        if(mysqli_num_rows($rs)==0)$error="Wrong email and/or password";
        else{
            list($id,$type,$name,$surname)=mysqli_fetch_array($rs);
            $_SESSION['active_user']=$name." ".$surname;
            $_SESSION['active_user_email']=$email;
            $_SESSION['active_user_id']=$id;
            $_SESSION['active_user_type']=$type;
            if ($_SESSION["active_user_type"]==2) header("Location:coach.php");
            else header("Location:member.php");

        }
    }
    else $error = "Please, enter your email and password.";
}
?>

<form id="login" name="login" method="POST" action="login.php" >
    <table style="width: 100%">
        <caption>Login</caption>
        <tbody>
        <tr>
            <td colspan="2" style="text-align:center;">
                <label class="error"><?php if($error!="")echo $error; ?></label>
            </td>
        </tr>
        <tr>
            <td class="left">
                <label for="email"><strong>Email:</strong></label>
            </td>
            <td>
                <input name="email" id="email" type="email" size="30" required autofocus/>
                *
            </td>
        </tr>
        <tr>
            <td>
                <label for="password"><strong>Password:</strong></label>
            </td>
            <td>
                <input name="password"	id="password" type="password" size="30" required/>
                *
            </td>
        </tr>
        <tr>
            <td colspan="2">
                * required field
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input name="submit" type="submit" value="LOG IN"/>
            </td>
        </tr>
        </tbody>
    </table>
</form>


<?php
close_db_connection($db);
include("footer.php");
?>