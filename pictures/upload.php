<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();
require_login();

$user = Users::current_user();

$file_uploaded = False;
if (isset($_POST['tag']) && isset($_POST['name']) && isset($_FILES['pic']) && isset($_POST['price']) && isset($_POST['title']))
{
   if ($_POST['tag'] == "" || $_POST['name'] == "" || $_POST['price'] == "" || $_POST['title'] == "")
   {
      $flash['error'] = "Must include all fields";
   }
   else
   {
      $_POST['name'] = str_replace("..", "", $_POST['name']);
      $_POST['name'] = str_replace(" ", "", $_POST['name']);
      $_POST['name'] = str_replace("/", "", $_POST['name']);
      if (!file_exists("../upload/{$_POST['tag']}/"))
      {
	 	mkdir("../upload/{$_POST['tag']}", 0777, True);
      }
      $filename = "../upload/{$_POST['tag']}/{$_POST['name']}";
      $relfilename = "{$_POST['tag']}/{$_POST['name']}";
      if ($_POST['price'] < 0)
      {
	 $_POST['price'] = abs($_POST['price']);
      }
      if (file_exists($filename))
      {
	 $new_name = tempnam("../upload", $filename);
	 move_uploaded_file($_FILES['pic']['tmp_name'], $new_name);
	 $id = Pictures::add_conflict($filename, $new_name, $_POST['tag'], $_POST['title'], $_POST['price'], $user['id']);
	 http_redirect(Pictures::$CONFLICT_URL . "?conflictid={$id}");
      }
      else
      {
	 if (move_uploaded_file($_FILES['pic']['tmp_name'], $filename))
	 {
	    
	    if ($id = Pictures::create_picture($_POST['title'], 128, 128, $_POST['tag'], $relfilename, $_POST['price'], $user['id']))
	    {
	       $main = ".550.jpg";
	       $side = ".128.jpg";
	       $thumb= ".128_128.jpg";
	       Pictures::resize_image($filename, $filename . $main, 550, 10000000);
	       Pictures::resize_image($filename, $filename . $side, 128, 10000000);
	       Pictures::resize_image($filename, $filename . $thumb, 128, 128);
	       
	       http_redirect(Pictures::$VIEW_PIC_URL . "?picid={$id}");
	       $file_uploaded = True;
	    }
	    else
	    {
	       $flash['error'] = "Couldn't create your picture, something wrong with the database";
	    }
	 }
	 else
	 {
	    $flash['error'] = "Couldn't move picture";
	 }
      }
   }
}


if (!$file_uploaded)
{

   our_header("upload");
?>

<!--
		<h2> Upload a Picture! </h2>
		<?php error_message(); ?>
	
		<form enctype="multipart/form-data" action="<?=h( $_SERVER['PHP_SELF'] )?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
		   <div class="form-floating">
		   <input type="text" class="form-control" name="tag" style="" />
		   <label for="floatingInput">File Name</label>
		   </div>
		   <input type="text" class="form-control" name="name" />
		   <label for="floatingInput">Name</label>
		   
		   <input type="text" class="form-control" name="title" />
		   <label for="floatingInput">Title</label>
		   
		   <input type="text" class="form-control" name="price" />
		   <label for="floatingInput">Price</label>
		   
		   <input type="file" class="form-control" name="pic" />
		   <label for="floatingInput">File</label>
		   
		   <input type="submit" value="Upload File" />       
		</form>
-->

<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<main class="form-signin w-50 m-auto">
		  <form enctype="multipart/form-data" action="<?=h( $_SERVER['PHP_SELF'] )?>" method="POST">
		  	<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
		    <h1 class="h3 mb-3 fw-normal">Upload a Picture!</h1>
		    <?php error_message(); ?>

		    <div class="form-floating">
		      <input type="text" class="form-control" id="floatingInput" placeholder="File Name" name="name">
		      <label for="floatingInput">File Name</label>
		    </div>
		    <div class="form-floating">
		      <input type="text" class="form-control" id="floatingInput" placeholder="Title" name="title">
		      <label for="floatingInput">Title</label>
		    </div>
		    <div class="form-floating">
		      <input type="text" class="form-control" id="floatingInput" placeholder="File Name" name="tag">
		      <label for="floatingInput">Tag</label>
		    </div>
		    <div class="form-floating">
		      <input type="text" class="form-control" id="floatingInput" placeholder="Price" name="price">
		      <label for="floatingInput">Price</label>
		    </div>
		    <div class="form-floating">
		      <input type="file" class="form-control" id="floatingInput" name="pic">
		      <label for="floatingInput">File</label>
		    </div><br>
		    <div class="form-floating">
		    	<div class="btn-group">
		    		<button class="w-100 btn btn-lg btn-primary" type="submit">Upload</button>
		    	</div> 
		    </div>
		  </form><br>
		</main>
	</div>
</div>
</div>
</div>

<?php
    our_footer();
}
?>