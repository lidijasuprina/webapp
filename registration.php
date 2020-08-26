<?php
include("header.php");
$db=database_connection();

$sql="";
$error= "";
$flag=false;
$result="";
$user_id="default";

if(isset($_POST['submit'])){
    $name=$_POST['first_name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    $birth=$_POST['birth'];
    $gender=$_POST['gender'];

    if($password1==$password2){
        $flag=true;
    }
    else{
        echo 'Passwords do not match.';
    }

    if($flag==true) {
        $salted=$password1.$email;
        $hashed=hash('sha512', $salted);

        $sql="INSERT INTO user (id, user.name, surname, email, password, birth, gender, user_type)
                VALUES ('$user_id','$name','$surname','$email','$hashed','$birth','$gender','3')";


        if (sqlQuery($db, $sql)) {
            echo "You signed up successfully.";
            header("Location:login.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
}
?>


<form id="register" name="register" method="POST" action="registration.php">
    <table width="100%">
        <caption>Registration</caption>
        <tbody>
        <tr>
            <td colspan="2" style="text-align:center;">
                <label class="error"><?php if($error!="")echo $error; ?></label>
            </td>
        </tr>
        <tr>
            <td class="left">
                <label for="first_name"><strong>* Name:</strong></label>
            </td>
            <td>
                <input name="first_name" id="first_name" type="text" size="50" required autofocus/>
            </td>
        </tr>
        <tr>
            <td class="left">
                <label for="surname"><strong>* Surname:</strong></label>
            </td>
            <td>
                <input name="surname" id="surname" type="text" size="50" required/>
            </td>
        </tr>
        <tr>
            <td class="left">
                <label for="email"><strong>* Email:</strong></label>
            </td>
            <td>
                <input name="email" id="email" type="email" size="50" required/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password1"><strong>* Password:</strong></label>
            </td>
            <td>
                <input name="password1"	id="password1" type="password" size="50" required/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password2"><strong>* Repeat password:</strong></label>
            </td>
            <td>
                <input name="password2"	id="password2" type="password" size="50" required/>
            </td>
        </tr>
        <tr>
            <td class="left">
                <label for="birth"><strong>* Date of birth:</strong></label>
            </td>
            <td>
                <input name="birth" id="birth" type="date" size="90" required/>
            </td>
        </tr>
        <tr>
            <td class="left">
                <label for="gender"><strong>* Gender:</strong></label>
            </td>
            <td>
                <input type="radio" id="male" name="gender" value="1">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="2">
                <label for="female">Female</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                * required field
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input name="submit" type="submit" value="SIGN UP"/>
            </td>
        </tr>
        </tbody>
    </table>
</form>


<?php
close_db_connection($db);
include("footer.php");
?>