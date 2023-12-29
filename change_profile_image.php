<?php 

	session_start();
	
	include("classes/connect.php");
	include("classes/login.php");
	include("classes/user.php");
	include("classes/post.php");
	include("classes/image.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['palsworld_userid']);
 
	//posting starts here
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
 
		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
		{
 
			if($_FILES['file']['type'] == "image/jpeg")
			{

				$allowed_size = (1024 * 1024) * 7;
				if($_FILES['file']['size'] < $allowed_size)
				{
					//everything is fine
					$folder = "uploads/" . $user_data['userid'] . "/";

					//create folder
					if(!file_exists($folder))
					{

						mkdir($folder,0777,true);
					}

					$image = new Image();

					$filename = $folder . $image->generate_filename(15) . ".jpg";
					move_uploaded_file($_FILES['file']['tmp_name'], $filename);

					$change = "profile";

						//check for mode
						if(isset($_GET['change']))
						{

							$change = $_GET['change'];
						}

					

					if($change == "cover")
					{
						if(file_exists($user_data['cover_image']))
						{
							unlink($user_data['cover_image']);
						}
						$image->resize_image($filename,$filename,1500,1500);
					}else
					{
						if(file_exists($user_data['profile_image']))
						{
							unlink($user_data['profile_image']);
						}
						$image->resize_image($filename,$filename,1500,1500);
					}

					if(file_exists($filename))
					{

						$userid = $user_data['userid'];

						if($change == "cover")
						{
							$query = "update users set cover_image = '$filename' where userid = '$userid' limit 1";
							$_POST['is_cover_image'] = 1;

						}else
						{
							$query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
							$_POST['is_profile_image'] = 1;

						}

						$Database = new Automated_DB();
						$Database->save_query_in_db($query);


						//create a post
						$post = new Post();

						$post->create_post($userid, $_POST,$filename);

						header(("Location: profile.php"));
						die;
					}


				}else
				{

					echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
					echo "<br>The following errors occured:<br><br>";
					echo "Only images of size 3Mb or lower are allowed!";
					echo "</div>";

				}
			}else
			{

				echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
				echo "<br>The following errors occured:<br><br>";
				echo "Only images of Jpeg type are allowed!";
				echo "</div>";

			}

		}else
		{
			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo "please add a valid image!";
			echo "</div>";
		}
		
	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Change Profile Image | Palsworld</title>
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
 					
 					<form method="post" enctype="multipart/form-data">
	 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

	 						<input type="file" name="file"><br>
	 						<input id="post-button" type="submit" value="Change">
	 						<br>
							<div style="text-align: center;">
								<br><br>
							<?php

 								//check for mode
								if(isset($_GET['change']) && $_GET['change'] == "cover")
								{

									$change = "cover";
 	 								echo "<img src='$user_data[cover_image]' style='max-width:500px;' >";
								}else
								{
									echo "<img src='$user_data[profile_image]' style='max-width:500px;' >";
								}


	 						?>
							</div>
	 					</div>
  					</form>

 				</div>
			</div>

		</div>

	</body>
</html>