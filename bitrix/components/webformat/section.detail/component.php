<?php
if(!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)){die();}
if(!CModule::IncludeModule('iblock')){ShowError(GetMessage('IBLOCK_MODULE_NOT_INSTALLED'));return 0;}
if(!CModule::IncludeModule('webformat.sectiondetail')){ShowError(GetMessage('WEBFORMAT_SECTIONDETAIL_NOT_INSTALLED'));return 0;}

if($arParams['IS_SEF'] == 'Y'){ //Get section id or code from SEF enfironment
    $engine = new CComponentEngine($this);
    $sefVars = array();
    $componentPage = $engine->guessComponentPath(
        $arParams['WF_SEF_FOLDER'],
        array($arParams['WF_SECTION_TEMPLATE']),
        $sefVars
    );
    if(isset($sefVars['SECTION_ID'])){
        $arParams['SECTION_ID'] = $sefVars['SECTION_ID'];
    }
    if(isset($sefVars['SECTION_CODE'])){
        $arParams['SECTION_CODE'] = $sefVars['SECTION_CODE'];
    }
}

$com = new WebformatSectionDetail($arParams);
if($com->DisplayTemplate()){
    $arResult = $com->PrepareArResult();
    if($this->StartResultCache()){$this->IncludeComponentTemplate();}

    //Edit panel from the edit mode
        $arTitleOptions = null;
        if($USER->IsAuthorized()){
            if(
                $APPLICATION->GetShowIncludeAreas()
                || $arParams["SET_TITLE"]
                || isset($arResult[$arParams["BROWSER_TITLE"]])
            ){
                $UrlDeleteSectionButton = "";
                if($arResult['section']["IBLOCK_SECTION_ID"] > 0)
                {
                    $rsSection = CIBlockSection::GetList(
                            array(),
                            array("=ID" => $arResult['section']["IBLOCK_SECTION_ID"]),
                            false,
                            array("SECTION_PAGE_URL")
                    );
                    $rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
                    $arSection = $rsSection->GetNext();
                    $UrlDeleteSectionButton = $arSection["SECTION_PAGE_URL"];
                }

                if(empty($UrlDeleteSectionButton))
                {
                    $url_template = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "LIST_PAGE_URL");
                    $arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
                    $arIBlock["IBLOCK_CODE"] = $arIBlock["CODE"];
                    $UrlDeleteSectionButton = CIBlock::ReplaceDetailURL($url_template, $arIBlock, true, false);
                }

                $arReturnUrl = array(
                        "add_section" => (
                                strlen($arParams["SECTION_URL"])?
                                $arParams["SECTION_URL"]:
                                CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")
                        ),
                        "delete_section" => $UrlDeleteSectionButton,
                );
                $arButtons = CIBlock::GetPanelButtons(
                        $arParams["IBLOCK_ID"],
                        0,
                        $arResult['section']["ID"],
                        array("RETURN_URL" =>  $arReturnUrl)
                );

                if($APPLICATION->GetShowIncludeAreas())
                    $this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

                if($arParams["SET_TITLE"] || isset($arResult[$arParams["BROWSER_TITLE"]])){
                    $arTitleOptions = array(
                        'ADMIN_EDIT_LINK' => $arButtons["submenu"]["edit_section"]["ACTION"],
                        'PUBLIC_EDIT_LINK' => $arButtons["edit"]["edit_section"]["ACTION"],
                        'COMPONENT_NAME' => $this->GetName(),
                    );
                }
            }
        }
    //---End---Edit panel from the edit mode
}