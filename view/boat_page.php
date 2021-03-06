<!DOCTYPE html>
<html lang="hr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../ship_booking/assets/sidro2.png" rel="icon">
    <title><?php echo $ship->name;?></title>       <!--PROMJENITI-->
    <link rel="stylesheet" href="../ship_booking/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
  </head>
  <body id="main">
    <nav style="background: url(../ship_booking/assets/rot.jpg);">
      <ul class="m">
        <li class="menu"><a class="menu1" href="#main"><p class="menu2">Izlet brodom</p></a></li>
        <li class="menu"><a class="menu1" href="#rezervacija"><p class="menu2">Rezervacija</p></a></li>
        <li class="menu"><a class="menu1" href="#komentari"><p class="menu2">Recenzije</p></a></li>
        <li class="menu"><a class="menu1" href="#galerija"><p class="menu2">Galerija</p></a></li>        
        <li class="lang"><a class="lang1" href="index.html"><img src="../ship_booking/assets/cro.png" alt="Croatia"></a></li>
        <li class="lang"><a class="lang1" href="index.html"><img src="../ship_booking/assets/uk.png" alt="English"></a></li>
        <li class="lang"><a class="lang1" href="index.html"><img src="../ship_booking/assets/ita.png" alt="Italy"></a></li>
        <li class="lang"><a class="lang1" href="index.html"><img src="../ship_booking/assets/ger.jpg" alt="Germany"></a></li>

      </ul>
    </nav>
    <h1 style="padding-top: 1.5em;font-family: 'Rock Salt', cursive;font-size: 40px;"><?php echo $ship->name;?></h1>    <!--naslov promjeniti-->
    <article>
      <p class="desc"><?php echo $ship->description;?>
      </p>    <!--description promjeniti-->
    </article>
    <aside>
      <img id="krk" src="../ship_booking/assets/<?php echo $ship->name;?>.jpg" alt="Brod">   <!--mozda ovjde za svakog posebna slika-->
    </aside>
    <br/>
    <section>
      <h2>Informacije o po??etku</h2>   <!--polaziste promjeniti-->
      <p id="info">Polazak broda je s predivne rive mjesta <?php echo $ship->start_place;?> u <strong><?php echo substr($ship->departure_time,0,5);?> sati ujutro svakoga dana</strong>. Brinemo za Va??u udobnost i sigurnost 
        te stoga ne primamo vi??e od <?php echo $ship->capacity;?> ljudi, stoga je preporu??ljivo
        rezervirati izlet na vrijeme. Na raspolaganju su Vam stolovi, mjesta za odlaganje stvari, wc te dodatna oprema. 
        U mjesto <?php echo $ship->start_place;?> vra??amo se oko <?php echo substr($ship->arrival_time,0,5)?> sati, sretni i radosni, puni dojmova!
      </p>
    </section>

    <div class="row">
      <h2>Cijenik i ponuda</h2>
      <div class="column" style="background-color: #f5df9f">
        <h4>Nudimo Vam:</h4>
        <ul class="po">  
          <li class="ponuda"><?php echo count($locations);?> lokacije za kupanje</li>                                       <!--pobroji lokacije-->
          <?php 
            $pocetak = intval(substr($ship->departure_time,0,2))*60 + intval(substr($ship->departure_time,3,2));
            $kraj = intval(substr($ship->arrival_time,0,2))*60 + intval(substr($ship->arrival_time,3,2))*60;
            $trajanje = -$pocetak+$kraj;
          ?>
          <li class="ponuda">Izlet u trajanju <?php echo floor($trajanje/60);?> sati i <?php echo $trajanje%60;?> minuta</li>                                            <!--trajanje-->
          <li class="ponuda">3 menija - mesni, riblji i vegetarijanski</li>
          <li class="ponuda">Kava i keksi</li>
        </ul>

      </div>
      <div class="column" style="background-color: #fcf39f;">
        <h4>Cijena izleta:</h4>
        <ul class="po">                                         <!--ubaci-->
          <li class="ponuda">Odrasli - <?php echo $ship->price_adults;?>kn</li>
          <li class="ponuda">Djeca(3-12g) - <?php echo $ship->price_kids;?>kn</li>
          <li class="ponuda">Djeca(0-3g) - besplatno</li>
          <li class="ponuda">Ljubimci - <?php if($ship->animal_friendly) echo "slobodno"; else echo "zabranjeno"; ?></li>
      </ul>
      </div>
</div>

<div>
    <h1 id="rezervacija">REZERVIRAJTE SVOJ IZLET!</h1>

    <h3 style="margin-left: 1em;">Bila bi ??teta propustiti ljepote koje Kvarner i na?? izlet nude. Stoga, rezervirajte svoj izlet kako bi osigurali mjesto na nesvakida??njem izletu.</h3> 
    <p style="margin-left: 1em;" >Rezervirati svoj izlet mo??ete na vi??e na??ina:</p> 
    <ul>
        <li>Svakim danom dostupni smo na odgovaraju??em ??tandu na rivi od 9 do 23h</li>
        <li>Rezerviranjem online - popunjavanje obrasca i dobivanje koda</li>
    </ul>
    <form method="post" action="index.php?rt=ship/reservation_make&name=<?php echo $ship->name;?>">
    <button type="submit" class="rezerviraj">REZERVIRAJTE ONLINE!</button></form>

</div>

<h2>Ukoliko nas ??elite prona??i u??ivo, potra??ite nas uz pomo?? pribli??ne lokacije!</h2>
<div id="mapa" style=" width: 500px; height: 500px;"><p id="lat"><?php echo $ship->start_lat;?></p><p id="lon"><?php echo $ship->start_lon;?></p></div>

<script>

$( document ).ready( function() 
{
    
        
        var sir1 = $('#lat').html();
        $('#lat').remove();
        var sir = parseFloat(sir1); 
        var duz1 = $('#lon').html();
        $('#lon').remove();
        var duz = parseFloat(duz1); 

        var openLayerMap = new ol.Map(
        {
            target: 'mapa', // id elementa gdje ??e se nacrtati mapa
            layers: // koje slojeve ??emo prikazati na mapi
            [
                // OpenStreetMap
                new ol.layer.Tile( { source: new ol.source.OSM() } )
            ],
            view: new ol.View(
            {
                center: ol.proj.fromLonLat( [duz, sir] ), // zemljopisne koord. centra mape
                zoom: 15
            })
    } );
} );
</script>

<h1 id="komentari">REZENCIJE</h1>
<h3 style="margin-left: 1em;">Pro??itajte komentare i ocijene koje su gosti ostavili:</h3> 
<ul>
    
    <?php 
        foreach($resList as $res){
          if($res->comment || $res->rating){
            echo '<li>';
            if($res->rating){
                echo '<font class="desc">Ocijena:<font style="color:red"> '.$res->rating;
            }
            if($res->comment){
                echo '</font>       Komentar: </font>'.$res->comment;
            }
            echo '</li>';
          }
        }
    ?>
</ul>



<h1 id="galerija">GALERIJA</h1>



<div style="display:inline-block;">
<div class="polaroid">
      <img src="../ship_booking/assets/<?php echo $ship->name;?>.jpg" style="width:100%">
      <div class="container">
        <p>Slika broda</p>
      </div>
    </div>
<?php
foreach($locations as $loc_name){
    ?>
    <div class="polaroid">
      <img src="../ship_booking/assets/<?php echo $loc_name;?>.jpg" style="width:100%">
      <div class="container">
        <p><?php echo $loc_name;?></p>
      </div>
    </div>
    <?php
}
?>
</div>

<div id='chart' name=<?php echo $ship->name;?>></div>

<script src="<?php echo __SITE_URL; ?>/js/chart.js" ></script>

  </body>

</html>
