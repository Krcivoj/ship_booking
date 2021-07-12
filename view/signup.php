<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="index.php?rt=authentication/signup" >
    Ime: 
    <input id="name" type="text" name="name" />
    <br />
    Prezime:
    <input id="surname" type="text" name="surname" />
    <br />
    Email:
    <input id="email" type="text" name="email" />
    <br />
    Zaporka:
    <input id="password" type="password" name="password" />
    <br />
    Ponovi zaporku:
    <input id="repeatPassword" id="name" type="password" name="repeatPassword" />
    <br />
    <button id="btn" type="submit" name="gumb" value="novi">Registiraj se!</button>
</form>

<?php 
    if( $message !== '' )
        echo '<p>' . $message . '</p>';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="<?php echo __SITE_URL; ?>/js/signup.js" ></script>
<?php require_once __DIR__ . '/_footer.php'; ?>