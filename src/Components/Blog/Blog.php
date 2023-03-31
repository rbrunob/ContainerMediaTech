<section id="blog">
    <div class="blog_row">
        <h6 class="title_section">NOVIDADES NO BLOG DA CONTAINER</h6>
        <?
        $query2 = "SELECT * FROM section_block
            INNER JOIN sections ON section_block.`section_id` = sections.id_section
            INNER JOIN blocks ON section_block.`block_id` = blocks.id_block
            WHERE section_id = $id_section";

        $result2 = $conn->query($query2);

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $blockId = $row2['block_id'];
        ?>
                <div class="<? echo $row2['class_block'] ?>">

                    <?
                    if ($namePage == 'Blog') {
                        $query3 = "SELECT * FROM posts ORDER BY id_post";
                        $result3 = $conn->query($query3);
                    } else {
                        $query3 = "SELECT * FROM posts ORDER BY id_post LIMIT 4";
                        $result3 = $conn->query($query3);
                    }

                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                    ?>

                            <a href="index.php?page=8&title=<? echo $row3['link_post'] ?>" class="blog_news_item">
                                <div class="blog_item_container">
                                    <div class="news_image">
                                        <img src="https://containermedia.com.br/assets/images/<? echo $row3['image_post']; ?>" alt="Notícia" loading="lazy" />
                                    </div>
                                    <div class="news_category">
                                        <span class="category"><? echo $row3['tag_post']; ?></span>
                                    </div>
                                    <div class="news_content">
                                        <p class="title"><? echo substr($row3['title_post'], 0, 80); ?></p>
                                        <p class="content"><? echo substr($row3["text_post"], 0, 200) . "..." ?></p>
                                    </div>
                                </div>
                            </a>

                    <?
                        }
                    } else {
                        echo "0 results";
                    }

                    ?>

                </div>
        <?
            }
        } else {
            echo "nenhum bloco encontrado ";
        }
        ?>
        <a href="https://preprod.containermedia.com.br/containermediatech/index?page=7" class="btn_blog">Explorar</a>
    </div>
</section>