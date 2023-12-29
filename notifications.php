<?php 

	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['palsworld_userid']);
 
 	$USER = $user_data;
 	
 	if(isset($_GET['id']) && is_numeric($_GET['id'])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($_GET['id']);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}
	
	$Post = new Post();
	$User = new User();
 	$image_class = new Image();

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Notifications | Palsworld</title>
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

 		#notification{

 			height: 40px;
 			background-color: #eee;
 			color:#666;
 			border: 1px solid #aaa;
 			margin: 6px;
 			
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

 						<?php 

 							$Database = new Automated_DB();
 							$id = esc($_SESSION['palsworld_userid']);
 							$follow = array();

 							//check content i follow
 							$sql = "select * from content_i_follow where disabled = 0 && userid = '$id' limit 100";
 							$i_follow = $Database->read_from_db($sql);
 							if(is_array($i_follow)){
 								$follow = array_column($i_follow, "contentid");
 							}

 							if(count($follow) > 0){

 								$str = "'" . implode("','", $follow) . "'";
   								$query = "select * from notifications where (userid != '$id' && content_owner = '$id') || (contentid in ($str)) order by id desc limit 30";
 							}else{

  								$query = "select * from notifications where userid != '$id' && content_owner = '$id' order by id desc limit 30";
 							}
 
 							$data = $Database->read_from_db($query);
 						?>

 						<?php if(is_array($data)): ?>

 							<?php foreach ($data as $notif_row): 
 							 
 							 	include("single_notification.php");
  					 		 endforeach; ?>
  					 	<?php else: ?>
  					 			No notifications were found
  					 	<?php endif; ?>

 					</div>
  

 				</div>
			</div>

		</div>

	</body>
</html>