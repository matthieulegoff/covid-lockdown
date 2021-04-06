
$(document).ready(function() {

    generateChart(
        $('#hospital'),
        $('#hospital').data('hospitalDates'),
        $('#hospital').data('hospitalValues'),
        'Personnes en réanimation',
        3000
    );

    generateChart(
        $('#tests'),
        $('#tests').data('testsDates'),
        $('#tests').data('testsValues'),
        'Tests positifs',
        5000
    );

    function generateChart(canvas, dates, values, label, goal) {
        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: dates.split(','),
                datasets: [{
                    backgroundColor: '#CCC',
                    label: label,
                    data: values.split(',')
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        distribution: 'series',
                        time: {
                            parser: 'DD-MM-YYYY'
                        }
                    }]
                },
                annotation: {
                    annotations: [{
                        drawTime: 'afterDatasetsDraw',
                        type: 'line',
                        mode: 'horizontal',
                        scaleID: 'y-axis-0',
                        value: goal,
                        borderColor: 'red',
                        borderWidth: 1,
                        label: {
                            backgroundColor: 'red',
                            content: 'Objectif',
                            enabled: true
                        }
                    }]
                }
            }
        });
    }
});
