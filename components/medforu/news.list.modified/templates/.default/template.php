<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
function dump($arr, $var_dump = false)
{
    echo "<pre style='background: #222;color: #54ff00;padding: 20px;'>";
    if ($var_dump){
        var_dump($arr);
    }
    else{
        print_r($arr);
    }
    echo "</pre>";
}
?>

<div id="container">
    <?php foreach ($arResult["SECTIONS"] as $key => $section) {
        if (!empty($section["NEWS"])) { ?>
            <div class="child">
<!--                <h1>--><?//= $section["NAME"] ?><!--</h1>-->
                <?php foreach ($section["NEWS"] as $index => $news) { ?>
                    <h2><?= $news["NAME"] ?></h2>
                    <h3><?= $news["PREVIEW_TEXT"] ?></h3>
                    <h4><?= $news["PROPERTY_COMMENT_VALUE"] ?></h4>
                <?php } ?>
                <hr>
            </div>
        <?php } ?>
    <?php } ?>
    <button id="showMoreBtn">Показать ещё</button>
</div>


