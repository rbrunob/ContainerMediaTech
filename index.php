<?php
include("./src/includes/connection.php");
include("./src/includes/get-components.php");
$urlSite = "https://preprod.containermedia.com.br/containermediatech/";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="UMA PLATAFORMA DE STREAMING PERSONALIZADA COM A SUA MARCA. CANAIS AO VIVO, CONTEÚDO VOD E APPS INTEGRADOS PARA SUA EMPRESA OFERTAR PARA O SEU CLIENTE." />

    <link rel="stylesheet" href="<? echo $urlSite; ?>/src/assets/styles/_reset.css" />
    <link rel="stylesheet" href="<? echo $urlSite; ?>/src/assets/styles/main.css" />

    <link rel="stylesheet" href="<? echo $urlSite; ?><? echo $classPage; ?>" />

    <title><? echo $namePage ?></title>
</head>

<body>

    <?php
    include("./src/Components/Header/Header.php")
    ?>

    <main>
        <?
        for ($i = 0; $i < count($sections); $i++) {
            $id_section = $id_sections[$i];
            include($sections[$i]);
        }
        ?>
    </main>

    <?php include("./src/Components/Footer/Footer.php") ?>


    <!-- ROUND SVG -->
    <svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="round">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -10" result="goo" />
                <feComposite in="SourceGraphic" in2="goo" operator="atop" />
            </filter>
        </defs>
    </svg>
    <!-- ROUND SVG -->

    <script src="./src/assets/js/default.js"></script>
</body>

</html>