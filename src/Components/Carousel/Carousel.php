<section id="banner">
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
            <div class="<? echo 'banner_row' ?>">
                <?
                $queryItems = "SELECT * FROM block_content
                    INNER JOIN blocks ON block_content.`block_id` = blocks.id_block
                    INNER JOIN contents ON block_content.`content_id` = contents.id_content
                    INNER JOIN images ON contents.`reference_id` = images.id_image
                    WHERE block_id = $blockId";

                $resultItems = $conn->query($queryItems);

                if ($resultItems->num_rows > 0) {
                    while ($rowItems = $resultItems->fetch_assoc()) {
                ?>
                        <img src="<? echo $rowItems['path_image'] ?>" alt="<? echo $rowItems['alt_image'] ?>" loading="lazy" />
                <?
                    }
                } else {
                    echo "0 result";
                }
                ?>
            </div>
    <?
        }
    } else {
        echo "nenhum bloco encontrado";
    }
    ?>
</section>