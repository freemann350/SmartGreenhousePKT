<?php
require "conn.php";

######################################
###INSERÇÃO DE DADOS DE TEMPERATURA###
######################################
if (isset($_POST["temp"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $temp = trim(mysqli_real_escape_string($conn, $_POST['temp']));

    #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
    $stmt = $conn->prepare("INSERT INTO temp (dia,hora,temp) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $data, $hora, $temp);
    $stmt->execute();
}

###################################
###INSERÇÃO DE DADOS DE HUMIDADE###
###################################
if (isset($_POST["humidade"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $humidade = trim(mysqli_real_escape_string($conn, $_POST['humidade']));

    #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
    $stmt = $conn->prepare("INSERT INTO humidade (dia,hora,humidade) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $data, $hora, $humidade);
    $stmt->execute();
}

###################################
###INSERÇÃO DE DADOS DE HUMITURA###
###################################
if (isset($_POST["humitura"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $humitura = trim(mysqli_real_escape_string($conn, $_POST['humitura']));

    #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
    $stmt = $conn->prepare("INSERT INTO humitura (dia,hora,humitura) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $data, $hora, $humitura);
    $stmt->execute();
}

#####################################
###INSERÇÃO DE DADOS DE pH DE ÁGUA###
#####################################
if (isset($_POST["phagua"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $phagua = trim(mysqli_real_escape_string($conn, $_POST['phagua']));

    #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
    $stmt = $conn->prepare("INSERT INTO phagua (data,hora,ph) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $data, $hora, $phagua);
    $stmt->execute();
}

#####################################
###INSERÇÃO DE DADOS DE pH DE SOLO###
#####################################
if (isset($_POST["phsolo"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $phsolo = trim(mysqli_real_escape_string($conn, $_POST['phsolo']));
    
    #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
    $stmt = $conn->prepare("INSERT INTO phsolo (data,hora,ph) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $data, $hora, $phsolo);
    $stmt->execute();
}

#####################################################
###INSERÇÃO DE DADOS DE ALARME E ACIONAMENTO DESTE###
#####################################################
if (isset($_POST['move']) && isset($_POST['data']) && isset($_POST['hora'])) {
    echo "1";
    #ESCREVER O MOVIMENTO
    $move = $_POST['move'];
    $myfile = fopen("move", "w");
    fwrite($myfile, $move);
    fclose($myfile);

    if ($_POST['move'] == "1") {
        #INSERIR NOVOS DADOS PARA A DB
        $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
        $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
        $tmp = "ND";
        $stmt = $conn->prepare("INSERT INTO camara (dia,hora,image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data, $hora, $tmp);
        $stmt->execute();
        

        #LÊ ID PARA NOMES DE WEBCAMS
        $Query = "SELECT id FROM camara ORDER BY id DESC LIMIT 1";
        $result = $conn->query($Query);
        $row = $result->fetch_assoc();
        
        #ESCREVER ID PARA FICHEIRO
        $id = $row['id'];
        echo $id;
        $myfile = fopen("lid", "w");
        fwrite($myfile, $id);
        fclose($myfile);
        $fullpath = "cv2_captures\webcam".$id.".jpg";
        
        if ($move==1) {
            $stmt = $conn->prepare("UPDATE camara SET image = ? WHERE id = ?");
            $stmt->bind_param("si",$fullpath,$id);
            $stmt->execute();
            require "sendmail.php";
        }
    }
}

###############################
###INSERÇÃO DE DADOS DE REGA###
###############################
if (isset($_POST["rega"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $status = trim(mysqli_real_escape_string($conn, $_POST['rega']));
    #ESCRITA DE ESTADO DE ATUADOR
    $myfile = fopen("status_rega", "w");
    fwrite($myfile, $status);
    fclose($myfile);

    if ($status == "1") {
        #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
        $stmt = $conn->prepare("INSERT INTO rega (data,hora) VALUES (?, ?)");
        $stmt->bind_param("ss", $data, $hora);
        $stmt->execute();   
    }
}

#####################################
###INSERÇÃO DE DADOS DE ASPERSORES###
#####################################
if (isset($_POST["aspersores"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $status = trim(mysqli_real_escape_string($conn, $_POST['aspersores']));
    #ESCRITA DE ESTADO DE ATUADOR
    $myfile = fopen("status_aspersores", "w");
    fwrite($myfile, $status);
    fclose($myfile);

    if ($status == "1") {
        #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
        $stmt = $conn->prepare("INSERT INTO aspersores (data,hora) VALUES (?, ?)");
        $stmt->bind_param("ss", $data, $hora);
        $stmt->execute();
    }
}

########################################
###INSERÇÃO DE DADOS DE HUMIDIFICADOR###
########################################
if (isset($_POST["humidificador"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $status = trim(mysqli_real_escape_string($conn, $_POST['humidificador']));
    #ESCRITA DE ESTADO DE ATUADOR
    $myfile = fopen("status_humidificador", "w");
    fwrite($myfile, $status);
    fclose($myfile);
    
    if ($status == "1") {
    #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
        $stmt = $conn->prepare("INSERT INTO humidificador (data,hora) VALUES (?, ?)");
        $stmt->bind_param("ss", $data, $hora);
        $stmt->execute();
    }
}

#################################
###INSERÇÃO DE DADOS DE ALARME###
#################################
if (isset($_POST["alarme"]) && isset($_POST["hora"]) && isset($_POST["data"])) {
    $data = trim(mysqli_real_escape_string($conn, $_POST['data']));
    $hora = trim(mysqli_real_escape_string($conn, $_POST['hora']));
    $status = trim(mysqli_real_escape_string($conn, $_POST['alarme']));
    #ESCRITA DE ESTADO DE ATUADOR
    $myfile = fopen("status_alarme", "w");
    fwrite($myfile, $status);
    fclose($myfile);

    if ($status == "1") {
        #QUERY PARA INSERÇÃO PARA A BASE DE DADOS
        $stmt = $conn->prepare("INSERT INTO alarme (data,hora) VALUES (?, ?)");
        $stmt->bind_param("ss", $data, $hora);
        $stmt->execute();
    }
}