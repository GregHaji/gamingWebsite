<?php

$conn = mysqli_connect('localhost','root','','compuware');

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $regemail = mysqli_real_escape_string($conn, $_POST['registerEmail']);
    $pass = md5($_POST['registerPassword']);
    $cpass = md5($_POST['cpassword']);
    $user_type = 'user';


    $select = " SELECT * FROM user_form WHERE email = '$regemail' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';

    }else{

        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$regemail','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:register.php');
        }
    }

};
if(isset($_POST['enter_page'])){


    $email = mysqli_real_escape_string($conn, $_POST['loginEmail']);
    $pass = md5($_POST['loginPassword']);


    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:home.php');

        }

    }else{
        $error[] = 'incorrect email or password!';
    }

};

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="style.css">
    <title>Register or Login</title>
</head>
<body>

<div class="form-container">


        <form action="" method="post">

            <h3>Register</h3>

            <input type="text" name="name" placeholder="Name" required >
            <input type="email" name="registerEmail"  placeholder="Email" required>
            <input type="password" name="registerPassword"  placeholder="Password" required>
            <input type="password" name="cpassword"  placeholder="Confirm Password" required>

            <button class="button-64" name="submit" role="button"><span class="text">Register</span></button>
        </form>


        <form action="" method="post">

            <h3>Login</h3>

            <input type="email" name="loginEmail"  placeholder="Email" required>
            <input type="password" name="loginPassword"  placeholder="Password" required>

            <button class="button-64" name="enter_page" role="button"><span class="text">Login</span></button>
        </form>



</div>


</body>
</html>
