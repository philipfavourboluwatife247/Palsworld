<div style="min-height: 400px;width:100%;background-color: white;text-align: center;">
	<div style="padding: 20px;max-width:350px;display: inline-block;">
		<form method="post" enctype="multipart/form-data">

  						
			<?php
		 
				$settings_class = new Settings();

				$settings = $settings_class->get_settings($_SESSION['palsworld_userid']);

				if(is_array($settings)){

					echo "<input type='text' id='textbox' name='username' value='".htmlspecialchars($settings['username'])."' placeholder='Username' />";



					echo "<input type='text' id='textbox' name='email'  value='".htmlspecialchars($settings['email'])."' placeholder='Email'/>";
					echo "<input type='password' id='textbox' name='password'  value='".htmlspecialchars($settings['password'])."' placeholder='Password'/>";
					echo "<input type='password' id='textbox' name='password2'  value='".htmlspecialchars($settings['password'])."' placeholder='Password'/>";
					
					echo "<br>About me:<br>
							<textarea id='textbox' style='height:200px;' name='about' value='".htmlspecialchars($settings['about'])."'>
							</textarea>	";

			
					echo '<input id="post-button" type="submit" value="Save">';
				}
				
			?>

		</form>
	</div>
</div>