<?php

require_once("../include/pictures.php");
require_once("../include/comments.php");
require_once("../include/cart.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();
require_login();

// load all the variables I'll need
$no_pic = False;
if (isset($_GET["picid"]))
{
   $pic = Pictures::get_picture($_GET["picid"]);
   if (!$pic)
   {
      $no_pic = True;
   }
   else
   {
      $comments = Comments::get_all_comments_picture($pic['id']);
      $related = Pictures::get_some_pictures_by_tag($pic['tag'], $pic['id'], 2);
      $same = Pictures::get_some_pictures_by_user($pic['user_id'], $pic['id'], 2);
   }
}
else
{
   $no_pic = True;
}

if ($no_pic)
{
   error_404();
}

?>

<?php our_header(); ?>

<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		   <h2 id="image-title"><?=h( $pic['title'] )?> </h2>
			<img id="image" src="../upload/<?=h( $pic['filename'] )?>.550.jpg" width="550" />
			
			<div class="container-fluid" id="comments">
				  <div class="column span-14 first last">
				    <h2 id="comment-title">Comments</h2>
				  </div>
			   <?php if ($comments) {
			   foreach ($comments as $comment) {  ?>
				  <div class="column prepend-1 span-12 first last">
				    <p class="comment"><?= $comment['text'] ?></p>
				  </div>
				  <div class="column prepend-10 span-6 first last">
				  - by <a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $comment['user_id'] )?>"><?=h( $comment['login'] ) ?></a>
				  </div>
			<?php
			   }
			}

			else
			{
			?>	  
			   <div class="" style="padding-top:2em;padding-bottom:2em">
			      <h3 style="text-align:center">No comments yet...</h3>
			      </div>
			<?php
			      }

			?>
				  <div class="" style="padding-bottom:2em;">
				    <h3 style="text-align:center;padding-top:2em;">Add your comment</h3>
				    <form action="<?= Comments::$PREVIEW_COMMENT_URL ?>" method="POST">
				      <textarea id="comment-box" name="text"></textarea>
				      <div class="column prepend-9 first last">
					<input type="hidden" name="picid" value="<?=h( $pic['id'] )?>"/>
					<input type="submit" value="Preview"/>

				      </div>
				    </form>
				  </div>
			  
			</div>

      
      <div class="container-fluid " style="padding-top:1em;" >
	   <h3 id="tradebux"><?=h( $pic['price'] )?> Tradebux<br />
	   <?php $usr = Users::current_user(); if ($usr['id'] != $pic['user_id']) { ?>
		  <a href="<?=h( Cart::$ACTION_URL . '?action=add&picid=' . $pic['id'] );?>">Add to Cart</a>
	    <?php } ?>
		</h3>
		<h3 id="info-area">Uploaded on <?=h( date("F j, Y", $pic['created_on_unix']) )?><br />
						  by <a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $pic['user_id'] ) ?>"><?=h($pic['login']) ?></a>
		</h3>  
		<?php if ($related) { ?>					  
		<div class="" id="related">
		  <div class="">
		    <h2 id="related-title">Related</h2>
		  </div>
	      <?php foreach ($related as $p) { ?>
		  <div class="">
		    <a href="<?=h( Pictures::$VIEW_PIC_URL . "?picid=" . $p['id'] ) ?>"><img src="/upload/<?=h($p['filename']) ?>.128.jpg" width="128" /></a>
		 <p>by <a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $p['user_id'] )?>"><?=h( $p['login'] )?></a></p>
		  </div>
	<?php }?>
		</div>
		<?php } ?>
		<?php if ($same) { ?>
		<div class="" id="same-upload">
		  <div class="">
		    <h2 id="same-upload-title">Other by <a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $pic['user_id'] )?>"><?=h($pic['login']) ?></a></h2>
		  </div>

	      <?php foreach ($same as $pic) { ?>
		  <div class="" style="margin-bottom:2em;">
		    <a href="<?=h( Pictures::$VIEW_PIC_URL . "?picid=" . $pic['id'] ) ?>"><img src="/upload/<?=h($pic['filename']) ?>" width="128" /></a>
		  </div>
	<?php }?>
		</div>
		<?php } ?>
	
      </div>
</div>
</div>
</div>
</div>


<?php our_footer(); ?>
