Array.prototype.reduce = undefined;
 
google.load('visualization', '1.1', {packages: ['corechart','line','bar','scatter']});
google.setOnLoadCallback(drawThird);
google.setOnLoadCallback(drawScatter);

var ScatterData;
var ScatterData2;
var scatterChart;
var isFullGraphDrawn = true;

var namee = [];
var effect = [];
var magni = [];
var reach = [];
var colorr = [];
var parent = [];
var totalReach = 0;
var noDisplayPerc = 0.04;

var code_hierarchy_data = [];
var reachGraph;

var data_slices;
var MainLegendTable = "";
var animating = false;
var ref;
var next_ref;
var last_refs;
var svg;
var arc;
var ScatterOptions = {
    legend: 'none',
    tooltip: { isHtml: true },
    animation:{
        duration: 500,
        easing: 'out',
    },
    hAxis: {
      title: 'Magnitude',
    },
    vAxis: {
      title: 'Effectiveness',
    }
}

var ReachOptions = {
    colors: ['#2FB1C4', '#2FB1C4', '#2FB1C4'],
    title: '',
    vAxis:{
         baselineColor: '#fff',
         gridlineColor: '#fff',
         textPosition: 'none'
    },
    hAxis:{
         baselineColor: '#fff',
         gridlineColor: '#fff',
         textPosition: 'none'
    },
     animation:{
        duration: 500,
        easing: 'out',
    },
    legend: 'none'
};

var ChartPrev = "";
var DonutPrev = "";

function topClicked(namee123){
    if(animating){
        return;
    }
    if(namee123 == "Reset"){
        console.log("its reset");
        if(ChartPrev != ""){
            console.log("chart prev is not empty");
            $('#legendtablediv').html(MainLegendTable);
            $('.tabletr').removeClass('hide');
            var indd = ChartPrev;
            var f1 = FindSlice(namee[indd],magni[indd]);
            console.log("slice "+f1);
            animate2(f1,"rev");
            console.log(f1);
            scatterChart.draw(ScatterData, ScatterOptions); 
            ChartPrev = ""; 
            updateReach(totalReach);
        }
    }
    else{
        if(ChartPrev == ""){
            $('.tabletr').addClass('hide');
            var indd = FirstIndexByName(namee123);
            console.log("index is "+indd);
            var f1 = FindSlice(namee[indd],magni[indd]);
            animate2(f1,"not");
            ScatterData2 = new google.visualization.DataTable();
            ScatterData2.addColumn('number', 'Magnitude');
            ScatterData2.addColumn('number', 'Effectiveness');
            ScatterData2.addColumn( {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}  );
            ScatterData2.addColumn( {'type': 'string', 'role': 'style'}  );
            
            var treach = 0;
            var legendtable = "<table>";
            if(namee[indd] == parent[indd]){
                for(var j = 0 ; j<parent.length ; j++){
                    if(parent[j] == namee[j]){
                        continue;
                    }
                    if(namee[indd] == namee[j] || parent[j] == namee[indd]){
                        ScatterData2.addRow([parseInt(magni[j]),parseInt(effect[j]),HTMLTooltip(namee[j],magni[j],effect[j]),'point {fill-color: #'+colorr[j]]);
                        treach+=parseInt(reach[j]);
                        legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                    }   
                }   
            }
            else{
                 ScatterData2.addRow([parseInt(magni[indd]),parseInt(effect[indd]),HTMLTooltip(namee[indd],magni[indd],effect[indd]),'point {fill-color: #'+colorr[indd]]);
                 legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[indd]+";\"></div></td><td>"+namee[indd]+"<td></tr>";
                 treach = parseInt(reach[indd]);
            }
            legendtable+="</table>";
            $('#legendtablediv').html(legendtable);
            updateReach(treach);
            scatterChart.draw(ScatterData2, ScatterOptions);
             var tttt = parent[indd];
                tttt = tttt.replace(/ /g , "-");
                $('.'+tttt).removeClass('hide');
            ChartPrev = indd;
            if(indd == 0){
                ChartPrev = "0";
            }   
            console.log("index is "+indd);
        }
        else{
            $('#legendtablediv').html(MainLegendTable);
            $('.tabletr').removeClass('hide');
            var indd = ChartPrev;
            var f1 = FindSlice(namee[indd],magni[indd]);
            //console.log("slice "+f1);
            animate2(f1,"rev");
            //console.log(f1);
            scatterChart.draw(ScatterData, ScatterOptions); 
            ChartPrev = ""; 
            updateReach(totalReach);
            
            setTimeout(function(){ 
                $('.tabletr').addClass('hide');
                var indd = FirstIndexByName(namee123);
                var f1 = FindSlice(namee[indd],magni[indd]);
                animate2(f1,"not");
                ScatterData2 = new google.visualization.DataTable();
                ScatterData2.addColumn('number', 'Magnitude');
                ScatterData2.addColumn('number', 'Effectiveness');
                ScatterData2.addColumn( {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}  );
                ScatterData2.addColumn( {'type': 'string', 'role': 'style'}  );
                
                var treach = 0;
                var legendtable = "<table>";
                if(namee[indd] == parent[indd]){
                    for(var j = 0 ; j<parent.length ; j++){
                        if(parent[j] == namee[j]){
                            continue;
                        }
                        if(namee[indd] == namee[j] || parent[j] == namee[indd]){
                            ScatterData2.addRow([parseInt(magni[j]),parseInt(effect[j]),HTMLTooltip(namee[j],magni[j],effect[j]),'point {fill-color: #'+colorr[j]]);
                            treach+=parseInt(reach[j]);
                            legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                        }   
                    }   
                }
                else{
                     ScatterData2.addRow([parseInt(magni[indd]),parseInt(effect[indd]),HTMLTooltip(namee[indd],magni[indd],effect[indd]),'point {fill-color: #'+colorr[indd]]);
                     legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[indd]+";\"></div></td><td>"+namee[indd]+"<td></tr>";
                     treach = parseInt(reach[indd]);
                }
                legendtable+="</table>";
                $('#legendtablediv').html(legendtable);
                updateReach(treach);
                scatterChart.draw(ScatterData2, ScatterOptions);
                 var tttt = parent[indd];
                    tttt = tttt.replace(/ /g , "-");
                    $('.'+tttt).removeClass('hide');
                ChartPrev = indd;
                if(indd == 0){
                    ChartPrev = "0";
                }   
            }, 1000);
        }
    }
    //console.log(namee123);
}

function drawScatter () {
    
    ScatterData = new google.visualization.DataTable();
    ScatterData.addColumn('number', 'Magnitude');
    ScatterData.addColumn('number', 'Effectiveness');
    ScatterData.addColumn( {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}  );
    ScatterData.addColumn( {'type': 'string', 'role': 'style'}  );
    
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getScatterGraphData" },		 
    	function( data ){
    	   //console.log(data);
    		var result  = JSON.parse(data);
            MainLegendTable = "<table>";
            for(var i=0 ; i<result[0].length ; i++){
			     if(result[5][i] == result[0][i]){
			         ScatterData.addRow([parseInt(result[3][i]),parseInt(result[1][i]),HTMLTooltip(result[0][i],result[3][i],result[1][i]),'point {fill-color: #'+result[4][i]]);   
			     }
                 namee.push(result[0][i]);
                 effect.push(parseInt(result[1][i]));
                 reach.push(parseInt(result[2][i]));
                 magni.push(parseInt(result[3][i]));
                 colorr.push(result[4][i]);
                 parent.push(result[5][i]);
                 totalReach+=parseInt(result[2][i]);
                 if(result[0][i] == result[5][i]){
                    MainLegendTable+="<tr><td><div onclick=\"topClicked('"+result[0][i]+"')\" style=\"margin-right: 10px;cursor: pointer; width:10px; height:10px; border-radius:5px !important; background:#"+result[4][i]+";\"></div></td><td style=\"cursor: pointer;\" onclick=\"topClicked('"+result[0][i]+"')\" >"+result[0][i]+"</td></tr>";
                 }
			}
            MainLegendTable+="</table>";
            $('#legendtablediv').html(MainLegendTable);
        
            scatterChart = new google.visualization.ScatterChart(document.getElementById('scatter_dual_y'));
            google.visualization.events.addListener(scatterChart, 'select', ScatterClicked);
            scatterChart.draw(ScatterData, ScatterOptions);
            reachGraph = new google.visualization.AreaChart(document.getElementById('fourth'));
            updateReach(totalReach);
    });   
}

function HTMLTooltip(name, mag,effecc) {
  return '<div style="padding:5px 5px 5px 5px;"><table class="medals_layout"><tr><td colspan="2"><b>'+name+'</b></tr><tr><td>Magnitude</td><td>'+mag+'</td></tr><tr><td>Effectiveness</td><td>'+effecc+'</td></tr></table></div>';
}

function ScatterClicked() {
    var selectedItem = scatterChart.getSelection()[0];
    if (selectedItem) {
        if(ChartPrev == ""){
            $('.tabletr').addClass('hide');
            var first = ScatterData.getValue(selectedItem.row, 0);
            var second = ScatterData.getValue(selectedItem.row, 1);
            var indd = FirstIndex(first,second);
            console.log("index is "+indd);
            var f1 = FindSlice(namee[indd],magni[indd]);
            animate2(f1,"not");
            ScatterData2 = new google.visualization.DataTable();
            ScatterData2.addColumn('number', 'Magnitude');
            ScatterData2.addColumn('number', 'Effectiveness');
            ScatterData2.addColumn( {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}  );
            ScatterData2.addColumn( {'type': 'string', 'role': 'style'}  );
            
            var treach = 0;
            var legendtable = "<table>";
            if(namee[indd] == parent[indd]){
                for(var j = 0 ; j<parent.length ; j++){
                    if(parent[j] == namee[j]){
                        continue;
                    }
                    if(namee[indd] == namee[j] || parent[j] == namee[indd]){
                        ScatterData2.addRow([parseInt(magni[j]),parseInt(effect[j]),HTMLTooltip(namee[j],magni[j],effect[j]),'point {fill-color: #'+colorr[j]]);
                        treach+=parseInt(reach[j]);
                        legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                    }   
                }   
            }
            else{
                 ScatterData2.addRow([parseInt(magni[indd]),parseInt(effect[indd]),HTMLTooltip(namee[indd],magni[indd],effect[indd]),'point {fill-color: #'+colorr[indd]]);
                 legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[indd]+";\"></div></td><td>"+namee[indd]+"<td></tr>";
                 treach = parseInt(reach[indd]);
            }
            legendtable+="</table>";
            $('#legendtablediv').html(legendtable);
            updateReach(treach);
            scatterChart.draw(ScatterData2, ScatterOptions);
             var tttt = parent[indd];
                tttt = tttt.replace(/ /g , "-");
                $('.'+tttt).removeClass('hide');
            console.log("index is "+indd);
            ChartPrev = indd;
            if(indd == 0){
                ChartPrev = "0";
            }   
        }
        else{
            $('#legendtablediv').html(MainLegendTable);
            $('.tabletr').removeClass('hide');
            var first = ScatterData2.getValue(selectedItem.row, 0);
            var second = ScatterData2.getValue(selectedItem.row, 1);
            var indd = FirstIndex(first,second);
            var f1 = FindSlice(namee[indd],magni[indd]);
            //console.log("slice "+f1);
            animate2(f1,"rev");
            //console.log(f1);
            scatterChart.draw(ScatterData, ScatterOptions); 
            ChartPrev = ""; 
            updateReach(totalReach);
        }
    }
}

function FirstIndex(first,second){
    for(var i=0 ; i<namee.length ; i++){
        if(first == magni[i] && second == effect[i]){
            return i;
        }
    }
}

function FirstIndexByName(namee123){
    for(var i=0 ; i<namee.length ; i++){
        if(namee123 == namee[i]){
            return i;
        }
    }
}

function FindSlice(name2,val2){
    for(var i=0 ; i<data_slices.length ; i++){
        if(data_slices[i][2] == name2 && parseInt(data_slices[i][4][1]) == parseInt(val2)){
            return data_slices[i];
        }
    }   
}

function FindSlice2(d){
    for(var i=0 ; i<namee.length ; i++){
        if(d[2] == namee[i] && parseInt(d[4][1]) == parseInt(magni[i])){
            return i;
        }
    }   
}




function drawThird() {
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Conversions'],
        ['Week 1',  20123],
        ['Week 2',  19861],
        ['Week 3',  22410],
        ['Week 5',  24762],
        ['Week 6',  23194],
        ['Week 7',  23782]
    ]);
    
    var options = {
        colors: ['#9958A5', '#9958A5', '#9958A5'],
        title: '',
        vAxis:{
             baselineColor: '#fff',
             gridlineColor: '#fff',
             textPosition: 'none'
        },
        hAxis:{
             baselineColor: '#fff',
             gridlineColor: '#fff',
             textPosition: 'none'
        },
        legend: 'none'
    };

    var third = new google.visualization.AreaChart(document.getElementById('third'));
    third.draw(data, options);
    
    var tthird = new google.visualization.AreaChart(document.getElementById('tthird'));
    tthird.draw(data, options);
}

function number_format(number, decimals, decPoint, thousandsSep){
	decimals = decimals || 0;
	number = parseFloat(number);

	if(!decPoint || !thousandsSep){
		decPoint = '.';
		thousandsSep = ',';
	}

	var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
	var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
	var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
	var formattedNumber = "";

	while(numbersString.length > 3){
		formattedNumber += thousandsSep + numbersString.slice(-3)
		numbersString = numbersString.slice(0,-3);
	}

	return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
}

function updateReach(rr) {
    $('#reachval').html(number_format( rr, 2, '.', ',' ));
    var percc = rr * 0.6;
    var r1 = Math.floor((Math.random() * rr+percc) + rr-percc);
    var r2 = Math.floor((Math.random() * rr+percc) + rr-percc);
    var r3 = Math.floor((Math.random() * rr+percc) + rr-percc);
    var r4 = Math.floor((Math.random() * rr+percc) + rr-percc);
    var r5 = Math.floor((Math.random() * rr+percc) + rr-percc);
    var r6 = Math.floor((Math.random() * rr+percc) + rr-percc);
    var r7 = Math.floor((Math.random() * rr+percc) + rr-percc);
    if(r1 < 0){r1*=-1;}
    if(r2 < 0){r2*=-1;}
    if(r3 < 0){r3*=-1;}
    if(r4 < 0){r4*=-1;}
    if(r5 < 0){r5*=-1;}
    if(r6 < 0){r6*=-1;}
    if(r7 < 0){r7*=-1;}
    
    var ReachData = google.visualization.arrayToDataTable([
        ['Year', 'Reach'],
        ['Week 1',  r1],
        ['Week 2',  r2],
        ['Week 3',  r3],
        ['Week 4',  r4],
        ['Week 5',  r5],
        ['Week 6',  r6],
        ['Week 7',  r7]
    ]);
    
    reachGraph.draw(ReachData, ReachOptions);
}

	
$(document).ready(function(){
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
    //$('.container-fluid').first().css("box-shadow","5px 5px 15px #888888");
    $('.container-fluid').first().css("padding-bottom","5px");
    $('.container-fluid').first().css("z-index","9999");
    $('.page-footer').first().css("position","fixed");
    $('.page-footer').first().css("bottom","0");
    $('.page-footer').first().css("left","0");
    $('.page-footer').first().css("width","100%");
    $('.dropdown.dropdown-user.open').first().css("z-index","99990");
});


function firsttab(){
    $('a[href="#tab_general"]').click();
}
 
function init_code_hierarchy_plot(element_id,data,count_function,color_function,title_function,legend_function)
{
    var plot = document.getElementById(element_id);

    while (plot.hasChildNodes())
    {
        plot.removeChild(plot.firstChild);
    }

    var width = plot.offsetWidth;
    var height = width;
    height = 350;
    width = 350;
   
    
    data_slices = [];
    var max_level = 3;

    svg = d3.select("#"+element_id).append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height * .52 + ")");
          
    function process_data(data,level,start_deg,stop_deg)
    {
        var name = data[0];
        var color = data[1][2];
        var perc = data[1][4];
        var parentchild = data[1][3];
        var total = count_function(data);
        var children = data[2];
        var current_deg = start_deg;
        if (level > max_level)
        {
            return;
        }
        if (start_deg == stop_deg)
        {
            return;
        }
        data_slices.push([start_deg,stop_deg,name,level,data[1],color,parentchild,perc]);
        for (var key in children)
        {
            child = children[key];
            var inc_deg = (stop_deg-start_deg)/total*count_function(child);
            var child_start_deg = current_deg;
            current_deg+=inc_deg;
            var child_stop_deg = current_deg;
            var span_deg = child_stop_deg-child_start_deg;
            process_data(child,level+1,child_start_deg,child_stop_deg);
        }
    }
    
    process_data(data,0,0,360./180.0*Math.PI);

    ref = data_slices[0];
    next_ref = ref;
    last_refs = [];

    var thickness = width/2.0/(max_level+2)*1.1;
        
    arc = d3.svg.arc()
    .startAngle(function(d) { if(d[3]==0){return d[0];}return d[0]+0.01; })//alihaider9
    .endAngle(function(d) { if(d[3]==0){return d[1];}return d[1]-0.01; })
    .innerRadius(function(d) { 
        if(d[2] == "Total Magnitude"){
            return 0;
        }
        var innr = 1.1*d[3]*thickness;
        innr = 1.1*(d[3]+0)*thickness;
        //console.log("inner is "+innr+" and d is "+d);
        return innr; 
    })
    .outerRadius(function(d) {
        if(d[2] == "Total Magnitude"){
            return 0;
        }
        var outr = (1.1*d[3]+1)*thickness;
        outr = (1.1*(d[3]+0)+1)*thickness;
        //console.log("outer is "+outr+" and d is "+d);
        return outr; 
    });    

    
    
    var slices = svg.selectAll(".form")
        .data(function(d) { return data_slices; })
        .enter()
        .append("g");
        
    var paths = slices.append("path")
        .attr("d", arc)
        .attr("id",function(d,i){return element_id+i;})
        .style("fill", function(d) { return color_function(d);})
        .attr("class","form");
        
    slices.on("click",animate);
    
   // Add a text label.
    var text = slices.append("text")
        .attr("x", 6)
        .attr('text-anchor', 'middle')
        .attr("dy", 15);
    
    text.append("textPath")
        //.attr("stroke","white")
        .style("opacity",function(d,i){if(d[3] == 1){return "1";}else{return "0";}})
        .style("font-size","10px")
        .style("fill","white")
        .attr("xlink:href",function(d,i){return "#"+element_id+i;})
        .attr('startOffset', '10%')
        .text(function(d,i){ return d[7]+"%";});

    
//    slices.append("text")
// .text(function(d){
//                return "d.value";
//            })

    if (title_function != undefined)
    {
        slices.append("svg:title")
              .text(title_function);        
    }
    if (legend_function != undefined)
    {
        slices.on("mouseover",update_legend)
              .on("mouseout",remove_legend);
        var legend = d3.select("#"+element_id+"_legend")
            
        function update_legend(d)
        {
            //alihaider9
            legend.html(legend_function(d));
            //legend.transition().duration(200).style("opacity","1");
            legend.style("display","none");
            
        }
        
        function remove_legend(d)
        {
           //alihaider9
           // legend.transition().duration(1000).style("opacity","0");
           legend.style("display","none");
        }
    }
}

function get_start_angle(d,ref)
{
	if (ref)
	{
		var ref_span = ref[1]-ref[0];
		return (d[0]-ref[0])/ref_span*Math.PI*2.0
	}
	else
	{
		return d[0];
	}
}

function get_stop_angle(d,ref)
{
	if (ref)
	{
		var ref_span = ref[1]-ref[0];
		return (d[1]-ref[0])/ref_span*Math.PI*2.0
	}
	else
	{
		return d[0];
	}
}

function get_start_angle2(d,ref)
{
	if (ref)
	{
		console.log("here 1");
        var ref_span = ref[1]-ref[0];
		return (d[0]-ref[0])/ref_span*Math.PI*2.0
	}
	else
	{
		console.log("here 2");
        return d[0];
	}
}

function get_stop_angle2(d,ref)
{
	if (ref)
	{
		console.log("here 3");
        var ref_span = ref[1]-ref[0];
		return (d[1]-ref[0])/ref_span*Math.PI*2.0
	}
	else
	{
		console.log("here 4");
        return d[0];
	}
}

function get_level(d,ref)
{
	if (ref)
	{
		return d[3]-ref[3];
	}
	else
	{
		return d[3];
	}
}

function rebaseTween(new_ref)
{
	//console.log("new ref is "+new_ref);
    return function(d)
	{
		console.log("d is "+d);
        var level = d3.interpolate(get_level(d,ref),get_level(d,new_ref));
		var start_deg = d3.interpolate(get_start_angle(d,ref),get_start_angle(d,new_ref));
		var stop_deg = d3.interpolate(get_stop_angle(d,ref),get_stop_angle(d,new_ref));
		var opacity = d3.interpolate(100,0);
		return function(t)
		{
			return arc([start_deg(t),stop_deg(t),d[2],level(t)]);
		}
	}
}


function animate2(d,aloo) {
	//console.log(d);
	if (animating)
	{
		return;
	}
	animating = true;
	var revert = false;
	var new_ref;
	if (d == ref && last_refs.length > 0)
	{
		revert = true;
		last_ref = last_refs.pop();
	}
    if(aloo == "rev" && revert == false){
        revert = true;
		last_ref = last_refs.pop();
        
    }
	if (revert)
	{
		d = last_ref;
		new_ref = ref;
		svg.selectAll(".form")
		.filter(
			function (b)
			{
				if (b[0] >= last_ref[0] && b[1] <= last_ref[1]  && b[3] >= last_ref[3])
				{
					return true;
				}
				return false;
			}
		)
		.transition().duration(1000).style("opacity","1").attr("pointer-events","all");
        
        svg.selectAll('textPath').style("opacity","0").style("fill","white");
        svg.selectAll('textPath').style("opacity",function(d,i){
            if(d[3] == 1)
            {
                if(d[1] - d[0]< noDisplayPerc){
                    return "0";
                }
                else{
                    return "1";   
                }
            }else
            {
                return "0";
            }
        }).attr('startOffset', "10%");
	}
	else
	{
		new_ref = d;
		svg.selectAll(".form")
		.filter(
			function (b)
			{
				if (b[0] < d[0] || b[1] > d[1] || b[3] < d[3])
				{
					return true;
				}
				return false;
			}
		)
		.transition().duration(1000).style("opacity","0").attr("pointer-events","none");
        svg.selectAll('textPath').style("opacity","0");
         svg.selectAll("textPath")
    	.filter(
    		function (b)
    		{
    			if (b[0] >= new_ref[0] && b[1] <= new_ref[1] && b[3] >= new_ref[3])
    			{
    				return true;
    			}
    			return false;
    		}
    	)
    	.style("opacity",function(d,i){if(d[1]-d[0] < noDisplayPerc ){return "0";}else{return "1";}}).style("fill",function(d,i){if(d[3] == 1){return "white";}else{return "black";}})
        .attr('startOffset', function(d,i){if(d[3] == 1){return "50%";}else{return "10%";}});
        
	}
    
	 var tttt = svg.selectAll(".form")
    	.filter(
    		function (b)
    		{
    			if (b[0] >= new_ref[0] && b[1] <= new_ref[1] && b[3] >= new_ref[3])
    			{
    				return true;
    			}
    			return false;
    		}
    	)
    	.transition().duration(1000).attrTween("d",rebaseTween(d));
        
        //tttt.selectAll('textPath').style("opacity","1");
        
        
    
	setTimeout(function(){
		animating = false;
		if (! revert)
		{
			last_refs.push(ref);
			ref = d;
		}
		else
		{
			ref = d;
		}
		},1000);
}  

function animate(d) {
	//console.log(d);
	if (animating)
	{
		return;
	}
    if(d[2] == "Total Magnitude"){
        return;
    }
	animating = true;
	var revert = false;
	var new_ref;
	if (d == ref && last_refs.length > 0)
	{
		revert = true;
        scatterChart.draw(ScatterData, ScatterOptions);
        ChartPrev = ""; 
        $('.tabletr').removeClass('hide');
        $('#legendtablediv').html(MainLegendTable);
		last_ref = last_refs.pop();
        if(last_ref == null){
            return;
        }
        updateReach(totalReach);
	}
    if(ChartPrev != "" && revert == false){
        revert = true;
        scatterChart.draw(ScatterData, ScatterOptions);
        $('#legendtablediv').html(MainLegendTable);
        ChartPrev = ""; 
        $('.tabletr').removeClass('hide');
		last_ref = last_refs.pop();
        if(last_ref == null){
            return;
        }
        updateReach(totalReach);
    }
	if (revert)
	{
		d = last_ref;
		new_ref = ref;
		svg.selectAll(".form")
		.filter(
			function (b)
			{
				if (b[0] >= last_ref[0] && b[1] <= last_ref[1]  && b[3] >= last_ref[3])
				{
					return true;
				}
				return false;
			}
		)
		.transition().duration(1000).style("opacity","1").attr("pointer-events","all");
        svg.selectAll('textPath').style("opacity","0").style("fill","white");
        
        svg.selectAll('textPath').style("opacity",function(d,i){
            if(d[3] == 1)
            {
                if(d[1] - d[0]< noDisplayPerc){
                    return "0";
                }
                else{
                    return "1";   
                }
            }else
            {
                return "0";
            }
        })
        .attr('startOffset', "10%");
	}
	else
	{
	    var indd = FindSlice2(d);
        ScatterData2 = new google.visualization.DataTable();
        ScatterData2.addColumn('number', 'Magnitude');
        ScatterData2.addColumn('number', 'Effectiveness');
        ScatterData2.addColumn( {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}  );
        ScatterData2.addColumn( {'type': 'string', 'role': 'style'}  );
        //console.log("ind is "+indd+" d is "+d);
        var legendtable = "<table>";
        var treach = 0;
        for(var j = 0 ; j<parent.length ; j++){
            if(d[6] == ""){
                if(parent[j] == namee[j]){
                    continue;
                }
                if(parent[j] == namee[indd]){
                    //console.log(parent[j]+ "==" +namee[indd]);
                    ScatterData2.addRow([parseInt(magni[j]),parseInt(effect[j]),HTMLTooltip(namee[j],magni[j],effect[j]),'point {fill-color: #'+colorr[j]]);
                    treach+=parseInt(reach[j]);
                    legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                }    
            }
            else{
                if(parent[j] == namee[j]){
                    continue;
                }
                if(namee[indd] == namee[j] && parent[j] == d[6]){
                    //console.log(namee[indd]+ "==" +namee[j]+ "||" +parent[j]+ "==" +d[6]);
                    ScatterData2.addRow([parseInt(magni[j]),parseInt(effect[j]),HTMLTooltip(namee[j],magni[j],effect[j]),'point {fill-color: #'+colorr[j]]);
                    treach+=parseInt(reach[j]);
                    legendtable+="<tr><td><div style=\"margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                } 
            }  
        }
        legendtable+="</table>";
        $('#legendtablediv').html(legendtable);
        updateReach(treach);
        scatterChart.draw(ScatterData2, ScatterOptions);
        ChartPrev = indd;
        if(indd == 0){
                ChartPrev = "0";
            }    
        $('.tabletr').addClass('hide');
        var tttt = parent[indd];
        tttt = tttt.replace(/ /g , "-");
        $('.'+tttt).removeClass('hide');
         
        new_ref = d;
        svg.selectAll(".form")
		.filter(
			function (b)
			{
				if (b[0] < d[0] || b[1] > d[1] || b[3] < d[3])
				{
					return true;
				}
				return false;
			}
		)
		.transition().duration(1000).style("opacity","0").attr("pointer-events","none");
        svg.selectAll('textPath').style("opacity","0");
         svg.selectAll("textPath")
    	.filter(
    		function (b)
    		{
    			if (b[0] >= new_ref[0] && b[1] <= new_ref[1] && b[3] >= new_ref[3])
    			{
    				return true;
    			}
    			return false;
    		}
    	)
    	.style("opacity",function(d,i){if(d[1]-d[0] < noDisplayPerc ){return "0";}else{return "1";}}).style("fill",function(d,i){if(d[3] == 1){return "white";}else{return "black";}})
        .attr('startOffset', function(d,i){if(d[3] == 1){return "50%";}else{return "10%";}}); 
        
       
         
	}
	svg.selectAll(".form")
    	.filter(
    		function (b)
    		{
    			if (b[0] >= new_ref[0] && b[1] <= new_ref[1] && b[3] >= new_ref[3])
    			{
    				return true;
    			}
    			return false;
    		}
    	)
    	.transition().duration(1000).attrTween("d",rebaseTween(d)); 
        
       
       
        //tttt.selectAll('textPath').style("opacity","1");
       
	setTimeout(function(){
		animating = false;
		if (! revert)
		{
			last_refs.push(ref);
			ref = d;
		}
		else
		{
			ref = d;
		}
		},1000);
}  

function init_plots()
{
    
    function count_function(d)
    {
        return d[1][0];
    }
    
    function label_function(d)
    {
        return d[2]+": "+d[4][0]+" Magnitude.";
    }
    
    function legend_function(d)
    {
        return "<h2>"+d[2]+"&nbsp;</h2><p>"+d[4][0]+" Magnitude.</p>"
    }
    
    var color = d3.scale.category20c();

    function color_function(d)
    {	
		//console.log(d);
        //var c = color(d[2]);
        var c = d[5];
		return "#"+c;
    }
    d3.select(self.frameElement).style("height", "200px");
    init_code_hierarchy_plot("code_hierarchy",code_hierarchy_data,count_function,color_function,label_function,legend_function);
}


$.post( 
	'database/rep_something.php', 			
	{ func: "getAjeebDonutData" },		 
	function( data ){ 	
		//console.log(data);
        code_hierarchy_data = JSON.parse(data);
        init_plots();
        
});    

$(document).ready(function(){
    $( "#slider-reach" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#reach" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#reach" ).val( "" + $( "#slider-reach" ).slider( "values", 0 ) + " - " + $( "#slider-reach" ).slider( "values", 1 ) );
    
    $( "#slider-effect" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#effect" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#effect" ).val( "" + $( "#slider-effect" ).slider( "values", 0 ) + " - " + $( "#slider-effect" ).slider( "values", 1 ) );
});


window.onload = init_plots;
window.onresize = init_plots;