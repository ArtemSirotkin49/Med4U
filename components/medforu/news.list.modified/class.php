<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Bitrix\Main\Data\Cache;

class NewsListModified extends CBitrixComponent
{
    public function executeComponent()
    {
        global $APPLICATION;
        Loader::includeModule("iblock");
        CJSCore::Init(['jquery']);
        $this->includeComponentLang("class.php");

        $request = Context::getCurrent()->getRequest();
        if (!empty($request->getPost("PAGE_NUM"))) {
            $objSections = CIBlockSection::GetTreeList(["IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y"], ["ID", "NAME", "CODE"]);
            while ($arSection = $objSections->Fetch()) {
                $this->arResult["SECTIONS"][] = $arSection;
            }

            $objNews = CIBlockElement::GetList(["SORT" => "ASC"], ["IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y"], false, ["nPageSize" => $this->arParams["PAGE_SIZE"], "iNumPage" => $request->getPost("PAGE_NUM")], ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_COMMENT"]);
            while ($arNews = $objNews->Fetch()) {
                $this->arResult["NEWS"][] = $arNews;
            }

            foreach ($this->arResult["SECTIONS"] as $key => $section) {
                foreach ($this->arResult["NEWS"] as $index => $news) {
                    if ($section["ID"] == $news["IBLOCK_SECTION_ID"]) {
                        $this->arResult["SECTIONS"][$key]["NEWS"][] = $news;
                        unset($this->arResult["NEWS"][$index]);
                    }
                }
            }
            unset($this->arResult["NEWS"]);
        } else {
            $cache = Cache::createInstance();
            if ($cache->initCache($this->arParams["CACHE_TIME"], "simple_id"))
            {
                $this->arResult = $cache->getVars();
            } elseif ($cache->startDataCache()) {
                $objSections = CIBlockSection::GetTreeList(["IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y"], ["ID", "NAME", "CODE"]);
                while ($arSection = $objSections->Fetch()) {
                    $this->arResult["SECTIONS"][] = $arSection;
                }

                $objNews = CIBlockElement::GetList(["SORT" => "ASC"], ["IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y"], false, ["nPageSize" => $this->arParams["PAGE_SIZE"], "iNumPage" => "1"], ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_COMMENT"]);
                while ($arNews = $objNews->Fetch()) {
                    $this->arResult["NEWS"][] = $arNews;
                }

                foreach ($this->arResult["SECTIONS"] as $key => $section) {
                    foreach ($this->arResult["NEWS"] as $index => $news) {
                        if ($section["ID"] == $news["IBLOCK_SECTION_ID"]) {
                            $this->arResult["SECTIONS"][$key]["NEWS"][] = $news;
                            unset($this->arResult["NEWS"][$index]);
                        }
                    }
                }
                unset($this->arResult["NEWS"]);
                $cache->endDataCache($this->arResult);
            }
        }
        $this->includeComponentTemplate();
    }
} ?>