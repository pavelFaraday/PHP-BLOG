<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>

<?php
if(isset($_POST["Submit"])){
    $Title=$_POST["Title"]; 
    $Category=$_POST["Category"]; 
    $Post=$_POST["Post"]; 
    date_default_timezone_set('Asia/Dubai');
    $CurrentTime=time();
    $DateTime=strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $Admin = "DevStudio"; // default admin
    $Image = $_FILES["Image"]["name"];
    $Target="Upload/".basename($_FILES["Image"]["name"]); // target for save image in 'Upload' folder

        global $Connection;
        $DeleteFromURL=$_GET['Delete'];
        $Query = "DELETE FROM admin_panel WHERE id='$DeleteFromURL'";
        $Execute = mysqli_query($Connection,$Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target); // function for save image in 'Upload' folder
        if($Execute) {
            $_SESSION["Successmessage"]="Post Deleted Successfully";
            Redirect_to("dashboard.php");
        }else {
            $_SESSION["ErrorMessage"]="Something Went Wrong!";
            Redirect_to("dashboard.php");
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
    <title>Delete Post</title>
</head>
<body>
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
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="Blog.php">Blog</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact Us</a></li>
                    <li><a href="">Feature</a></li>
                </ul>
                <form action="Blog.php" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" name="Search" placeholder="Search">
                    </div>
                    <button id="search_button" class="btn btn-info" name="SearchButton">Search</button>
                </form>
            </div>
            </div>
        </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
            <img id="dashboard_logo" src="img/logo44.png" alt="logo">
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li><a href="dashboard.php"><i class="fas fa-th"></i>&nbsp;Dashboard</a></li>
                    <li class="active"><a href="AddNewPost.php"><i class="fas fa-plus-square"></i>&nbsp;Add New Post</a></li>
                    <li><a href="Categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a></li>
                    <li><a href="Admins.php"><i class="fas fa-user"></i>&nbsp;Manage Admins</a></li>
                    <li><a href="Comments.php"><i class="fas fa-comment-alt"></i>&nbsp;Comments</a></li>
                    <li><a href="Blog.php?Page=1" target=_blank><i class="fas fa-podcast"></i>&nbsp;Live Blog</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                </ul>
            </div> <!-- End Side Area-->

            <div class="col-sm-10">
                <h1>Delete Post</h1>
                <div><?php 
                    echo message(); 
                    echo Successmessage();
                ?></div>
                <div>
                <?php 
                    $SearchQueryParameter = $_GET['Delete'];
                    global $Connection;
                    $Query = "SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
                    $Execute = mysqli_query($Connection,$Query);
                    while ($row=mysqli_fetch_array($Execute)) {
                        $Title_To_Update=$row["title"]; 
                        $Category_To_Update=$row["category"]; 
                        $Image_To_Update=$row["image"]; 
                        $Post_To_Update=$row["post"]; 
                    }
                ?>

                    <form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                        <fieldset>
                          <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input disabled value="<?php echo $Title_To_Update; ?>" class="form-control" type="text" name="Title" id="title">
                          </div>

                          <div class="form-group">
                            <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
                            <span>(Existing Category: <?php echo $Category_To_Update; ?>)</span>
                            <select disabled name="Category" id="categoryselect" class="form-control">
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
                            <div><img src="Upload/<?php echo $Image_To_Update; ?>" width=200></div>
                            <label for="image"><span class="FieldInfo">Select Image:</span></label>
                            <input disabled  type="file" class="form-control" name="Image" id="image">
                          </div>
                          <div class="form-group">
                            <label for="postarea"><span class="FieldInfo">Post:</span></label>
                            <textarea disabled  cols="30" rows="10" class="form-control" name="Post" id="postarea">
                                <?php echo $Post_To_Update; ?>
                            </textarea>
                          <br>
                          <input class="btn btn-danger btn-block" type="submit" name="Submit" value="Delete Post">
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