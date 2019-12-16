<?php
//Get professor email
session_start();
$profEmail = $_SESSION['professorEmail'];
//echo $profEmail;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="profAdminCSS.css">
  </head>
  <body>
    <h1>Signed in as <?php echo $profEmail;?> </h1>


    <h2>Enter a class</h2>
    <form action="professorAdmin.php" method="post" enctype="multipart/form-data">
      <table style = "background: #4CAF50;">
          <tr>
            <td>Enter Course Code</td>
            <td><input type="text" name="CourseCode" id="CourseCode"></td>
          </tr>
          <tr>
            <td>Enter Course Title</td>
            <td><input type="text" name="CourseTitle" id="CourseTitle"></td>
          </tr>
          <tr>
            <td>Enter Image</td>
            <td><input type="file" name="Image" id="Image"></td>
          </tr>
          <tr>
            <td>Enter Assignment</td>
            <td><input type="file" name="Assignment" id="Assignment"></td>
          </tr>
          <tr>
            <td>Enter Link</td>
            <td><input type="text" name="Link" id="Link"></td>
          </tr>
          <tr>
            <td>Enter Department</td>
            <td><input type="text" name="Department" id="Department"></td>
          </tr>
          <tr>
              <td><input type="submit" value="Upload" name="submit" ></td>
            </tr>
        </table>
    </form>

    <br/>
    <?php include 'professorAdmin.php'?>
      <!--<script>
        function openForm() {
          var xmlCSE
          xmlCSE = new XMLHttpRequest();
          xmlCSE.open("GET", "professorAdmin.php?cc="+document.getElementById("CourseCode").value+
          "&ct="+document.getElementById("CourseTitle").value+
          "&ci="+document.getElementById("Image").value+
          "&ca="+document.getElementById("Assignment").value+
          "&cl"+document.getElementById("Link").value, false)
          xmlCSE.send(null);
        }
      </script>
    -->
  </body>
</html>
