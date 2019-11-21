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

    <title>Categories</title>
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
                    <li><a href="AddNewPost.php"><i class="fas fa-plus-square"></i>&nbsp;Add New Post</a></li>
                    <li class="active"><a href="Categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a></li>
                    <li><a href=""><i class="fas fa-user"></i>&nbsp;Manage Admins</a></li>
                    <li><a href="Comments.php"><i class="fas fa-comment-alt"></i>&nbsp;Comments
                    <?php 
                        global $Connection;
                        $AllCommnetQuery = "SELECT COUNT(*) FROM comments WHERE status='OFF'";
                        $AllCommnetExecute = mysqli_query($Connection,$AllCommnetQuery);
                        $AllCommnetrow=mysqli_fetch_array($AllCommnetExecute);
                        $AllCommnets=array_shift($AllCommnetrow);
                        if($AllCommnets>0) {
                    ?>
                        <span class="label label-warning pull-right"><?php echo $AllCommnets; ?></span>
                                 <?php } ?>
                    </a></li>
                    <li><a href="#"><i class="fas fa-podcast"></i>&nbsp;Live Blog</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                </ul>
            </div> <!-- End Side Area-->

            <div class="col-sm-10">
                <h1>Manage Categories</h1>
                <div><?php 
                    echo message(); 
                    echo Successmessage();
                ?></div>
                <div>
                    <form action="Categories.php" method="post">
                        <fieldset>
                          <div class="form-group">
                            <label for="categoryname"><span class="FieldInfo">Name:</span></label>
                            <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
                          </div>
                          <br>
                          <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Add New Category">
                        </fieldset>
                        <br>
                    </form>
                </div>

                <div class="">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sr No.</th>
                            <th>Date & Time</th>
                            <th>Category Name</th>
                            <th>Creator Name</th>
                        </tr>
                        <?php 
                            global $Connection;
                            $ViewQuery = "SELECT * FROM category ORDER by datetime desc";
                            $Execute = mysqli_query($Connection,$ViewQuery);
                            
                            $SrNo=0;
                            while ($row=mysqli_fetch_array($Execute)) {
                                $Id=$row["id"];
                                $DateTime=$row["datetime"];   
                                $CategoryName=$row["name"]; 
                                $CreatorName=$row["creatorname"]; 
                                $SrNo++;                          
                        ?>
                        <tr>
                            <td><?php echo $SrNo ?></td>
                            <td><?php echo $DateTime ?></td>
                            <td><?php echo $CategoryName ?></td>
                            <td><?php echo $CreatorName ?></td>
                        </tr>
                        <?php } ?>
                    </table>
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