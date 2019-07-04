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

addLoadEvent(delivery_line_chart);


function delivery_line_chart(){
    var chart = new CanvasJS.Chart("adminchartContainer", {
        exportEnabled: true,
        animationEnabled: true,
        
     
        // axisX: {
        //     title: "States"
        // },
        axisY: {
            title: "Delivery - Income",
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC"
        },
        axisY2: {
            title: "Pick Up - Income",
            titleFontColor: "#C0504E",
            lineColor: "#C0504E",
            labelFontColor: "#C0504E",
            tickColor: "#C0504E"
        },
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data: [{
            type: "column",
            name: "Delivery Orders",
            showInLegend: true,      
            yValueFormatString: "#,##0.# NZD",
            // dataPoints: [
            //     { label: "New Jersey",  y: 19034.5 },
            //     { label: "Texas", y: 20015 },
            //     { label: "Oregon", y: 25342 },
            //     { label: "Montana",  y: 20088 },
            //     { label: "Massachusetts",  y: 28234 }
            // ]
            dataPoints: <?php echo json_encode($dataPoints_delivery, JSON_NUMERIC_CHECK); ?>
        },
        {
            type: "column",
            name: "Pickup Orders",
            axisYType: "secondary",
            showInLegend: true,
            yValueFormatString: "#,##0.# NZD",
            // dataPoints: [
            //     { label: "New Jersey", y: 210.5 },
            //     { label: "Texas", y: 135 },
            //     { label: "Oregon", y: 425 },
            //     { label: "Montana", y: 130 },
            //     { label: "Massachusetts", y: 528 }
            // ]
            dataPoints: <?php echo json_encode($dataPoints_pickup, JSON_NUMERIC_CHECK); ?>

        }]
    });
    chart.render();
    
    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }
}
</script>