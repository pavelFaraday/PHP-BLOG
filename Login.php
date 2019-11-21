<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>


<?php
if(isset($_POST["Submit"])){
    $UserName=$_POST["Username"]; 
    $Password=$_POST["Password"]; 
    $ConfirmPassword=$_POST["ConfirmPassword"]; 
    
    date_default_timezone_set('Asia/Dubai');
    $CurrentTime=time(); 
    $DateTime=strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);   
    $DateTime;
    $Admin = "DevStudio"; // default admin
    if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]="All Fields must be field out";
        Redirect_to("Login.php");
    }elseif(strlen($Password)<4) {
        $_SESSION["ErrorMessage"]="Atleast 4 characters are Required for Password";
        Redirect_to("Login.php");
    }
    elseif($Password!==$ConfirmPassword) {
        $_SESSION["ErrorMessage"]="Passwords does't match!";
        Redirect_to("Login.php");
    }else {
        global $Connection;
        $Query = "INSERT INTO registration(datetime,username,password,addedby) VALUES('$DateTime','$UserName','$Password','$Admin')";
        $Execute = mysqli_query($Connection,$Query);
        if($Execute) {
            $_SESSION["Successmessage"]="Admin added Successfully";
            Redirect_to("Login.php");
        }else {
            $_SESSION["ErrorMessage"]="Admin failed to add";
            Redirect_to("Login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminstyles.css">
    <script src="js/all.js"></script>
    <title>Login</title>
</head>
<body id="Login_body">
<nav class="navbar navbar-inverse rounded-0" role="navigation">
            <div class="container">
                <div id="logo" class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="Blog.php">
                        <img src="img/logo44.png" alt="apple" width=25%;>
                    </a>
                </div>
            <div class="collapse navbar-collapse" id="collapse">
               
            </div>
            </div>
        </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <br><br><br><br>
                <div><?php 
                    echo message(); 
                    echo Successmessage();
                ?></div>
                <h2>Welcome Back :)</h1>
               
                <div>
                    <form action="Login.php" method="post">
                        <fieldset>
                          <div class="form-group">
                            <label for="username"><span class="FieldInfo">UserName:</span></label>
                            <input class="form-control" type="text" name="Username" id="username" placeholder="Username">
                          </div>
                          <div class="form-group">
                            <label for="password"><span class="FieldInfo">Password:</span></label>
                            <input class="form-control" type="password" name="Password" id="password" placeholder="Password">
                          </div>
                          <br>
                          <input class="btn btn-info btn-block" type="submit" name="Submit" value="Login">
                        </fieldset>
                        <br>
                    </form>
                </div>

            </div> <!--END Main Area-->
        </div> <!--END row-->
    </div> <!--END Main Container-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>