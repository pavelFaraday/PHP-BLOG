<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>


<?php 
    if(isset($_GET["id"])) {
        $IdFromURL=$_GET["id"];

        global $Connection;
        $Query = "DELETE FROM comments WHERE id='$IdFromURL'"; 
        $Execute = mysqli_query($Connection,$Query);
        if($Execute) {
            $_SESSION["Successmessage"]="Comment Deleted Successfully";
            Redirect_to("Comments.php");
        }else {
            $_SESSION["ErrorMessage"]="Something Went Wrong!";
            Redirect_to("Comments.php");
        }
    }
?>