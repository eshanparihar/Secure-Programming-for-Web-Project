<?php

require_once("../include/pictures.php");
require_once("../include/comments.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

$pictures = Pictures::get_recent_pictures(10);

?>

<?php our_header("recent"); ?>

<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">

		<h2>Marketplace</h2>
		<?php thumbnail_pic_list($pictures); ?>

	</div></div>
</div></div>


<?php our_footer(); ?>

