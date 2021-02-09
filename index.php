<?php
    $title = "Login";
    session_start();

    if (isset($_SESSION['usr']) && ($_SESSION['usr'] !== "")) {
        header('Location: Inicial');
    }
    
    require 'shared/conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // username and password sent from form
        $usr = mysqli_real_escape_string($conn, $_POST['username']);
        $pwd = $_POST['password']; 
    
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = BINARY ? LIMIT 1");
        $stmt->bind_param("s", $usr);
        
        $stmt->execute();

        $result = $stmt->get_result();
        $rowCheck = $result->fetch_assoc();
        $count = $result->num_rows;
        
        // If result matched $usr and $pwd, table row must be 1 row
        if(($count == 1) && (password_verify($pwd, $rowCheck['password']))) {
            if (!session_id()) 
                session_start();
                $_SESSION['usr'] = $usr;
                $_SESSION['Logged'] = true;

                if(isset($_GET['return_url'])) {
                    header('Location: ' . $_GET['return_url']);
                } else {
                    header('Location: Inicial');
                };

                die();
        } else {
            $error = true;
        };
       };
?>
<!DOCTYPE html>
<html lang="en">

<?php 
    require 'shared/head.php';
?>

<body>
    <section id="container">
            <div class="container">
                <form class="form-login" method = "post" action="">
                    <h2 class="form-login-heading"><b>Smart Greenhouse</b></h2>
                    <div class="login-wrap">
                    <?php if (isset($error) && ($error=true)) {?>
                        <div class="form-group has-error has-feedback">
                        <input type="text" name="username" style="text-align: center;" class="form-control" id="inputError" placeholder="Utilizador" value="<?php if (isset($_POST['username'])) { echo $_POST['username']; }?>" autofocus required>
                        <br>
                        <input type="password" name="password" style="text-align: center;" class="form-control" id="inputError" placeholder="Palavra-passe" required>
                        <input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                        <br>
                        <button class="btn btn-theme btn-block" href="inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
                        <p style="text-align: center; color: #FF0000">Utilizador/Palavra-Passe inválida</p>
                    <?php } else {?>
                        <input type="text" style="text-align: center;" class="form-control" placeholder="Utilizador" name="username" autofocus required>
                        <br>
                        <div class="form-group">
                            <input type="password" style="text-align: center;" class="form-control" placeholder="Palavra-passe" name="password" required>
                            <input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                            <br>
                            <button class="btn btn-theme btn-block" href="Inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
                    <?php };?>
                    </div>
                </form>
            </div>
    </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/greenhouse.jpg");
    </script>
</body>

</html>
