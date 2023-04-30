<?php

require_once("include/html_functions.php");
require_once("include/guestbook.php");

if (isset($_POST["name"]) && isset($_POST["comment"]))
{
   if ($_POST['name'] == "" || $_POST['comment'] == "")
   {
      $flash['error'] = "Must include both the name and comment field!";
   }
   else
   {
      $res = Guestbook::add_guestbook($_POST["name"], $_POST["comment"], False);
      if (!$res)
      {
	 die(mysql_error());
      }      
   }
}

$guestbook = Guestbook::get_all_guestbooks();
?>

<?php our_header("guestbook"); ?>


<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<h1 class="h1 mb-3 fw-normal">Guestbook</h2>
		<?php error_message(); ?>
		<h2 class="fs-3 text-center">See what people are saying about us!</h3>

		<?php
		   if ($guestbook)
		   { 
		     foreach ($guestbook as $guest)
		     {
			?>
			<p class="comment"><?= $guest["comment"] ?></p>
			<p> - by <?=h( $guest["name"] ) ?> </p>
			<?php
		     } ?>
		<?php
		   }
		?>


		<main class="w-50 m-auto">
			<form action="<?=h( Guestbook::$GUESTBOOK_URL )?>" method="POST">
		    <h1 class="h3 mb-3 fw-normal">Feedback</h1>

		    <div class="form-floating">
		      <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name">
		      <label for="floatingInput">Name</label>
		    </div>
		    <div class="form-floating">
		      <textarea class="form-control" name="comment" placeholder="Feedback" name="comment"></textarea>
		      <label for="floatingPassword">Your Feedback</label>
		    </div><br>
		    <div class="form-floating">
		    	<div class="btn-group">
		    		<button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
		    	</div> 
		    </div>
		  </form>
		</main>

		<!-- <form action="<?=h( Guestbook::$GUESTBOOK_URL )?>" method="POST">
		   Name: <br>
		   <input type="text" name="name" /><br>
		   Comment: <br>
		   <textarea id="comment-box" name="comment"></textarea> <br>
		   <input type="submit" value="Submit" />
		</form> -->
	</div>
</div>
</div>
</div>

<?php
   our_footer();
?>