<?php require_once __DIR__ . '/_header.php'; ?>


<?php 
    if( $message !== '' )
        echo '<div style="color:black; text-align:center; font-family: Garamond; font-size: 2em; font-weight: bold; margin-top:100px;">' . $message . '</div>';
        
    if ($btn)
    echo '<form method="post" action="index.php?rt=authentication/registered" style="text-align:center">
        <button type="submit" name="again" value="again" class="button-submit">Ponovno pošalji</button>
    </form>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>