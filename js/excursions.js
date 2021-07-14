var place = $("#place");
var loc = $("#location");
var ships;

place.on('input', function(){
    loc.val('');
    loc.blur();
})

loc.on('input', function(){
    place.val('');
    place.blur();
})


place.on('keyup',function(e) {
    if(e.key == 'Enter') {
        $.ajax( {
            url: "index.php?rt=excursions/searchByPlace",
            data: { place: place.val() },
            dataType: "json",
            success: function( data ) {
                ships = data;
                console.log(data);
                prikazi();
            }
        } );
            
    }
});

loc.on('keyup',function(e) {
    if(e.key == 'Enter') {
        $.ajax( {
            url: "index.php?rt=excursions/searchByLocation",
            data: { location: loc.val() },
            dataType: "json",
            success: function( data ) {
                ships = data;
                console.log(data);
                prikazi();
            }
        } );
            
    }
});


function prikazi(){
    let popis = $('.popis');
    popis.html('');
    for(let i = 0; i < ships.length; i++){
        let brod = $('<div class="rezultat"></div>');
        brod.append($('<a href="#" style="text-decoration: none;"><img class="brodic" src = "../ship_booking/assets/brod.png"></img></a>'));
        let ime =$('<p id="rezultat-ime" style=" font-family:'+'Rock Salt' + '; font-weight: bold; font-size:20px;color:black;"></p>');
        ime.html(ships[i].name);
        brod.append(ime);
        let cijena = $('<p id="rezultat-cijena"  style=" margin-top:10px;font-family:sans-serif; font-size:15px;color:#306a82;">Cijena: '
        + ships[i].price_kids+'/'+ships[i].price_adults +'kn</p>')
        brod.append(cijena);
        let polazak = $('<p id="rezultat-polazak"  style=" margin-top:0;font-family:sans-serif; font-size:15px;color:#306a82;">Polazak: '+ ships[i].start_place+'</p>')
        brod.append(polazak);
        let trajanje = $(' <p id="rezultat-trajanje"  style=" margin-top:0;font-family:sans-serif; font-size:15px;color:#306a82;">Trajanje: '+
        ships[i].departure_time.substring(0,5)+' - '+ships[i].arrival_time.substring(0,5)+'</p>');
        brod.append(trajanje);
        let ocijena =$('<p id="rezultat-ocijena"  style=" margin-top:0;font-family:sans-serif; font-size:15px;color:#306a82;">Ocijena: '+
        ships[i].rank+'</p>');
        let rezerviraj = $('<form method="post" action="index.php?rt=ship/reservation_make&name='+
        ships[i].name + '"><button id="1" class="rezervacija" type="submit">REZERVIRAJ</button></form> ');
        brod.append(rezerviraj);
        popis.append(brod);
    }

}

/*<div class="rezultat">
              <a href="#" style="text-decoration: none;"><img class="brodic" src = ../ship_booking/assets/brod.png></img></a>       
              <p id="rezultat-ime" style=" font-family:'Rock Salt'; font-weight: bold; font-size:20px;color:black;">MARLENA</p>
              <p id="rezultat-cijena"  style=" margin-top:10px;font-family:sans-serif; font-size:15px;color:#306a82;">Cijena: 230/340 kn</p>
              <p id="rezultat-polazak"  style=" margin-top:0;font-family:sans-serif; font-size:15px;color:#306a82;">Polazak: Krk</p>
              <p id="rezultat-trajanje"  style=" margin-top:0;font-family:sans-serif; font-size:15px;color:#306a82;">Trajanje: 10-17h</p>
              <p id="rezultat-ocijena"  style=" margin-top:0;font-family:sans-serif; font-size:15px;color:#306a82;">Ocijena: 5</p>
              <form method="post" action="index.php?rt=ship/reservation">
              <button id="1" class="rezervacija" type="submit">REZERVIRAJ</button>
              </form> 
            </div>*/ 