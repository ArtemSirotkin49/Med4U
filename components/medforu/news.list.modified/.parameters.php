<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    $arComponentParameters = [
        "GROUPS" => [],
        "PARAMETERS" => [
            "IBLOCK_ID" => [
                "PARENT" => "BASE",
                "NAME" => "ID инфлоблока",
                "TYPE" => "STRING",
                "MULTIPLE" => "N",
                "DEFAULT" => "2"
            ],
            "PAGE_SIZE" => [
                "PARENT" => "BASE",
                "NAME" => "Количество новостей",
                "TYPE" => "STRING",
                "MULTIPLE" => "N",
                "DEFAULT" => "1"
            ],
            "CACHE_TIME" => [
                "PARENT" => "BASE",
                "NAME" => "Время кэширования",
                "TYPE" => "STRING",
                "MULTIPLE" => "N",
                "DEFAULT" => "3600"
            ]
        ]
    ];
?>