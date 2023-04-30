<?php

require_once("ourdb.php");


class Users
{
   static public $HOME_URL = "../users/home.php";
   static public $VIEW_URL = "../users/view.php";
   static public $LOGIN_URL = "../users/login.php";
   static public $LOGOUT_URL = "../users/logout.php";
   static public $PURCHASED_URL = "../pictures/purchased.php";
   static public $ADMIN_URL = "../admin/index.php?page=home";
   static public $cur_user = False;

   function get_user($userid)
   {
      $query = sprintf("SELECT * from users where id = '%d'",
		       mysql_real_escape_string($userid));
      $res = mysql_query($query);
      if ($res)
      {
	 return mysql_fetch_assoc($res);
      }
      else
      {
	 return False;
      }
   }

   function update_user($username, $password, $firstname, $lastname)
   {
      $salt = mt_rand(0, 900);
      $salt = base64_encode($salt);
      $query = sprintf("UPDATE `users` SET `password` = SHA1('%s'), `firstname` = '$s', `lastname` = '$s' WHERE `login` = '%s';",
             mysql_real_escape_string($password . $salt), mysql_real_escape_string($firstname), mysql_real_escape_string($lastname), mysql_real_escape_string($username));
      $res = mysql_query($query);
      if ($res)
      {
    return mysql_fetch_assoc($res);
      }
      else
      {
    return False;
      }
   }

   function create_user($username, $pass, $firstname, $lastname)
   {
      $salt = mt_rand(0, 900);
      $salt = base64_encode($salt);
      $initial_bux = 100;
	  $query = sprintf("INSERT INTO `users` (`id`, `login`, `password`, `firstname`, `lastname`, `salt`, `tradebux`, `created_on`, `last_login_on`) VALUES (NULL, '%s', SHA1('%s'), '%s', '%s', '%s','%d', NOW(), NOW());",       	  // changes made by shivam
			  mysql_real_escape_string($username),								// changes made by shivam
			  mysql_real_escape_string($pass . $salt),							// changes made by shivam	
			  mysql_real_escape_string($firstname),								// changes made by shivam
	          mysql_real_escape_string($lastname),								// changes made by shivam
			  mysql_real_escape_string($salt),									// changes made by shivam
			  mysql_real_escape_string($initial_bux));							// changes made by shivam
      if ($res = mysql_query($query))
      {
	 	return mysql_insert_id();
      }
      else
      {
	    return False;
	  }
      
	 
   }

   function login_user($userid)
   {
      session_start();
      $_SESSION['userid'] = $userid;
      $query = sprintf("UPDATE `users` SET `last_login_on` = NOW( ) WHERE `users`.`id` = '%d' LIMIT 1;",
		       mysql_real_escape_string($userid));
      return mysql_query($query);
   }

   function logout()
   {
      session_unset();
   }

   function check_login($username, $pass)
   {
	 $query = sprintf("SELECT * from `users` where `login` like '%s' and `password` = SHA1( CONCAT('%s', `salt`)) limit 1;",
	                   mysql_real_escape_string($username),
	                   mysql_real_escape_string($pass));
      
      $res = mysql_query($query);
      if ($res)
      {
	 return mysql_fetch_assoc($res);
      }
      else
      {
	    return False;
	 
      }
   }

   function similar_login($login)
   {
      if ($vuln)
      {
	 $query = sprintf("SELECT * from `users` where `firstname` like '%%%s%%' and firstname != '%s'",			// changes made by shivam
			  mysql_real_escape_string($login),					// changes made by shivam
			  mysql_real_escape_string($login));				// changes made by shivam
      }
      else
      {
	 $query = sprintf("SELECT * from `users` where `firstname` like '%%%s%%' and firstname != '%s'",
			  mysql_real_escape_string($login),
			  mysql_real_escape_string($login));
      }
      $res = mysql_query($query);
      if ($res)
      {
	 while ($row = mysql_fetch_assoc($res))
	 {
	    $to_ret[] = $row;
	 }
	 return $to_ret;
	 
      }
      else
      {
	 if ($vuln)
	 {
	    die(mysql_error());
	 }
	 return False;
      }
      
      
   }

   function current_user()
   {
      if (isset($_SESSION['userid']))
      {
	 if (!$cur_user)
	 {
	    $cur_user = Users::get_user($_SESSION['userid']);
	 }
	 return $cur_user;
      }
      else
      {
	 return False;
      }
   }
   
   function is_logged_in()
   {
      if (Users::current_user())
      {
	 return True;
      }
      else
      {
	 return False;
      }
   }
}

?>