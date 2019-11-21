<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminstyles.css">
    <script src="js/all.js"></script>

    <title>Admin Dashboard</title>
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
                    <li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
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
                    <li class="active"><a href="Dashboard.php"><i class="fas fa-th"></i>&nbsp;Dashboard</a></li>
                    <li><a href="AddNewPost.php"><i class="fas fa-plus-square"></i>&nbsp;Add New Post</a></li>
                    <li><a href="Categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a></li>
                    <li><a href="#"><i class="fas fa-user"></i>&nbsp;Manage Admins</a></li>
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
            </div>
            <!-- End Side Area-->


            <!--Main area-->
            <div class="col-sm-10">
            <div><?php 
                echo message(); 
                echo Successmessage();
            ?></div>
                <h1>Admin Dashboard</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Post Title</th>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>

                        <?php 
                            global $Connection;
                            $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc";
                            $Execute = mysqli_query($Connection,$ViewQuery);
                            $SrNo = 0;
                            while ($row=mysqli_fetch_array($Execute)) {
                                $Id=$row["id"];
                                $DateTime=$row["datetime"];  
                                $Title=$row["title"]; 
                                $Category=$row["category"];
                                $Admin=$row["author"];
                                $Image=$row["image"];
                                $Post=$row["post"];
                                $SrNo++;
                        ?>

                        <tr>
                            <td><?php echo $SrNo; ?></td>
                            <td id="title_style">
                            <?php
                                if(strlen($Title)>18) {$Title=substr($Title,0,18).'..';}
                                echo $Title; 
                            ?></td>
                            <td><?php
                                if(strlen($DateTime)>11) {$DateTime=substr($DateTime,0,11).'..';}
                                echo $DateTime; 
                            ?></td>
                            <td><?php echo $Admin; ?></td>
                            <td><?php echo $Category; ?></td>
                            <td><img src="Upload/<?php echo $Image; ?>" width="100"></td>
                            <td>  
                                <?php 
                                    global $Connection;
                                    $CommnetQuery = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
                                    $CommnetExecute = mysqli_query($Connection,$CommnetQuery);
                                    $Commnetrow=mysqli_fetch_array($CommnetExecute);
                                    $Total=array_shift($Commnetrow);
                                    if($Total>0) {
                                ?>
                                    <span class="label label-success pull-right"><?php echo $Total; ?></span>
                                    <?php } ?>

                                <?php 
                                    global $Connection;
                                    $UnCommnetQuery = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
                                    $UnCommnetExecute = mysqli_query($Connection,$UnCommnetQuery);
                                    $UnCommnetrow=mysqli_fetch_array($UnCommnetExecute);
                                    $UnTotal=array_shift($UnCommnetrow);
                                    if($UnTotal>0) {
                                ?>
                                    <span class="label label-danger pull-left"><?php echo $UnTotal; ?></span>
                                    <?php } ?>
                            </td>
                            <td>
                                <a href="EditPost.php?Edit=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>  
                                <a href="DeletePost.php?Delete=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>  
                            </td>
                           <td> <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                        </tr>
                            <?php } ?>
                    </table>
                </div>

            </div> <!--END Main Area-->
        </div> <!--END row-->
    </div> <!--END Main Container_fluid-->

    <div id="footer">
        <p>Theme by Devstudio  |  &copy;2018-2019  |  All rights reserved</p>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>