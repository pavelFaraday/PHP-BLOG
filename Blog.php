<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/publicstyles.css">
    <title>Blog | Main</title>
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
        <div class="Blog-header">
            <h1>PHP CMS Blog</h1>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?php 
                    global $Connection;
                    // Query when search button is active
                    if(isset($_GET["SearchButton"])) {
                        $Search=$_GET["Search"];
                        $ViewQuery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' 
                        OR title LIKE '%$Search%'
                        OR category LIKE '%$Search%' 
                        OR post LIKE '%$Search%' ";
                    // Query when category is active
                    }elseif(isset($_GET["Category"])) {
                        $Category=$_GET["Category"];
                        $ViewQuery = "SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime desc";
                    }
                    // Query When Pagination is active i.e Blog.php?Page=1
                     elseif(isset($_GET["Page"])){
                        $Page = $_GET["Page"];
                        if($Page==0||$Page<0){
                            $ShowPostFrom=0;
                        } else { 
                        $ShowPostFrom = ($Page*5)-5;
                        }
                        $ViewQuery = "SELECT * FROM Admin_panel ORDER BY datetime desc LIMIT $ShowPostFrom,5";
                    // The default query for Blog.php
                    } else {
                        $ViewQuery = "SELECT * FROM Admin_panel ORDER BY datetime desc LIMIT 0,2"; }
                        $Execute = mysqli_query($Connection,$ViewQuery);
                        while ($row=mysqli_fetch_array($Execute)) {
                            $PostId=$row["id"];
                            $DateTime=$row["datetime"];  
                            $Title=$row["title"]; 
                            $Category=$row["category"];
                            $Admin=$row["author"];
                            $Image=$row["image"];
                            $Post=$row["post"];
                ?>
                <div class="blogpost thumbnail">
                    <img class="img-responsive img-rounded" src="Upload/<?php echo $Image ?>" alt="">
                    <div class="caption">
                        <h1 id="heading"><?php echo htmlentities($Title)?></h1>
                        <p class="description">
                        Category: <?php echo htmlentities($Category); ?> 
                        <span id="devider">|</span> 
                        Published on <?php echo htmlentities($DateTime); ?>
                        </p>
                        <p class="post"><?php 
                        if(strlen($Post)>280) {$Post=substr($Post,0,280).'...';}
                        echo $Post; ?></p>
                    </div>
                    <a href="FullPost.php?id=<?php echo $PostId; ?>"><button class="btn btn-info">Read More &rsaquo;&rsaquo;</button></a>
                </div>
                    <?php } ?>

                    <nav>
                        <ul class="pagination pull-left">
                        <!-- Creating Backward Button -->
                        <?php
                        if(isset($Page)) {
                            if($Page>1){
                            ?> 
                            <li><a href="Blog.php?Page=<?php echo $Page-1; ?>">&laquo;</a></li>   
                            <?php } 
                        } ?> 
                    <?php 
                        global $Connection;
                        $QueryPagination = "SELECT COUNT(*) FROM admin_panel";
                        $ExecutePagination = mysqli_query($Connection,$QueryPagination);
                        $rowPagination = mysqli_fetch_array($ExecutePagination);
                            $TotalPosts = array_shift($rowPagination);
                            $PostsPagination = $TotalPosts/5;
                            $PostsPagination = ceil($PostsPagination);
                            
                            for ($i=1; $i<=$PostsPagination; $i++) { 
                              if(isset($Page)) {
                                if($i==$Page) {
                    ?>    
                            <li class="active"><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                } else { ?>
                            <li><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                           <?php }
                             }
                        } ?>
                      <!-- Creating Forward Button -->
                    <?php
                        if(isset($Page)) {
                            if($Page+1<=$PostsPagination){
                            ?> 
                            <li><a href="Blog.php?Page=<?php echo $Page+1; ?>">&raquo;</a></li>   
                            <?php } 
                        } ?> 
                            </ul>
                        </nav>

            </div>
            <div class="col-sm-4">
                <h2>About Us</h2>
                <img class="img-responsive" src="img/about-us.jpg" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero repudiandae corrupti quam molestiae magnam nam omnis expedita, eum quia explicabo eius. Totam odit ratione illum! Suscipit, eos rerum nulla alias veniam similique dolor repudiandae vel aliquid? Eos illum obcaecati inventore ratione quisquam laudantium? Ab ducimus nam inventore enim deleniti voluptas alias mollitia. Architecto, qui officiis illo, facere asperiores labore ipsum unde fugit accusantium ducimus reiciendis incidunt dignissimos? Quod, tenetur repellat.</p>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Categories</h2>
                    </div>
                    <div class="panel-body background">
                        <?php 
                        global $Connection;
                        $ViewQuery = "SELECT * FROM category ORDER BY datetime desc"; 
                            $Execute = mysqli_query($Connection,$ViewQuery);
                            while ($row=mysqli_fetch_array($Execute)) {
                                $Id=$row["id"];
                                $Category=$row["name"];
                        ?>
                        <a href="Blog.php?Category=<?php echo $Category; ?>"><span id="heading"><?php echo $Category."<br>"; ?></span></a>
                        <?php } ?>
                    </div>
                    <div class="panel-footer">
                    
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Recent Posts</h2>
                    </div>
                    <div class="panel-body">
                        <?php 
                             global $Connection;
                             $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
                             $Execute = mysqli_query($Connection,$ViewQuery);
                             while ($row=mysqli_fetch_array($Execute)) {
                                 $Id=$row["id"];
                                 $Title=$row["title"];
                                 $DateTime=$row["datetime"];
                                 $Image=$row["image"];  
                                 if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,11);}
                        ?>

                        <div>
                            <img id="img-panel" class="pull-left" src="Upload/<?php echo $Image; ?>" width=90;>
                            <a href="FullPost.php?id=<?php echo $Id; ?>">
                               <p id="heading" style="margin-left:150px;"><?php echo htmlentities($Title); ?></p>
                               <p class="description" style="margin-left:150px;"><?php echo htmlentities($DateTime); ?></p>
                            </a>
                            <hr>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="panel-footer">
                    
                    </div>
                </div>

            </div>
        </div>
    </div>
  

    <div id="footer">
        <p>Theme by Devstudio  |  &copy;2018-2019  |  All rights reserved</p>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>