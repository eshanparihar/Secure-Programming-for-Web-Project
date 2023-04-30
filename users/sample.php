<?php
session_start();
require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");


$pictures = Pictures::get_all_pictures_by_user(1);

?>


<?php our_header(""); ?>
<div class="column prepend-1 span-24 first last">
   <?php if ($pictures) { 
?>

<h2>These are our sample Pictures: </h2>   

<?php thumbnail_pic_list($pictures); ?>

</div>

<?php
}
else { ?>
   <h2> No pictures yet! </h2>
<?php

      } ?>

<?php our_footer(); ?>
