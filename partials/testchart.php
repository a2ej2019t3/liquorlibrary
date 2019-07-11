 <script>
     function addLoadEvent(func) {
         var oldonload = window.onload;
         if (typeof window.onload != 'function') {
             window.onload = func;
         } else {
             window.onload = function() {
                 if (oldonload) {
                     oldonload();
                 }
                 func();
             }
         }
     };
     addLoadEvent(admin_annualchart_1);     
     addLoadEvent(admin_annualchart_2);
     addLoadEvent(admin_annualchart_3);
     addLoadEvent(admin_annualchart_4);

     function admin_annualchart_1() {

         CanvasJS.addColorSet("customColorSet",
             [ //colorSet Array

                 "#393f63",
                 "#e5d8B0",
                 "#ffb367",
                 "#f98461",
                 "#d9695f",
                 "#e05850",
             ]);
             
         CanvasJS.addColorSet("customColorSet2",
             [ //colorSet Array

                "#ffb367",
                "#e5d8B0",
                "#2F4F4F",
                "#008080",
                "#2E8B57",
                "#3CB371",
             ]);

             CanvasJS.addColorSet("customColorSet3",
             [ //colorSet Array

              
                "#2F4F4F",
                "#008080",
                "#2E8B57",
                "#3CB371",
                "#90EE90"   
             ]);
         var chart = new CanvasJS.Chart("annualsales-doughnut-chart", {
             animationEnabled: true,
             colorSet: "customColorSet",
             title: {
                 dockInsidePlotArea: true,
                 fontSize: 35,
                 fontWeight: "normal",
                 horizontalAlign: "center",
                 verticalAlign: "center",
                 text: <?php echo number_format($sales_amount, 2, '.', ', '); ?> 
                 
             },
             data: [{
                 type: "doughnut",
                 startAngle: 60,
                 //innerRadius: 60,
                 theme: "theme2",
                 indexLabelFontSize: 17,
                 indexLabel: "{label} - #percent%",
                 toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                 dataPoints: [{
                         y: <?php echo count($sales_card_Arr); ?> ,
                         label: "Card"
                     },
                     {
                         y: <?php echo count($sales_cash_Arr); ?> ,
                         label: "Cash"
                     },

                 ]
             }]
         });
         chart.render();

     }

     //  second: delivery chart

     function admin_annualchart_2() {

         var chart = new CanvasJS.Chart("users-medium-pie-chart", {
             animationEnabled: true,
             colorSet: "customColorSet2",
             data: [{
                 type: "pie",
                 startAngle: 240,
                 indexLabel: "{label} - #percent%",
                 toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                 dataPoints: [{
                         y: <?php echo count($sales_pickup_Arr); ?>,
                         label: "pick up"
                     },
                     {
                         y: <?php echo count($sales_delivery_Arr); ?>,
                         label: "delivery"
                     }
                    
                 ]
             }]
         });
         chart.render();

     }

    //  third chart
    function admin_annualchart_3(){
        
var chart = new CanvasJS.Chart("users-category-pie-chart", {
	theme:"light2",
	animationEnabled: true,
	axisY :{
		includeZero: false,
		title: "Number of Orders",
		suffix: "NZD"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [{
		type: "spline",
		
		showInLegend: true,
		yValueFormatString: "$##.00",
		name: "Delivery",
		dataPoints:<?php echo json_encode($dataPoints_delivery, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "spline", 
		showInLegend: true,
		
		yValueFormatString: "$##.00",
		name: "Pick up",
		dataPoints:<?php echo json_encode($dataPoints_pickup_total, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "spline",
		showInLegend: true,
		yValueFormatString: "$##.00",
		name: "Card",
		dataPoints:<?php echo json_encode($dataPoints_card, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "$##.00",
		name: "Cash",
		dataPoints:<?php echo json_encode($dataPoints_cash, JSON_NUMERIC_CHECK); ?>
	}
	]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
    }


    // fourth chart

 function admin_annualchart_4() {
	
    var chart = new CanvasJS.Chart("backorderchartbranch", {
        animationEnabled: true,
        
        title:{
            text:"Fortune 500 Companies by Country"
        },
        axisX:{
            interval: 1
        },
        axisY2:{
            interlacedColor: "rgba(1,77,101,.2)",
            gridColor: "rgba(1,77,101,.1)",
            title: "Number of Companies"
        },
        data: [{
            type: "bar",
            name: "companies",
            axisYType: "secondary",
            color: "#393f63",
            dataPoints: [
                { y: 3, label: "Sweden" },
                { y: 7, label: "Taiwan" },
                { y: 5, label: "Russia" },
                { y: 9, label: "Spain" },
                { y: 7, label: "Brazil" },
                { y: 7, label: "India" },
                { y: 9, label: "Italy" },
                { y: 8, label: "Australia" },
                { y: 11, label: "Canada" },
                { y: 15, label: "South Korea" },
                { y: 12, label: "Netherlands" },
                { y: 15, label: "Switzerland" },
                { y: 25, label: "Britain" },
                { y: 28, label: "Germany" },
                { y: 29, label: "France" },
                { y: 52, label: "Japan" },
                { y: 103, label: "China" },
                { y: 134, label: "US" }
            ]
        }]
    });
    chart.render();
    
    }
 </script>