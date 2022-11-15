<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult["SECTIONS"])>0):?>
<div class="catalog-section-list">

<script>

$(document).ready(function(){
	$('#wrapper a').click(function() {
	    var tab_id=$(this).attr('id');
	    tabClick(tab_id)
	});
	function tabClick(tab_id) {
	    if (tab_id != $('#wrapper a.active').attr('id') ) {
	        $('#wrapper .tabs').removeClass('active');
	        $('#'+tab_id).addClass('active');
	        $('#con_' + tab_id).addClass('active');
	    }    
	}	
})

</script>

<div id="wrapper"> <b><i>Сортировка:</b>
    <a href="javascript:;" id="tab1" class="tabs active">по типу</a>
    <a href="javascript:;" id="tab2" class="tabs">по производителю</a></i>    

    <div id="con_tab1" class="tabs active">
    
<table width="100%">
	<tr>
		<td>
			<ul>
			<?
			$i=0;
			$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
			foreach($arResult["SECTIONS"] as $arSection):
			
			    if($i==round(count($arResult["SECTIONS"])/2)){
			    	?></ul></td><td><ul><?
			    }
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
				if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
					echo "<ul>";
				elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
					echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
				$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
			?>
				<li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a></li>
			<?$i++;?>	
			<?endforeach?>
			</ul>		
					</td>
				</tr>
			</table>    
    
    </div>
    <div id="con_tab2" class="tabs">
		<table width="100%" border="0">
			<tr>
				<td>
			<ul>
			<?
			$i=0;
			
			foreach($arResult["PRODUCERS"] as $arProducer):
			
			    if($i==round(count($arResult["PRODUCERS"])/2)){
			    	?></ul></td><td><ul><?
			    }
				
			?>
				<li>
					<a href="<?=$arParams["SECTION_URL"]?>search/?section_id=<?=$arResult["SECTION"]["ID"]?>&producerID=<?=$arProducer["PROPERTY_PRODUCER_VALUE"]?>">
						<?=$arProducer["PROPERTY_PRODUCER_NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arProducer["CNT"]?>)<?endif;?>
					</a>
				</li>
			<?$i++;?>	
			<?endforeach?>
			</ul>		
					</td>
				</tr>
			</table>    
    </div>
</div>



</div>
<?endif;?>