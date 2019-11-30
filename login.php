<?php
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
    $username = sanitizeStr($username);
    $password = sanitizeStr($password);
    $qry = "SELECT username, password FROM users WHERE username === '$username' AND password === '$password'";
    $result = mysqli_query($conn, $qry);
    if(!$result || mysqli_num_rows($result) <= 0)
    {
        $result->close();
        $conn->close();
        $this->HandleError("Username or password doesn't match");
        return false;
    }
        $result->close();
        $conn->close();
        return true;
}
/*actual login for user from site*/
function login()
{
    if (empty($_POST['username'])) {
        $this->HandleError("Username is empty");
        return false;
    }
    if (empty($_POST['password'])) {
        $this->HandleError("password is empty");
    }
    $username = sanitizeStr($_POST['username']);
    $password = sanitizeStr($_POST['password']);
    if (!$this->checkDBLogin($username, $password))
    {
        return false;
    }
    /*
     * going to have to add some type of session management at some point
     * session_start();
     */
        return true;
}
?>
