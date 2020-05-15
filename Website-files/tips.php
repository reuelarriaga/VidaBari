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
	<!-- Main Navigation -->
	<nav class="navbar navbar-expand-lg navbar fixed-top">
      <!-- navbar title -->
      <a id="navbar-brand" class="navbar-brand" href="account.php"><?php echo $WEBSITE_NAME ?></a>
      <!-- title header -->
      <div class="title-header">DICAS</div>
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
        
		  <?php if ($currentUser) { ?> <a href="tips.php">
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




    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- javascript functions -->
    <script>
    	function fireBlockedAlert(username) { swal('Ouch, @' + username + ' has blocked you!'); }

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
