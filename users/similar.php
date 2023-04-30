<?php

require_once("../include/users.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();
require_login();

$user = Users::current_user();

$similar_usernames = Users::similar_login($user['firstname'], True);

?>

<?php our_header() ; ?>

<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<h2> Users with similar names to you, <?=h( $user['firstname'] )?> </h2>
		<ul>
		   <?php if ( $similar_usernames ) { ?>
		   <?php foreach( $similar_usernames as $u ) { ?>

							       <li><a href="<?=h( Users::$VIEW_URL . "?userid=" . $u['id'] )?>"><?=h( $u['login'] ) ;?></a></li>

		   <?php } ?>
		   <?php }
		    else { ?>

		   <h3> No one with a similar username. Lucky you! </h3>

		   <?php } ?>
		</ul>
</div>
</div>
</div>
</div>
<?php our_footer() ; ?>