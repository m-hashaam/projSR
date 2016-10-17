Array.prototype.reduce = undefined; 
google.load('visualization', '1.1', {packages: ['corechart','line','bar','scatter']});
google.setOnLoadCallback(drawReachGraph);
google.setOnLoadCallback(drawScatterGraph);
google.setOnLoadCallback(drawAreaChart);

var data_slices;

var MainLegendTable = "";

var personaSelectValuesStart = "";

var animating = false;
var ref;
var next_ref;
var last_refs;
var svg;
var arc;
var noDisplayPerc = 0.001;

var MAINtmaxreach = 0;
var MAINtminreach = 0;
var MAINtmaxeffec = 0;
var MAINtmineffec = 0;

var axisFarValuePerc = 0.50;

var namee = [];
var effect = [];
var magni = [];
var reach = [];
var colorr = [];
var parent = [];
var MainScatterColors = [];

var minReach = 0;
var maxReach = 0;
var minEffec = 0;
var maxEffec = 0;

var getScatterData = false;
var getDonutData = false;
var getReachData = false;
var getTableData = true;
var getConvData = false;
var getAreaChartData = false;
var reachGraph;
var ReachOptions = {
    colors: ['#2FB1C4'],
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


var ScatterChart;
var ScatterData;
var ScatterOptions = {
    title: '',
    bubble: {textStyle: {fontSize: 0}},
     animation:{
        duration: 500,
        easing: 'out',
    },
    legend: 'none'
  };
  
var AreaChart;
var AreaOptions = {
      title: '',
      hAxis: {title: 'Date',gridlines: {
        color: 'transparent'
    }},
      colors: ['blue','red'],
      animation:{
        duration: 500,
        easing: 'out',
    },
    series: {0: {targetAxisIndex:0},
       1:{targetAxisIndex:1}
      },
    legend: 'none'
      
    }; 
  
	
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
    //startStopLoading();
    getDonutGraphData();
    getReachEffecData();
    
    (document.getElementById("aspectf")).addEventListener("change", function() {
        if(personaSelectValuesStart == ""){
            personaSelectValuesStart = $('#personaf').html();
            console.log("personaSelectValuesStart "+personaSelectValuesStart);
        }
        
        var aspectt = $('#aspectf').val();
        console.log("aspect is "+aspectt);
        var toChange = "<option value='all'>All</option>";
        if(aspectt == "all"){
            $('#personaf').html(personaSelectValuesStart);
            console.log("i was here to put "+personaSelectValuesStart);
        }
        else{
            for(var i=0; i<namee.length; i++){
                if(parent[i] == aspectt && namee[i] != aspectt){
                    toChange += "<option value=\""+namee[i]+"\">"+namee[i]+"</option>";   
                }
            }
            $('#personaf').html(toChange); 
            console.log("toChange "+toChange);  
        }
    });
});

function allUp(){
    return getReachData && getDonutData && getScatterData && getTableData && getAreaChartData && getConvData;
}

function startStopLoading(isStarted,whatDiv){
    if(isStarted){
        $('#loadingimg'+whatDiv).css('display','none');
    	$('#aroundloading'+whatDiv).css('visibility','collapse');
    	$('#backdull'+whatDiv).css('display','none');
    }
    else{
       $('#loadingimg'+whatDiv).css('display','block');
	   $('#aroundloading'+whatDiv).css('visibility','visible');
	   $('#backdull'+whatDiv).css('display','block');
    }
}

function getDonutGraphData(){
    getDonutData = false;
    startStopLoading(getDonutData,"donut");
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getAjeebDonutDataNew" },		 
    	function( data ){ 	
    		//console.log(data);
            code_hierarchy_data = JSON.parse(data);
            init_plots();
            getDonutData = true;
            startStopLoading(getDonutData,"donut");
    });
}

function firsttab(){
    $('a[href="#tab_general"]').click();
}

///////////////////////////////////////////// filter functions //////////////////////////////////////////////

function filter(){
    var timeline = $('#timeline').val();
    var aspect = $('#aspectf').val();
    var persona = $('#personaf').val();
    
    ChartPrev = "";
    
    getTopConversionDataFilter(timeline,aspect,persona);
    drawReachGraphFilter(timeline,aspect,persona);
    getDonutGraphDataFilter(timeline,aspect,persona);
    drawScatterGraphFilter(timeline,aspect,persona);
    drawAreaChartFilter(timeline,aspect,persona);
    getTableTopicDataFilter(timeline,aspect,persona);
}

function clearfilter(){
    $('#timeline').val("7");
    $('#aspectf').val("all");
    $('#personaf').val("all");
    filter();
}

function drawAreaChartFilter(timeline,aspect,persona,thecolors = "ff0000"){
    getAreaChartData = false;
    startStopLoading(getAreaChartData,"area");
    
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getNewAreaData",timeline:timeline,aspect:aspect,persona:persona },		 
    	function( data ){
    	   //console.log(data);
           var result  = JSON.parse(data);
           var AreaData = new google.visualization.DataTable();
           AreaData.addColumn('date', 'Date');
           AreaData.addColumn('number', 'Conversion');
           AreaData.addColumn('number', 'Sentiment');
           var totalReach = 0;
           for(var i=0 ; i<result[0].length ; i++){
                AreaData.addRow([new Date(parseInt(result[4][i]),parseInt(result[3][i])-1,parseInt(result[2][i])),parseInt(result[1][i]),parseInt(result[0][i])]);
           }
           AreaChart = new google.visualization.AreaChart(document.getElementById('areachart'));
           AreaOptions['colors'] = ['blue','#'+thecolors];
           AreaChart.draw(AreaData, AreaOptions);
           getAreaChartData = true;
           startStopLoading(getAreaChartData,"area");
    	   
    }); 
}

var tempPersonaName = "";
function drawScatterGraphFilter(timeline,aspect,persona){
    getScatterData = false;
    startStopLoading(getScatterData,"scatter");
      
      
      namee = [];
      effect = [];
      reach = [];
      magni = [];
      colorr = [];
      parent = [];
      tempPersonaName = aspect;
      $.post( 
    	'database/rep_something.php', 			
    	{ func: "getScatterGraphDataNew", timeline:timeline,aspect:aspect,persona:persona  },		 
    	function( data ){
    	   console.log(data);
    		var result  = JSON.parse(data);
            
            ScatterData = new google.visualization.DataTable();
            ScatterData.addColumn('string', 'ID');
            ScatterData.addColumn('number', 'Reach');
            ScatterData.addColumn('number', 'Effectiveness');
            ScatterData.addColumn('string', 'Aspect');
            ScatterData.addColumn('number', 'Engagement');
            
            MainScatterColors = [];
            MainLegendTable = "<table>";
            var tmaxreach = 0;
            var tminreach = 0;
            var tmaxeffec = 0;
            var tmineffec = 0;
            if(result[0].length>1){
                tmaxreach = parseInt(result[2][0]);
                tminreach = parseInt(result[2][0]);
                tmaxeffec = parseInt(result[1][0]);
                tmineffec = parseInt(result[1][0]);
            }
            
            for(var i=0 ; i<result[0].length ; i++){
			     if(result[5][i] == result[0][i]){
			         ScatterData.addRow(['',parseInt(result[2][i]),parseInt(result[1][i]),result[0][i],parseInt(result[3][i])-parseInt(result[2][i])]);   
			         MainScatterColors.push('#'+result[4][i]);
                 }
                 namee.push(result[0][i]);
                 effect.push(parseInt(result[1][i]));
                 reach.push(parseInt(result[2][i]));
                 magni.push(parseInt(result[3][i]));
                 colorr.push(result[4][i]);
                 parent.push(result[5][i]);
                 if(result[0][i] == result[5][i]){
                    MainLegendTable+="<tr><td><div onclick=\"topClicked('"+result[0][i]+"')\" style=\"margin-bottom: 10px; margin-top: 10px; margin-right: 10px;cursor: pointer; width:10px; height:10px; border-radius:5px !important; background:#"+result[4][i]+";\"></div></td><td style=\"cursor: pointer;\" onclick=\"topClicked('"+result[0][i]+"')\" >"+result[0][i]+"</td></tr>";
                 }
                   if(tmaxreach < parseInt(result[2][i])){
                    tmaxreach = parseInt(result[2][i]);
                 }
                 if(tminreach > parseInt(result[2][i])){
                    tminreach = parseInt(result[2][i]);
                 }
                 if(tmaxeffec < parseInt(result[1][i])){
                    tmaxeffec = parseInt(result[1][i]);
                 }
                 if(tmineffec > parseInt(result[1][i])){
                    tmineffec = parseInt(result[1][i]);
                 }
			}
            MainLegendTable+="</table>";
            $('#legendtablediv').html(MainLegendTable);
            
            ScatterChart = new google.visualization.BubbleChart(document.getElementById('scatter_dual_y'));
            if(MainScatterColors.length > 0){
                ScatterOptions['colors'] = MainScatterColors;   
            }
            //console.log("tmaxreach "+tmaxreach+" tminreach "+tminreach+" timeffe "+tmineffec+" tmaxefe "+tmaxeffec);
            tmaxreach = (tmaxreach * axisFarValuePerc)+tmaxreach;
            tminreach = tminreach - (tminreach * axisFarValuePerc);
            tmaxeffec = (tmaxeffec * axisFarValuePerc)+tmaxeffec;
            tmineffec = tmineffec - (tmineffec * axisFarValuePerc);
            //console.log("tmaxreach "+tmaxreach+" tminreach "+tminreach+" timeffe "+tmineffec+" tmaxefe "+tmaxeffec);
            ScatterOptions['vAxis'] = { 
                      title: 'Effectiveness',
                      gridlines: {
                          color: 'transparent'
                      }
                      //viewWindowMode:'explicit',
                      //viewWindow:{
                      //  max:tmaxeffec,
                      //  min:tmineffec,
                      //  gridlines: {
                      //      color: 'transparent'
                      //  }
                     // }
                    };
            ScatterOptions['hAxis'] = {title: 'Reach',
            gridlines: {
                          color: 'transparent'
                      }
                            //viewWindowMode:'explicit',
                      //viewWindow:{
                      //  max:tmaxreach,
                      //  min:tminreach,
                      //  gridlines: {
                      //      color: 'transparent'
                      //  }
                      //}
                      };
            google.visualization.events.addListener(ScatterChart, 'select', ScatterClicked);
            
            ScatterChart.draw(ScatterData, ScatterOptions);
            getScatterData = true;
            startStopLoading(getScatterData,"scatter");
            ChartPrev = "";
            if(tempPersonaName != "all"){
                setTimeout(function(){
                    aspectFilterAdditionalFunction();
                },100);
            }
            
    });   
}

function aspectFilterAdditionalFunction(){
    if(getDonutData == false){
        setTimeout(function(){
            aspectFilterAdditionalFunction();
        },100);
        return;
    }
    var indd = FirstIndexViaName(tempPersonaName);
    var f1 = FindSlice(namee[indd],magni[indd]);
    animate(f1);
}

function getDonutGraphDataFilter(timeline,aspect,persona){
    getDonutData = false;
    startStopLoading(getDonutData,"donut");
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getAjeebDonutDataNew",timeline:timeline,aspect:aspect,persona:persona  },		 
    	function( data ){ 	
    		//console.log(data);
            code_hierarchy_data = JSON.parse(data);
            init_plots();
            getDonutData = true;
            startStopLoading(getDonutData,"donut");
    });
}

function getTopConversionDataFilter(timeline,aspect,persona){
    getConvData = false;
    startStopLoading(getConvData,"conv");
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getTopConversionFilter" ,timeline:timeline,aspect:aspect,persona:persona },		 
    	function( data ){
    	  $('#topConversionDabba').html(data);
          getConvData = true;
          startStopLoading(getConvData,"conv");
    }); 
}

function getTableTopicDataFilter(timeline,aspect,persona){
    getTableData = false;
    startStopLoading(getTableData,"table");
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getTableTopicData" ,timeline:timeline,aspect:aspect,persona:persona },		 
    	function( data ){
    	  $('#tableTopicDataBox').html(data);
          getTableData = true;
        startStopLoading(getTableData,"table");
    }); 
}

function drawReachGraphFilter(timeline,aspect,persona,thecolors = "2FB1C4"){
    getReachData = false;
    startStopLoading(getReachData,"reach");
    //console.log("the colors is "+thecolors)
    $.post(  
    	'database/rep_something.php', 			
    	{ func: "getNewReachData"  ,timeline:timeline,aspect:aspect,persona:persona },		 
    	function( data ){
    	   //console.log(data);
           var result  = JSON.parse(data);
           ReachData = new google.visualization.DataTable();
           ReachData.addColumn('date', 'Date');
           ReachData.addColumn('number', 'Reach');
           var totalReach = 0;
           for(var i=0 ; i<result[0].length ; i++){
                ReachData.addRow([new Date(parseInt(result[2][i]),parseInt(result[1][i])-1,parseInt(result[0][i])),parseInt(result[3][i])]);
                totalReach += parseInt(result[3][i]);
           }
           $('#reachval').html(number_format( totalReach, 0, '.', ',' )).css("color","#"+thecolors);
           ReachOptions['colors'] = ['#'+thecolors];
           reachGraph.draw(ReachData, ReachOptions);
           getReachData = true;
           startStopLoading(getReachData,"reach");
    	   
    }); 
}


////////////////////////////////////////// first time graphs data get ///////////////////////////////////////

    

function drawReachGraph(){
    getReachData = false;
    startStopLoading(getReachData,"reach");
    
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getNewReachData" },		 
    	function( data ){
    	   var result  = JSON.parse(data);
           ReachData = new google.visualization.DataTable();
           ReachData.addColumn('date', 'Date');
           ReachData.addColumn('number', 'Reach');
           var totalReach = 0;
           for(var i=0 ; i<result[0].length ; i++){
                ReachData.addRow([new Date(parseInt(result[2][i]),parseInt(result[1][i])-1,parseInt(result[0][i])),parseInt(result[3][i])]);
                totalReach += parseInt(result[3][i]);
           }
           $('#reachval').html(number_format( totalReach, 0, '.', ',' ));
           reachGraph = new google.visualization.AreaChart(document.getElementById('fourth'));
           reachGraph.draw(ReachData, ReachOptions);
           getReachData = true;
           startStopLoading(getReachData,"reach");
    	   
    }); 
}

function drawScatterGraph(){
    getScatterData = false;
    startStopLoading(getScatterData,"scatter");
      
      
      $.post( 
    	'database/rep_something.php', 			
    	{ func: "getScatterGraphDataNew" },		 
    	function( data ){
    	   //console.log(data);
    		var result  = JSON.parse(data);
            
            ScatterData = new google.visualization.DataTable();
            ScatterData.addColumn('string', 'ID');
            ScatterData.addColumn('number', 'Reach');
            ScatterData.addColumn('number', 'Effectiveness');
            ScatterData.addColumn('string', 'Aspect');
            ScatterData.addColumn('number', 'Engagement');
            
            MainLegendTable = "<table>";
            
            MainScatterColors = [];
            
            var tmaxreach = 0;
            var tminreach = 0;
            var tmaxeffec = 0;
            var tmineffec = 0;
            if(result[0].length>1){
                tmaxreach = parseInt(result[2][0]);
                tminreach = parseInt(result[2][0]);
                tmaxeffec = parseInt(result[1][0]);
                tmineffec = parseInt(result[1][0]);
            }
            for(var i=0 ; i<result[0].length ; i++){
			     if(result[5][i] == result[0][i]){
			         ScatterData.addRow(['',parseInt(result[2][i]),parseInt(result[1][i]),result[0][i],parseInt(result[3][i])-parseInt(result[2][i])]);   
			         MainScatterColors.push('#'+result[4][i]);
                 }
                 namee.push(result[0][i]);
                 effect.push(parseInt(result[1][i]));
                 reach.push(parseInt(result[2][i]));
                 magni.push(parseInt(result[3][i]));
                 colorr.push(result[4][i]);
                 parent.push(result[5][i]);
                 if(result[0][i] == result[5][i]){
                    MainLegendTable+="<tr><td><div onclick=\"topClicked('"+result[0][i]+"')\" style=\"margin-bottom: 10px; margin-top: 10px; margin-right: 10px;cursor: pointer; width:10px; height:10px; border-radius:5px !important; background:#"+result[4][i]+";\"></div></td><td style=\"cursor: pointer;\" onclick=\"topClicked('"+result[0][i]+"')\" >"+result[0][i]+"</td></tr>";
                 }
                 if(tmaxreach < parseInt(result[2][i])){
                    tmaxreach = parseInt(result[2][i]);
                 }
                 if(tminreach > parseInt(result[2][i])){
                    tminreach = parseInt(result[2][i]);
                 }
                 if(tmaxeffec < parseInt(result[1][i])){
                    tmaxeffec = parseInt(result[1][i]);
                 }
                 if(tmineffec > parseInt(result[1][i])){
                    tmineffec = parseInt(result[1][i]);
                 }
			}
            MainLegendTable+="</table>";
            $('#legendtablediv').html(MainLegendTable);
            
            ScatterChart = new google.visualization.BubbleChart(document.getElementById('scatter_dual_y'));
             
            ScatterOptions['colors'] = MainScatterColors;
            //console.log("tmaxreach "+tmaxreach+" tminreach "+tminreach+" timeffe "+tmineffec+" tmaxefe "+tmaxeffec);
            tmaxreach = (tmaxreach * axisFarValuePerc)+tmaxreach;
            tminreach = tminreach - (tminreach * axisFarValuePerc);
            tmaxeffec = (tmaxeffec * axisFarValuePerc)+tmaxeffec;
            tmineffec = tmineffec - (tmineffec * axisFarValuePerc);
            //console.log("tmaxreach "+tmaxreach+" tminreach "+tminreach+" timeffe "+tmineffec+" tmaxefe "+tmaxeffec);
            MAINtmaxreach = tmaxreach;
            MAINtminreach = tminreach;
            MAINtmaxeffec = tmaxeffec;
            MAINtmineffec = tmineffec;
            ScatterOptions['vAxis'] = { 
                      title: 'Effectiveness',
                      viewWindowMode:'explicit',
                      viewWindow:{
                        max:tmaxeffec,
                        min:tmineffec,
                        gridlines: {
                            color: 'transparent'
                        }
                      }
                    };
            ScatterOptions['hAxis'] = {title: 'Reach',
                            viewWindowMode:'explicit',
                      viewWindow:{
                        max:tmaxreach,
                        min:tminreach,
                        gridlines: {
                            color: 'transparent'
                        }
                      }};
            
            google.visualization.events.addListener(ScatterChart, 'select', ScatterClicked);
            
            ScatterChart.draw(ScatterData, ScatterOptions);
            getScatterData = true;
            startStopLoading(getScatterData,"scatter");
            
    });   
}

function topClicked(thenames){
    
}

function drawAreaChart(){
    getAreaChartData = false;
    startStopLoading(getAreaChartData,"area");
    
    $.post( 
    	'database/rep_something.php', 			
    	{ func: "getNewAreaData" },		 
    	function( data ){
    	   //console.log(data);
           var result  = JSON.parse(data);
           var AreaData = new google.visualization.DataTable();
           AreaData.addColumn('date', 'Date');
           AreaData.addColumn('number', 'Conversion');
           AreaData.addColumn('number', 'Sentiment');
           var totalReach = 0;
           for(var i=0 ; i<result[0].length ; i++){
                AreaData.addRow([new Date(parseInt(result[4][i]),parseInt(result[3][i])-1,parseInt(result[2][i])),parseInt(result[1][i]),parseInt(result[0][i])]);
           }
           
           var range1 = AreaData.getColumnRange(1);
           var range2 = AreaData.getColumnRange(2);
           
           var maxValue1 = (range1.max <= 0) ? 1 : range1.max;
           var maxValue2 = (range2.max <= 0) ? 1 : range2.max;
           var scalar = maxValue2 / maxValue1;
           var minValue1 = Math.min(range1.min, 0);
           var minValue2 = minValue1 * scalar;
           AreaOptions['vAxes'] = [
                                      {title: 'Conversion',
                                      //maxValue: maxValue1,
                                        //minValue: minValue1,
                                        gridlines: {
                                        color: 'transparent'
                                    }}, // Left axis
                                      {title: 'Sentiment',
                                      //maxValue: maxValue1,
                                        //minValue: minValue1,
                                        gridlines: {
                                        color: 'transparent'
                                    }} // Right axis
                                    ];
           
           AreaChart = new google.visualization.AreaChart(document.getElementById('areachart'));
           AreaChart.draw(AreaData, AreaOptions);
           getAreaChartData = true;
           startStopLoading(getAreaChartData,"area");
    	   
    }); 
}










/////////////////////////////ajeeb donut functions ///////////////////////////////////////////////













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
        var rreachs = data[1][5];
        var eefecss = data[1][5];
        if (level > max_level)
        {
            return;
        }
        if (start_deg == stop_deg)
        {
            return;
        }
        data_slices.push([start_deg,stop_deg,name,level,data[1],color,parentchild,perc,rreachs,eefecss]);
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
        .attr("stroke","white")
        .style("display",function(d,i){if(d[3] == 1){return "block";}else{return "none";}})
        .style("font-size","10px")
        .style("fill","white")
        .attr("xlink:href",function(d,i){return "#"+element_id+i;})
        .attr('startOffset', '10%')
        .text(function(d,i){ return d[7]+"%";});


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

function get_level(d,ref)
{
	return d[3];
    if (ref)
	{
        if(revert){
            console.log("1");
            return d[3]-ref[3];
        }
        else{
            console.log("2");
            return d[3]-ref[3]+1;
        }
	}
	else
	{
        if(revert){
            console.log("3");
            return d[3]+1;
        }
        else{
            console.log("4");
            return d[3];
        }
	}
}

function rebaseTween(new_ref)
{
	return function(d)
	{
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
    d3.select(self.frameElement).style("height", "300px");
    init_code_hierarchy_plot("code_hierarchy",code_hierarchy_data,count_function,color_function,label_function,legend_function);
}


function displayFirstPercDonut(){
     svg.selectAll('textPath').style("display","none").style("fill","white");
       svg.selectAll('textPath').style("display",function(d,i){
           if(d[3] == 1)
           {
               if(d[1] - d[0]< noDisplayPerc){
                   return "none";
               }
               else{
                   return "block";   
               }
           }else
           {
               return "none";
           }
       })
       .attr('startOffset', "10%");
}

function displaySecondPercDonut(new_ref){
    svg.selectAll('textPath').style("display","none");
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
    	.style("display",function(d,i){if(d[1]-d[0] < noDisplayPerc ){return "none";}else{return "block";}}).style("fill",function(d,i){if(d[3] == 0){return "white";}else{return "black";}})
        .attr('startOffset', function(d,i){if(d[3] == 1){return "50%";}else{return "10%";}});
}




///////////////////////////////////// extras //////////////////////////////////////////////////////











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

function getReachEffecData(){
    // $.post( 
    	// 'database/rep_something.php', 			
    	// { func: "getReachEffectData" },		 
    	// function( data ){ 	
    		// var result  = JSON.parse(data);
            // var minreach = parseInt(result['minreach']);
            // var maxreach = parseInt(result['maxreach']);
            // var mineffec = parseInt(result['mineffec']);
            // var maxeffec = parseInt(result['maxeffec']);
            // minreach = 0;
            // minReach = minreach;
            // maxReach = maxreach;
            // minEffec = mineffec;
            // maxEffec = maxeffec;
            // $( "#slider-reach" ).slider({
              // range: true,
              // min: minreach,
              // max: maxreach,
              // values: [ minreach, maxreach ],
              // slide: function( event, ui ) {
                // $( "#reach" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                // minReach = ui.values[ 0 ];
                // maxReach = ui.values[ 1 ];
              // }
            // });
            // $( "#reach" ).val( "" + $( "#slider-reach" ).slider( "values", 0 ) + " - " + $( "#slider-reach" ).slider( "values", 1 ) );
            
            // $( "#slider-effect" ).slider({
              // range: true,
              // min: mineffec,
              // max: maxeffec,
              // values: [ mineffec, maxeffec ],
              // slide: function( event, ui ) {
                // $( "#effect" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                // minEffec = ui.values[ 0 ];
                // maxEffec = ui.values[ 1 ];
              // }
            // });
            // $( "#effect" ).val( "" + $( "#slider-effect" ).slider( "values", 0 ) + " - " + $( "#slider-effect" ).slider( "values", 1 ) );
    // });
}

function showModalHelp(title,texts){
    $('#modaltext').html(texts);
    $('#modalhead').html(title);
    $('#resetpassModal').modal('show');
}

function aspectChanged(){
    console.log("changed");
}