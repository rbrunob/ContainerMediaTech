<section id="channels">
  <div class="channels_row">
    <h5 class="title">Canais Lineares</h5>
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
          $query3 = "SELECT * FROM block_content
             INNER JOIN blocks ON block_content.`block_id` = blocks.id_block
             INNER JOIN contents ON block_content.`content_id` = contents.id_content
             INNER JOIN images ON contents.`reference_id` = images.id_image
             WHERE block_id = $blockId";
          $result3 = $conn->query($query3);

          if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
          ?>
              <div class="channel_item">
                <img src="<? echo $row3['path_image'] ?>" alt="<? echo $row3['alt_image'] ?>" loading="lazy" />
              </div>
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
  </div>
</section>