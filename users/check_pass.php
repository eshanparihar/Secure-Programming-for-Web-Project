<?php
require_once("../include/html_functions.php");

if (!isset($_GET["password"])) // ?password=blah
{
   error_404();
}
$pass = $_GET["password"];


exec("/bin/cat /usr/share/dict/words | grep " . $pass, $output, $status);

if ($status == 0)
{
   $strong = False;
}
else
{
   $string = True;
}


?>

<?php our_header("home"); ?>

<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<h2>Password Strength</h2>
		<p>
		   <?php if ($strong) { ?>
		   <h3>You have chosen a strong password.</h3>
		   <?php } else { ?>
		   <h3>You have chosen a weak password.</h3>
		   <?php } ?>
		    
		</p>
</div>
</div>
</div>
</div>