function showGraph() {
    {
        $.post("data.php",
            function(data) {
                console.log(data);
                var name = [];
                var quantity = [];

                for (var i in data) {
                    name.push(data[i].p_name);
                    quantity.push(data[i].p_qty);
                }

                var chartdata = {
                    labels: name,
                    datasets: [{
                        label: 'Quantity',
                        backgroundColor: '#008080',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#49e2ff',
                        hoverBorderColor: '#666666',
                        data: quantity
                    }]
                };

                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });
            });
    }
}