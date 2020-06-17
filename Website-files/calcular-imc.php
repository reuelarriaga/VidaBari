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

/*--- VARIABLES ---*/
// currentUser
$currentUser = ParseUser::getCurrentUser();
$cuObjectID = $currentUser->getObjectId();

$weight = $_GET['weight'];
$height = $_GET['height'];


// prepare data
$currentUser->set($USER_WEIGHT, $weight);
$currentUser->set($USER_HEIGHT, $height);


// save...
try { $currentUser->save();
  echo 'IMC cálculado com sucesso!';
// error 
} catch (ParseException $ex) { echo $ex->getMessage(); }
?>