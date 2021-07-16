let js = $( '<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>' );
$("head").prepend( js );

let types = ["column", "bar"];
let type = 0;

let datas = new Array();

$(window).on("load",load);

function draw() {

    var chart = new CanvasJS.Chart('chart', {
        title:{
            text: 'Posječenost'             
        },
        axisX:{
            title: 'Datum'
        },
        axisY:{
            title: 'Broj gostiju'
        },
        data: datas
        
    });
    chart.render();
    let crt = document.getElementById( 'chart' );
    crt.addEventListener("click", change, false);
    
}

function change(){
    type = (type + 1)%2;
    for ( let i = 0; i < datas.length; i++){
        datas[i].type = types[type];
    }
    draw();
}

function load(){
    $.ajax( {
        url: "index.php?rt=ship/attendance",
        data: { name: String($("#chart").attr('name'))},
        type: "GET",
        //dataType: "json",
        success: function( data ) {
            datas = data;
            for(let i = 0; i < datas.length; i++){
                for(let j = 0; j < datas[i].dataPoints.length; j++){
                    datas[i].dataPoints[j].y= parseInt(datas[i].dataPoints[j].y);
                }
                datas[i].showInLegend = true;
            }
            //console.log(datas);
            draw();
        },
        error: function( xhr, status, errorThrown ) { console.log(errorThrown); }
    } );
}
