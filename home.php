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

  
	//posting starts here
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$post = new Post();
		$id = $_SESSION['palsworld_userid'];
		$result = $post->create_post($id, $_POST,$_FILES);
		
		if($result == "")
		{
			header("Location:" . ROOT . "home");
			die;
		}else
		{

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}
	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Timeline | Palsworld</title>
    <link rel="stylesheet" href="user-profile.css">
	</head>



	<body style="font-family: tahoma; background-color: #bcb3d0;">

		<?php include("header.php"); ?>

		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
			
			 
			<!--below cover area-->
			<div style="display: flex;">	

				<!--friends area-->			
				<div style="min-height: 400px;flex:1;">
					
					<div id="friends-bar">
						
						 <?php 

							$image = "images/user_female.jpg";

							if(file_exists($user_data['profile_image']))
							{
								$image = $image_class->get_thumb_profile($user_data['profile_image']);
							}
						?>

					<img id="profile-pic" src="<?php echo ROOT . $image ?>"><br/>

						<a href="<?=ROOT?>profile" style="text-decoration: none;"> 
						 <?php echo $user_data['username'] ?>
						</a>

					</div>

				</div>

				<!--posts area-->
 				<div style="min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">
 					
 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

 						<form method="post" enctype="multipart/form-data">

	 						<textarea name="post" placeholder="What's on your mind?"></textarea>
	 						<input type="file" name="file">
	 						<input id="post-button" type="submit" value="Post">
	 						<br>
 						</form>
 					</div>
 
	 				<!--posts-->
	 				<div id="post-bar">
 					
 						<?php 

 							$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  							$page_number = ($page_number < 1) ? 1 : $page_number;

 							
 							$limit = 10;
 							$offset = ($page_number - 1) * $limit;

  						$Database = new Automated_DB();
 							$user_class = new User();
 							$image_class = new Image();

 							$followers = $user_class->get_following($_SESSION['palsworld_userid'],"user");

 							$follower_ids = false;
 							if(is_array($followers)){

 								$follower_ids = array_column($followers, "userid");
 								$follower_ids = implode("','", $follower_ids);

 							}

 							if($follower_ids){
 								$myuserid = $_SESSION['palsworld_userid'];
 								$sql = "select * from posts where parent = 0 and owner = 0 and (userid = '$myuserid' || userid in('" .$follower_ids. "')) order by id desc limit $limit offset $offset";
 								$posts = $Database->read_from_db($sql);
 							}

 	 					 	if(isset($posts) && $posts)
 	 					 	{

 	 					 		foreach ($posts as $ROW) {
 	 					 			# code...

 	 					 			$user = new User();
 	 					 			$ROW_USER = $user->get_user($ROW['userid']);

 	 					 			include("post.php");
 	 					 		}
 	 					 	}
 	 			 
 	 					 	//get current url
 							$pg = pagination_link();
 
	 					 ?>
	 					 <a href="<?= $pg['next_page'] ?>">
	 					 <input type="button" value="Next Page" style="float: right;width:150px;background-color:#462c7d;color:#fff;">
	 					 </a>
	 					 <a href="<?= $pg['prev_page'] ?>">
	 					 <input type="button" value="Prev Page" style="float: left;width:150px;background-color:#462c7d;color:#fff;">
	 					 </a>
	 				</div>

 				</div>
			</div>

		</div>

	</body>
</html>