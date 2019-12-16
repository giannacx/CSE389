<?php

/*
if(empty($POST['username']) || empty($POST['password'])){
    $error = "Username or Password is invalid";
}
*/


//When professor Login Button is clicked
if(isset($_POST['profLoginBtn'])){
    //Create MySQL Connection
    $conn =new mysqli('localhost','root','' );

    //Connect to the Project Database
    $selectedalreadycreateddatabase = mysqli_select_db($conn, "project");

    $profEmail = $_POST['username'];
    $profPassword = $_POST['password'];

    //Find professor query
    $queryTeach  = "SELECT * FROM `professors` WHERE `Email` = '$profEmail' AND `Password` = '$profPassword'";
    $resultTeach = mysqli_query($conn, $queryTeach);

    if(mysqli_num_rows($resultTeach) ===1){

        //$row1 = mysqli_fetch_array($queryTeach, MYSQLI_NUM);
        
            //if(row1[0] === $profEmail && $row1[1] === $profPassword)
            session_start();
            $_SESSION['professorEmail'] = $profEmail;
            //Send the username to the professorAdminHome.php
            header("Location: ./professorAdminHome.php");
            exit();
        }else{
            header("Location: ./professorIndex.html");
        //}
    }
}


?>
