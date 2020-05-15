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
// session_start();

// logout automatically
ParseUser::logOut();

// SIGN UP ------------------------------------------------
if(isset($_GET['username']) 
    && isset($_GET['password']) 
    && isset($_GET['email']) 
    && isset($_GET['fullName'])
){
    $username = $_GET['username'];
    $password = $_GET['password'];
    $email = $_GET['email'];
    $fullName = $_GET['fullName'];
    $isAccepted = $_GET['isAccepted'];

    // USER HAS ACCEPTED THE TERMS OF SERVICE
    if ($isAccepted) {     
    
        if ($username != '' && $password != ''  && $email != '' && $fullName != '' ) {
            
            // Prepare data
            $user = new ParseUser();
            $user->set("username", $username);
            $user->set("password", $password);
            $user->set("email", $email);
            $user->set($USER_IS_REPORTED, false);
            $user->set($USER_FULLNAME, $fullName);
            $user->setArray($USER_HAS_BLOCKED, array());
            
            // Save...
            try {
                $user->signUp();
                // Save default avatar
                $defAvatarPath = 'assets/images/default_avatar.png';    
                $file = ParseFile::createFromFile($defAvatarPath, "avatar.jpg");
                $file->save();
                // $url = $file->getURL();
                $user->set("avatar", $file);
                $user->save();
                
                // echo '<br>LOCAL PATH: '.$localFilePath;

                // Go back to account.php
                header("Refresh:1; url=account.php"); ?>

                <div class="alert alert-success text-center">
                    Cadastro realizado com sucesso. <br>
                    Por favor, aguarde...
                </div>
                <div class="text-center">
                    <p>Caso você não seja redirecionado para a página inicial dentro de 5 segundos, clique no botão abaixo.</p>
                    <a href="account.php" class="btn btn-primary">Voltar ao início</a>
                </div>
                
            <?php
            // error 
            } catch (ParseException $error) { $e = $error->getMessage(); ?>
                <div class="alert alert-danger text-center">
                    <em class="fa fa-exclamation"></em><?php echo $e ?>
                </div>
                <div class="text-center">
                    <a href="intro.php" class="btn btn-primary">Voltar ao início</a>
                </div>   
            <?php }
            
        // You must fill all the fields to sign up!
        } else { ?>
            <div class="text-center">
                <div class="alert alert-danger">
                    Você deve preencher todos os campos para se inscrever!
                </div>
            </div>
        <?php }// end IF


    // USER HAS NOT ACCEPTED THE TERMS OF SERVICE
    } else { ?>
        <div class="alert alert-danger text-center">
            Você deve aceitar nossos Termos de Serviço para se inscrever!
        </div>
    <?php }
} ?>

<!-- header -->
<?php include 'header.php' ?>

	<!-- main container -->
    <div class="container">
         <div class="text-center">
            
                <a href="intro.php"><img src="assets/images/favicon.png" width="80"></a>
                <br><br>
                <h3>Cadastrar</h3>
                <br>
                <form action="signup.php">
                    <!-- username input -->
                    <input class="login-input" type="text" name="username" placeholder="NOME DE USUÁRIO">
                    <br>
                    <!-- password input -->
                    <input class="login-input" type="password" name="password" placeholder="SENHA">
                    <br>
                    <!-- email input -->
                    <input class="login-input" type="email" name="email" placeholder="EMAIL">
                    <br>
                    <!-- full name input -->
                    <input class="login-input" type="text" name="fullName" placeholder="NOME COMPLETO">
                    <br>
                    <br>

                    <!-- Sign Up button -->
                    <input type="submit" value="Cadastrar" class="btn btn-primary" onclick="showLoadingModal()" style="text-decoration: none;">
                    <br><br>

                    <!-- terms of service -->
                    <input type="radio" name="isAccepted" id="tos-radio">
                    Você concorda com nossos <a href="" style="text-decoration: none; font-weight: 700">Termos de Serviços</a>
                    <br><br>
                </form>
            
        </div>
    </div>
	
<!-- footer -->
<?php include 'footer.php' ?>

<script>
    // Show loading modal
    function showLoadingModal() {
        var isAccepted = document.getElementById("tos-radio").checked;
        console.log(isAccepted);
        if (isAccepted) {
            // Show loading modal
            $('#loading-modal').modal('show');
        }
    }
</script>

</body>
</html>