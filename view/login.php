<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="index.php?rt=login" >
    Email:
    <input type="text" name="email" />
    <br />
    Password:
    <input type="password" name="password" />
    <br />
    <button type="submit" name="gumb" value="login">Log in!</button>
    <button type="submit" name="gumb" value="novi">Sign up!</button>
</form>

<?php 
    if( $message !== '' )
        echo '<p>' . $message . '</p>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>