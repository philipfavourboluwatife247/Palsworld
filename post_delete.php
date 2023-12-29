
	<div id="post">
		<div>
		
			<?php 

				$image = "images/user_female.jpg";


				$image_class = new Image();
				if(file_exists($ROW_USER['profile_image']))
				{
					$image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
				}
  
			?>

			<img src="<?php echo ROOT . $image ?>" style="width: 75px;margin-right: 4px;border-radius: 50%;">
		</div>
		<div style="width: 100%;">
			<div style="font-weight: bold;color: #462c7d;width: 100%;">
				<?php 

					echo htmlspecialchars($ROW_USER['username']); 

					if($ROW['is_profile_image'])
					{
						$username = $ROW_USER['username'];

						echo "<span style='font-weight:normal;color:#aaa;'> updated $username profile image</span>";

					}

					if($ROW['is_cover_image'])
					{
						$username = $ROW_USER['username'];

						echo "<span style='font-weight:normal;color:#aaa;'> updated $username cover image</span>";

					}


				?>
			</div>
			
			<?php echo htmlspecialchars($ROW['post']) ?>

			<br><br>

			<?php 

				if(file_exists($ROW['image']))
				{

					$ext = pathinfo($ROW['image'],PATHINFO_EXTENSION);
					$ext = strtolower($ext);

					if($ext == "jpeg" || $ext == "jpg"){

						$post_image = $image_class->get_thumb_post($ROW['image']);

 						echo "<img src='" . ROOT . "$post_image' style='width:80%;' />";
 
					}elseif($ext == "mp4"){

						echo "<video controls style='width:100%' >
							<source src='" . ROOT . "$ROW[image]' type='video/mp4' >
						</video>";
 						
					}
				}
				
			?>
  		
		</div>
	</div>