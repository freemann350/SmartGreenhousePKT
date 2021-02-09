<?php
    $titulo = "Editar Utilizador";

    require_once 'shared/conn.php';
    require_once 'shared/restrict.php';

    if (!(isset($_GET["id"])) || (trim($_GET["id"]) == "") || (!is_numeric($_GET["id"]))) {
        header("Location: 404");
    }


    if ($Role != "1") {
        header("Location: 403");
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");

    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($result->num_rows == 0) {
        header("Location: 404");
    }

    if ((isset($_POST["editar_util_submit"])) && (isset($_POST["Nome"])) && (isset($_POST["Email"])) && (isset($_POST["Username"]))) {
        // Escape user inputs for security
        $Nome = trim(mysqli_real_escape_string($conn, $_POST['Nome']));
        $Email = trim(mysqli_real_escape_string($conn, $_POST['Email']));
        $Username = trim(mysqli_real_escape_string($conn, $_POST['Username']));
        $Tipo = trim(mysqli_real_escape_string($conn, $_POST['Tipo']));
        $Id = trim(mysqli_real_escape_string($conn, $_GET["id"]));

        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, username = ?, id_role = ? WHERE Id = ?");

        $stmt->bind_param("sssii", $Nome, $Email, $Username, $Tipo, $Id);

        $stmt->execute();

        header("Location: Utilizadores");
    };

    if (isset($_POST["editar_pwd_submit"])) {
        if ($_POST['Password'] == $_POST['Password2']) {
        // Escape user inputs for security
        $Id = trim(mysqli_real_escape_string($conn, $_GET["id"]));
        $Password = trim(mysqli_real_escape_string($conn,$_POST['Password']));

        $options = [
            'cost' => 11,
        ];

        $Password = password_hash($Password, PASSWORD_BCRYPT, $options);

        $stmt = $conn->prepare(
        "UPDATE users SET password = ? WHERE id = ?");

        $stmt->bind_param("si", $Password, $Id);

        $stmt->execute();

        header("Location: Utilizadores");
        }
    };
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      Include 'Shared/Head.php';
?>

<body>
    <section id="container">
      <?php #HEADER INCLUDE
            include 'Shared/Header.php';
      ?>

      <?php #SIDEBAR INCLUDE
            include 'Shared/Sidebar.php';
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper">
              <br>
                <h3><i class="fa fa-angle-right"></i> Edição de Utilizador</h3>
                <div class="row mt">
                    <div class="form-panel">
                      <h3><i class="fa fa-angle-right"></i> Editar dados principais de utilizador</h3><br>
                        <form class="form-horizontal style-form" method="POST" id="EditarUtilizador">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?=$user['name']?>" name="Nome" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" value="<?=$user['email']?>" name="Email" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Nome de utilizador</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?=$user['username']?>" name="Username" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de utilizador</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Tipo" required>
                                      <?php
                                        $stmt = $conn->prepare("SELECT * FROM roles");

                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                      ?>
                                        <option value="<?= $row['id'] ?>" <?=(($row["id"] == $user["id_role"]) ? "selected" : "")  ?>><?=$row["role"] ?></option>
                                      <?php } ?>
                                    </select>
                                    <br>
                                  <input type="submit" class="btn btn-primary" value="Submeter" name="editar_util_submit">
                                </div>
                        </form>
                        </div>
                    </div><br>

                        <div class="form-panel">
                          <h3><i class="fa fa-angle-right"></i> Editar Palavra-Passe</h3>
                          <br>
                            <form class="form-horizontal style-form" method="POST" id="EditarPassword">
                                <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Palavra-Passe</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" name="Password" placeholder="••••••" id="pw1" required>
                                    <br>
                                  </div><br>
                                  <label class="col-sm-2 col-sm-2 control-label">Confirmar Palavra-Passe</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" name="Password2" placeholder="••••••" required>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="editar_pwd_submit">
                                  </div>
                            </form>
                            </div>
                          </div>
                        </div>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              include 'shared/footer.php';
            ?>
        </section>
    </section>

    <?php #SCRIPTS INCLUDE
          include 'shared/scripts.php'
    ?>

</body>

</html>
