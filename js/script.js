var w = 500,
	h = 500;

var colorscale = d3.scale.category10();

//Legend titles
var LegendOptions = ['FMCG','Fashion & Life Style','Telcos','Real Estate','Banks','Government','Electronics','Hospitality','Education','Pharmaceutical'];

//Data
var d = [
		  [
			{axis:"Marketing Share",value:23},
			{axis:"Average Enthusiasm and Qualification of Executives",value:7},
			{axis:"Current Technology State",value:4}
		  ],[
			{axis:"Marketing Share",value:18},
			{axis:"Average Enthusiasm and Qualification of Executives",value:9},
			{axis:"Current Technology State",value:3}
		  ],
		  [
			{axis:"Marketing Share",value:6},
			{axis:"Average Enthusiasm and Qualification of Executives",value:9},
			{axis:"Current Technology State",value:8}
		  ],
		  [
			{axis:"Marketing Share",value:13},
			{axis:"Average Enthusiasm and Qualification of Executives",value:6},
			{axis:"Current Technology State",value:4}
		  ],
		  [
			{axis:"Marketing Share",value:6},
			{axis:"Average Enthusiasm and Qualification of Executives",value:8},
			{axis:"Current Technology State",value:5}
		  ],
		  [
			{axis:"Marketing Share",value:14},
			{axis:"Average Enthusiasm and Qualification of Executives",value:5},
			{axis:"Current Technology State",value:2}
		  ],
		  [
			{axis:"Marketing Share",value:2},
			{axis:"Average Enthusiasm and Qualification of Executives",value:7},
			{axis:"Current Technology State",value:6}
		  ],
		  [
			{axis:"Marketing Share",value:5},
			{axis:"Average Enthusiasm and Qualification of Executives",value:5},
			{axis:"Current Technology State",value:7}
		  ],
		  [
			{axis:"Marketing Share",value:9},
			{axis:"Average Enthusiasm and Qualification of Executives",value:5},
			{axis:"Current Technology State",value:4}
		  ],
		  [
			{axis:"Marketing Share",value:2},
			{axis:"Average Enthusiasm and Qualification of Executives",value:6},
			{axis:"Current Technology State",value:3}
		  ]
		];

//Options for the Radar chart, other than default
var mycfg = {
  w: w,
  h: h,
  maxValue: 0.6,
  levels: 6,
  ExtraWidthX: 300
}

//Call function to draw the Radar chart
//Will expect that data is in %'s
RadarChart.draw("#chart", d, mycfg);

////////////////////////////////////////////
/////////// Initiate legend ////////////////
////////////////////////////////////////////

var svg = d3.select('#body')
	.selectAll('svg')
	.append('svg')
	.attr("width", w+300)
	.attr("height", h)

//Create the title for the legend
var text = svg.append("text")
	.attr("class", "title")
	.attr('transform', 'translate(90,0)') 
	.attr("x", w - 70)
	.attr("y", 10)
	.attr("font-size", "12px")
	.attr("fill", "#404040")
	.text("");
		
//Initiate Legend	
var legend = svg.append("g")
	.attr("class", "legend")
	.attr("height", 100)
	.attr("width", 200)
	.attr('transform', 'translate(90,20)') 
	;
	//Create colour squares
	legend.selectAll('rect')
	  .data(LegendOptions)
	  .enter()
	  .append("rect")
	  .attr("x", w - 65)
	  .attr("y", function(d, i){ return i * 20;})
	  .attr("width", 10)
	  .attr("height", 10)
	  .style("fill", function(d, i){ return colorscale(i);})
	  ;
	//Create text next to squares
	legend.selectAll('text')
	  .data(LegendOptions)
	  .enter()
	  .append("text")
	  .attr("x", w - 52)
	  .attr("y", function(d, i){ return i * 20 + 9;})
	  .attr("font-size", "11px")
	  .attr("fill", "#737373")
	  .text(function(d) { return d; })
	  ;	