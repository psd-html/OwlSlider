<?php
class OwlSlider extends plxPlugin {
 
    public function __construct($default_lang){
    # Appel du constructeur de la classe plxPlugin (obligatoire)
    parent::__construct($default_lang);
    
    # Pour accéder à une page de configuration
    $this->setConfigProfil(PROFIL_ADMIN,PROFIL_MANAGER);
    # Déclaration des hooks
    $this->addHook('ThemeEndHead', 'ThemeEndHead');
    $this->addHook('ThemeEndBody', 'ThemeEndBody');
    $this->addHook('OwlSlider', 'OwlSlider'); //hook pour l'affichage manuel
    } 
    
    public function ThemeEndHead() { ?>
    
        <link rel="stylesheet" href="<?php echo PLX_PLUGINS ?>OwlSlider/app/style.min.css">
        <style>
          #owl-demo .item img{
            display: block;
            width: 100%;
            height: auto;
          }
          #bar{
            width: 0%;
            max-width: 100%;
            height: 8px;
            background: <?php echo $this->getParam("color_bar");?>;
            border-radius: 3px;
          }
          #progressBar{
            width: 100%;
            background-color: transparent;
            margin-bottom: 4px;

          }
          .item img{border-radius: 6px}
    </style>

        <?php
    }
    public function OwlSlider() {

      $dossier =  $this->getParam("dir");

      $directory = 'data/images/'.$dossier; // pluxml version 5.4

      $files = plxGlob::getInstance(PLX_ROOT.$directory);

      echo '<div id="owl-demo" class="owl-carousel">';

        if($styles = $files->query("/[a-z0-9-_\.\(\)]+/i")) {
          foreach($styles as $k=>$v) {
            $slider = $directory.'/'.$v;

            echo '<div class="item"><img src="'.$slider.'" alt="" /></div>';
          }
        }


        echo '</div>';


      ?>


        <br>

        <p><i class="flaticon-accepted"></i>Plud d'info sur ce plugin ? voir l'<a href="plugin-minislider" title="plugin PluXml MiniSlider">article</a></p>

      <?php 
    }
    public function ThemeEndBody(){ ?>


        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

        <script src="<?php echo PLX_PLUGINS ?>OwlSlider/app/owl.min.js"></script>

        <script>

            $(document).ready(function() {

              var time = <?php echo $this->getParam("time");?>; // time in seconds


              var $progressBar,
                  $bar, 
                  $elem, 
                  isPause, 
                  tick,
                  percentTime;

                //Init the carousel
                $("#owl-demo").owlCarousel({
                  slideSpeed : <?php echo $this->getParam("time_slider");?>,
                  paginationSpeed : <?php echo $this->getParam("time_slider");?>,
                  singleItem : true,
                  afterInit : progressBar,
                  afterMove : moved,
                  startDragging : pauseOnDragging,
                  pagination: <?php echo $this->getParam("pagination");?>,



                });

                //Init progressBar where elem is $("#owl-demo")
                function progressBar(elem){
                  $elem = elem;
                  //build progress bar elements
                  buildProgressBar();
                  //start counting
                  start();
                }

                //create div#progressBar and div#bar then prepend to $("#owl-demo")
                function buildProgressBar(){
                  $progressBar = $("<div>",{
                    id:"progressBar"
                  });
                  $bar = $("<div>",{
                    id:"bar"
                  });
                  $progressBar.append($bar).prependTo($elem);
                }

                function start() {
                  //reset timer
                  percentTime = 0;
                  isPause = false;
                  //run interval every 0.01 second
                  tick = setInterval(interval, 10);
                };

                function interval() {
                  if(isPause === false){
                    percentTime += 1 / time;
                    $bar.css({
                       width: percentTime+"%"
                     });
                    //if percentTime is equal or greater than 100
                    if(percentTime >= 100){
                      //slide to next item 
                      $elem.trigger('owl.next')
                    }
                  }
                }

                //pause while dragging 
                function pauseOnDragging(){
                  isPause = true;
                }

                //moved callback
                function moved(){
                  //clear interval
                  clearTimeout(tick);
                  //start again
                  start();
                }


                $elem.on('mouseover',function(){
                  isPause = <?php echo $this->getParam("hover");?>;
                })
                $elem.on('mouseout',function(){
                  isPause = false;
                })
            });

        </script>
        <?php
    }
      
} // class OwlSlider
?>