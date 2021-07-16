var place = $("#place");
var loc = $("#location");
var allShips;
var ships;
var zivotinje = false;

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
                allShips = ships;
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
                allShips = ships;
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
        brod.append($('<a href="index.php?rt=ship/show_page&name=' +ships[i].name +'" target="_blank" style="text-decoration: none;"><img class="brodic" src = "../ship_booking/assets/brod.png"></img></a>'));
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

function checkFunction()
{
    zivotinje = !zivotinje;
    ships = [];
    allShips.forEach((ship) => {
        //if((zivotinje === true && ship.animal_friendly === '1') || (zivotinje === false && ship.animal_friendly === '1')|| (zivotinje === false && ship.animal_friendly === '0'))
        if(!(zivotinje && !ship.animal_friendly))
            ships.push(ship);
        
    });
    prikazi();
}

$('#btn').on('click', () => {
    djecaLow = $('#djecaLow p').html();
    djecaHigh = $('#djecaHigh p').html();
    odrasliLow = $('#odrasliLow p').html();
    odrasliHigh = $('#odrasliHigh p').html();
    zivotinje = $('.checkbox-con');
    radio =$('input[name="radio"]:checked').val();
    ships = [];
    allShips.forEach((ship) => {
        pocetak= parseInt(ship.departure_time.substring(0,2))+(parseInt(ship.departure_time.substring(3,5))/60);
        kraj= parseInt(ship.arrival_time.substring(0,2))+(parseInt(ship.arrival_time.substring(3,5))/60);
        if(ship.price_kids >= djecaLow && ship.price_kids <= djecaHigh && ship.price_adults >= odrasliLow && ship.price_adults <= odrasliHigh){
            if(!(zivotinje === true && ship.animal_friendly === 0)){
                if(radio){
                    if(radio==='1' && kraj-pocetak <= 3)
                        ships.push(ship);
                    else if(radio==='2' && kraj-pocetak <= 6)
                        ships.push(ship);
                    else if(radio==='3' && kraj-pocetak > 6)
                        ships.push(ship);
                }
                else
                ships.push(ship);
            }
                
        } 
    });
    prikazi()

})

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