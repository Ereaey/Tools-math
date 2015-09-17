<?php
session_start();
if (isset($_GET['l']))
{
    $_SESSION['langue'] = $_GET['l'];
}
if (!isset($_SESSION['langue']))
{
    $_SESSION['langue'] = 'fr';
}

if ($_SESSION['langue'] == 'en')
{
    $text_header = array("French", "English", "Equations", "Lois", "Khi 2", "Statisctics series",
    "Documentation", "Binomial distribution", "Normal distribution", "Uniform distribution", "Poisson distribution");
}
else if ($_SESSION['langue'] == 'fr')
{
    $text_header = array("Francais", "Anglais", "Equations", "Lois", "Khi 2", "Series statistiques",
    "Documentation", "Loi Binomial", "Loi Normal", "Loi Uniforme", "Loi Poisson");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tools Math</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .marge 
    {
        margin-left: 15px;
    }
    </style>
       <script type="text/javascript">
   <!--
   // Create a namespace to hold variables and functions
   mimetex = new Object();
   // Change this to use your server
  mimetex.imgSrc = "http://tools-math.com/maths/cgi-bin/mimetex.cgi?";
   // Transform the whole document: add src to each img with
   // alt text starting with "mimetex:", unless img already has a src.
   mimetex.init = function () {
       if (! document.getElementsByTagName) return;
       var objs = document.getElementsByTagName("img");
       var len  = objs.length;
       for (i=0; i<len; i++) {
          var img = objs[i];
          if (img.alt.substring(0,8) == 'mimetex:')
             if (!img.src) {
                var tex_src = img.alt.substring(8);
                img.src = mimetex.imgSrc + encodeURIComponent(tex_src);
                // Append TEX to the class of the IMG.
                img.className +=' tex'; }
          }
       mimetex.hideElementById("mimetex.error"); }
   // Utility function
   mimetex.hideElementById = function (id) {
       var obj = document.getElementById(id);
       if (obj) obj.style.display = 'none'; }
   // resolve a cross-browser issue (see CBS events)
   mimetex.addEvent = function (obj, evType, fn, useCapture) {
       if (obj.addEventListener) { //For Mozilla.
           obj.addEventListener(evType, fn, useCapture);
           return true; }
       else if (obj.attachEvent) { //For Internet Explorer.
           var r = obj.attachEvent("on"+evType, fn);
           return r; }
       }
   // Initialize after entire document is loaded
   mimetex.addEvent(window, 'load', mimetex.init, false);
   -->
   </script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Tools Math</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-flag fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?l=fr"><i class="fa fa-gear fa-fw"></i><?php echo $text_header[0]; ?></a>
                        </li>
                        <li><a href="?l=en"><i class="fa fa-gear fa-fw"></i><?php echo $text_header[1]; ?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-gears fa-fw"></i><?php echo $text_header[2]; ?></a>
                        </li>
                        <li>
                            <a href="lois.php"><i class="fa fa-gears fa-fw"></i><?php echo $text_header[3]; ?></a>
                        </li>
                        <li>
                            <a href="khi2.php"><i class="fa fa-table fa-fw"></i><?php echo $text_header[4]; ?></a>
                        </li>
                        <li>
                            <a href="series.php"><i class="fa fa-table fa-fw"></i><?php echo $text_header[5]; ?></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i><?php echo $text_header[6]; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="doc_equation.php"><?php echo $text_header[2]; ?></a>
                                </li>
                                <li>
                                    <a href="doc_loi_b.php"><?php echo $text_header[7]; ?></a>
                                </li>
                                <li>
                                    <a href="doc_loi_n.php"><?php echo $text_header[8]; ?></a>
                                </li>
                                <li>
                                    <a href="doc_loi_u.php"><?php echo $text_header[9]; ?></a>
                                </li>
                                <li>
                                    <a href="doc_loi_p.php"><?php echo $text_header[10]; ?></a>
                                </li>
                                <li>
                                    <a href="doc_khi2.php"><?php echo $text_header[4]; ?></a>
                                </li>
                                <li>
                                    <a href="doc_series.php"><?php echo $text_header[5]; ?></a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->