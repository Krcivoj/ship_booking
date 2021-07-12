<?php require_once __DIR__ . '/_header.php'; ?>

<?php 
    if( $message !== '' )
        echo '<p>' . $message . '</p>';
        
    if ($btn)
    echo '<form method="post" action="index.php?rt=authentication/registered" >
        <button type="submit" name="again" value="again">Ponovno pošalji</button>
    </form>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>