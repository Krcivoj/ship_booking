<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="index.php?rt=login/login" >
    Email:
    <input type="text" name="email" />
    <br />
    Password:
    <input type="password" name="password" />
    <br />
    <button type="submit" name="login" value="login">Log in!</button>
    <button type="submit" name="novi" value="novi">Sign up!</button>
</form>

<?php 
    if( $message !== '' )
        echo '<p>' . $message . '</p>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>