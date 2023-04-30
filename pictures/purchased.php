<?php
require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

require_login();

$user = Users::current_user();
$pictures = Pictures::get_purchased_pictures($user['id']);

?>

<?php our_header(); ?>
<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<h2>You have purchased the following pictures: </h2>
		   <?php thumbnail_pic_list($pictures, true); ?>
</div>
</div>
</div>
</div>


<?php our_footer(); ?>