<?php
if(empty($POST['username']) || empty($POST['password'])){
    $error = "Username or Password is invalid";
}

//When professor Login Button is clicked
if(isset($_POST['profLoginBtn'])){
    login();
}


function sanitizeStr($var){
    if(get_magic_quotes_gpc())
    {
        $var = stripslashes($var);
    }
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}
function sanitizeMySQL($connection, $var)
{
    $var = mysqli_real_escape_string($connection, $var);
    $var = sanitizeStr($var);
    return $var;
}
/*check username and password for db*/
function checkUserLogin($user, $pass)
{
    if (!$this->dblogin()) {
        $this->HandleError("db login failed");
        return false;
    }

    /*PHP has a built in sanitize option tho*/
    $user = $this->SanitizeForSQL($user);
    if (!$this->checkDBLogin($user, $pass))
    {
        return false;
    }
        return http_redirect("professorAdmin.html");
}
/*test function with all details already in there
* paramaters are user's info logging in from site
 */
function checkDBLogin($username, $password)
{
    $user = "";
    $pass = "";
    $dbn = "";
    $host = "";
    $conn = mysqli_connect($host, $user, $pass, $dbn);
    if(!$conn)
    {
        return false;
    }
    //$username = sanitizeStr($username);
    //$password = sanitizeStr($password);
    $qry = "SELECT `Email`, `Password` FROM `professors` WHERE Email = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $qry);
    if(!$result || mysqli_num_rows($result) <= 0)
    {
        $result->close();
        $conn->close();
        $this->HandleError("Username or password doesn't match");
        return false;
    }
        //$result->close();
        //$conn->close();
        return true;
}
/*actual login for user from site*/
function login()
{
    if (empty($_POST['username'])) {
        //$errorMessage = HandleError("Username is empty");
        //echo $errorMessage;
        return false;
    }
    if (empty($_POST['password'])) {
        //$errorMessage = HandleError("Password is empty");
        //echo $errorMessage;
        return false;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (checkDBLogin($username, $password))
    {
        return false;
    }else{
        echo "worked";
        //If the login works and finds the users
        //Create the session
        session_start();
        $_SESSION['professorEmail'] = $username;
        //Send the username to the professorAdminHome.php
        header('Location: professorAdminHome.php');
        exit();
    }
    /*
     * going to have to add some type of session management at some point
     * session_start();
     */
        return true;
}
?>
