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
    body {
        margin:0px;
        font-family:sans-serif;
        font-size:12px;
        color: #505050;
    }
    a{
        color: #505050;
        text-decoration: none;
    }
    a:hover {
        color: #FF0000;
        text-decoration: none;
    }

    td {
        border: none;
        outline: none;
    }

    tr {
        border: none;
        outline: none;
    }

    tr:nth-child(1) {
        display: none;
    }

    table {
        border: none;
        outline: none;
    }

    tbody {
        border: none;
        outline: none;
        background: white;
    }

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
                <td>Este e-mail foi enviado em <b>$date</b> as <b>$time</b></td>
            </tr>

    </table>

 </html>
";

$toSend = "contato@containermedia.net.br";
$destionation = $toSend;
$subject = "Contato pelo do site institucional";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $name <$email>";

$sendEmail = mail($destionation, $subject, $emailBody, $headers);

if ($sendEmail) {
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    echo " <meta http-equiv='refresh' content='0.1;URL=https://preprod.containermedia.com.br/containermediatech/home'>";
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "";
}
