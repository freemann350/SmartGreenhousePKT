<?php
    $title = "Consulta de rega";
    $RG = true;
    $At = true;
    
    #LÊ ESTADO DE ATUADOR
    $myfile = fopen("shared/status_rega", "r");
    $status = fread($myfile,filesize("shared/status_rega"));
    fclose($myfile);

    require 'Shared/conn.php';
    require 'Shared/Restrict.php';
    
    #PAGINAÇÃO
    if (isset($_GET['p']) && (trim($_GET['p']) <> "") && (is_numeric($_GET['p']))) {
        $pg = $_GET['p'];
    } else {
        $pg = 1;
    }
    
    if ($pg < '1'){
        header("Location: ConsultaRega");
    }
    
    $per_page = 15;
    $pfunc = ceil($pg*$per_page) - $per_page;
        
    $Query = "SELECT * FROM rega ORDER BY id LIMIT $pfunc, $per_page";
    $CountData = "SELECT count(*) AS totaldados FROM rega";

    $stmt = $conn->prepare($Query);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<?php require 'shared/head.php' ?>

<body>
    <section id="container">
        <?php 
            require 'shared/header.php';
            require 'shared/sidebar.php'; 
        ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Dados de rega</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <?php if ($status == "1") { ?>
                            <h3 class="status-header-active"><b>Estado atual: Ativado</b></h3>
                            <?php } else { ?>
                            <h3 class="status-header-inactive"><b>Estado atual: Desativado</b></h3>
                            <?php } ?>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Dia</th>
                                        <th>Hora de acionamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {                            
                                    ?>
                                    <tr>
                                        <td><?=$row['data'];?></td>
                                        <td><?=$row['hora'];?></td>
                                    </tr>
                                    <?php }} else { ?>
                                    <tr>
                                      <td>N/D</td>
                                      <td>N/D </td>
                                    </tr>
                                    <?php };?>
                                </tbody>
                            </table>
                            <?php
                                $stmt = $conn->prepare($CountData);

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                echo "Total de dados: " . $row['totaldados'] ."<br><br>";
                            ?>
                        </div>
                    </div>
                </div>
                <?php #PAGINAÇÃO SCRIPT
                    require("shared/paginate.php");
                ?>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
                include 'shared/footer.php';
            ?> 
        </section>
    </section>

    <?php #SCRIPTS INCLUDE
        include 'shared/scripts.php';
    ?>
    
</body>

</html>