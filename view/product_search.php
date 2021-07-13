<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="nav">
          <ul class="menu-bar">
            <li class="left">DISCOVER KVARNER</li>
            <li class="right"><a href="login.html" class="button">Login</a></li>
            <li class="right"><a href="register.html" class="button">Register</a></li>
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

                <div class="wrapper">
                  <div class="search_box">
                    <div class="dropdown">
                      <div class="default_option">All</div>
                      <ul class="default_option_ul">
                        <li class="dropdown_ul_li">Grad - polaska</li>
                        <li class="dropdown_ul_li">Cijena</li>
                        <li class="dropdown_ul_li">Trajanje</li>
                        <li class="dropdown_ul_li">Lokacija</li>
                        <li class="dropdown_ul_li">Ljubimci dopušteni</li>
                      </ul>
                    </div>
                    <div class="search_field">
                      <input type="text" class="main-input" placeholder="Search">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <script>
            $(".default_option").click(function(){
                $(".dropdown_ul").addClass("active");
            });

            $(".dropdown_ul_li").click(function(){
              var text = $(this).text();
                $(".default_option").text(text);
            $(".dropdown_ul").removeClass("active");
});
        </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
