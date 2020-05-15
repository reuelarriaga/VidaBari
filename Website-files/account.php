<?php include 'Configurations.php';
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;
use Parse\ParseSessionStorage;
use Parse\ParseGeoPoint;
//session_start();
?>
<!-- header -->
<?php include 'header.php' ?>
<body>
	<!-- main navigation -->
	<nav class="navbar navbar-expand-lg navbar fixed-top">
      <!-- navbar title -->
      <a id="navbar-brand" class="navbar-brand" href="account.php"><?php echo $WEBSITE_NAME ?></a>
      <!-- title header -->
      <div class="title-header"></div>
      <!-- right menu button -->
      <a href="#" id="btn-right-menu" class="btn btn-right-menu" onclick="openSidebar()">&#9776;</a>
   </nav>

    <!-- bottom navbar -->
    <div class="bottom-navbar" id="bottom-navbar">
        <a href="account.php"><img src="assets/images/tab_home.png" style="width: 44px;"></a>
        <?php $currentUser = ParseUser::getCurrentUser(); ?>
		  
        <?php if (!$currentUser) { header("Refresh:0; url=intro.php"); }
		  $cuObjID = $currentUser->getObjectId();

        if ($currentUser) { ?> <a href="following.php">
	     <?php } else { ?> <a href="intro.php"> <?php } ?>
        <img src="assets/images/tab_following.png" style="width: 44px; margin-left: 20px;"></a>
		  
        <?php if ($currentUser) { ?> <a href="notifications.php">
	     <?php } else { ?> <a href="intro.php"> <?php } ?>
        <img src="assets/images/tab_notifications.png" style="width: 44px; margin-left: 20px;"></a>
        
		  <?php if ($currentUser) { ?> <a href="dicas.php">
	     <?php } else { ?> <a href="intro.php"> <?php } ?>
        <img src="assets/images/tab_chats.png" style="width: 44px; margin-left: 20px;"></a>
        
		  <?php if ($currentUser) { ?> <a href="account.php">
	     <?php } else { ?> <a href="intro.php"> <?php } ?>
        <img src="assets/images/tab_account_active.png" style="width: 44px; margin-left: 20px;"></a>
    </div><!-- ./ bottom navbar -->

    <!-- right sidebar menu -->
    <div id="right-sidebar" class="right-sidebar">
    	<a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
    	
    	<a href="account.php"><img src="assets/images/tab_home.png" style="width: 44px;"> Início</a>
		
    	<?php if ($currentUser) { ?> <a href="progress.php">
	   <?php } else { ?> <a href="intro.php"> <?php } ?>
      <img src="assets/images/tab_following.png" style="width: 44px;"> Acompanhamento</a>
    	
		<?php if ($currentUser) { ?> <a href="tips.php">
	   <?php } else { ?> <a href="intro.php"> <?php } ?>
		<img src="assets/images/tab_chats.png" style="width: 44px;"> Dicas</a>
    	
		<?php if ($currentUser) { ?> <a href="account.php">
	   <?php } else { ?> <a href="intro.php"> <?php } ?>
      <img src="assets/images/tab_account_active.png" style="width: 44px;"> Minha Conta</a>
	</div><!-- ./ right sidebarmenu -->

    <!-- container -->
    <div class="container">
        <?php
            // get currentUser info
            $currentUser = ParseUser::getCurrentUser();

            // full name
            $fullname = $currentUser->get($USER_FULLNAME);
            // avatar
            $avatarImg = $currentUser->get($USER_AVATAR);
            $avatarURL = $avatarImg->getURL();
            // bio
            $bio = $currentUser->get($USER_BIO);
            // verified
            $verified = $currentUser->get('emailVerified');

            $option = 'selling';
        ?>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="user-box">
                    <div class="text-center">
                        <!-- avatar -->
                        <img style="margin-top: 10px; margin-left: 70px;" src="<?php echo $avatarURL; ?>">
                        
                        <!-- options button -->
                        <a href="settings.php" class="btn btn-option-user"><i class="fas fa-cog"></i></a>
                        
                        <!-- full name -->
                        <div class="account-fullname">Olá, <?php echo $fullname ?></div>
                        <!-- bio -->
                        <p><?php if ($bio != null) { echo $bio; } ?></p>
                    </div>
                </div>
            </div>
        </div><!-- ./ row -->
        <br>

        <!-- adsGrid -->
        <div class="row" id="adsGrid"></div>

    </div><!-- /.container -->

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- javascript functions -->
    <script>
   	    var cuObjID = '<?php echo $cuObjID ?>';
    	console.log('CURRENT USER ID: ' + cuObjID);


		 //---------------------------------
		 // MARK - OPEN/CLOSE RIGHT SIDEBAR
		 //---------------------------------
		 function openSidebar() {
			  document.getElementById("right-sidebar").style.width = "250px";
		 }

		 function closeSidebar() {
			  document.getElementById("right-sidebar").style.width = "0";
		 }
    </script>

  </body>
</html>