var ChartPrev = "";
var DonutPrev = "";
var revert = false;

function animate(d) {
	if(!getScatterData){
	   return;
	}
    //console.log(d);
	if (animating)
	{
		return;
	}
    if(d[2] == "Total Magnitude"){
        return;
    }
	animating = true;
	revert = false;
	var new_ref;
	if (d == ref && last_refs.length > 0)
	{
		revert = true;
       	last_ref = last_refs.pop();
        if(last_ref == null){
            return;
        }
	}
    if(ChartPrev != "" && revert == false){
        revert = true;
		last_ref = last_refs.pop();
        if(last_ref == null){
            return;
        }
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
        displayFirstPercDonut();
        AspectClickedViaDonut();
        DonutPrev = "";
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
        displaySecondPercDonut(new_ref);
        personaClickedViaDonut(new_ref); 
        DonutPrev = new_ref;
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

function personaClickedViaDonut(d){
    var indd = FindSlice2(d);
    
    if(parent[indd] == namee[indd]){
        drawReachGraphFilter($('#timeline').val(),parent[indd],"all",colorr[indd]);
        drawAreaChartFilter($('#timeline').val(),parent[indd],"all",colorr[indd]);
        getTableTopicDataFilter($('#timeline').val(),parent[indd],"all");   
    }
    else{
        drawReachGraphFilter($('#timeline').val(),parent[indd],namee[indd],colorr[indd]);
        drawAreaChartFilter($('#timeline').val(),parent[indd],namee[indd],colorr[indd]);
        getTableTopicDataFilter($('#timeline').val(),parent[indd],"all");  
    }
    
    var ScatterData2 = new google.visualization.DataTable();
    ScatterData2.addColumn('string', 'ID');
    ScatterData2.addColumn('number', 'Reach');
    ScatterData2.addColumn('number', 'Effectiveness');
    ScatterData2.addColumn('string', 'Persona');
    ScatterData2.addColumn('number', 'Engagement');
    
    var legendtable = "<table>";
    var colorrs = [];
    
    var tmaxreach = 0;
    var tminreach = 0;
    var tmaxeffec = 0;
    var tmineffec = 0;
    if(reach.length>1){
        tmaxreach = parseInt(reach[0]);
        tminreach = parseInt(reach[0]);
        tmaxeffec = parseInt(effect[0]);
        tmineffec = parseInt(effect[0]);
    }
    for(var j = 0 ; j<parent.length ; j++){
        if(d[6] == ""){
            if(parent[j] == namee[j]){
                continue;
            }
            if(parent[j] == namee[indd]){
                ScatterData2.addRow(['',parseInt(reach[j]),parseInt(effect[j]),namee[j],parseInt(magni[j])-parseInt(reach[j])]);   
			    colorrs.push('#'+colorr[j]);
                legendtable+="<tr><td><div style=\"margin-bottom: 10px; margin-top: 10px; margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                 if(tmaxreach < parseInt(reach[j])){
                    tmaxreach = parseInt(reach[j]);
                 }
                 if(tminreach > parseInt(reach[j])){
                    tminreach = parseInt(reach[j]);
                 }
                 if(tmaxeffec < parseInt(effect[j])){
                    tmaxeffec = parseInt(effect[j]);
                 }
                 if(tmineffec > parseInt(effect[j])){
                    tmineffec = parseInt(effect[j]);
                 }
            }    
        }
        else{
            if(parent[j] == namee[j]){
                continue;
            }
            if(namee[indd] == namee[j] && parent[j] == d[6]){
                ScatterData2.addRow(['',parseInt(reach[j]),parseInt(effect[j]),namee[j],parseInt(magni[j])-parseInt(reach[j])]);
                colorrs.push('#'+colorr[j]);
                legendtable+="<tr><td><div style=\"margin-bottom: 10px; margin-top: 10px; margin-right: 10px; width:10px; height:10px; border-radius:5px !important; background:#"+colorr[j]+";\"></div></td><td>"+namee[j]+"<td></tr>";
                if(tmaxreach < parseInt(reach[j])){
                    tmaxreach = parseInt(reach[j]);
                 }
                 if(tminreach > parseInt(reach[j])){
                    tminreach = parseInt(reach[j]);
                 }
                 if(tmaxeffec < parseInt(effect[j])){
                    tmaxeffec = parseInt(effect[j]);
                 }
                 if(tmineffec > parseInt(effect[j])){
                    tmineffec = parseInt(effect[j]);
                 }
            } 
        }  
    }
    
    legendtable+="</table>";
    $('#legendtablediv').html(legendtable);
    if(colorrs.length > 0){
        ScatterOptions['colors'] = colorrs;   
    }
    //console.log("tmaxreach "+tmaxreach+" tminreach "+tminreach+" timeffe "+tmineffec+" tmaxefe "+tmaxeffec);
    tmaxreach = (tmaxreach * axisFarValuePerc)+tmaxreach;
    tminreach = tminreach - (tminreach * axisFarValuePerc);
    tmaxeffec = (tmaxeffec * axisFarValuePerc)+tmaxeffec;
    tmineffec = tmineffec - (tmineffec * axisFarValuePerc);
    //console.log("tmaxreach "+tmaxreach+" tminreach "+tminreach+" timeffe "+tmineffec+" tmaxefe "+tmaxeffec);
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
    ScatterChart.draw(ScatterData2, ScatterOptions);
    $('#impactheading').html("Persona Impact");
    
    ChartPrev = indd;
    if(indd == 0){
        ChartPrev = "0";
    }
}

function AspectClickedViaDonut(){
    ScatterOptions['colors'] = MainScatterColors;
    ScatterOptions['vAxis'] = { 
              title: 'Effectiveness',
              viewWindowMode:'explicit',
              viewWindow:{
                max:MAINtmaxeffec,
                min:MAINtmineffec,
                gridlines: {
                    color: 'transparent'
                }
              }
            };
    ScatterOptions['hAxis'] = {title: 'Reach',
                    viewWindowMode:'explicit',
              viewWindow:{
                max:MAINtmaxreach,
                min:MAINtminreach,
                gridlines: {
                    color: 'transparent'
                }
              }};
    ScatterChart.draw(ScatterData, ScatterOptions);
    $('#legendtablediv').html(MainLegendTable);
    ChartPrev = ""; 
    $('#impactheading').html("Aspect Impact");
    drawReachGraphFilter($('#timeline').val(),$('#aspectf').val(),$('#personaf').val());
    drawAreaChartFilter($('#timeline').val(),$('#aspectf').val(),$('#personaf').val());
    getTableTopicDataFilter($('#timeline').val(),$('#aspectf').val(),$('#personaf').val());
}

function FindSlice2(d){
    for(var i=0 ; i<namee.length ; i++){
        if(d[2] == namee[i] && parseInt(d[4][1]) == parseInt(magni[i])){
            return i;
        }
    }   
}

function FirstIndex(my_reach,my_effec){
    for(var i=0 ; i<namee.length ; i++){
        if(my_reach == reach[i] && my_effec == effect[i]){
            return i;
        }
    }
}

function FirstIndexViaName(personaname){
    for(var i=0 ; i<namee.length ; i++){
        if(personaname == namee[i]){
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

function ScatterClicked(){
    var selectedItem = ScatterChart.getSelection()[0];
    if(selectedItem){
        if(ChartPrev == ""){
            var my_reach = ScatterData.getValue(selectedItem.row, 1);
            var my_effec = ScatterData.getValue(selectedItem.row, 2);
            var indd = FirstIndex(my_reach,my_effec);
            var f1 = FindSlice(namee[indd],magni[indd]);
            animate(f1);
        }
        else{
            animate(DonutPrev);
        }
    }
}