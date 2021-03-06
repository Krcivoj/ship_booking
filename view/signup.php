<?php require_once __DIR__ . '/_header.php'; ?>
<!--
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
-->

        
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title"> Registriraj se</h2>
                        <form method="post" action="index.php?rt=authentication/signup"  class="register-form" id="register-form">
                            <div class="form-group">
                                <label id="ikona" style="color: black; margin:8px;" for="name">
                                    <i style="margin-right:10px" class="zmdi zmdi-account material-icons-name">
                                    </i>
                                </label>
                                <input id="name" type="text" name="name" class="podaci" placeholder="Vaše ime"/>
                            </div>
                            <div class="form-group">
                                <label id="ikona" style="color: black; margin:8px;" for="surname">
                                    <i style="margin-right:10px" class="zmdi zmdi-account material-icons-name-outline">
                                    </i>
                                </label>
                                <input id="surname" type="text" name="surname" class="podaci" placeholder="Vaše prezime"/>
                            </div>
                            <div class="form-group">
                                <label id="ikona" style="color: black; margin:8px;" for="email"><i style="margin-right:10px" class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email" id="email" class="podaci" placeholder="Vaš email"/>
                            </div>
                            <div class="form-group">
                                <label  id="ikona" style="color: black; margin:8px;" for="pass"><i style="margin-right:10px" class="zmdi zmdi-lock"></i></label>
                                <input id="password" type="password" name="password" class="podaci" placeholder="Lozinka"/>
                            </div>
                            <div class="form-group">
                                <label id="ikona" style="color: black; margin:8px;" for="re-pass"><i style="margin-right:10px" class="zmdi zmdi-lock-outline"></i></label>
                                <input id="repeatPassword" type="password" name="repeatPassword" class="podaci" placeholder="Ponovite lozinku"/>
                            </div>
                            <?php 
                                if( $message !== '' )
                                    echo '<p style="color:red; font-family: Garamond; font-size: 1.25em; margin-left: 20px; margin: 10px;">' . $message . '</p>';
                            ?>
                            <div class="form-group form-button">
                                <input id="btn" type="submit" name="gumb" class="button-submit" value="registriraj se"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


<script src="<?php echo __SITE_URL; ?>/js/signup.js" ></script>
<?php require_once __DIR__ . '/_footer.php'; ?>