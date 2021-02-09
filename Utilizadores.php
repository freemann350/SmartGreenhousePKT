<?php 
    $title = "Consulta de Utilizadores";
    $ADM = true;
    $USR = true;

    require 'shared/conn.php';
    require 'Shared/restrict.php';
    
    if ($Role != "1") {
        header("Location: 403");
    }

    #PAGINAÇÃO
    if (isset($_GET['p']) && (trim($_GET['p']) <> "") && (is_numeric($_GET['p']))) {
        $pg = $_GET['p'];
    } else {
        $pg = 1;
    }
    
    if ($pg < '1'){
        header("Location: Utilizadores");
    }
    
    $per_page = 15;
    $pfunc = ceil($pg*$per_page) - $per_page;
    
    $Query = "SELECT users.id,users.name,roles.role FROM users INNER JOIN roles ON users.id_role = roles.id WHERE name != '$Nome' ORDER BY id LIMIT $pfunc, $per_page";
    $CountData = "SELECT count(*) AS totaldados FROM users WHERE name != '$Nome' ";

    $stmt = $conn->prepare($Query);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<?php 
    require 'shared/head.php';
?>

<body>

    <section id="container">

        <?php 
            require 'shared/header.php';
            require 'shared/sidebar.php';
        ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Gestão de utilizadores</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Tipo de utilizador</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {                            
                                    ?>
                                    <tr>
                                        <td><?=$row['name'];?></td>
                                        <td><?=$row['role'];?></td>
                                        <td><a href="EditarUtilizador?id=<?=$row['id'];?>"><i title="Editar" class="fas fa-pencil-alt fa-lg" aria-hidden="true"></i></a>
                                        <a href="javascript:;" class="deleteRecord" style="color: red" data-id="<?=$row['id'];?>">
                                            <i title="Eliminar" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                            </a></td>
                                    </tr>
                                    <?php }} else { ?>
                                    <tr>
                                      <td>N/D</td>
                                      <td>N/D </td>
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
                            <a href="NovoUtilizador" title="Adicionar um novo utilizador">+ Registar novo Utilizador</a>
                        </div>
                    </div>
                </div>
                <?php #PAGINAÇÃO SCRIPT
                    require("shared/paginate.php");
                ?>                              
            </section>
        </section>
        <!-- /MAIN CONTENT -->

        <?php #FOOTER INCLUDE
            include 'shared/footer.php';
        ?>  
    </section>

    <?php #SCRIPTS INCLUDE
        include 'shared/scripts.php';
    ?>
    
    <script type="text/javascript">
        $('.deleteRecord').click(function() {
            let id = $(this).attr("data-id");
            $.confirm({
                title: 'Eliminar Utilizador',
                content: 'Tem a certeza que pretende eliminar este registo?',
                buttons: {
                    Sim: function() {
                        $.ajax({
                            method: "GET",
                            url: "shared/deluser.php?id=" + id,
                        })
                        
                    },
                    Não: function() {

                    },

                }
            });
        });
    </script>
</body>

</html>