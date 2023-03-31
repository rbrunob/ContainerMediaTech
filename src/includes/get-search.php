<?php
require_once('./connection.php');
$currentSearch = $_GET['currentSearch'];
$currentCategory = $_GET['currentCategory'];
$tagSearch = $_GET['tagSearch'];

if ($tagSearch == true) {
    $query = "SELECT * FROM `posts` WHERE `tag_post` LIKE '%$currentCategory%'";
    $verify = mysqli_query($conn, $query) or die('ERROR');
} else {
    if ($currentSearch == '') {
        $query = "SELECT * FROM `posts`";
        $verify = mysqli_query($conn, $query) or die('ERROR');
    } else {
        $query = "SELECT * FROM `posts` WHERE LOWER(`tag_post`) LIKE LOWER('%$currentSearch%') OR LOWER(`title_post`) LIKE LOWER('%$currentSearch%') OR LOWER(`text_post`) LIKE LOWER('%$currentSearch%')";
        $verify = mysqli_query($conn, $query) or die('ERROR');
    }
}


if ($verify->num_rows > 0) {
    $search = array();
    $i = 0;

    while ($row = $verify->fetch_array()) {

        $searchResult = array(
            'id_post' => $row['id_post'],
            'tag_post' => $row['tag_post'],
            'title_post' => $row['title_post'],
            'text_post' => substr(strip_tags($row['text_post']), 0, 240),
            'image_post' => $row['image_post'],
            'link_post' => $row['link_post']
        );

        $search[$i] = $searchResult;
        $i++;
    }
    echo json_encode($search);
} else {
    $notFound = "Nenhuma";
    echo json_encode($notFound);
};
