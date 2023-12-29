<?php 

	include("classes/autoload.php");
 
	$login = new Login();
	$user_data = $login->check_login($_SESSION['palsworld_userid']);
 
 	$USER = $user_data;
 	
 	if(isset($URL[2]) && is_numeric($URL[2])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($URL[2]);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}
 	
	
	$Post = new Post();
	$likes = false;

	$ERROR = "";
	if(isset($URL[2]) && isset($URL[1])){
 
		$likes = $Post->get_likes($URL[2],$URL[1]);
	}else{

		$ERROR = "No information post was found!";
	}
 
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>People who like | Palsworld</title>
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


		<?php include("header.php"); ?>

		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
		 
			<!--below cover area-->
			<div style="display: flex;">	

				<!--posts area-->
 				<div style="min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">
 					
 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

  					 <?php 

  					 		$User = new User();
  					 		$image_class = new Image();

  					 		if(is_array($likes)){

  					 			foreach ($likes as $row) {
  					 				# code...
  					 				$FRIEND_ROW = $User->get_user($row['userid']);
 									include("user.php");
 					 			}
  					 		}

  					 ?>

  					 <br style="clear: both;">
 					</div>
  

 				</div>
			</div>

		</div>

	</body>
</html>