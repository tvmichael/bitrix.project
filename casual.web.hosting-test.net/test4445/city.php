<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("МІСТА");
?>

<h2>S</h2>


   <?
   $db_vars = CSaleLocation::GetList(
        array(),
        array('REGION_LID' => LANGUAGE_ID, 'CITY_LID' => LANGUAGE_ID),
        false,
        false,
        array('CITY_NAME', 'CITY_NAME_ORIG')
    );   
   while ($vars = $db_vars->Fetch()):
      ?>
      <pre>
        <?print_r($vars);?>
      </pre>
      <?
   endwhile;
   ?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>