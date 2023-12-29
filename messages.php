<?php 

	include("classes/autoload.php");
	$image_class = new Image();

	$ERROR = "";

	$login = new Login();
	$user_data = $login->check_login($_SESSION['palsworld_userid']);
 
 	$USER = $user_data;
 	
 	if(isset($URL[1]) && is_numeric($URL[1])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($URL[1]);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}
	 
	$msg_class = new Messages();

  	//new message//check if thread already exists
  	if(isset($URL[1]) && $URL[1] == "new"){

  		$old_thread = $msg_class->read($URL[2]);
  		if(is_array($old_thread)){

  			//redirect the user
  			header("Location: ".ROOT."messages/read/". $URL[2]);
			die;
  		}
  	}

	//if a message was posted
	if($ERROR == "" && $_SERVER['REQUEST_METHOD'] == "POST"){
 
		$user_class = new User();
		if(is_array($user_class->get_user($URL[2]))){

			$ERROR = $msg_class->send($_POST,$_FILES,$URL[2]);

			header("Location: ".ROOT."messages/read/". $URL[2]);
			die;
		}else{
			$ERROR = "The requested user could not be found!";
		}

		
	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Messages | Palsworld</title>
	</head>

	<style type="text/css">
		
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			text-decoration: none;
		}

		#purple-bar{

			height: 50px;
			background-color: #462c7d;
			color: #d9dfeb;
		}
		body{
			font-family: tahoma;
			background-color: #bcb3d0;
		}

		#bar-content{
			width: 800px;
			margin: auto;
			font-size: 30px;
		}

		#search-box{

			width: 400px;
			height: 25px;
			border-radius: 5px;
			border: none;
			padding: 7px;
			color: rgba(0, 0, 0, 0.8);
			font-size: 14px;
			background-image: url(search.png);
			background-repeat: no-repeat;
			background-position: right;
		}

		#userimage-bar{

			width: 50px;
			float: right;
		}

		#content{
				
			width: 800px;
			margin: auto;
			min-height: 400px;
		}

		#first-content{
			background-color: #fff;
			text-align: center;
			color: #462c7d;
		}

		#profile-pic{

			width: 150px;
			margin-top: -200px;
			border-radius: 50%;
			border: 2px solid #fff;
		}

		#menu-buttons{

			width: 100px;
			display: inline-block;
			margin: 2px;
		}

		#friends-img{
			width: 75px;
			float: left;
			margin: 8px;
		}

		#friends-bar{
			background-color: #fff;
			min-height: 400px;
			margin-top: 20px;
			color: #aaa;
			padding: 8px;
		}

		#friends{
			clear: both;
			font-size: 12px;
			font-weight: bold;
			color: #462c7d;
		}

		textarea{
			width: 100%;
			border: none;
			font-family: tahoma;
			font-size: 14px;
			height: 60px;
		}

		#post-button{
			float: right;
			background-color: #462c7d;
			border: none;
			color: #fff;
			padding: 4px;
			font-size: 14px;
			border-radius: 2px;
			width: 50px;
		}

		#post-bar{
			margin-top: 20px;
			background-color: #fff;
			padding: 10px;
		}

		#post{
			padding: 4px;
			font-size: 13px;
			display: flex;
			margin-bottom: 20px;
		}

 		#message_left{

 			padding: 4px;
 			font-size: 13px;
 			display: flex;
 			margin: 8px;
 			width: 60%;
 			float: left;
 			border-radius: 10px;
 		}

 		#message_right{

 			padding: 4px;
 			font-size: 13px;
 			display: flex;
 			margin: 8px;
 			width: 60%;
 			float: right;
 			border-radius: 10px;
 			
 		}

 		#message_thread{

 			padding: 4px;
 			font-size: 13px;
 			display: flex;
 			margin: 8px;
   			border-radius: 10px;
 		}

	</style>

	<body style="font-family: tahoma; background-color: #bcb3d0;">


		<?php include("header.php"); ?>

		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
		 
			<!--below cover area-->
			<div style="display: flex;">	

				<!--posts area-->
 				<div style="min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">
 					
 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

  						<form method="post" enctype="multipart/form-data">
 							
  								<?php

 									if($ERROR != ""){

								 		echo $ERROR;
								 	}else{

								 		if(isset($URL[1]) && $URL[1] == "read"){

 								 			echo "Chatting with:<br><br>";
	  										if(isset($URL[2]) && is_numeric($URL[2])){
								 			
 								 				$data = $msg_class->read($URL[2]);
	  											
	  											$user = new User();
		 										$FRIEND_ROW = $user->get_user($URL[2]);

		 										include "user.php";

		 										echo "<a href='".ROOT."messages'>";
		 										echo '<input id="post-button" type="button" style="width:auto;cursor:pointer;margin:4px;" value="All Messages">';
		 										echo "</a>";

		 										if(is_array($data)){
			 										echo "<a href='".ROOT."delete/thread/". $data[0]['msgid'] ."'>";
			 										echo '<input id="post-button" type="button" style="width:auto;cursor:pointer;background-color:#b76d40;margin:4px;" value="Delete Thread">';
			 										echo "</a>";
			 									}


		 										echo '
 		 										<div>';
 		 											$user = new User();

 		 											if(is_array($data)){
	 		 											foreach ($data as $MESSAGE) {
	 		 												# code...
	  		 												//show($MESSAGE);
			 												$ROW_USER = $user->get_user($MESSAGE['sender']);

			 												if(i_own_content($MESSAGE)){
	 		 													include "message_right.php";
	 		 												}else{

	  		 													include "message_left.php";
			 												}
	 		 											}
 		 											}

		 										echo '
		 										</div>';

		 										echo '
		 										<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

 								 						<textarea name="message" placeholder="Write your message here"></textarea>
								 						<input type="file" name="file" >
								 						<input id="post-button" type="submit" value="Send">
								 						<br>
 							 						
							 					</div>

							 					';

	  										}else{

	  											echo "That user could not be found<br><br>";
	  										}

								 		}else
								 		if(isset($URL[1]) && $URL[1] == "new"){

	  										echo "Start New Message with:<br><br>";
	  										if(isset($URL[2]) && is_numeric($URL[2])){
	  											
	  											$user = new User();
		 										$FRIEND_ROW = $user->get_user($URL[2]);

		 										include "user.php";

		 										echo '
		 										<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

 								 						<textarea name="message" placeholder="Write your message here"></textarea>
								 						<input type="file" name="file" >
 								 						<input id="post-button" type="submit" value="Send">
								 						<br>
 							 						
							 					</div>

							 					';

	  										}else{

	  											echo "That user could not be found<br><br>";
	  										}
	  										

								 		}else{

	  										echo "Messages<br><br>";
		  									$data = $msg_class->read_threads();
		  									$user = new User();
		  									$me = esc($_SESSION['palsworld_userid']);

		  									if(is_array($data)){
			  									foreach ($data as $MESSAGE) {
			  										# code...
			  										$myid = ($MESSAGE['sender'] == $me) ? $MESSAGE['receiver'] : $MESSAGE['sender'];

			 										$ROW_USER = $user->get_user($myid);

			  										include("thread.php");
			  									}
		  									}else{
		  										echo "You have no messages!";
		  									}

		  									echo "<br style='clear:both;'>";
								 		}

										
 									}
 								?>
  							
	 						
	 						<br>
 						</form>
 					</div>
  

 				</div>
			</div>

		</div>

	</body>
</html>