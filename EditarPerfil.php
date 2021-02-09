<?php
    $title = "Edição de Perfil";
    $PRF = true;

    require 'Shared/conn.php';
    require 'Shared/restrict.php';

    if (isset($_POST['Nome']) && isset($_POST['Email'])) {
      $UDName = trim(mysqli_real_escape_string($conn, $_POST['Nome']));
      $UDEmail = trim(mysqli_real_escape_string($conn, $_POST['Email']));
      $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = $LoggedID");
      $stmt->bind_param("ss", $UDName,$UDEmail);
      $stmt->execute();
      header("Location: Perfil");
    }
?>

<!DOCTYPE html>
<html lang="pt">

<?php #HEAD INCLUDE
      require 'shared/head.php';
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            require 'shared/header.php';
      ?>

      <?php #SIDEBAR INCLUDE
            require 'shared/sidebar.php';
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Editar perfil</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <br>
                            <form class="form-horizontal style-form" method="post">
                                <div class="form-group">

                                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?=$Nome?>" name="Nome" required>
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?=$Email?>" name="Email" required>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="editar_perfil_submit">
                                  </div>
                            </form>
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