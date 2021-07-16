<div class="rezultat">
      <a href="#" style="text-decoration: none;"><img class="brodic" src = ../ship_booking/assets/brod.png></img></a>       
      <p id="povijest-ime" style=" font-family:'Rock Salt'; font-weight: bold; font-size:20px;color:black;"><?php echo $reservation->name; ?></p>
      <p id="povijest-karte-odrasli"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Odrasli: <?php echo $reservation->ticket_adults; ?></p>
      <p id="povijest-karte-djeca"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Djeca: <?php echo $reservation->ticket_kids; ?></p>
      <p id="povijest-karte-bebe"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Bebe: <?php echo $reservation->ticket_baby; ?></p>
      <p id="povijest-meso"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Mesni meni: <?php echo $reservation->menu_meat; ?></p>
      <p id="povijest-riba"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Riblji meni: <?php echo $reservation->menu_fish; ?></p>
      <p id="povijest-vege"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Vegeterijanski meni: <?php echo $reservation->menu_veg; ?></p>
      <p id="povijest-datum-rezervacije"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Datum rezervacije: <?php echo $reservation->date_buy; ?></p>
      <p id="povijest-datum-putovanja"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Datum putovanja: <?php echo $reservation->date_trip; ?></p>
      <p id="povijest-kod"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Rezervacijski kod: <?php echo $reservation->code; ?></p>
      <?php
        if($reservation->comment)
        {
          ?>
          <p id="povijest-komentar"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;"> Komentar: <?php echo $reservation->comment; ?></p>
          <p id="povijest-ocijena"  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Ocijena: <?php echo $reservation->rating; ?></p>
          <?php
        }
        else if(!$owner)
        {
          ?>
          <form method="post" action="index.php?rt=user/comment" >
          <p  style=" margin-top:10px;font-family:sans-serif; font-size:20px;color:#306a82;">Želite li komentirati svoje putovanje:</p>
          
          <br>
          <p  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Ocjena:</p>
              <select name="rating">
                  <option disabled selected>Please select...</option>
                  <option value=1>1</option>
                  <option value=2>2</option>
                  <option value=3>3</option>
                  <option value=4>4</option>
                  <option value=5 selected>5</option>
              </select>
          <br>
          <p  style=" margin-top:5px;font-family:sans-serif; font-size:15px;color:#306a82;">Komentar:</p>
          <input type="text" name="comment" />
          <button type="submit" name="id" value= <?php echo $reservation->id; ?> >Pošalji</button>
        </form>
        <?php
        }
      ?>
              
</div>