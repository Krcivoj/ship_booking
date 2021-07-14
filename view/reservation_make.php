<?php require_once __SITE_PATH . '/view/_header.php'; ?>


<div style="display:inline-block;margin-top: 30px;width:100%">
  <div class="forma" style="margin-left:15px; margin-right:15px;height:500px;">
  <form action="/action_page.php" style="margin-left: 20%; margin-right:20%;background-color:rgb(256,256, 256, 0.8); border-radius: 15px;">
    <div style="display: inline-block;width:100%">
      <div style="float:left;width:35%;margin-top:10px;">
      <label for="ime" style="position:relative; color: #056fa1; float:left; margin-right: 1em; height:27px; font-family: 'Exo 2', sans-serif; font-size: 20px;">IME:</label>
      <input style="float:left;margin-bottom:5px;width:40%"type="text" id="ime" name="ime" placeholder="Vaše ime..."/> 
      </div>
      <div style="float:right;width:55%;margin-top:10px;">
      <input style="float:right;margin-right:20px;width:40%" type="text" id="prezime" name="prezime" placeholder="Vaše prezime..."/>
      <label style="position: relative; color: #056fa1; float:right; margin-right: 1em; height:27px;font-family:'Exo 2', sans-serif; font-size: 20px;" for="prezime">PREZIME:</label>
      </div>
    </div>
    <div style="margin-top:0px;">
      <label for="mail"  style="position: relative; color: #056fa1; float:left; margin-right: 1em; height:27px;font-family: 'Exo 2', sans-serif; font-size: 20px;">E-MAIL:</label>
      <input type="text" id="mail" name="mail" placeholder="Vaš email..."/>
    </div>
    <div style="margin-top:0px;width:100%; display:inline-block;">
      <label  style="position: relative;color: #056fa1; float:left; margin-right: 1em; height:27px;font-family:  'Exo 2', sans-serif; font-size: 20px;" for="datum">DATUM:</label>
      <input type="date" id="datum" name="datum" value="2021-07-01" min="2019-01-01" max="2021-12-31"/>
    </div>
    <div style="display: inline-block;width:100%;">
      <div style="float:left;width:30%">
        <label style="position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">ODRASLI:</label>
        <input type="number" class="kol" name="kolicina" min="0" max="50"/>
      </div>
      <div style="float:left;width:30%">
        <label style="position: relative; color: #056fa1; float:left; height:27px;font-family: 'Exo 2', sans-serif; font-size: 15px;" for="opcija">DJECA:</label>
        <input type="number" class="kol" name="kolicina" min="0" max="50"/>
      </div>
      <div style="float:left;width:40%">
        <label style="position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">BEBE:</label>
        <input type="number" class="kol" name="kolicina" min="0" max="50"/>
      </div>
    </div>
    <div style="display: inline-block;width:100%;">
      <div style="float:left;width:30%">
        <label style="position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">MESNI:</label>
        <input type="number" class="kol" name="kolicina" min="0" max="50"/>
      </div>
      <div style="float:left;width:30%">
        <label style="position: relative; color: #056fa1; float:left; height:27px;font-family: 'Exo 2', sans-serif; font-size: 15px;" for="opcija">RIBLJI:</label>
        <input type="number" class="kol" name="kolicina" min="0" max="50"/>
      </div>
      <div style="float:left;width:40%">
        <label style="position: relative; color: #056fa1; float:left; height:27px;font-family:  'Exo 2', sans-serif; font-size: 15px;" for="opcija">VEGE:</label>
        <input type="number" class="kol" name="kolicina" min="0" max="50"/>
      </div>
    </div>
    <input type="submit" value="rezerviraj" class="button-submit" style="margin-left:35%;margin-bottom:10px;"/>
    </form>
   </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>