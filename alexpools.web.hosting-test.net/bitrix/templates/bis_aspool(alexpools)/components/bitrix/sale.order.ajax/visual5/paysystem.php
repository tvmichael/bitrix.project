<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2><?=GetMessage("SOA_TEMPL_PAY_SYSTEM")?></h2>

<table>
	<?
	if ($arResult["PAY_FROM_ACCOUNT"]=="Y")
	{
		?>
		<tr>
		<td style="padding:10px 5px 10px 0;">
            <input type="hidden" name="PAY_CURRENT_ACCOUNT" value="N">
            <input type="checkbox" name="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT" value="Y"<?if($arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y") echo " checked=\"checked\"";?> onChange="submitForm()">
		</td>
		<td style="width:100%; padding:10px 0;">
			<?=GetMessage("SOA_TEMPL_PAY_ACCOUNT")?>
            <br /><i style="font-weight:normal;"><?=GetMessage("SOA_TEMPL_PAY_ACCOUNT_TEXT", Array("#MONEY#" => $arResult["CURRENT_BUDGET_FORMATED"]))?></i>
		</td></tr>
		<?
	}
	?>
	<?
$arAllPaySystem = $arResult["PAY_SYSTEM"];
	//$myPaySystem = array();
		foreach($arResult["PAY_SYSTEM"] as $armyPaySystem):
		
			if ( CSite::InGroup( array(8) ) ){
				if ($armyPaySystem["ID"] == 16){
					$arPaySystem = $armyPaySystem;
//if($USER->IsAdmin()) {echo '<pre>'; print_r($arPaySystem); echo '</pre>';}
				}	
			}
			else{
				if ($armyPaySystem["ID"] == 19){
					$arPaySystem = $armyPaySystem;
				}	
			}
		
		
		endforeach;

			//if($USER->IsAdmin()) {echo '<pre>'; print_r($arPaySystem); echo '</pre>';}
				?>
				<tr>
				<td colspan="2">
					<input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arPaySystem["ID"]?>">
					<?=$arPaySystem["NAME"];?>
					<p style="font-weight:normal;">
					<?
					if (strlen($arPaySystem["DESCRIPTION"])>0)
					{
						?>
						<br />
						<?=$arPaySystem["DESCRIPTION"]?>
						<?
					}
					?>
					</p>
				</td>
				</tr>
				<?
			
			
	?>
</table>