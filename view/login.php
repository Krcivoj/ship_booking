<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="index.php?rt=authentication" >
    Email:
    <input type="text" name="email" />
    <br />
    Zaporka:
    <input type="password" name="password" />
    <br />
    <button type="submit" name="gumb" value="login">Prijava</button>
    <button type="submit" name="gumb" value="novi">Registriraj se!</button>
</form>

<?php 
    if( $message !== '' )
        echo '<p>' . $message . '</p>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>