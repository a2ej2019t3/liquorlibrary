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

addLoadEvent(linechart);
addLoadEvent(piechart);
function linechart() {
 
var chart = new CanvasJS.Chart("myAreaChart", {
	title: {
		text: "OVERVIEW"
	},
	axisY: {
		title: "Earning from pickup orders"
	},
	data: [{
		type: "splineArea",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}


function piechart() {
 
var totalVisitors = <?php echo $totalVisitors ?>;
var visitorsData = {
	"Payment Method status": [{
		
		cursor: "pointer",
		explodeOnClick: false,
		innerRadius: "75%",
		legendMarkerType: "square",
		name: "Payment Method status",
		radius: "100%",
		showInLegend: true,
		startAngle: 90,
		type: "doughnut",
		dataPoints: <?php echo json_encode($paymentmethodDataPoints, JSON_NUMERIC_CHECK); ?>
	}],
	"Card": [{
		color: "#E7823A",
		name: "Card",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($payDataPoints, JSON_NUMERIC_CHECK); ?>
	}],
	"Cash": [{
		color: "#546BC1",
		name: "Cash",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($returningpayDataPoints, JSON_NUMERIC_CHECK); ?>
	}]
};
 
var newVSReturningVisitorsOptions = {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Payment Method status"
	},
	subtitles: [{
		text: "Card VS Cash",
		backgroundColor: "#2eacd1",
		fontSize: 16,
		fontColor: "white",
		padding: 5
	}],
	legend: {
		fontFamily: "calibri",
		fontSize: 14,
		itemTextFormatter: function (e) {
			return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";  
		}
	},
	data: []
};
 

var chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
chart.options.data = visitorsData["Payment Method status"];
chart.render();
 


 
}
</script>