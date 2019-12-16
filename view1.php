<?php
//Create MySQL Connection
    $conn =new mysqli('localhost','root','' );

    //Connect to the Project Database
    $selectedalreadycreateddatabase = mysqli_select_db($conn, "project");

    $id = isset($_GET['id'])? $_GET['id'] : "";

    $stat = $conn->prepare("select * from courses where CourseCode=?");
    $stat->bindParam(1, $id);
    $stat->execute();
    $row = $stat->fetch();
    header('Content-Type:' .$row[7]);
    echo $row[6];
?>