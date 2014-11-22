$(function(){
	var ctx = document.getElementById("proyectosChart").getContext("2d");
	var data = [
    {
        value: 300,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    }
	];
	var myPieChart = new Chart(ctx).Pie(data, {
		showTooltips: true, 
		tooltipEvents: ['mousemove','touchstart','touchmove'],
		tooltipFontSize: 14,
		tooltipXOffset: 10, 
		tooltipTemplate: '<%if(label){%><%=label%>: <%}%><%=value%>'
	});
});