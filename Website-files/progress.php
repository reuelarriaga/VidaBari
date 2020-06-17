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
      <div class="title-header">Acompanhamento</div>
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
    	
		<?php if ($currentUser) { ?> <a href="settings.php">
	   <?php } else { ?> <a href="intro.php"> <?php } ?>
      <img src="assets/images/tab_account_active.png" style="width: 44px;"> Minha Conta</a>
	</div><!-- ./ right sidebarmenu -->

    <!-- container -->
    <div class="container">
        <?php
            // currentUser
            $currentUser = ParseUser::getCurrentUser();

            // username
            $username = $currentUser->get($USER_USERNAME);
            // full name
            $fullname = $currentUser->get($USER_FULLNAME);
            // avatar
            $avatarImg = $currentUser->get($USER_AVATAR);
            $avatarURL = $avatarImg->getURL();
            // weight
            $weight = $currentUser->get($USER_WEIGHT);
            // height
            $height = $currentUser->get($USER_HEIGHT);
            // evolution
            $evolution = $currentUser->get($USER_EVOLUTION);
            $evolutionURL = $avatarImg->getURL();
            // date
            $current_date = date('d/m/y');
        ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <figure class="highcharts-figure">
            <div id="container">
            
            </div>
        </figure>
        
        <div class="row">
            <div class="col-md-6 offset-md-3">
               <!-- peso -->
                <div>
                <i class="fas fa-user" style="font-size: 22px; color: var(--main-color); margin-right: 10px;"></i> Peso:
                <input type="number" id="weight" class="settings-input" placeholder="Informe o seu peso" value="<?php echo $weight ?>">
            	</div>
                <br><br><div class="separator"></div>
                
                <!-- altura -->
                <div>
                <i class="fas fa-user" style="font-size: 22px; color: var(--main-color); margin-right: 10px;"></i> Altura:
                <input type="number" id="height" class="settings-input" placeholder="Informe a sua altura" value="<?php echo $height ?>">
            	</div>
                <br><br><div class="separator"></div>
                <!-- data -->
                <div>
                <i class="fas fa-user" style="font-size: 22px; color: var(--main-color); margin-right: 10px;"></i> Data:
                <input type="date" id="current_date" class="settings-input" placeholder="Informe a sua altura" value="<?php echo date("Y-m-d");?>">
            	</div>

                <br><div class="separator"></div>

                <!-- update profile button -->
                <br><br>
                <div class="text-center"><a href="#" class="btn btn-primary" style="width: 280px" onclick="calcular()">Calcular</a></div>
                <!-- logout button -->
                <br>
                <br>
            </div>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div><!-- ./ row -->
        
        <div class="separator"></div>
        <!DOCTYPE HTML>

  <script>
  window.onload = function () {
      
var dataPoints = [];
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Evolução IMC"
	},
	axisY: {
		title: "",
		includeZero: false
	},
	data: [{
		type: "line",
		toolTipContent: "{y} Kg/m2",
		dataPoints: dataPoints
	}]
});
 
$.get("https://voe.legacyteen.com/vidabari/Website-files/progress.csv", getDataPointsFromCSV);
 
//CSV Format
//Year,Volume
function getDataPointsFromCSV(csv) {
	var csvLines = points = [];
	csvLines = csv.split(/[\r?\n|\r|\n]+/);
	for (var i = 0; i < csvLines.length; i++) {
		if (csvLines[i].length > 0) {
			points = csvLines[i].split(",");
			dataPoints.push({
				label: points[0],
				y: parseFloat(points[1])
			});
		}
	}
	chart.render();
}
 
}
</script>
    </div><!-- /.container -->


 

    <!-- Footer -->
    <?php include 'footer.php' ?>


    <!-- javascript functions -->
    <script>
    var cuObjID = '<?php echo $cuObjID ?>';
    // console.log('CURRENT USER ID: ' + cuObjID);

	//---------------------------------
	// MARK - UPDATE PROFILE 
	//---------------------------------
    function calcular() {
        
    	var weight = document.getElementById('weight').value;
    	var height = document.getElementById('height').value;
    	
    	weight = parseFloat(weight);
    	height = parseFloat(height);
    	
    	var imc = (weight/(height*height)).toFixed(2);

    	console.log('WEIGHT: ' + weight);
    	console.log('HEIGHT: ' + height);
    	
    	// ajax call
    	document.getElementById('loadingText').innerHTML = " Calculando...";
    	$('#loadingModal').modal('show');

    	$.ajax({
    		url:'calcular-imc.php',
    		data: 'weight=' + weight + '&height=' + height,
    		type: 'GET',
    		success:function(data) {
    			// var results = data.replace(/\s+/, "");
    	    	console.log(data);
                
    			$('#loadingModal').modal('hide');

                swal({
                        title: '<?php echo $WEBSITE_NAME ?>',
                        text: data,
                        icon: "success",
                        dangerMode: false,
                });
                location.reload();

    		// error
    	  	},error: function(xhr, status, error) {
    	    	$('#loadingModal').modal('hide');
    	    	var err = eval("(" + xhr.responseText + ")");
    	    	swal(err.Message);
    	}});
    	updateFile();
    }
    
    function updateFile() {
    	
    	var imc = (weight/(height*height)).toFixed(2);
    <?php
        // height
        $weight = $currentUser->get($USER_WEIGHT);
        $height = $currentUser->get($USER_HEIGHT);
        $imc = $weight / ($height * $height);
        $imc = sprintf('%0.0f', round($imc, 2));
    
        // date
        $current_date = date('d/m/y');
        $fp=fopen("progress.csv","a+",0);
        //$fp = fopen('progress.csv', 'w');
        $linha=$current_date.",".$imc."\n";
        fwrite($fp,$linha,strlen($linha));
        fclose($fp);
    ?>    
    }    
    
    Highcharts.chart('container', {

         
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
    
        title: {
            text: 'Meu IMC'
        },
    
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
    
        // the value axis
        yAxis: {
            min: 15,
            max: 50,
    
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
    
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'IMC ATUAL'
            },
            plotBands: [{
                from: 0,
                to: 18.5,
                color: '#1DBCC8' // blue
            },{
                from: 18.6,
                to: 24.9,
                color: '#12F225' // green
            },{
                from: 25,
                to: 29.9,
                color: '#F3EB0C' // yellow
            },{
                from: 30,
                to: 39.9,
                color: '#FD9103' // orange
            },{
                from: 40,
                to: 50,
                color: '#DF5353' // red
            }]
        },
    
        series: [{
            name: 'IMC ATUAL',
            data: [0.00],
            tooltip: {
                valueSuffix: ''
            }
        }]
    
    },
    // Add some life
    function (chart) {
        var weight = document.getElementById('weight').value;
    	var height = document.getElementById('height').value;
    	
    	weight = parseFloat(weight);
    	height = parseFloat(height);
    	
    	var imc_float = weight/(height*height);
    	var imc = Math.floor(imc_float)

        if (!chart.renderer.forExport) {
            setInterval(function () {
                var point = chart.series[0].points[0],
                    newVal,
                    inc = Math.round((Math.random() - 0.5) * 20);
    
                newVal = point.y + inc;
                if (newVal < 0 || newVal > 200) {
                    newVal = point.y - inc;
                }
    
               point.update(imc);
    
            }, 3000);
        }
    });

    //---------------------------------
    // MARK - DROP IMAGES AREA
    //---------------------------------
    let dropArea = document.getElementById("drop-area")

    // Prevent default drag behaviors
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, preventDefaults, false)   
      document.body.addEventListener(eventName, preventDefaults, false)
    })

    // Highlight drop area when item is dragged over it
    ;['dragenter', 'dragover'].forEach(eventName => {
      dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, unhighlight, false)
    })

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false)

    function preventDefaults (e) {
      e.preventDefault()
      e.stopPropagation()
    }

    function highlight(e) {
      dropArea.classList.add('highlight')
    }

    function unhighlight(e) {
      dropArea.classList.remove('active')
    }

    function handleDrop(e) {
      var dt = e.dataTransfer;
      var files = dt.files;
      if (files.length == 1) {
        handleFiles(files);
      } else { alert('1 image only!'); }
    }

    let uploadProgress = []
    let progressBar = document.getElementById('progress-bar')


    function handleFiles(files) {
      files = [...files]
      initializeProgress(files.length)
      files.forEach(uploadFile)
      files.forEach(previewFile)
    }

    function initializeProgress(numFiles) {
      progressBar.value = 0
      uploadProgress = []

      for(let i = numFiles; i > 0; i--) {
        uploadProgress.push(0)
      }
    }

    function updateProgress(fileNumber, percent) {
      uploadProgress[fileNumber] = percent
      let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
      console.log('UPDATE: ', fileNumber, percent, total)
      progressBar.value = total
    }


    function previewFile(file) {
      let reader = new FileReader()
      reader.readAsDataURL(file)
      reader.onloadend = function() {
        let img = document.createElement('img')
        img.src = reader.result
        document.getElementById('gallery').appendChild(img)
      }
    }
    
    //---------------------------------
    // MARK - UPLOAD FILE
    //---------------------------------
    function uploadFile(file) {
        $('#uploadImageModal').modal('hide');

        // show loading modal
        document.getElementById('loadingText').innerHTML = " Por favor, aguarde...";
        $('#loadingModal').modal('show');
           
        var filename = "image.jpg";
        var data = new FormData();
        data.append('file', file);
        var websitePath = '<?php echo $WEBSITE_PATH ?>';
        $.ajax({
            url : "upload-image.php?imageWidth=300",
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
                var fileURL = websitePath + data;
                console.log('UPLOADED TO: ' + fileURL);
                document.getElementById("fileURL").value = fileURL;
                $('#avatarImg').attr("src", fileURL);
                
                $('#loadingModal').modal('hide');
            // error
            }, error: function(e) { 
                 $('#loadingModal').modal('hide');
                 swal("Something went wrong: " + e); 
        }});
    }


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
