<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if( !empty( $arResult ) ){?>
	<div class="table-menu">
		<table>
			<tr>
				<?foreach( $arResult as $arItem ){?>
					<td class="<?if( !empty( $arItem["CHILD"] ) ){?>dropdown<?}?> <?if( $arItem["SELECTED"] ){?>active<?}?>">
						<div class="wrap"><a <?if( !empty( $arItem["CHILD"] ) ){?>class="dropdown-toggle"<?}?> href="<?=$arItem["LINK"]?>">
							<?=$arItem["TEXT"]?>
							<?if( !empty( $arItem["CHILD"] ) ){?><i class="fa fa-angle-down"></i>
<?}?>
						</a>
						<?if( !empty( $arItem["CHILD"] ) ){?>
							<ul class="dropdown-menu">
								<?foreach( $arItem["CHILD"] as $arSubItem ){?>
									<li <?=!empty( $arSubItem["CHILD"] ) ? 'class="dropdown-submenu"' : ''?>>
										<a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
										<?if( !empty( $arSubItem["CHILD"] ) ){?>
											<ul class="dropdown-menu">
												<?foreach( $arSubItem["CHILD"] as $arSubSubItem ){?>
													<li><a href="<?=$arSubSubItem["LINK"]?>"><?=$arSubSubItem["TEXT"]?></a></li>
												<?}?>
											</ul>
										<?}?>
									</li>
								<?}?>
							</ul>
						<?}?>
						</div>
					</td>
				<?}?>
			</tr>
		</table>
	</div>
<?}?>

<?if( !empty( $arResult ) ){?>
	<ul class="nav nav-pills responsive-menu" id="mainMenu">
		<?foreach( $arResult as $arItem ){?>
			<li class="<?if( !empty( $arItem["CHILD"] ) ){?>dropdown<?}?> <?if( $arItem["SELECTED"] ){?>active<?}?>">
				<a <?if( !empty( $arItem["CHILD"] ) ){?>class="dropdown-toggle"<?}?> href="<?=$arItem["LINK"]?>">
					<?=$arItem["TEXT"]?>
					<?if( !empty( $arItem["CHILD"] ) ){?><i class="icon icon-angle-down"></i><?}?>
				</a>
				<?if( !empty( $arItem["CHILD"] ) ){?>
					<ul class="dropdown-menu">
						<?foreach( $arItem["CHILD"] as $arSubItem ){?>
							<li <?=!empty( $arSubItem["CHILD"] ) ? 'class="dropdown-submenu"' : ''?>>
								<a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
								<?if( !empty( $arSubItem["CHILD"] ) ){?>
									<ul class="dropdown-menu">
										<?foreach( $arSubItem["CHILD"] as $arSubSubItem ){?>
											<li><a href="<?=$arSubSubItem["LINK"]?>"><?=$arSubSubItem["TEXT"]?></a></li>
										<?}?>
									</ul>
								<?}?>
							</li>
						<?}?>
					</ul>
				<?}?>
			</li>
		<?}?>
	</ul>
<?}?>