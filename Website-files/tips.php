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
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
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
    	
		<?php if ($currentUser) { ?> <a href="settings.php">
	   <?php } else { ?> <a href="intro.php"> <?php } ?>
      <img src="assets/images/tab_account_active.png" style="width: 44px;"> Minha Conta</a>
	</div><!-- ./ right sidebarmenu -->

	<!-- Main -->
		<div id="page">

			
	    <section class="third-section">
          <div class="container">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="right-text col-md-8">
                    <header>
					    <h2>Cirurgia Bariatrica</h2>
						<span class="byline">Mitos e Verdades</span>
					</header>
                    <iframe width="1000" height="500" src="https://www.youtube.com/embed/aRDXm6muqgI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <div class="intro-line"></div>

			<!-- Main -->
			<div id="main" class="container">
				<div class="row">
					<div class="6u">
						<section>
							<header>
								<h2>Pudim de Pão</h2>
								<span class="byline">Receita da Semana: Dieta Pastosa</span>
							</header>
							<img src="images/pudim.jpg" alt="" width=300 height=200><br><br>
							<p>O pudim de pão é simples de fazer e pode ser utilizado nos lanches, por exemplo.

Ingredientes:

1 colher de chá rasa de canela em pó
1 colher de sobremesa de açúcar
1 pitada de sal
1 fatia de pão de forma picado
Meia xícara de leite
1 ovo batido levemente
2 gotas de essência de baunilha
Modo de preparo:

Misturar a canela e o açúcar. Untar uma forma pequena com um pouco de manteiga ou azeite. Salpicar a mistura de canela e açúcar no fundo da forma e adicionar o pão picado. Em outro recipiente, misturar o leite com o ovo, a baunilha e o sal. Em seguida, despejar a mistura sobre o pão, misturando bem. Colocar essa mistura na forma e levar ao forno em banho-maria por aproximadamente 30 minutos ou até que um palito saia limpo do centro do pudim.</p>
							<a href="" class="button">Outras Receitas</a>
						</section>
					</div>
					<div class="3u">
						<section class="sidebar">
							<header>
								<h2>Textos</h2>
							</header>
							<ul class="style2">
								<li>
									<a href="https://www.tuasaude.com/dieta-da-proteina/"><img src="images/proteina.jpg" alt=""></a>
									<p>O que comer na Dieta da Proteína</p>
								</li>
								<li>
									<a href="https://www.tuasaude.com/dieta-cetogenica/"><img src="images/cetogenica.jpg" alt=""></a>
									<p>Dieta Cetogênica: como fazer e alimentos permitidos</p>
								</li>
								<li>
									<a href="https://www.tuasaude.com/dieta-detox/"><img src="images/detox.jpg" alt=""></a>
									<p>Como fazer uma dieta detox de 3 ou 5 dias</p>
								</li>
							</ul>						
						</section>
					</div>
				</div>
			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->



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
