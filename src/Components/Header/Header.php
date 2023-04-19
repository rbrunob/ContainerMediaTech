<?php
$menu = "SELECT * FROM itens_menu WHERE menu_id = $menuPage";
$resultMenu = $conn->query($menu);

if ($resultMenu->num_rows > 0) {

    $pageMenu = array();
    $i = 0;

    while ($rowMenu = $resultMenu->fetch_assoc()) {
        $items = array(
            'link' => $rowMenu['link_item_menu'],
            'name' => $rowMenu['name_item_menu']
        );

        $pageMenu[$i] = $items;
        $i++;
    }
} else {
    echo "Nenhum item de menu encontrado.";
}

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
                for ($i = 0; $i < count($pageMenu); $i++) {

                ?><a href="<? echo $urlSite;
                            echo $pageMenu[$i]['link'] ?>"><? echo $pageMenu[$i]['name'] ?></a><?

                                                                                            }
                                                                                                ?>
                <a href="https://containermediaplay.com.br/" target="_blank" class="btn_plataform">conheça a plataforma</a>
                <div class="languages">
                    <button class="language_current">
                        <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/bra.png" alt="language" />
                    </button>
                    <ul class="languages_options">
                        <li class="laguagens_item" data-language="bra">
                            <a href="home" class="language_name">
                                Português
                            </a>
                        </li>
                        <li class="laguagens_item" data-language="ing">
                            <a href="home-en" class="language_name">
                                Inglês
                            </a>
                        </li>
                        <li class="laguagens_item" data-language="esp">
                            <a href="home-es" class="language_name">
                                Espanhol
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav_mobile">
                <div class="nav_menu">
                    <div class="menu_line"></div>
                    <div class="menu_line"></div>
                    <div class="menu_line"></div>
                </div>
                <div class="nav_content">
                    <?
                    for ($i = 0; $i < count($pageMenu); $i++) {

                    ?><a href="<? echo $urlSite;
                                echo $pageMenu[$i]['link'] ?>"><? echo $pageMenu[$i]['name'] ?></a><?

                                                                                                }
                                                                                                    ?>
                    <a href="https://containermediaplay.com.br/" target="_blank">conheça a plataforma</a>
                </div>
            </div>
        </nav>
    </div>
</header>