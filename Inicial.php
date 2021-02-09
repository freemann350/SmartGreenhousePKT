<?php
    date_default_timezone_set('Europe/Lisbon');
    $title = "Dashboard";
    $IN = true;

    require 'Shared/conn.php';
    require 'Shared/restrict.php';

    //QUERIES PARA CONTAGEM DE LOGS
    //LOGS DE TEMPERATURA
    $QueryLT = "SELECT count(*) AS Logs FROM temp";
    $resultLT = $conn->query($QueryLT);
    $rowLT = $resultLT->fetch_assoc();

    //LOGS DE HUMIDADE
    $QueryLH = "SELECT count(*) AS Logs FROM humidade";
    $resultLH = $conn->query($QueryLH);
    $rowLH = $resultLH->fetch_assoc();

    //LOGS DE ph
    $QueryLPA = "SELECT count(*) AS Logs FROM phagua";
    $resultLPA = $conn->query($QueryLPA);
    $rowLPA = $resultLPA->fetch_assoc();
    
    $QueryLPS = "SELECT count(*) AS Logs FROM phsolo";
    $resultLPS = $conn->query($QueryLPS);
    $rowLPS = $resultLPS->fetch_assoc();
    $TotalPH = $rowLPS['Logs'] + $rowLPA['Logs'];

    //LOGS DE ACESSOS
    $QueryLA = "SELECT count(*) AS Logs FROM camara";
    $resultLA = $conn->query($QueryLA);
    $rowLA = $resultLA->fetch_assoc();

    //LOGS DE ALARME
    $QueryLAl = "SELECT count(*) AS Logs FROM alarme";
    $resultLAl = $conn->query($QueryLAl);
    $rowLAl = $resultLAl->fetch_assoc();

    //QUERIES PARA DADOS DE TEMPERATURAS
    $QueryT1 = "SELECT count(*) AS CountTemp FROM temp WHERE temp < 17";
    $resultT1 = $conn->query($QueryT1);
    
    $QueryT2 = "SELECT count(*) AS CountTemp FROM temp WHERE temp BETWEEN 17 AND 25";
    $resultT2 = $conn->query($QueryT2);
    
    $QueryT3 = "SELECT count(*) AS CountTemp FROM temp WHERE temp BETWEEN 26 AND 33";
    $resultT3 = $conn->query($QueryT3);
    
    $QueryT4 = "SELECT count(*) AS CountTemp FROM temp WHERE temp > 34";
    $resultT4 = $conn->query($QueryT4);
    
    //QUERIES PARA CONTAGEM DE ACESSOS NOS ÚLTIMOS DIAS (BAR CHART)
    $DateBar1 = date("Y-m-d", strtotime("-4 days"));
    $QueryEB1 = "SELECT count(*) AS TotalEntradas, dia FROM camara WHERE dia = '$DateBar1'";
    $resultEB1 = $conn->query($QueryEB1);

    $DateBar2 = date("Y-m-d", strtotime("-3 days"));
    $QueryEB2 = "SELECT count(*) AS TotalEntradas, dia FROM camara WHERE dia = '$DateBar2'";
    $resultEB2 = $conn->query($QueryEB2);

    $DateBar3 = date("Y-m-d", strtotime("-2 days"));
    $QueryEB3 = "SELECT count(*) AS TotalEntradas, dia FROM camara WHERE dia = '$DateBar3'";
    $resultEB3 = $conn->query($QueryEB3);

    $DateBar4 = date("Y-m-d", strtotime("-1 days"));
    $QueryEB4 = "SELECT count(*) AS TotalEntradas, dia FROM camara WHERE dia = '$DateBar4'";
    $resultEB4 = $conn->query($QueryEB4);

    $DateBar5 = date("Y-m-d");
    $QueryEB5 = "SELECT count(*) AS TotalEntradas, dia FROM camara WHERE dia = '$DateBar5'";
    $resultEB5 = $conn->query($QueryEB5);

    //QUERIES DE VARIAÇÃO DE pH (LINE CHART)
    //PH ÁGUA 
    $QueryApH1 = "SELECT hora, ph FROM phagua ORDER BY id DESC LIMIT 4,1 ";
    $resultApH1 = $conn->query($QueryApH1);
    $QueryApH2 = "SELECT hora, ph FROM phagua ORDER BY id DESC LIMIT 3,1 ";
    $resultApH2 = $conn->query($QueryApH2);
    $QueryApH3 = "SELECT hora, ph FROM phagua ORDER BY id DESC LIMIT 2,1 ";
    $resultApH3 = $conn->query($QueryApH3);
    $QueryApH4 = "SELECT hora, ph FROM phagua ORDER BY id DESC LIMIT 1,1 ";
    $resultApH4 = $conn->query($QueryApH4);
    $QueryApH5 = "SELECT hora, ph FROM phagua ORDER BY id DESC LIMIT 0,1 ";
    $resultApH5 = $conn->query($QueryApH5);
    //PH SOLO
    $QuerySpH1 = "SELECT ph FROM phsolo ORDER BY id DESC LIMIT 4,1 ";
    $resultSpH1 = $conn->query($QuerySpH1);
    $QuerySpH2 = "SELECT ph FROM phsolo ORDER BY id DESC LIMIT 3,1 ";
    $resultSpH2 = $conn->query($QuerySpH2);
    $QuerySpH3 = "SELECT ph FROM phsolo ORDER BY id DESC LIMIT 2,1 ";
    $resultSpH3 = $conn->query($QuerySpH3);
    $QuerySpH4 = "SELECT ph FROM phsolo ORDER BY id DESC LIMIT 1,1 ";
    $resultSpH4 = $conn->query($QuerySpH4);
    $QuerySpH5 = "SELECT ph FROM phsolo ORDER BY id DESC LIMIT 0,1 ";
    $resultSpH5 = $conn->query($QuerySpH5);
?>
<!DOCTYPE html>
<html lang="en">

<?php require 'shared/head.php';?>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box unselectable">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Acionar navegação" id="menu-toggle"></div>
            </div>
            <a href="inicial" class="logo unselectable" style="cursor: pointer; "><b>Smart Greenhouse</b></a>
        </header>

        <?php require 'shared\sidebar.php'; ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Dashboard</h3>

                <div class="row mt">
                    <div class="col-md-2 col-sm-6 col-md-offset-1 box0">
                        <div class="box1">
                            <span class="unselectable"><i class="fa fa-clipboard"></i> <i class="fas fa-temperature-low"></i></span>
                            <h3 class="unselectable"><?=$rowLT['Logs'];?></h3>
                        </div>
                        <b><p class="unselectable">Total de logs de temperatura</p></b>
                    </div>

                    <div class="col-md-2 col-sm-6 box0">
                        <div class="box1">
                            <span class="unselectable"><i class="fa fa-clipboard"></i> <i class="fas fa-tint"></i></span>
                            <h3 class="unselectable"><?=$rowLH['Logs'];?></h3>
                        </div>
                        <p class="unselectable">Total de logs de humidade</p>
                    </div>

                    <div class="col-md-2 col-sm-6 box0">
                        <div class="box1">
                            <span class="unselectable"><i class="fa fa-clipboard"></i> <i class="fas fa-seedling"></i></span>
                            <h3 class="unselectable"><?=$TotalPH;?></h3>
                        </div>
                        <p class="unselectable">Total de logs de pH</p>
                    </div>

                    <div class="col-md-2 col-sm-6 box0">
                        <div class="box1">
                            <span class="unselectable"><i class="fa fa-clipboard"></i> <i class="fas fa-video"></i></span>
                            <h3 class="unselectable"><?=$rowLA['Logs'];?></h3>
                        </div>
                        <p class="unselectable">Total de logs de acessos</p>
                    </div>

                    <div class="col-md-2 col-sm-12 box0">
                        <div class="box1">
                            <span class="unselectable"><i class="fa fa-clipboard"></i> <i class="fas fa-bell"></i></span>
                            <h3 class="unselectable"><?=$rowLAl['Logs'];?></h3>
                        </div>
                        <p class="unselectable">Total de logs de alarme de incêndio</p>
                    </div>
                </div>
                
                <div class="tab-pane">
                    <div class="row mt">
                        <div class="col-md-4 col-sm-12">
                            <div class="content-panel">
                                <h4><i class="fa fa-angle-right"></i> Temperaturas mais comuns</h4>
                                <div class="panel-body text-center">
                                    <canvas id="doughnutchart" width="20%" height="15%"></canvas>
                                </div>
                                <h6 style="padding-left: 5px; text-align: center"><a href="ConsultaTemperatura">Ver mais dados</a></h6>
                            </div>
                        </div>
                
                        <div class="col-md-4 col-sm-12">
                            <div class="content-panel" style="padding-bottom: 20px">
                                <h4><i class="fa fa-angle-right"></i> Acessos nos últimos 5 dias</h4>
                                <div class="panel-body text-center">
                                    <canvas id="barchart" width="20%" height="15%"></canvas>
                                </div>
                                <h6 style="padding-left: 5px; text-align: center"><a href="ConsultaAcessos">Ver mais dados</a></h6>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="content-panel">
                                <h4><i class="fa fa-angle-right"></i> Variação de pHs (Água/Solo)</h4>
                                <div class="panel-body text-center">
                                    <canvas id="linechart" width="20%" height="15%"></canvas>
                                </div>
                                <h6 style="text-align: center"><a href="ConsultapHAgua">Ver mais dados (Água)</a> | <a href="ConsultapHSolo">Ver mais dados (Solo)</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
              </section>
            <!-- /MAIN CONTENT -->

            <?php include 'shared/footer.php'?>
          </section>
        </section>

        <?php #FOOTER INCLUDE
            include 'shared/scripts.php';
        ?>

    <script src="assets\chart.js\Chart.bundle.min.js"></script>

    <?php include 'shared\chartjs.php'; ?>
</body>

</html>
