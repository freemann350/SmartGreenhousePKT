<?php
    $title = "Perfil";
    $PRF = true;

    require 'Shared/conn.php';
    require 'Shared/restrict.php';
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEAD INCLUDE
      require 'shared/head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            require 'shared/header.php'
      ?>


      <?php #SIDEBAR INCLUDE
            require 'shared/sidebar.php'
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i>Perfil de <?=$Nome?></h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                          <form class="form-horizontal style-form" method="get">
                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"><b>Nome</b></label>
                                <div class="col-sm-10">
                                  <p class="form-control-static"><?=$Nome?></p>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Email</b></label>
                                <div class="col-sm-10">
                                  <p class="form-control-static"><?=$Email?></p>
                                  <br>
                                </div>

                                  <label class="col-sm-2 col-sm-2 control-label"><b>Estatuto</b></label>
                                  <div class="col-sm-10">
                                    <p class="form-control-static"><?php if ($Role == 1) {echo "Administrador";} else if ($Role == 2){echo "Utilizador";} else {echo "Outro";}?></p>
                                    <br> 
                                    <a href="EditarPerfil"><input type="button" class="btn btn-primary" value="Editar Perfil"></a>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              require 'shared/footer.php';
            ?>
        </section>
    </section>
    <?php #HEADER INCLUDE
          require 'shared/scripts.php';
    ?>
</body>

</html>