<!DOCTYPE html>
<html lang="en">

<?php require 'shared/head.php' ?>

<body>

    <section id="container">
        <?php 
            require 'shared/header.php';
        ?>

        <!--MAIN CONTENT-->
        <section>
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> 404: Página não existente</h3>

                <div class="row mt">
                    <p style="margin-left:2.5%; font-size: 14px">A página que procura não existe.
                        <br><a href="index">Voltar à página inicial.</a>
                    </p>
                </div>
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
