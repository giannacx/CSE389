<?php
//Create MySQL Connection
    $conn =new mysqli('localhost','root','' );

    //Connect to the Project Database
    $selectedalreadycreateddatabase = mysqli_select_db($conn, "project");

    $id = isset($_GET['id'])? $_GET['id'] : "";
    echo $id;

    $query= "SELECT * FROM `courses` WHERE `CourseCode`='$id'";
    $stat = mysqli_query($conn, $query);
    if(!$stat){
        printf("Erorr: %s\n", mysqli_error($conn));
        exit();
    }
    
    $row = mysqli_fetch_array($stat, MYSQLI_NUM);
    header('Content-Type:'.$row[4]);
    echo $row[3];
?>