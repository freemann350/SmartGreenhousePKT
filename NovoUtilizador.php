<?php
    $title = "Novo Utilizador";
    $NU = true;
    $ADM = true;

    require 'Shared/conn.php';
    require 'Shared/restrict.php';
    
    if ($Role != "1") {
      header("Location: 403");
    }
    
    if (isset($_POST['Nome']) && isset($_POST['Email']) && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Password2']) && isset($_POST['Tipo']) && ($_POST['Password'] == $_POST['Password2'])) {  
      $NUNome = trim(mysqli_real_escape_string($conn, $_POST['Nome']));
      $NUEmail = trim(mysqli_real_escape_string($conn, $_POST['Email']));
      $NUUsername = trim(mysqli_real_escape_string($conn, $_POST['Username']));
      $NUPassword = trim(mysqli_real_escape_string($conn, $_POST['Password']));
      $NURole = trim(mysqli_real_escape_string($conn, $_POST['Tipo']));
      
      $options = [
        'cost' => 11,
      ];
      
      $NUPasswordHash = password_hash($NUPassword,PASSWORD_BCRYPT,$options);
      $stmt = $conn->prepare("INSERT INTO users (name,email,username,password,id_role) VALUES (?,?,?,?,?)");
      $stmt->bind_param("ssssi", $NUNome, $NUEmail, $NUUsername, $NUPasswordHash, $NURole);
      $stmt->execute();
      
      header("Location: Utilizadores");
    }
?>

<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      Include 'shared/head.php';
?>

<body>
    <section id="container">
      <?php #HEADER INCLUDE
            include 'shared/header.php';
      ?>

      <?php #SIDEBAR INCLUDE
            include 'shared/sidebar.php';
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Novo Utilizador</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" id="NovoUtilizador" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Nome" value="<?php if (isset($_POST['Nome'])) {echo $_POST['Nome'];} ?>" required>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" name="Email" value="<?php if (isset($_POST['Email'])) {echo $_POST['Email'];} ?>" required>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Nome de utilizador</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Username" value="<?php if (isset($_POST['Username'])) {echo $_POST['Username'];} ?>" required>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Palavra-Passe</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="Password" id="pw1" required>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Confirmar Palavra-Passe</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="Password2" required>
                                  <span class="help-block"></span>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de utilizador</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Tipo" required>
                                      <option value="" selected hidden>Escolha um tipo de utilizador</option>
                                      <?php
                                        $stmt = $conn->prepare("SELECT * FROM roles");

                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                      ?>
                                        <option value="<?=$row['id']?>"<?php if ((!empty($_POST['Tipo'])) && (isset($_POST['Tipo']))) {  if ($row["Id"] == $_POST['Tipo']) { echo "Selected";}} ?>><?=$row['role']?></option>
                                      <?php } ?>
                                    </select>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="novo_util_submit">
                                </div>
                        </form>
                        </div>
                    </div>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              include 'shared/footer.php';
            ?>
        </section>
    </section>

    <?php #HEADER INCLUDE
          include 'shared/scripts.php'
    ?>
