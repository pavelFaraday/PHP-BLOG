<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>



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

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-2">
            <h1 id="logo_Dash"><i class="fas fa-tree"></i>  Bonsai</h1>
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="Dashboard.php"><i class="fas fa-th"></i>&nbsp;Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-plus-square"></i>&nbsp;Add New Post</a></li>
                    <li><a href="Categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a></li>
                    <li><a href="#"><i class="fas fa-user"></i>&nbsp;Manage Admins</a></li>
                    <li><a href="#"><i class="fas fa-comment-alt"></i>&nbsp;Comments</a></li>
                    <li><a href="#"><i class="fas fa-podcast"></i>&nbsp;Live Blog</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                </ul>
            </div> <!-- End Side Area-->

            <div class="col-sm-10">
                <h1>Admin Dashboard</h1>
                <div><?php 
                    echo message(); 
                    echo Successmessage();
                ?></div>
               
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
                <h4>About</h4>
                <p>Lorem ipsum <em>dolor sit amet consectetur</em> adipisicing elit. Quae corporis officia maiores amet at, tempore sed quidem ratione fuga architecto, magni, molestiae officiis quis animi ipsum quia pariatur exercitationem illo.</p>
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