<?php require_once __SITE_PATH . '/view/_header.php'; ?>


  <?php if($type === 'owner')
  {
    echo '<ul style="list-style-type: none;">';
    echo '<li class="right"><a href="index.php?rt=user/reservations" class="button-submit">Moji izleti</a><a style="margin-left:10px;" href="index.php?rt=user/ships" class="button-submit">Rezervacije brodova</a></li>';
    //echo '<li class="right"><a href="index.php?rt=user/ships" class="button-submit">Rezervacije brodova</a></li>';
    echo '</ul>';

  }
  
    echo '<div style="color:black; text-align:center; font-family: Garamond; font-size: 2em; font-weight: bold; margin-top:80px;">'. $title .'</div>';
    
  ?>
    <div class="popis">
    <?php
      foreach($reservationList as $reservation){
        $this->registry->template->reservation = $reservation;
        $this->registry->template->show('reservation');
      }
          
     ?>     
        
          <script src="<?php echo __SITE_URL; ?>/js/excursions.js" ></script>
        </div>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>