<!--top bar-->
<?php 

	$corner_image = "images/user_female.jpg";
	if(isset($USER)){
		
		if(file_exists($USER['profile_image']))
		{
			$image_class = new Image();
			$corner_image = $image_class->get_thumb_profile($USER['profile_image']);
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Timeline | Palsworld</title>
	<style>
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
  margin-top: 10px;
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
</head>


<body>


<div id = "purple-bar">

	<form method="get" action="<?=ROOT?>search">
		<div style="width: 800px;margin:auto;font-size: 30px;">
			
			<a href="<?=ROOT?>home" style="color: white;">Palsworld </a> 
			&nbsp &nbsp <input type="text" id="search-box" name="find" placeholder="Search for people" />



			<?php if(isset($USER)): ?>
				<a href="<?=ROOT?>profile">
				<img src="<?php echo ROOT . $corner_image ?>" style="width: 50px;float: right; margin-left:20px;">
				</a>
				<a href="<?=ROOT?>logout">
				<span style="font-size: 13px; float: right; margin-top: 10px; margin-left: 10px; border-radius: 3px; 
          text-align: center; padding:2px; color: #FFF; border: thin solid #bcb3d0;">
          Logout</span>
				</a>

				<a href="<?=ROOT?>notifications">
				<span style="display: inline-block;position: relative;">
					<img src="<?=ROOT?>notif.svg" style="width:25px;float:right;margin-top: 10px">
					<?php 
						$notif = check_notifications();
					?>
					<?php if($notif > 0): ?>
						<div style="background-color: red;color: white;position: absolute;right:-15px;
						width:15px;height: 15px;border-radius: 50%;padding: 4px;text-align:center;font-size: 14px;"><?= $notif ?></div>
					<?php endif; ?>
				</span>
				</a>

				<a href="<?=ROOT?>messages">
				<span style="display: inline-block;position: relative;margin-left: 10px;">
 					<svg fill="orange" style="float:right;margin-top: 10px" width="25" height="25" viewBox="0 0 24 24"><path d="M12 12.713l-11.985-9.713h23.971l-11.986 9.713zm-5.425-1.822l-6.575-5.329v12.501l6.575-7.172zm10.85 0l6.575 7.172v-12.501l-6.575 5.329zm-1.557 1.261l-3.868 3.135-3.868-3.135-8.11 8.848h23.956l-8.11-8.848z"/></svg>
					<?php 
						$notif = check_messages();
					?>
					<?php if($notif > 0): ?>
						<div style="background-color: red;color: white;position: absolute;right:-15px;
						width:15px;height: 15px;border-radius: 50%;padding: 4px;text-align:center;font-size: 14px;"><?= $notif ?></div>
					<?php endif; ?>
				</span>
				</a>

				

			<?php else: ?>
				<a href="<?=ROOT?>login">
				<span style="font-size:13px;float: right;margin:10px;color:white;">Login</span>
				</a>
			<?php endif; ?>


		</div>
	</form>
</div>
	
</body>
</html>