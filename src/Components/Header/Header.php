<?php
$menu = "SELECT * FROM itens_menu WHERE menu_id = $menuPage";
$resultMenu = $conn->query($menu);
?>
<header>
    <div class="header_row">
        <div class="header_logo">
            <a title="Container Media Tech" href="https://preprod.containermedia.com.br/containermediatech/home">
                <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/logo_containermediatech.svg" alt="Logo Container Media Tech" loading="lazy" />
            </a>
        </div>

        <nav class="header_nav">
            <div class="nav_item">
                <?
                    if ($resultMenu->num_rows > 0) {
                        while ($rowMenu = $resultMenu->fetch_assoc()) {
                        ?><a href="<? echo $urlSite; echo $rowMenu['link_item_menu']?>"><?echo $rowMenu['name_item_menu']?></a><?
                        }
                    } else {
                        echo "Nenhum item de menu encontrado.";
                    }
                ?>
                <a href="https://containermediaplay.com.br/" target="_blank" class="btn_plataform">conheça a plataforma</a>
            </div>
            <div class="nav_mobile">
                <div class="nav_menu">
                    <div class="menu_line"></div>
                    <div class="menu_line"></div>
                    <div class="menu_line"></div>
                </div>
                <div class="nav_content">
                    <?
                        if ($resultMenu->num_rows > 0) {
                            while ($rowMenu = $resultMenu->fetch_assoc()) {
                            ?><a href="<? echo $urlSite; echo $rowMenu['link_item_menu']?>"><?echo $rowMenu['name_item_menu']?></a><?
                            }
                        } else {
                            echo "Nenhum item de menu encontrado.";
                        }
                    ?>
                    <a href="https://containermediaplay.com.br/" target="_blank">conheça a plataforma</a>
                </div>
            </div>
        </nav>
    </div>
</header>