<?php

include_once "includes/db_connect.php";
include_once "includes/main_scripts.php";

session_start();
$header_for_user = auth();

include_once "includes/header.php";

foreach ($result as $k => $v) { ?>
    <article>
        <?php if ($k === 'author') {
            echo "<p>Автор: $v</p>";
        } elseif ($k === 'title') {
            echo "<p>Название: $v</p>";
        } elseif ($k === 'text') {
            echo "<p>$v</p>";
        } elseif ($k === 'date') {
            echo "<p>Дата: $v</p>";
        }
        ?>
    </article>
    <?php
}

include_once "includes/footer.php";

?>