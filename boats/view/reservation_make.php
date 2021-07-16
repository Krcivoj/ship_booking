<?php require_once __SITE_PATH . '/view/_header.php'; ?>


<div style="display:inline-block;margin-top: 30px;width:100%">
  <div class="forma" style="margin-left:15px; margin-right:15px;">
  <form method="POST" style="margin-left: 20%; margin-right:20%;background-color:rgb(256,256, 256, 0.8); border-radius: 15px;padding:10px;">
    
      <div style="margin-top:10px;margin-left:15%;width:100%">
        <label for="ime" style="position:relative; color: #056fa1; height:27px; font-family: 'Exo 2', sans-serif; font-size: 20px;">IME:</label>
        <input style="margin-bottom:5px;width:40%"type="text" id="ime" name="ime" placeholder="Vaše ime..."/> 
      </div>
      
        <div style="width:100%;margin-top:10px;margin-left:15%;">
          <label style="position: relative; color: #056fa1; height:27px;font-family:'Exo 2', sans-serif; font-size: 20px;" for="prezime">PREZIME:</label>
          <input style="margin-bottom:5px;width:40%" type="text" id="prezime" name="prezime" placeholder="Vaše prezime..."/>
        </div>
    <div style="width:100%;margin-top:10px;margin-left:15%;">
      <label for="mail"  style="position: relative; color: #056fa1;height:27px;font-family: 'Exo 2', sans-serif; font-size: 20px;">E-MAIL:</label>
      <input style="margin-bottom:5px;width:40%" type="text" id="mail" name="mail" placeholder="Vaš email..."/>
    </div>
    <div style="width:100%;margin-top:10px;margin-left:15%;margin-bottom:20px;">
      <label  style="position: relative;color: #056fa1;height:27px;font-family:  'Exo 2', sans-serif; font-size: 20px;" for="datum">DATUM:</label>
      <input type="date" id="datum" name="datum" value="2021-07-01" min="2019-01-01" max="2021-12-31" style="margin-bottom:5px;"/>
    </div>

    <div style="display: inline-block;width:100%;">
      <div style="float:left;width:30%">
        <label style="margin-left:20px;padding: 0px; position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">ODRASLI:</label>
        <input style="width:15%" type="number" class="kol" name="adults" min="0" max="50" value="0"/>
      </div>
      <div style="float:left;width:30%">
        <label style="padding: 0px; position: relative; color: #056fa1; float:left; height:27px;font-family: 'Exo 2', sans-serif; font-size: 15px;" for="opcija">DJECA (3-12 god.):</label>
        <input style="width:15%" type="number" class="kol" name="kids" min="0" max="50" value="0"/>
      </div>
      <div style="float:left;width:30%">
        <label style="padding: 0px; position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">BEBE (&lt 3 god.):</label>
        <input  style="width:15%" type="number" class="kol" name="babies" min="0" max="50" value="0" />
      </div>
    </div>
    <div style="display: inline-block;width:100%;">
      <div style="float:left;width:30%">
        <label style="margin-left:20px;padding: 0px; position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">MESNI:</label>
        <input  style="width:15%" type="number" class="kol" name="meat" min="0" max="50" value="0"/>
      </div>
      <div style="float:left;width:30%">
        <label style="padding: 0px; position: relative; color: #056fa1; float:left; height:27px;font-family: 'Exo 2', sans-serif; font-size: 15px;" for="opcija">RIBLJI:</label>
        <input style="width:15%" type="number" class="kol" name="fish" min="0" max="50" value="0"/>
      </div>
      <div style="float:left;width:30%">
        <label style="padding: 0px; position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">VEGE:</label>
        <input  style="width:15%" type="number" class="kol" name="vege" min="0" max="50" value="0"/>
      </div>
    </div>
<?php 
    if( $message !== '' )
        echo '<p style="color:red; font-family: Garamond; font-size: 1.25em; margin-left: 20px; margin: 10px;">' . $message . '</p>';
?>
    <input type="submit" value="rezerviraj" class="button-submit" style="margin-left:35%;margin-bottom:10px;"/>
    </form>
   </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>