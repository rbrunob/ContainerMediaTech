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
        <section id="postNew">
            <div class="postnew_row">
                <div class="postnew_content">
                    <div class="backto">
                        <button class="backto_button" data-back><? echo $LastPagetitle ?></button> <span class="current_page">/ <? echo $row['title_post'] ?></span>
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