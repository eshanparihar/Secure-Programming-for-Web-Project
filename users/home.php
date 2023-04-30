<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

require_login();

$user = Users::current_user();

?>

<?php our_header("home"); ?>
<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<h2>Hello <?=h( $user['login'] )?>, you got <?=h($user['tradebux']) ?> Tradebuxs to spend!</h2>
		<h2>Cool stuff to do:</h2>
		<ul style="list-style-type:none;">
		<h3><a href="/users/similar.php">Who's got a similar name to you?</a></h3>
		<h3><a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $user['id'] ) ?>">Your Uploaded Pics</a></h3>
		<h3><a href="/pictures/purchased.php">Your Purchased Pics</a></h3>
		</ul>
</div>
</div>
</div>
</div>

<?php our_footer(); ?>