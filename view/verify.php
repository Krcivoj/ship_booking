<?php require_once __DIR__ . '/_header.php'; ?>
<div class="nav">
          <ul class="menu-bar">
            <a href="index.php?rt=excursions" id="link"><li class="left">DISCOVER KVARNER</li></a>
            <li class="right"><a href="index.php?rt=authentication/login" class="button">Prijavi se</a></li>
            <li class="right"><a href="index.php?rt=authentication/signup_index" class="button">Registriraj se</a></li>
          </ul>
</div>

<?php 
    if( $message !== '' )
        echo '<div style="color:black; text-align:center; font-family: Garamond; font-size: 2em; font-weight: bold; margin-top:100px;">' . $message . '</div>';
        
    if ($btn)
    echo '<form method="post" action="index.php?rt=authentication/registered" style="text-align:center">
        <button type="submit" name="again" value="again" class="button-submit">Ponovno pošalji</button>
    </form>';
?>

<?php require_once __DIR__ . '/_footer.php'; ?>