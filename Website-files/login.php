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

// Login
if(isset($_POST['username']) && isset($_POST['password']) ) {
    $username = $_POST['username'];
    $password = $_POST['password'];
        
    try {
        $user = ParseUser::logIn($username, $password); 

        // Go to account.php
        header('Refresh:1; url=account.php'); ?>

        <div class="alert alert-success text-center">
            Você efetuou login com sucesso. <br>
            Por favor, espere...
        </div>
        <div class="text-center">
            <p>Caso você não seja redirecionado para a página inicial dentro de 5 segundos, clique no botão abaixo.</p>
            <a href="account.php" class="btn btn-primary">Voltar ao início</a>
        </div>
        
    <?php 
    // error 
    } catch (ParseException $error) { $e = $error->getMessage(); ?>
        <div class="alert alert-danger text-center">
            <em class="fa fa-exclamation"> </em><?php echo $e ?>
        </div>
        <div class="text-center">
            <a href="account.php" class="btn btn-primary">Voltar ao início</a>
        </div> 
    <?php }
}

// Reset Password
if( isset($_POST['email']) ) {
    $email = $_POST['email'];
    try {
        ParseUser::requestPasswordReset($email); ?>

        <div class="alert alert-success text-center">
            Em breve, você receberá um email com um link para redefinir sua senha.
        </div>
        <div class="text-center">
            <a href="intro.php" class="btn btn-primary">Voltar ao início</a>
        </div>
    <?php  
    // error
    } catch (ParseException $error) { $e = $error->getMessage(); ?>
        <div class="alert alert-danger text-center">
            <em class="fa fa-exclamation"></em> <?php echo $e ?>
        </div>
        <div class="text-center">
            <a href="intro.php" class="btn btn-primary">Voltar ao início</a>
        </div>   
    <?php }
}
?>
<!-- header -->
<?php include 'header.php' ?>
    
    <!-- main container -->
    <div class="container">
        <div class="text-center">
            <div class="row">
                <div class="col-lg-12">
                    <a href="intro.php"><img src="assets/images/favicon.png" width="80"></a>
                    	<br><br>
                    	<h3>Entrar</h3>
                    	<br>

    					<!-- form -->
    					<form method="post" action="login.php">
    						<!-- username input -->
    						<input class="login-input" id="username" type="text" name="username" placeholder="NOME DE USUÁRIO">
    						<br>
                            <!-- password input -->
                            <input class="login-input" id="password" type="password" name="password" placeholder="SENHA">
    						<br>

    						<!-- Log in button -->
    						<input type="submit" value="Entrar" class="btn btn-primary">
    					</form>
                        
                        <br><br>

                        <div class="text-center">
                            <!-- reset password btn -->
                            <a href="#" data-toggle="modal" data-target="#resetModal" style="text-decoration: none; font-weight: 700">Esqueci a senha</a>
                            &nbsp;&nbsp;
                            <!-- sign up with email -->
                            <a href="signup.php" style="text-decoration: none; font-weight: 700">Cadastrar</a>
                        </div>
                    </div>
                </div>
            </div>

        <hr>

    </div><!-- ./ container -->


        <!-- reset modal -->
        <div id="resetModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Esqueci a senha</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <p>Digite o endereço de e-mail que você usou para se inscrever.</p>
                            <form method="post" action="login.php">
                                <input class="login-input" type="email" name="email" placeholder="Seu endereço de e-mail">
                                <br>
                                <input type="submit" value="Mudar senha" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    <!-- cancel btn -->
                    <div class="modal-footer"><button type="button" class="btn btn-cancel" data-dismiss="modal">Fechar</button></div>
                </div>
            </div>
        </div><!-- ./ reset modal -->

<!-- footer -->
<?php include 'footer.php' ?>

</body>
</html>