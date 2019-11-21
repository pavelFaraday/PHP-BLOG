<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>

<?php 
    function Redirect_to($New_Location) {
        header("Location:".$New_Location);
        exit;
    }

    function Login_Attempt($UserName,$Password) {
        global $Connection;
            $Query = "SELECT * FROM registration WHERE username='$UserName' AND password='$Password'";
            $Execute = mysqli_query($Connection,$Query);
            if($admin=mysqli_fetch_assoc($Execute)) {
                return $admin;
            } else {
                return null;
            }
    }
?>