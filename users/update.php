<?php

require_once("../include/users.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

// login requires username and password both as POST. 
$bad_login = !(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['password']) && isset($_POST['lastname']));
if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']))
{
   if ($user = Users::check_login($_POST['username'], $_POST['password']))
   {
      Users::update_user($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);
      if (isset($_POST['next']))
      {
	 http_redirect($_POST['next']);
      }
      else
      {
	 http_redirect(Users::$HOME_URL);
      }
   }
   else
   {
      $bad_login = True;
   }
}
if ($bad_login)
{
   our_header();

   ?>

<!-- <div class="column prepend-1 span-23 first last">
    <h2>Login</h2>
    <?php error_message(); ?>
    <table style="width:320px" cellspacing="0">
      <form action="<?=h( $_SERVER['PHP_SELF'] )?>" method="POST">
      <tr><td>Username :</td><td> <input type="text" name="username" /></td></tr>
      <tr><td>Password :</td><td> <input type="password" name="password" /></td></tr>
      <tr><td><input type="submit" value="login" /></td>
      	<td> <a href="/users/register.php">Register</a></td> 
      </tr>
   </form>
 </table>
</div> -->
<div class="my-5 text-center">
  <div class="p-5 text-center bg-body-tertiary">
	<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
		<main class="form-signin w-50 m-auto">
		  <form action="<?=h( $_SERVER['PHP_SELF'] )?>" method="POST">
		    <img class="mb-4" src="/images/logo.png" alt="" width="72" height="57">
		    <h1 class="h3 mb-3 fw-normal">Update your information</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="First Name" name="username">
          <label for="floatingInput">Your username</label>
        </div>
		    <div class="form-floating">
		      <input type="text" class="form-control" id="floatingInput" placeholder="First Name" name="firstname">
		      <label for="floatingInput">New First Name</label>
		    </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" name="lastname">
          <label for="floatingInput">New Last Name</label>
        </div>
		    <div class="form-floating">
		      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
		      <label for="floatingPassword">New Password</label>
		    </div><br>
		    <div class="form-floating">
		    	<div class="btn-group">
		    		<button class="w-100 btn btn-lg btn-primary" type="submit">Change Information</button>
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