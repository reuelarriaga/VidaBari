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
use Parse\ParseGeoPoint;
use Parse\ParseClient;
use Parse\ParseSessionStorage;
// session_start();

ParseUser::logOut();
header("Refresh:1; url=intro.php");
?>
<!-- header -->
<?php include 'header.php' ?>

<!-- main container -->
<div class="container">
    <div class="text-center">
        <div class="row">
            <div class="col-lg-12">
                <img src="assets/images/favicon.png" width="80">
                <br><br>
                <h4>Por favor, aguarde...</h4>
            </div>
        </div>
    </div>
</div><!-- ./ container -->
    
<!-- footer -->
<?php include 'footer.php' ?>
</body>
</html>
