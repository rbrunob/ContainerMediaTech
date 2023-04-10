<?php
$page = $_GET['page'];

if ($page == '8') {
    $title = $_GET['title'];

    $query = "SELECT * FROM `posts` WHERE `link_post` = '$title'";
    $result = $conn->query($query);
}

if (isset($_SERVER['HTTP_REFERER'])) {
    $lastUrl = $_SERVER['HTTP_REFERER'];
    $html = file_get_contents($lastUrl);
    preg_match("/<title>(.*)<\/title>/i", $html, $matches);
    $LastPagetitle = $matches[1];
}
?>
<?
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div id="google_translate_element" class="boxTradutor"></div>
        <section id="postNew">
            <div class="postnew_row">
                <div class="postnew_content">
                    <div class="backto">
                        <div>
                            <button class="backto_button" data-back><? echo $LastPagetitle ?></button> <span class="current_page">/ <? echo $row['title_post'] ?></span>
                        </div>
                        <div class="items_lang">
                            <a href="javascript:changeLanguage('pt')" class="item_lang"><img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/logo-pt-br.png" alt="Português" /></a>
                            <a href="javascript:changeLanguage('en')" class="item_lang"><img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/logo-en-uk.png" alt="Inglês" /></a>
                            <a href="javascript:changeLanguage('es')" class="item_lang"><img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/logo-es.png" alt="Espanhol" /></a>
                        </div>
                    </div>
                    <div class="content_image">
                        <img src="https://containermedia.com.br/assets/images/<? echo $row['image_post']; ?>" alt="<? echo $row['title_post'] ?>" />
                        <div class="text_image">
                            <span class="text"><? echo $row['title_post'] ?></span>
                        </div>
                    </div>
                    <div class="content_presets">
                        <span><? echo $row['tag_post'] ?></span>
                        <div class="share_news">
                            <a class="share_item">
                                <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/icon-facebook.svg" alt="Facebook" loading="lazy" />
                            </a>
                            <a class="share_item">
                                <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/icon-whatsapp.svg" alt="Whatsapp" loading="lazy" />
                            </a>
                            <a class="share_item">
                                <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/icon-instagram.svg" alt="Instagram" loading="lazy" />
                            </a>
                            <a class="share_item">
                                <img src="https://preprod.containermedia.com.br/containermediatech/src/assets/images/icon-twitter.svg" alt="Twitter" loading="lazy" />
                            </a>
                        </div>
                    </div>
                    <!-- <div class="postnew_title">
                <h1 class="title"></h1>
            </div> -->
                    <div class="content_texts">
                        <p class="texts">
                            <?
                            echo $row['text_post']
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
<?
    }
} else {
    echo "0 result";
}
?>
<script type="text/javascript">
    var languages = null;

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'pt',
            includedLanguages: 'en,es,pt',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');

        languages = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
    }

    function changeEvent(element) {
        if (element.fireEvent) {
            element.fireEvent('onchange');
        } else {
            var evObj = document.createEvent("HTMLEvents");

            evObj.initEvent("change", false, true);
            element.dispatchEvent(evObj);
        }
    }

    function changeLanguage(lang) {
        if (languages) {
            languages.value = lang;
            changeEvent(languages);
        }
    }
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>