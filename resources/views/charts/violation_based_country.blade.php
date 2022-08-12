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
        locationmode
        : 'country names',
        locations: unpack(countryData, 'country'),
        z: unpack(countryData, 'total_articles'),
        text: unpack(countryData, 'country'),
        showscale : false,

        colorscale: [
            [0.000, "#f5b5d9"],
            [0.111, "#faa0d3"],
            [0.222, "#e887be"],
            [0.333, "#eb7cbb"],
            [0.444, "#ed72b8"],
            [0.556, "#ed61b1"],
            [0.667, "#e84da5"],
            [0.778, "#eb3fa1"],
            [0.889, "#e82a96"],
            [1.000, "#E82A86"]
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
            landcolor : '#f5b5d9',

        },
        // dragmode: true,
        height: 1000,
        margin: {
            l: 10,
            r: 10,
            b: 170,
            t: 0,
            pad: 2
        }
    };

    const config = {
        showLink: false,
        responsive: true,
        displaylogo: false,
        displayModeBar: true,
        scrollZoom: true,
        // staticPlot: true,
    }

    Plotly.newPlot("violation-by-country-chart", data, layout, config);

</script>
