<section id="highlightNews">
    <div class="highlightnews_row">
        <p class="title">Destaques</p>
        <?
        $query = "SELECT * FROM section_block
                INNER JOIN sections ON section_block.`section_id` = sections.id_section
                INNER JOIN blocks ON section_block.`block_id` = blocks.id_block
                WHERE section_id = $id_section";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $blockId = $row['block_id'];
        ?>

                <div class="<? echo 'container_highlights' ?>">
                    <?
                    $queryHighlights = "SELECT * FROM posts ORDER BY id_post LIMIT 3";
                    $resultHighlights = $conn->query($queryHighlights);

                    if ($resultHighlights->num_rows > 0) {
                        while ($rowHighlights = $resultHighlights->fetch_assoc()) {
                    ?>
                            <a href="blog/?title=<? echo $rowHighlights['link_post'] ?>&language=1">
                                <div class="highlights_item">
                                    <div class="item_image">
                                        <img src="https://containermedia.com.br/assets/images/<? echo $rowHighlights['image_post']; ?>" alt="Imagem Highlight" loading="lazy" />
                                    </div>
                                    <div class="item_tag">
                                        <p class="tag"><? echo $rowHighlights['tag_post']; ?></p>
                                    </div>
                                    <div class="item_content">
                                        <div class="content_title">
                                            <p class="title_content"><? echo substr($rowHighlights['title_post'], 0, 80); ?></p>
                                        </div>
                                        <div class="content_description">
                                            <p class="description_content"><? echo substr($rowHighlights["text_post"], 0, 200) . "..." ?></p>
                                        </div>
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
            echo "nenhum bloco encontrado";
        }
        ?>
    </div>
</section>