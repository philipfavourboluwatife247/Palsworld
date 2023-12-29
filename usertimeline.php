<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Timeline | Palsworld</title>
  <link rel="stylesheet" href="usertimeline.css">
</head>
<body>

  <!--Top bar -->
    <div id = "purple-bar">

        <div id="bar-content">

          Palsworld &nbsp &nbsp<input type="text" id="search-box" placeholder="Search for People">

          <img id="userimage-bar" src="selfie.jpg" alt="userphoto">

        </div>
    
    </div>

    <!-- Cover Area -->

    <div id="content">


        <!-- Below the cover area-->
        <div style="display: flex;">

            <!--Friends Area-->
          <div style="min-height: 400px; flex:1;">
          
             <div id="friends-bar">

              <img src="selfie.jpg" alt="userphoto" id="profile-pic">
              <br>
              Gloria Whyte
             </div> 
          
          </div>

              <!-- Post Area -->

          <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
          
            <div style="border: thin solid #aaa; padding: 10px; background-color: #fff;">
                <textarea placeholder="What's on your mind?"></textarea>
                <input type="submit" id="post-button" value="Post">
                <br><br>
            </div>
            
              <!-- Posts -->

              <div id="post-bar">

                 <!-- Post 1 -->

                <div id="post">

                  <div>
                    <img src="user1.jpg" alt="userphoto" style="width: 75px; margin-right: 4px;">
                  </div>

                  <div>
                      <div style="font-weight: bold; color: #462c7d;">
                          Sam Nkolo
                       </div>
                     Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque, quis eaque neque quod ullam a veniam consequuntur molestiae nisi officia possimus quas impedit dolorum tenetur libero et, dignissimos, ipsa non!
                      <br><br>
                      <a href="#">Like</a> . <a href="#">Comment</a> . <span style="color: #999;">December 14 2023</span>
                  </div>
                </div>

                                 <!-- Post 2 -->

                                 <div id="post">

                                    <div>
                                      <img src="user2.jpg" alt="userphoto" style="width: 75px; margin-right: 4px;">
                                    </div>
                  
                                    <div>
                                        <div style="font-weight: bold; color: #462c7d;">
                                            Jonah Freeman
                                         </div>
                                       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque, quis eaque neque quod ullam a veniam consequuntur molestiae nisi officia possimus quas impedit dolorum tenetur libero et, dignissimos, ipsa non!
                                        <br><br>
                                        <a href="#">Like</a> . <a href="#">Comment</a> . <span style="color: #999;">December 14 2023</span>
                                    </div>
                                  </div>

                                                   <!-- Post 3 -->

                <div id="post">

                    <div>
                      <img src="user4.jpg" alt="userphoto" style="width: 75px; margin-right: 4px;">
                    </div>
  
                    <div>
                        <div style="font-weight: bold; color: #462c7d;">
                            Sharlie Snow
                         </div>
                       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque, quis eaque neque quod ullam a veniam consequuntur molestiae nisi officia possimus quas impedit dolorum tenetur libero et, dignissimos, ipsa non!
                        <br><br>
                        <a href="#">Like</a> . <a href="#">Comment</a> . <span style="color: #999;">December 14 2023</span>
                    </div>
                  </div>

              </div> 

          </div>

        </div>

    </div>
</body>
</html>