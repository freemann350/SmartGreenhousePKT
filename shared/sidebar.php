<aside>
    <div id="sidebar" class="nav-collapse">
        <ul class="sidebar-menu" id="nav-accordion">

            <li class="mt">
                <a  <?php if (isset($IN) && $IN) { ?> class="active" <?php }; ?> href="Inicial" >
                    <i class="fa fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="Perfil" <?php if (isset($PRF) && $PRF) { ?> class="active" <?php }; ?>>
                    <i class="fa fa-user"></i>
                    <span>Perfil</span>
                </a>
            </li>

            <?php if ($Role == "1") { ?>
            <li class="sub-menu">
                <a href="javascript:;" <?php if (isset($ADM) && $ADM) { ?> class="active" <?php }; ?>>
                <i class="fas fa-users"></i>
                    <span>Administração</span>
                </a>
                <ul class="sub">
                    <li <?php if (isset($NU) && $NU) { ?> class="active" <?php }; ?>><a href="NovoUtilizador" style="background: transparent;">Novo Utilizador</a></li>
                    <li <?php if (isset($USR) && $USR) { ?> class="active" <?php }; ?>><a href="Utilizadores" style="background: transparent;">Utilizadores</a></li>
                </ul>
            </li>
            <?php } ?>

            <li class="sub-menu">
                <a href="javascript:;" <?php if (isset($Se) && $Se) { ?> class="active" <?php }; ?>>
                    <i class="fas fa-compress-arrows-alt"></i>
                    <span>Dados de sensores</span>
                </a>
                <ul class="sub">
                    <li <?php if (isset($CT) && $CT) { ?> class="active" <?php }; ?>><a href="ConsultaTemperatura" style="background: transparent;">Temperatura</a></li>
                    <li <?php if (isset($CH) && $CH) { ?> class="active" <?php }; ?>><a href="ConsultaHumidade" style="background: transparent;">Humidade</a></li>
                    <li <?php if (isset($CHT) && $CHT) { ?> class="active" <?php }; ?>><a href="ConsultaHumitura"style="background: transparent;">Humitura</a></li>
                    <li <?php if (isset($CPA) && $CPA) { ?> class="active" <?php }; ?>><a href="ConsultapHAgua"style="background: transparent;">pH Água</a></li>
                    <li <?php if (isset($CPS) && $CPS) { ?> class="active" <?php }; ?>><a href="ConsultapHSolo"style="background: transparent;">pH Solo</a></li>
                    <li <?php if (isset($CAE) && $CAE) { ?> class="active" <?php }; ?>><a href="ConsultaAcessos"style="background: transparent;">Acessos</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" <?php if (isset($At) && $At) { ?> class="active" <?php }; ?>>
                </i><i class="fas fa-expand-arrows-alt"></i>
                    <span>Dados de atuadores</span>
                </a>
                <ul class="sub">
                    <li <?php if (isset($RG) && $RG) { ?> class="active" <?php }; ?>><a href="ConsultaRega" style="background: transparent;">Rega</a></li>
                    <li <?php if (isset($ASP) && $ASP) { ?> class="active" <?php }; ?>><a href="ConsultaAspersores" style="background: transparent;">Aspersores</a></li>
                    <li <?php if (isset($HUM) && $HUM) { ?> class="active" <?php }; ?>><a href="ConsultaHumidificador" style="background: transparent;">Humidificador</a></li>
                    <li <?php if (isset($ALM) && $ALM) { ?> class="active" <?php }; ?>><a href="ConsultaAlarme"style="background: transparent;">Alarme</a></li>
                </ul>
            </li>
        </ul>

        <ul class="sidebar-menu" id="logoutbtn">
            <li class="sub-menu">
                <a id="logout" style="cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
                </a>
            </li>
        </ul>
    </div>
</aside>