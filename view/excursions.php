<?php require_once __SITE_PATH . '/view/_header.php'; ?>



        <section class="index" >
            <div class="center">
                <div class="main">
                    <div class="search">
                      <h1 class="main-title">DOBRODOŠLI NA  <font style="font-family: 'Rock Salt';">  Kvarner!</font></h1>
                      <h4 class="main-small"> Potražite najbolje izlete i iskoristite godišnji odmor na najbolji način!</h4>
                    </div>
                </div>
                <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

                <div class="wrap" style="width: 100%;">

                  <div class="l">
                    <label for="place">MJESTO POLASKA</label>
                    <input id="place" type="text" class="cool" style="color:black; font-family: Garamond; font-weight:bold"/>
                  </div>

                  <div class="r" style="width: 40%;">
                    <label for="location" style="position: absolute; margin-left:30px;">LOKACIJA KOJU ŽELIM POSJETITI</label>
                    <input id="location" type="text" class="cool" style="color:black; font-family: Garamond; font-weight:bold; margin-right:20px; margin-left:20px; padding-left: 10px;"/>
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
            <div class="ispod" style="  width: 100%; padding-left:10px; padding-top: 8px; margin-top: 60px; margin-left: 20px; display: inline-block;  background-color:#f5ddb0; opacity: 0.85; border-radius:10px;">
                    <div style="float:left"><p style="margin-top: 8px; margin-right: 8px; color:black; font-weight: bold; font-family: Garamond; font-size:1em;opacity: 1;">ODRASLI</p></div>
                    <div class="nivo" style="margin-top:14px;float: left; opacity: 1;">
                        <div class="slider" style="background-color: #a9a9a9;">
                            <div class="track">
                            </div>
                        </div>
                        <div class="output o0" id="odrasliLow" style="border: #a9a9a9;"> </div>
                        <div class="thumb t0"></div> 

                        <div class="output o1" id="odrasliHigh"> </div>
                        <div class="thumb t1"></div>
                        <br/>

                   </div>

                   <div class="nivo2" style="margin-top:14px;float: right; opacity: 1;">
                       <div class="slider2" style="background-color: #a9a9a9;">
                           <div class="track2"></div>
                       </div>
                       <div class="output2 o02" id="djecaLow"> </div>
                       <div class="thumb2 t02"></div>

                       <div class="output2 o12" id="djecaHigh"> </div>
                       <div class="thumb2 t12"></div>
                  </div>
                  <div style="float:right"><p style="margin-top: 8px; margin-right: 8px; color:black; font-weight: bold; font-family: Garamond; font-size:1em;opacity: 1;">DJECA</p></div>
               </div>

               <script>
                   var inputsRy = {
                      sliderWidth: 300,
                      minRange: 100,
                      maxRange: 500,
                      outputWidth:30, // output width
                      thumbWidth: 18, // thumb width
                      thumbBorderWidth: 4,
                      trackHeight: 4,
                      theValue: [100, 500] // theValue[0] < theValue[1]
                    };
                    var isDragging0 = false;
                    var isDragging1 = false;

                    var range = inputsRy.maxRange - inputsRy.minRange;
                    var rangeK = inputsRy.sliderWidth / range;
                    var container = document.querySelector(".nivo");
                    var thumbRealWidth = inputsRy.thumbWidth + 2 * inputsRy.thumbBorderWidth;

                    // styles
                    var slider = document.querySelector(".slider");
                    slider.style.height = inputsRy.trackHeight + "px";
                    slider.style.width = inputsRy.sliderWidth + "px";
                    slider.style.paddingLeft = (inputsRy.theValue[0] - inputsRy.minRange) * rangeK + "px";
                    slider.style.paddingRight = inputsRy.sliderWidth - inputsRy.theValue[1] * rangeK + "px";

                    var track = document.querySelector(".track");
                    track.style.width = inputsRy.theValue[1] * rangeK - inputsRy.theValue[0] * rangeK + "px";

                    var thumbs = document.querySelectorAll(".thumb");
                    for (var i = 0; i < thumbs.length; i++) {

                      thumbs[i].style.width = thumbs[i].style.height = inputsRy.thumbWidth + "px";
                      //console.log(inputsRy.thumbWidth + "px");
                      thumbs[i].style.borderWidth = inputsRy.thumbBorderWidth + "px";
                      thumbs[i].style.top = -(inputsRy.thumbWidth / 2 + inputsRy.thumbBorderWidth - inputsRy.trackHeight / 2) + "px";
                      thumbs[i].style.left = (inputsRy.theValue[i] - inputsRy.minRange) * rangeK - (thumbRealWidth / 2) + "px";

                    }
                    var outputs = document.querySelectorAll(".output");
                    for (var i = 0; i < outputs.length; i++) {
                      //console.log(thumbs[i])
                      outputs[i].style.width = outputs[i].style.height = outputs[i].style.lineHeight = outputs[i].style.left = inputsRy.outputWidth + "px";
                      outputs[i].style.top = -(Math.sqrt(2 * inputsRy.outputWidth * inputsRy.outputWidth) + inputsRy.thumbWidth / 2 - inputsRy.trackHeight / 2) +"px";
                      outputs[i].style.left = (inputsRy.theValue[i] - inputsRy.minRange) * rangeK - inputsRy.outputWidth / 2 + "px";
                      outputs[i].innerHTML = "<p>" + inputsRy.theValue[i] + "</p>";
                    }

                    //events

                    thumbs[0].addEventListener("mousedown", function(evt) {
                      isDragging0 = true;
                    }, false);
                    thumbs[1].addEventListener("mousedown", function(evt) {
                      isDragging1 = true;
                    }, false);
                    container.addEventListener("mouseup", function(evt) {
                      isDragging0 = false;
                      isDragging1 = false;
                    }, false);
                    container.addEventListener("mouseout", function(evt) {
                      isDragging0 = false;
                      isDragging1 = false;
                    }, false);

                    container.addEventListener("mousemove", function(evt) {
                      var mousePos = oMousePos(this, evt);
                      var theValue0 = (isDragging0) ? Math.round(mousePos.x / rangeK) + inputsRy.minRange : inputsRy.theValue[0];
                      //console.log(theValue0);
                      var theValue1 = (isDragging1) ? Math.round(mousePos.x / rangeK) + inputsRy.minRange : inputsRy.theValue[1];

                      if (isDragging0) {

                        if (theValue0 < theValue1 - (thumbRealWidth / 2) &&
                          theValue0 >= inputsRy.minRange) {
                          inputsRy.theValue[0] = theValue0;
                          thumbs[0].style.left = (theValue0 - inputsRy.minRange) * rangeK - (thumbRealWidth / 2) + "px";
                          outputs[0].style.left = (theValue0 - inputsRy.minRange) * rangeK - inputsRy.outputWidth / 2 + "px";
                          outputs[0].innerHTML = "<p>" + theValue0 + "</p>";
                          slider.style.paddingLeft = (theValue0 - inputsRy.minRange) * rangeK + "px";
                          track.style.width = (theValue1 - theValue0) * rangeK + "px";

                        }
                      } else if (isDragging1) {

                        if (theValue1 > theValue0 + (thumbRealWidth / 2) &&
                          theValue1 <= inputsRy.maxRange) {
                          inputsRy.theValue[1] = theValue1;
                          thumbs[1].style.left = (theValue1 - inputsRy.minRange) * rangeK - (thumbRealWidth / 2) + "px";
                          outputs[1].style.left = (theValue1 - inputsRy.minRange) * rangeK - inputsRy.outputWidth / 2 + "px";
                          outputs[1].innerHTML = "<p>" + theValue1 + "</p>";
                          slider.style.paddingRight = (inputsRy.maxRange - theValue1) * rangeK + "px";
                          track.style.width = (theValue1 - theValue0) * rangeK + "px";

                        }
                      }

                    }, false);

                    // helpers

                    function oMousePos(elmt, evt) {
                      var ClientRect = elmt.getBoundingClientRect();
                      return { //objeto
                        x: Math.round(evt.clientX - ClientRect.left),
                        y: Math.round(evt.clientY - ClientRect.top)
                      }
                    }

                    var inputsRy2 = {
                       sliderWidth: 300,
                       minRange: 100,
                       maxRange: 500,
                       outputWidth:30, // output width
                       thumbWidth: 18, // thumb width
                       thumbBorderWidth: 4,
                       trackHeight: 4,
                       theValue: [100, 500] // theValue[0] < theValue[1]
                     };
                     var isDragging02 = false;
                     var isDragging12 = false;

                     var range2 = inputsRy2.maxRange - inputsRy2.minRange;
                     var rangeK2 = inputsRy2.sliderWidth / range2;
                     var container2 = document.querySelector(".nivo2");
                     var thumbRealWidth2 = inputsRy2.thumbWidth + 2 * inputsRy2.thumbBorderWidth;

                     // styles
                     var slider2 = document.querySelector(".slider2");
                     slider2.style.height = inputsRy2.trackHeight + "px";
                     slider2.style.width = inputsRy2.sliderWidth + "px";
                     slider2.style.paddingLeft = (inputsRy2.theValue[0] - inputsRy2.minRange) * rangeK2 + "px";
                     slider2.style.paddingRight = inputsRy2.sliderWidth - inputsRy2.theValue[1] * rangeK2 + "px";

                     var track2= document.querySelector(".track2");
                     track2.style.width = inputsRy2.theValue[1] * rangeK2 - inputsRy2.theValue[0] * rangeK2 + "px";

                     var thumbs2 = document.querySelectorAll(".thumb2");
                     for (var i = 0; i < thumbs2.length; i++) {

                       thumbs2[i].style.width = thumbs2[i].style.height = inputsRy2.thumbWidth + "px";
                       //console.log(inputsRy2.thumbWidth + "px");
                       thumbs2[i].style.borderWidth = inputsRy2.thumbBorderWidth + "px";
                       thumbs2[i].style.top = -(inputsRy2.thumbWidth / 2 + inputsRy2.thumbBorderWidth - inputsRy2.trackHeight / 2) + "px";
                       thumbs2[i].style.left = (inputsRy2.theValue[i] - inputsRy2.minRange) * rangeK2 - (thumbRealWidth2 / 2) + "px";

                     }
                     var outputs2 = document.querySelectorAll(".output2");
                     for (var i = 0; i < outputs2.length; i++) {
                       //console.log(thumbs2[i])
                       outputs2[i].style.width = outputs2[i].style.height = outputs2[i].style.lineHeight = outputs2[i].style.left = inputsRy2.outputWidth + "px";
                       outputs2[i].style.top = -(Math.sqrt(2 * inputsRy2.outputWidth * inputsRy2.outputWidth) + inputsRy2.thumbWidth / 2 - inputsRy2.trackHeight / 2) + "px";
                       outputs2[i].style.left = (inputsRy2.theValue[i] - inputsRy2.minRange) * rangeK2 - inputsRy2.outputWidth / 2 + "px";
                       outputs2[i].innerHTML = "<p>" + inputsRy2.theValue[i] + "</p>";
                     }

                     //events

                     thumbs2[0].addEventListener("mousedown", function(evt) {
                       isDragging02 = true;
                     }, false);
                     thumbs2[1].addEventListener("mousedown", function(evt) {
                       isDragging12 = true;
                     }, false);
                     container2.addEventListener("mouseup", function(evt) {
                       isDragging02 = false;
                       isDragging12 = false;
                     }, false);
                     container2.addEventListener("mouseout", function(evt) {
                       isDragging02 = false;
                       isDragging12 = false;
                     }, false);

                     container2.addEventListener("mousemove", function(evt) {
                       var mousePos2 = oMousePos(this, evt);
                       var theValue02 = (isDragging02) ? Math.round(mousePos2.x / rangeK2) + inputsRy2.minRange : inputsRy2.theValue[0];
                       //console.log(theValue02);
                       var theValue12 = (isDragging12) ? Math.round(mousePos2.x / rangeK2) + inputsRy2.minRange : inputsRy2.theValue[1];

                       if (isDragging02) {

                         if (theValue02< theValue12 - (thumbRealWidth2 / 2) &&
                           theValue02 >= inputsRy2.minRange) {
                           inputsRy2.theValue[0] = theValue02;
                           thumbs2[0].style.left = (theValue02 - inputsRy2.minRange) * rangeK2 - (thumbRealWidth2 / 2) + "px";
                           outputs2[0].style.left = (theValue02 - inputsRy2.minRange) * rangeK2 - inputsRy2.outputWidth / 2 + "px";
                           outputs2[0].innerHTML = "<p>" + theValue02 + "</p>";
                           slider2.style.paddingLeft = (theValue02 - inputsRy2.minRange) * rangeK2 + "px";
                           track2.style.width = (theValue12 - theValue02) * rangeK2 + "px";

                         }
                       } else if (isDragging12) {

                         if (theValue12 > theValue02 + (thumbRealWidth2 / 2) &&
                           theValue12 <= inputsRy2.maxRange) {
                           inputsRy2.theValue[1] = theValue12;
                           thumbs2[1].style.left = (theValue12 - inputsRy2.minRange) * rangeK2 - (thumbRealWidth2 / 2) + "px";
                           outputs2[1].style.left = (theValue12 - inputsRy2.minRange) * rangeK2 - inputsRy2.outputWidth / 2 + "px";
                           outputs2[1].innerHTML = "<p>" + theValue12 + "</p>";
                           slider2.style.paddingRight = (inputsRy2.maxRange - theValue12) * rangeK2 + "px";
                           track2.style.width = (theValue12 - theValue02) * rangeK2 + "px";

                         }
                       }

                     }, false);
               </script>

              <div class="ispod" style="width: 100%; padding-top:20px; height:auto; margin-top: 20px; margin-left: 20px; padding-left:10px; display: inline-block; background-color:#f5ddb0; opacity:0.85;border-radius:10px;">
                 <div style="display:inline-block; ">
                   <label class="checkbox-con" font style="color:black;family-font: Garamond;font-weight: bold; font-size:1em;margin-top:10px;">ŽIVOTINJE NA BRODU</font>
                    <input type="checkbox" style="margin-top: 10px;"  onclick="checkFunction()">
                    <span class="checkmark" ></span>
                  </label>
                 </div>
                 <div style="float:right; display:inline-block;margin-right:10%;">
                   <p style="padding-top:6px;color:black; font-weight: bold; font-family: Garamond; float:left; font-size:1em;margin-top:0;">TRAJANJE:</p>
                   <label class="radio-con" style="float:left; color:black;font-size:1.25em;"> &lt 3h
                      <input type="radio" name="radio" value=1>
                      <span class="checkmark-radio"></span>
                    </label>
                    <label class="radio-con" style="float:left; color:black;font-size:1.25em;"> &lt 6h
                      <input type="radio" name="radio" value=2>
                      <span class="checkmark-radio"></span>
                    </label>
                    <label class="radio-con" style="float:left;margin-right:20px; color:black; font-weight: bold; font-size:1.25em;"> &gt 6h
                      <input type="radio" name="radio" value=3>
                      <span class="checkmark-radio"></span>
                    </label>
                    <button id="btn" class="button-submit" style="color:black; font-weight:bold;">Filtriraj</button>

                 </div>
               </div>



            </div>
        </section>
        


        <div class="popis"></div>
          <script src="<?php echo __SITE_URL; ?>/js/excursions.js" ></script>
        </div>
          
          
        
          <script src="<?php echo __SITE_URL; ?>/js/excursions.js" ></script>
        </div>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
