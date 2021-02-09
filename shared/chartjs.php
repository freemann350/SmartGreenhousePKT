<!--DOUGHNUT CHART FOR TEMPERATURE OVERVIEW-->
<script>
    var ctx = document.getElementById('doughnutchart');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['<17ºC', '18-25ºC', '26-33ºC','<34ºC'],
            datasets: [{
                <?php 
                    $rowT1 = $resultT1->fetch_assoc();
                    $rowT2 = $resultT2->fetch_assoc();
                    $rowT3 = $resultT3->fetch_assoc();
                    $rowT4 = $resultT4->fetch_assoc(); 
                ?>
                label: 'Temperaturas',
                data: [<?=$rowT1['CountTemp']?>,<?=$rowT2['CountTemp']?>,<?=$rowT3['CountTemp']?>,<?=$rowT4['CountTemp']?>],
                backgroundColor: [
                    'rgba(0, 188, 154, 1)',
                    'rgba(0, 255, 10, 1)',
                    'rgba(40,190, 62, 1)',
                    'rgba(255, 127, 0, 1)'
                ],
                borderWidth: 2
            }]
        },
    });
</script>

<!--BAR CHART FOR LAST ACCESSES-->
<script>
    var ctx = document.getElementById('barchart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                //DATA
                '<?=$DateBar1?>', '<?=$DateBar2?>', '<?=$DateBar3?>', '<?=$DateBar4?>', '<?=$DateBar5?>'
                ],
            datasets: [{
                    <?php 
                        $rowEB1 = $resultEB1->fetch_assoc();     
                        $rowEB2 = $resultEB2->fetch_assoc();
                        $rowEB3 = $resultEB3->fetch_assoc();
                        $rowEB4 = $resultEB4->fetch_assoc();
                        $rowEB5 = $resultEB5->fetch_assoc();
                    ?>                      
                label: 'Acessos',
                //ESCRITA DE TOTAIS DE ENTRADAS
                data: [<?=$rowEB1['TotalEntradas']?>,<?=$rowEB2['TotalEntradas']?>,<?=$rowEB3['TotalEntradas']?>,<?=$rowEB4['TotalEntradas']?>,<?=$rowEB5['TotalEntradas']?>,],
                backgroundColor: [
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)'
                ],
                borderColor: [
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)',
                    'rgba(138, 164, 89, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision:0
                    }
                }]
            }
        }
    });
</script>

<!--LINE CHART FOR pH VARIATION (WATER/SOIL)-->
<script>
    var ctx = document.getElementById('linechart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            <?php 
                $rowApH1 = $resultApH1->fetch_assoc();
                $rowApH2 = $resultApH2->fetch_assoc();
                $rowApH3 = $resultApH3->fetch_assoc();
                $rowApH4 = $resultApH4->fetch_assoc(); 
                $rowApH5 = $resultApH5->fetch_assoc(); 
            ?>
            labels: [
                '<?=$rowApH1['hora']?>', '<?=$rowApH2['hora']?>', '<?=$rowApH3['hora']?>', '<?=$rowApH4['hora']?>', '<?=$rowApH5['hora']?>'
                ],
            datasets: [{
                label: 'pH Água',
                data: [<?=$rowApH1['ph']?>,<?=$rowApH2['ph']?>,<?=$rowApH3['ph']?>,<?=$rowApH4['ph']?>,<?=$rowApH5['ph']?>],
                fill:false,
                backgroundColor: 'rgba(0, 148, 255, 1)',
                borderColor: 'rgba(0, 148, 255, 1)',
                borderWidth: 3
            }, {
                <?php 
                $rowSpH1 = $resultSpH1->fetch_assoc();
                $rowSpH2 = $resultSpH2->fetch_assoc();
                $rowSpH3 = $resultSpH3->fetch_assoc();
                $rowSpH4 = $resultSpH4->fetch_assoc(); 
                $rowSpH5 = $resultSpH5->fetch_assoc(); 
            ?>
                label: 'pH Solo',
                fill: false,
                backgroundColor: 'rgba(127, 51, 0, 1)',
                borderColor: 'rgba(127, 51, 0, 1)',
                data: [<?=$rowSpH1['ph']?>,<?=$rowSpH2['ph']?>,<?=$rowSpH3['ph']?>,<?=$rowSpH4['ph']?>,<?=$rowSpH5['ph']?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 14
                    }
                }]
            }
        }
    });
</script>