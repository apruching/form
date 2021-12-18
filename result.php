<?php
//TRUNCATED users this code is remove all id


//register for same page
session_start();
//print_r($_POST);

//web form
$db_host_name = 'localhost';
$db_user_name = "root";
$db_password = "";
$db_name = "web_form_reg";


// db connect;

$db_connect = mysqli_connect($db_host_name, $db_user_name, $db_password, $db_name);

//information from form;

$user_name =  filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = $_POST['phone'];
$password = $_POST['password'];

$validated_email = filter_var($email, FILTER_VALIDATE_EMAIL);


//password rules
$pass_cap = preg_match('@[A-Z]@', $password);
$pass_small = preg_match('@[a-z]@', $password);
$pass_numeric = preg_match('@[0-9]@', $password);
$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
$pass_char = preg_match($pattern, $password);


//email validation in if else
//password validation in if else
if ($validated_email) {
    if (strlen($password) > 5 && $pass_cap == 1 && $pass_small == 1 && $pass_numeric == 1 && $pass_char == 1) {
        //make encript password
        $encript_password = md5($password);
        $checking_query = "SELECT COUNT(*) AS total_users FROM users WHERE email ='$validated_email'";
        $db_result = mysqli_query($db_connect, $checking_query);
        $after_assoc = mysqli_fetch_assoc($db_result);
        // print_r($after_assoc);

        if ($after_assoc['total_users'] == 0) {
            //insert query;
            $insert_query = "INSERT INTO users(user_name,email,phone,password) VALUES('$user_name','$email','$phone','$encript_password')";

            //insert data into database
            mysqli_query($db_connect, $insert_query);
            //register for same  page
            $_SESSION['success_msg'] = "Congratulation! You registered successfully";
            header('location: index.php');

            // echo "Your form is submited";


        } else {
            $_SESSION['err_msg'] = "already registered";
            header('location: index.php');
        }
    } else {
        $_SESSION['err_msg'] = "password must be contained 6 characters";
        header('location: index.php');
    }
} else {
    $_SESSION['err_msg'] = "Invalid email";
    header('location: index.php');
}
