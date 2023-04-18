<?php

$name  = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$site = $_POST['site'];
$message = $_POST['messages'];
$date = date('d/m/Y');
$time = date('H:i:s');

$emailBody = "
 <style type='text/css'>
 
 

 </style>

 <html>

    <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
           
            <tr>

                <td>

                    <tr>
                        <td width='500'>Nome: $name</td>
                    </tr>

                    <tr>
                        <td width='320'>Empresa: $company</td>
                    </tr>

                    <tr>
                        <td width='320'>E-mail: <b>$email</b></td>
                    </tr>

                    <tr>
                        <td width='320'>Telefone: <b>$phone</b></td>
                    </tr>

                    <tr>
                        <td width='320'>Site: <b>$site</b></td>
                    </tr>

                    <tr>
                        <td width='320'>Mensagem: $message</td>
                    </tr>

                </td>

            </tr>

            <tr>
                <td>Este e-mail foi enviado em <b>$date</b> às <b>$time</b></td>
            </tr>

    </table>

 </html>
";

$toSend = "contato@containermedia.com.br";
$destionation = $toSend;
$subject = "Contato através do site institucional";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: $name <$email>';

$sendEmail = mail($destionation, $subject, $emailBody, $headers);

if ($sendEmail) {
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "";
}
