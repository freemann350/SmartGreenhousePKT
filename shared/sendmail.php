<?php
$to_email = "<EMAIL GOES HERE>";
$subject = "Alerta de movimento!";
$body = "Houve movimento na entrada da estufa!\r\nEntre na sua conta para verificar o que aconteceu.\r\n\r\nAcesso imediato: http://prsi.smartgreenhouse.net/estufa/ConsultaAcessos";
$headers = "From: Smart Greenhouse BOT";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
