<?php


//Get professor email
//session_start();
$profEmail = $_SESSION['professorEmail'];
//echo $profEmail;


//Create MySQL Connection
$conn =new mysqli('localhost','root','' );

//Connect to the Project Database
$selectedalreadycreateddatabase = mysqli_select_db($conn, "project");

//If the database exists
/*
if($selectedalreadycreateddatabase){
    echo "Existing database selected success";
}else{
    echo "Existing database selected not success";
}*/


//Classes Table Query
$query = "SELECT * FROM `courses` INNER JOIN `profclasses` ON courses.CourseCode = profclasses.CourseCode WHERE profClasses.ProfEmail = '$profEmail'";
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
    if($_FILES['Image']['error']>0){
        echo "Error: " . $_FILES['Image']['error'];
    } else{
        echo "File Name: " . $_FILES["Image"]["name"] . "<br>";
        echo "File Type: " . $_FILES["Image"]["type"] . "<br>";
        echo "File Size: " . ($_FILES["Image"]["size"] / 1024) . " KB<br>";
        echo "Stored in: " . $_FILES["Image"]["tmp_name"];
    }
    if($_FILES['Assignment']['error']>0){
        echo "Error: " . $_FILES['Assignment']['error'];
    } else{
        echo "File Name: " . $_FILES["Assignment"]["name"] . "<br>";
        echo "File Type: " . $_FILES["Assignment"]["type"] . "<br>";
        echo "File Size: " . ($_FILES["Assignment"]["size"] / 1024) . " KB<br>";
        echo "Stored in: " . $_FILES["Assignment"]["tmp_name"];
    }
    $CourseCode=$_POST['CourseCode'];
    $CourseTitle=$_POST['CourseTitle'];
    $CourseImageName=$_FILES['Image']['name'];
    $CourseImageType=$_FILES['Image']['type'];
    $CourseImageContent=$_FILES['Image']['tmp_name'];
    $CourseAssignmentName=$_FILES['Assignment']['name'];
    $CourseAssignmentType=$_FILES['Assignment']['type'];
    $CourseAssignmentContent=$_FILES['Assignment']['tmp_name'];
    $CourseLink=$_POST['Link'];
    $CourseDepartment = $_POST['Department'];

    
    //Insert Course into database
    $sqlInsertCourse = "INSERT INTO `Courses`(`CourseCode`, `CourseTitle`, `PictureName`, `PictureContent`, `PictureType`, `AssignmentsName`, `AssignmentsContent`, `AssignmentsType`, `Links`, `Department`) VALUES ('$CourseCode', '$CourseTitle', '$CourseImageName', '$CourseImageContent', '$CourseImageType', '$CourseAssignmentName','$CourseAssignmentContent', '$CourseAssignmentType', '$CourseLink', '$CourseDepartment')";
    $result = mysqli_query($conn, $sqlInsertCourse);
    echo mysqli_error($conn);
    
    //Insert that the professor has this course
    //Have to implement it to find the professor using the session
    $sqlInsertProfessor = "INSERT INTO `profclasses`(`CourseCode`, `ProfEmail`) VALUES ('$CourseCode', '$profEmail')";

    
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

    //header("Location: ./professorAdminHome.php");

}


?>

<html>
    <head>
    </head>
    <body>
    <table>
        <h2>My Classes</h2>
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
                <td style ="border: 1px solid #ddd"><a target='_blank' href = "view.php?id=".$row[0].><?php echo $row1[2];?></a></td>
                <td style ="border: 1px solid #ddd"><a target='_blank' href = '"$row1[7]."'><?php echo $row1[5];?></a></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[8];?></td>
                <td style ="border: 1px solid #ddd"><?php echo $row1[9];?></td>
            </tr>
            <?php endwhile;?>
        </table>

    </body>

</html>