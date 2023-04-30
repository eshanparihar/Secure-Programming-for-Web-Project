<?php
require_once("../include/pictures.php");
require_once("../include/comments.php");
require_once("../include/cart.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

$query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);  

if (!isset($query))    
{
   http_redirect("/error.php?msg=Error! You need to provide a query to search");
}

$pictures = Pictures::get_all_pictures_by_tag($query);  

?>

<?php our_header("", $query); ?>  

<div class="my-5">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<h2>Pictures that are tagged as '<?= $query  ?>'</h2>

   		<p class="text-center"><?php thumbnail_pic_list($pictures); ?></p>
</div>
</div>
</div>
</div>

<?php our_footer(); ?>