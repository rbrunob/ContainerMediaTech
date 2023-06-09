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
                        <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/<? if ($language == 1) {
                                                                                                                    echo 'bra';
                                                                                                                } else if ($language == 2) {
                                                                                                                    echo 'ing';
                                                                                                                } else if ($language == 3) {
                                                                                                                    echo 'esp';
                                                                                                                } ?>.png" alt="language" />
                    </button>
                    <ul class="languages_options">
                        <?
                        $languagePages = "SELECT * FROM change_language
                        INNER JOIN itens_menu ON change_language.item_menu_id = itens_menu.id_item_menu
                        WHERE page_id = $page";
                        $resultLanguages = $conn->query($languagePages);

                        if ($resultLanguages->num_rows > 0) {

                            while ($rowLanguage = $resultLanguages->fetch_assoc()) { ?>
                                <li class="laguagens_item" data-language="<? if ($language == 1) {
                                                                                echo 'bra';
                                                                            } else if ($language == 2) {
                                                                                echo 'ing';
                                                                            } else if ($language == 3) {
                                                                                echo 'esp';
                                                                            } ?>">
                                    <a href="<? echo $rowLanguage['link_item_menu']; ?>" class="language_name">
                                        <? echo $rowLanguage['name_language']; ?>
                                    </a>
                                </li>
                        <?   }
                        } else {
                            echo "";
                        }
                        ?>
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