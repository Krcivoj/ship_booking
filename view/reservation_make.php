<link href="css/styles.css" rel="stylesheet" />
<div class="forma">
  <form action="https://rp2.studenti.math.hr/action_page.php">
    <label for="ime">Ime i prezime</label>
    <input type="text" id="ime" name="ime" placeholder="Vaše ime i prezime...">

    <label for="mail">Vaš e-mail</label>
    <input type="text" id="mail" name="mail" placeholder="Mail za komunikaciju...">

    <label for="datum">Datum</label>
    <input type="date" id="datum" name="datum" value="2020-01-01" min="2020-01-01" max="2020-12-31">

    <select id="opcija" name="ponuda">
      <option value="Odrasli">Odrasli</option>
      <option value="Djeca-st">Djeca - starija</option>
      <option value="Djeca-ml">Djeca - mlađa</option>
    </select>

    <label for="opcija">Količina</label>
    <input type="number" class="kol" name="kolicina" min="0" max="30">

    <select id="opcija1" name="ponuda">
      <option value="Odrasli">Odrasli</option>
      <option value="Djeca-st">Djeca - starija</option>
      <option value="Djeca-ml">Djeca - mlađa</option>
    </select>

    <label for="opcija1">Količina</label>
    <input type="number" class="kol" name="kolicina" min="0" max="30">

    <select id="opcija2" name="ponuda">
      <option value="Odrasli">Odrasli</option>
      <option value="Djeca-st">Djeca - starija</option>
      <option value="Djeca-ml">Djeca - mlađa</option>
    </select>

    <label for="opcija2">Količina</label>
    <input type="number" class="kol" name="kolicina" min="0" max="30">

    <input type="submit" value="Submit">
  </form>
</div>