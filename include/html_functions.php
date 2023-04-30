<?php

require_once("users.php");
require_once("functions.php");
session_start();

function our_header($selected = "", $search_terms = "")
{

   ?>
<html>
  <head>
    <link rel="stylesheet" href="/css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="/css/blueprint/print.css" type="text/css" media="print">
    <!--[if IE]><link rel="stylesheet" href="/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" href="/css/stylings.css" type="text/css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>WackoPicko - The Web App</title>
  </head>
  <body>


  	<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/index.php" class="d-flex align-items-center mb-2 mb-lg-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img"><use xlink:href="/images/logo.png"/></svg>
        <span class="fs-4">WackoPicko - The Web App</span>
      </a>

      <ul class="nav nav-pills justify-content-center">
        <li class="nav-item <?php if($selected == "home"){ echo 'active'; } ?>"><a href="/index.php" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item <?php if($selected == "upload"){ echo 'active'; } ?>"><a href="/pictures/upload.php" class="nav-link">Upload</a></li>
        <li class="nav-item <?php if($selected == "guestbook"){ echo 'active'; } ?>"><a href="/guestbook.php" class="nav-link">Guestbook</a></li>
        <?php if (Users::is_logged_in()) { ?>
        <li class="nav-item <?php if($selected == "recent"){ echo 'active'; } ?>"><a href="/pictures/marketplace.php" class="nav-link">Marketplace</a></li>
        <li class="nav-item <?php if($selected == "cart"){ echo 'active'; } ?>"><a href="/cart/review.php" class="nav-link">Cart</a></li><?php } ?>
        <li class="nav-item <?php if($selected == "guestbook"){ echo 'active'; } ?>"><a href="/users/home.php" class="nav-link">User Home</a></li>
        </ul>

        <form action="/pictures/search.php" method="get" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input id="query2" name="query" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
        	<?php if (Users::is_logged_in()){ ?>
        	<a href="/users/logout.php"> <button type="button" class="btn btn-danger me-2">Logout</button> </a>
          <a href="/users/update.php"> <button type="button" class="btn btn-outline-primary me-2">Update Info</button> </a>
        	<?php } else { ?>
        	<a href="/users/login.php"><button type="button" class="btn btn-primary">Login</button></a>
        	<a href="/users/register.php"><button type="button" class="btn btn-primary">Register</button></a>
        	<?php } ?>
      	</div>
        </header>

        </div>
    

   <?php
}

function our_admin_header($selected = "", $search_terms = "")
{

   ?>
<html>
  <head>
    <link rel="stylesheet" href="/css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="/css/blueprint/print.css" type="text/css" media="print">
    <!--[if IE]><link rel="stylesheet" href="/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" href="/css/stylings.css" type="text/css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>WackoPicko - The Web App</title>
  </head>
  <body>


    <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/index.php" class="d-flex align-items-center mb-2 mb-lg-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img"><use xlink:href="/images/logo.png"/></svg>
        <span class="fs-4">WackoPicko - The Web App</span>
      </a>

      <ul class="nav nav-pills justify-content-center">
        <li class="nav-item <?php if($selected == "home"){ echo 'active'; } ?>"><a href="/index.php" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item <?php if($selected == "upload"){ echo 'active'; } ?>"><a href="/pictures/upload.php" class="nav-link">Upload</a></li>
        <li class="nav-item <?php if($selected == "guestbook"){ echo 'active'; } ?>"><a href="/guestbook.php" class="nav-link">Guestbook</a></li>
        <?php if (Users::is_logged_in()) { ?>
        <li class="nav-item <?php if($selected == "recent"){ echo 'active'; } ?>"><a href="/pictures/marketplace.php" class="nav-link">Marketplace</a></li>
        <li class="nav-item <?php if($selected == "cart"){ echo 'active'; } ?>"><a href="/cart/review.php" class="nav-link">Cart</a></li><?php } ?>
        <li class="nav-item <?php if($selected == "guestbook"){ echo 'active'; } ?>"><a href="/users/home.php" class="nav-link">User Home</a></li>
        </ul>

        <form action="/pictures/search.php" method="get" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input id="query2" name="query" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <?php if (Admins::is_logged_in()){ ?>
          <a href="/admin/logout.php"> <button type="button" class="btn btn-danger me-2">Logout</button> </a>
          <a href="/admin/update.php"> <button type="button" class="btn btn-outline-primary me-2">Update Info</button> </a>
          <?php } else { ?>
          <!-- <a href="/users/login.php"><button type="button" class="btn btn-primary">Login</button></a>
          <a href="/users/register.php"><button type="button" class="btn btn-primary">Register</button></a> -->
          <?php } ?>
        </div>
        </header>

        </div>
    

   <?php
}

function error_message()
{
   global $flash;
   if ($flash['error'])
   {
      ?>
<p class="span-10 error">
	 <?= h($flash['error']) ?>
</p>
      <?php
   }
}

function our_footer()
{
   ?>
       <!--<div class="column span-24 first last" id="footer" >
	<ul>
	  <li><a href="/">Home</a> |</li>
          <li><a href="/admin/index.php?page=login">Admin</a> |</li>
	  <li><a href="mailto:contact@wackopicko.com">Contact</a> |</li>
	  <li><a href="/tos.php">Terms of Service</a></li>
	</ul>
      </div>-->
    </div>
    
  </body>
</html>
   <?php

}

function thumbnail_pic_list($pictures, $high_quality = False)
{
   ?>


<div class="column prepend-1 first last" style="margin-bottom: 2em;">
      <?php if ($pictures) { ?>
<ul class="thumbnail-pic-list">
<?php
   for ($i = 0; $i < count($pictures); $i++)
   {
      $link_to = '';
      if (!$high_quality)
      {
        $link_to = Pictures::$VIEW_PIC_URL . "?";
      }
      else
      {
        $link_to = Pictures::$HIGH_QUALITY_URL . "?";
      }
      $pic = $pictures[$i];
      if ($i != 0 && (($i % 4) == 0))
      {
	 ?>
</ul>
</div>


<div class="column prepend-1 first last" style="margin-bottom: 2em;">
<ul class="thumbnail-pic-list">
	 <?php
      }
$link_to = $link_to . "picid=" . $pic['id'];
if ($high_quality)
{
  $link_to = $link_to . "&key=" . urlencode($pic['high_quality']);
}
?>
<li>
<a href="<?=h($link_to) ?>"><img src="/upload/<?=h( $pic['filename']) ?>.128_128.jpg" height="128" width="128" /></a>
</li>
<?php

   }
?>
<?php }
   else { ?>
<h3 class="error">No pictures here...</h3>


<?php } ?>
</ul>
</div>

<?php
}

function high_quality_item_link($item)
{
   $name = url_origin($_SERVER);
   $high_quality_encoded = urlencode($item['high_quality']);
   $link = $name . Pictures::$HIGH_QUALITY_URL . "?picid={$item['id']}&key={$high_quality_encoded}";
   return "<a href='{$link}'>{$link}</a>";
}


?>