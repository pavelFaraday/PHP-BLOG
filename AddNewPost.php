<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>


<?php
if(isset($_POST["Submit"])){
    $Category=$_POST["Category"]; 
    date_default_timezone_set('Asia/Dubai');
    $CurrentTime=time(); 
    $DateTime=strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);   
    $DateTime;
    $Admin = "DevStudio"; // default admin
    if(empty($Category)){
        $_SESSION["ErrorMessage"]="Field must be field out";
        Redirect_to("Categories.php");
    }elseif(strlen($Category)>99) {
        $_SESSION["ErrorMessage"]="Too long name for Category";
        Redirect_to("Categories.php");
    }else {
        global $Connection;
        $Query = "INSERT INTO category(datetime,name,creatorname) VALUES('$DateTime','$Category','$Admin')";
        $Execute = mysqli_query($Connection,$Query);
        if($Execute) {
            $_SESSION["Successmessage"]="Category added Successfully";
            Redirect_to("Categories.php");
        }else {
            $_SESSION["ErrorMessage"]="Category failed to add";
            Redirect_to("Categories.php");
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

    <title>Add New Post</title>
</head>
<body>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-2">
            <h1 id="logo_Dash"><i class="fas fa-tree"></i>  Bonsai</h1>
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li><a href="dashboard.php"><i class="fas fa-th"></i>&nbsp;Dashboard</a></li>
                    <li class="active"><a href="AddNewPost.php"><i class="fas fa-plus-square"></i>&nbsp;Add New Post</a></li>
                    <li><a href="Categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a></li>
                    <li><a href=""><i class="fas fa-user"></i>&nbsp;Manage Admins</a></li>
                    <li><a href="#"><i class="fas fa-comment-alt"></i>&nbsp;Comments</a></li>
                    <li><a href="#"><i class="fas fa-podcast"></i>&nbsp;Live Blog</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                </ul>
            </div> <!-- End Side Area-->

            <div class="col-sm-10">
                <h1>Add New Post</h1>
                <div><?php 
                    echo message(); 
                    echo Successmessage();
                ?></div>
                <div>
                    <form action="Categories.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                          <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input class="form-control" type="text" name="Title" id="title" placeholder="Title">
                          </div>

                          <div class="form-group">
                            <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
                            <select name="Category" id="categoryselect" class="form-control">
                            <?php 
                                global $Connection;
                                $ViewQuery = "SELECT * FROM category ORDER by datetime desc";
                                $Execute = mysqli_query($Connection,$ViewQuery);
                                while ($row=mysqli_fetch_array($Execute)) {
                                    $Id=$row["id"]; 
                                    $CategoryName=$row["name"];                        
                            ?>
                                 <option><?php echo $CategoryName; ?></option>
                                 <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="image"><span class="FieldInfo">Select Image:</span></label>
                            <input type="file" class="form-control" name="Image" id="image">
                          </div>
                          <div class="form-group">
                            <label for="postarea"><span class="FieldInfo">Post:</span></label>
                            <textarea class="form-control" name="Post" id="postarea"></textarea>
                          <br>
                          <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Add New Post">
                        </fieldset>
                        <br>
                    </form>
                </div>

            </div> <!--END Main Area-->
        </div> <!--END row-->
    </div> <!--END Main Container-->

    <div id="footer">
        <p>Theme by Devstudio  |  &copy;2018-2019  |  All rights reserved</p>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>