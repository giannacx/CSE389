<?php


//Get professor email
session_start();
//$profEmail = $_SESSION['professorEmail'];


//Create MySQL Connection
$conn =new mysqli('localhost','root','' );

//Connect to the Project Database
$selectedalreadycreateddatabase = mysqli_select_db($conn, "project");

//If the database exists
if($selectedalreadycreateddatabase){
    echo "Existing database selected success";
}else{
    echo "Existing database selected not success";
}
//Classes Table Query
$query = "SELECT * FROM `courses` INNER JOIN `profclasses` ON courses.CourseCode = profclasses.CourseCode WHERE profClasses.ProfEmail = 'professorYu@syr.edu'";
$sqlClassesQuery1 = mysqli_query($conn, $query);
if(!$sqlClassesQuery1){
    printf("Erorr: %s\n", mysqli_error($conn));
    exit();
}
//$sqlClassesQuery2 = mysqli_query($conn, $query);

/*
$dataRow = "";
while($row2 = mysqli_fetch_array($sqlClassesQuery2)){
    $dataRow = $dataRow."<tr><td>$row2</td></tr>";
}
*/


//On submit button
if(isset($_POST['submit'])){
    if(getimagesize($_FILES['Image']['tmp_name'])== false){
        echo "<br/>Please Select an image";
    }
    $CourseCode=$_POST['CourseCode'];
    $CourseTitle=$_POST['CourseTitle'];
    $CourseImage=$_FILES['Image']['tmp'];
    $CourseAssignment=$_FILES['Assignment']['TMP_NAME'];
    $CourseLink=$_POST['Link'];
    $CourseDepartment = $_POST['Department'];

    $CourseImage = base64_encode(file_get_contents(addslashes($CourseImage)));
    $CourseAssignment = base64_encode(file_get_contents(addslashes($CourseAssignment)));
    
    //Insert Course into database
    $sqlInsertCourse = "INSERT INTO `Courses`(`CourseCode`, `CourseTitle`, `Pictures`, `Assignments`, `Links`, `Department`) VALUES ('$CourseCode','$CourseTitle', '$CourseImage', '$CourseAssignment', '$CourseLink', '$CourseDepartment')";
    
    //Insert that the professor has this course
    //Have to implement it to find the professor using the session
    $sqlInsertProfessor = "INSERT INTO `profclasses`(`CourseCode`, `ProfEmail`) VALUES ('$CourseCode', 'professorYu@syr.edu')";

    
    if(mysqli_query($conn, $sqlInsertCourse)){
        echo "<br/> Course Added";
    }else{
        echo"<br/> Course not added";
    }

    //Adds course to courses taught by the specific professor\
    if(mysqli_query($conn, $sqlInsertProfessor)){
        echo "<br/> Professor Course Added";
    }else{
        echo"<br/> Professor Course not added";
    }

    header("Refresh:0");

}


?>

<html>
    <head>
    </head>
    <body>
    <table>
        <h1>My Classes</h1>
        <table>
            <tr>
                <th style="width: 150px; color: white; background: #4CAF50; border: 1px solid #ddd">Course Code</th>
                <th style="width: 250px; color: white; background: #4CAF50; border: 1px solid #ddd">Course Title</th>
                <th style="width: 250px; color: white; background: #4CAF50; border: 1px solid #ddd">Picture</th>
                <th style="width: 250px; color: white; background: #4CAF50; border: 1px solid #ddd">Assignment</th>
                <th style="width: 350px; color: white; background: #4CAF50; border: 1px solid #ddd">Link</th>
                <th style="width: 150px; color: white; background: #4CAF50; border: 1px solid #ddd">Department</th>
            </tr>
            <?php while($row1 = mysqli_fetch_array($sqlClassesQuery1, MYSQLI_NUM)):;?>
            <tr>
                <td style ="border: 1px solid #ddd"><?php echo $row1[0];?></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[1];?></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[2];?></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[3];?></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[4];?></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[5];?></td>
            </tr>
            <?php endwhile;?>
        </table>

    </body>

</html>