<?php require_once __SITE_PATH . '/view/_header.php'; ?>


  <?php if($type === 'owner')
  {
    echo '<li class="right"><a href="index.php?rt=user/reservations" class="button">Moji izleti</a></li>';
    echo '<li class="right"><a href="index.php?rt=user/ships" class="button">Rezervacije brodova</a></li>';
    ?>
    <div style="color:black; text-align:center; font-family: Garamond; font-size: 2em; font-weight: bold; margin-top:100px;">Sve rezervacije na Vašim brodovima:</div>
    <?php
  }
  else
  {
    ?>
    <div style="color:black; text-align:center; font-family: Garamond; font-size: 2em; font-weight: bold; margin-top:100px;">Vaše rezervacije:</div>
    <?php
  }
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