<head>
	<script src="{{ asset('assets/js/plugins/plotly/plotly-2.12.1.min.js') }}"></script>
</head>

<body>
	<div id='violation-by-country-chart'></div>
</body>

<script>
    const countryData = <?= json_encode($countryData); ?>;

    function unpack(rows, key) {
        return rows.map(function(row) { return row[key]; });
    }

    const data = [{
        type: 'choropleth',
        locationmode: 'country names',
        locations: unpack(countryData, 'country'),
        z: unpack(countryData, 'total_articles'),
        text: unpack(countryData, 'country'),
        showscale : false,

        colorscale: [
            [0.000, "#B4E7F5"],
            [0.111, "#9DDBF0"],
            [0.222, "#86CEEB"],
            [0.333, "#6FBFE5"],
            [0.444, "#59AFDE"],
            [0.556, "#449ED6"],
            [0.667, "#308CCE"],
            [0.778, "#2785C6"],
            [0.889, "#1F7EBD"],
            [1.000, "#1876B3"]
        ],
        colorbar: {
            title: 'Violations count',
        },
    }];

    const layout = {
        title: false,
        geo: {
            projection: {
                type: 'natural earth'
            },
            showland : true,
            landcolor : '#e5ecf6',

        },
        // dragmode: true,
        height: 600,
    };


    const config = {
        showLink: false,
        responsive: true,
        displaylogo: false,
        displayModeBar: false,
        // scrollZoom: true,
        // staticPlot: true,
    }

    Plotly.newPlot("violation-by-country-chart", data, layout, config);

</script>
