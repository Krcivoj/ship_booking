<?php require_once __DIR__ . '/_header.php'; ?>
<!---
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
    //if( $message !== '' )
    //    echo '<p>' . $message . '</p>';
?>
-->
<div class="nav">
          <ul class="menu-bar">
            <li class="left">DISCOVER KVARNER</li>
            <li class="right"><a href="index.php?rt=authentication/login" class="button">Prijavi se</a></li>
            <li class="right"><a href="index.php?rt=authentication/signup_index" class="button">Registriraj se</a></li>
          </ul>
        </div>
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-form">
                        <h2 class="form-title">Prijavi se</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label id="ikona" style="color: black; margin:8px;" for="your_name">
                                    <i style="margin-right:10px" class="zmdi zmdi-email">
                                    </i>
                                </label>
                                <input type="text" name="email" id="your_name" class="podaci" placeholder="Vaš email"/>
                            </div>
                            <div class="form-group">
                                <label id="ikona" style="color: black; margin:8px;" for="your_pass">
                                    <i style="margin-right:10px" class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" class="podaci" placeholder="Lozinka"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="gumb" value="prijavi se" id="signin" class="button" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
<?php require_once __DIR__ . '/_footer.php'; ?>