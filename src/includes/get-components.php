<?php
$page = $_GET['page'];

$query = "SELECT * FROM page_section
INNER JOIN pages ON page_section.`page_id` = pages.id_page
INNER JOIN sections ON page_section.`section_id` = sections.id_section
WHERE page_id = $page ORDER BY position_page_section ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $sections = [];
    $id_sections = [];
    while ($row = $result->fetch_assoc()) {
        array_push($id_sections, $row["id_section"]);
        array_push($sections, "./src/Components/" . $row['path_section']);
        $classPage = './src/assets/styles/pages/' . $row['style_page'];
        $namePage = $row['name_page'];
    }
} else {
    echo "0 results";
}
