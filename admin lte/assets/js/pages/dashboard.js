
/**
 * Script Page
 *
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
let myChart

function selectReport(point, el, type) {
    setActive(el)
    myChart.destroy()
    renderChart(point, type)
}

function setActive(_this) {
    $('#salesbtn button').removeClass('btn-secondary').addClass('btn-outline-secondary')
    $(_this).addClass('btn-secondary').removeClass('btn-outline-secondary')
}

function renderChart(endpoint, type = 'bar') {
    Chart.defaults.global.tooltips.callbacks.label = function (tooltipItem, data) {
        var dataset = data.datasets[tooltipItem.datasetIndex]
        var datasetLabel = dataset.label || ''
        return datasetLabel + ": " + Intl.NumberFormat().format(dataset.data[tooltipItem.index]) + ""
    }
    console.log(endpoint);
    let result = '';
    result = {
        'status': true,
        'response': {
            'label': 'ยอดขายเดือน มิถุนายน 2021',
            'labels': ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
            'results': [1290, 2000, 1300, 1800, 1000, 1500, 2600, 3250, 2000, 1300, 4100, 1000, 1500, 3500, 2250, 2000, 1300, 1800, 3500, 1500, 2600, 3500, 2250, 1300, 1800, 3500, 1500, 2600, 3500, 2250]
        },
        'message': 'OK'
    };
        label = result.response.label
        endpoint = endpoint
        type = type
        myChart = new Chart($('#visitors-chart'), {
            type: type,
            data: {
                labels: result.response.labels,
                datasets: [{
                    label: label,
                    data: result.response.results,
                    backgroundColor: '#007bff88',
                    borderColor: '#007bff',
                    borderWidth: 3,
                    datalabels: {
                        align: 'end',
                        anchor: 'end'
                    },
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    datalabels: {
                        display: function (context) {
                            return context.chart.width > 767
                        },
                        backgroundColor: function (context) {
                            return context.dataset.backgroundColor
                        },
                        borderRadius: 4,
                        color: 'white',
                        font: {
                            weight: 'bold'
                        },
                        formatter: function (value, context) {
                            return Intl.NumberFormat().format(value)
                        },
                        padding: 6
                    }
                },
                // Core options
                layout: {
                    padding: {
                        top: 32,
                        right: 20,
                        bottom: 0,
                        left: 8
                    }
                },
                legend: {
                    display: false //ทำให้ป้ายหัวข้อหาย
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return Intl.NumberFormat().format(value)
                            }
                        },
                        gridLines: {
                            display: true,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: true
                        }
                    }]
                }
            }
        })

        let salesReport = result.response.results.reduce(function (a, b) {
            return a + b
        }, 0)
        $('#salesTextReport').text(label)
        $('#salesReport').text(Intl.NumberFormat().format(salesReport))
 
}

renderChart('report-month.php', 'line')