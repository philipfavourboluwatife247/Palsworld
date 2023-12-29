<?php 

	include("classes/autoload.php");

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
	
	$Post = new Post();

	$ERROR = "";
	if(isset($URL[1])){

		 $ROW = $Post->get_one_post($URL[1]);

		 if(!$ROW){

		 	$ERROR = "No such post was found!";
		 }else{

		 	if($ROW['userid'] != $_SESSION['palsworld_userid']){

		 		$ERROR = "Accesss denied! you cant delete this file!";
		 	}
		 }

	}else{

		$ERROR = "No such post was found!";
	}

	if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "/edit/")){

		$_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
	}

	//if something was posted
	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$Post->edit_post($_POST,$_FILES);


		header("Location: ".$_SESSION['return_to']);
		die;
	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Edit | Palsworld</title>
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

	</style>

	<body style="font-family: tahoma; background-color: #bcb3d0;">

		<br>
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

	  									echo "Edit Post<br><br>";
 										
 										echo '<textarea name="post" placeholder="Whats on your mind?">'.$ROW['post'].'</textarea>
	 											<input type="file" name="file">';

	  									echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
	 									echo "<input id='post_button' type='submit' value='Save'>";

	 									if(file_exists($ROW['image']))
										{
											$image_class = new Image();
  
											$ext = pathinfo($ROW['image'],PATHINFO_EXTENSION);
											$ext = strtolower($ext);

											if($ext == "jpeg" || $ext == "jpg"){

												$post_image = $image_class->get_thumb_post($ROW['image']);

												echo "<br><br><div style='text-align:center;'><img src='$post_image' style='width:50%;' /></div>";

											}elseif($ext == "mp4"){

												echo "<video controls style='width:100%' >
													<source src='" . ROOT . "$ROW[image]' type='video/mp4' >
												</video>";
						 						
											}
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