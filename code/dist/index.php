<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sharepicgenerator</title>
    <meta name="theme-color" content="#46962b">
    <link rel="stylesheet" type="text/css" href="./assets/css/styles.css">
    <style>
header {
  position: relative;
  background-color: white;
  height: 75vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

header video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
  filter: grayscale(50%);
}

header .container {
  position: relative;
  z-index: 2;
}

header .overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}

.text-shadow{
  text-shadow: black 1px 1px 12px;
}

@media (pointer: coarse) and (hover: none) {
  header {
    background: #46962b;
    height: auto;
    padding: 5em 0;
  }
  header video {
    display: none;
  }
}
    </style>
</head>
<body>

<header>
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="assets/background.mp4" type="video/mp4">
  </video>
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      <div class="w-100 text-white">
        <h1 class="display-4 text-shadow">Grüner<br/>Sharepic&shy;generator</h1>
        <p class="lead mb-0 text-shadow">Erstelle Deine eigenen Sharepics für Social Media und Co.</p>
        <div class="mt-3 d-flex flex-column align-items-center">
          <a href="create.php" class="mt-5 btn btn-secondary btn-lg">
            <i class="fas fa-pen mr-2 small"></i>eigenes Sharepic erstellen
          </a>
          <a href="bayern" class="mt-2 btn btn-info btn-sm">Kommunalwahl Bayern</a>
            <span class="mt-5 cursor-pointer testaccess">
                <i class="fas fa-sign-in-alt"></i> Testzugang
            </span>
            <div class="mt-1 testaccess" style="display:none">
                <form method="post" action="create.php" class="form-inline">
                    <div class="mt-2">
                        <input type="text" class="form-control" name="pass" placeholder="Passwort eingeben">
                        <input type="submit" class="btn btn-sm btn-info" value="okay">
                    </div>
                </form>
                <a href="MAILTO:mail@tom-rose.de?subject=Sharepicgenerator" class="text-white">
                  <i class="fas fa-envelope"></i> Testzugang beantragen
                </a>
            </divmt-3>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-text-center">
        <h2 class="text-right"><span id="sharepics-counter"><?php echo count_sharepics(); ?></span> erstellte Sharepics</h2>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-8 offset-md-2 ">
        <h2>Beispiele</h2>
        <div class="row">
          <div class="col-6"><img src="assets/example1.jpg" class="img-fluid"></div>
          <div class="col-6"><img src="assets/example2.jpg" class="img-fluid"></div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-8 offset-md-2 ">
        <h2>Featureliste</h2>
        <ul>
          <li>Anpassbare Ausgabegröße</li>
          <li>Bildausschnitt frei wählbar</li>
          <li>Templates für alle gängigen Social-Media-Plattformen</li>
          <li>eigenes Bild hochladbar</li>
          <li>Bilder von <a href="https://pixabay.com/de" target="_blank">Pixabay</a></li>
          <li>Icons von <a href="https://thenounproject.com/" target="_blank">TheNounProject</a></li>
          <li>Eigenes Logo wird dauerhaft gespeichert</li>
          <li><a href="https://github.com/codeispoetry/sharepicgenerator" target="_blank">Open Source</a></li>
          <li><em>und vieles mehr</em></li>
        </ul>
      </div>
    </div>
  </div>
</section>


<footer class="row bg-primary p-2 text-white">
    <div class="col-12 col-lg-6">
    <a href="https://github.com/codeispoetry/sharepicgenerator" target="_blank">Quellcode auf github.com</a> 
    </div>

    <div class="col-12 col-lg-6 text-lg-right">
        Programmiert mit <i class="fas fa-heart text-yellow"></i> von 
        <a href="MAILTO:mail@tom-rose.de?subject=Sharepicgenerator">Tom Rose</a>.
    </div>
</footer>
<script src="./vendor/jquery-3.4.1.min.js"></script>
<script>
    $('span.testaccess').click(function(){
        $('div.testaccess').slideDown();
    });

    $( document ).ready(function() {
        let sc = $('#sharepics-counter');
        let number = <?php echo count_sharepics(); ?>;
        let counting_number = Math.round( number * 0.6 );

        let counter = window.setInterval(() => {
            let delta = number - counting_number;
            counting_number += Math.max( 2, Math.round( delta / 10 ) );
           
            sc.html( counting_number.toLocaleString() );

            if( counting_number >= number){
                sc.html( (number -1).toLocaleString() );
                clearInterval( counter );
                window.setTimeout(() => {
                  sc.html( number.toLocaleString() );
                }, 1000);
            }
        }, 30);

    });

</script>
<?php
function count_sharepics( ){
    $number = 4550;
    $countSharepicsFiles = array('log/countsharepics.txt','bayern/log/countsharepics.txt');
    foreach($countSharepicsFiles AS $countSharepicsFile){
        if(file_exists($countSharepicsFile)){
            $number += (int) file_get_contents($countSharepicsFile);
        }
    }

    return $number;
}
?>
</body>
</html>