<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="index.php?rt=login/signup" >
    Ime: 
    <input type="text" name="name" />
    <br />
    Prezime:
    <input type="text" name="surname" />
    <br />
    Email:
    <input type="text" name="email" />
    <br />
    Password:
    <input type="password" name="password" />
    <br />
    <button type="submit" name="gumb" value="novi">Registiraj se!</button>
</form>

<?php 
    if( $message !== '' )
        echo '<p>' . $message . '</p>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>