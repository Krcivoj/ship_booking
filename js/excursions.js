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
            }
        } );
            
    }
});