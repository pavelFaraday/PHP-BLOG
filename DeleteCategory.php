<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>


<?php 
    if(isset($_GET["id"])) {
        $IdFromURL=$_GET["id"];

        global $Connection;
        $Query = "DELETE FROM category WHERE id='$IdFromURL'"; 
        $Execute = mysqli_query($Connection,$Query);
        if($Execute) {
            $_SESSION["Successmessage"]="Category Deleted Successfully";
            Redirect_to("Categories.php");
        }else {
            $_SESSION["ErrorMessage"]="Something Went Wrong!";
            Redirect_to("Categories.php");
        }
    }
?>