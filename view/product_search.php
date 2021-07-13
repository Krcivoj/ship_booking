<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="nav">
          <ul class="menu-bar">
            <li class="left">DISCOVER KVARNER</li>
            <li class="right"><a href="index.php?rt=authentication/login" class="button">Prijavi se</a></li>
            <li class="right"><a href="index.php?rt=authentication/signup_index" class="button">Registriraj se</a></li>
          </ul>
        </div>

        <section class="index">
            <div class="center">
                <div class="main">
                    <div class="search">
                      <h1 class="main-title">DOBRODOŠLI NA  <font style="font-family: 'Rock Salt';">  Kvarner!</font></h1>
                      <h4 class="main-small"> Potražite najbolje izlete i iskoristite godišnji odmor na najbolji način!</h4>
                    </div>
                </div>
                <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

                <div class="wrap">

                  <div class="l">
                    <label for="fname">Mjesto polaska</label>
                    <input id="fname" type="text" class="cool"/>
                  </div>

                  <div class="r">
                    <label for="lname">Lokacija koju želim posjetiti</label>
                    <input id="lname" type="text" class="cool"/>
                  </div>
                </div>
                <script>
                  $('input').on('focusin', function() {
                      $(this).parent().find('label').addClass('active');
                  });

                  $('input').on('focusout', function() {
                      if (!this.value) {
                          $(this).parent().find('label').removeClass('active');
                        }
                  });
            </script>


            </div>
        </section>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
