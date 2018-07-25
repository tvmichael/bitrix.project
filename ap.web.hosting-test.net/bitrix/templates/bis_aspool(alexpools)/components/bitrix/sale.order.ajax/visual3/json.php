<?

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

//$arFilter['email'] = htmlspecialchars($_GET['email']);
$arFilter['email'] = htmlspecialchars($request->getQuery("email"));


$arPropsForGetListForOferL["SELECT"] = array("email");

$rsUsers = CUser::GetList(($by=""), ($order=""), $arFilter, $arPropsForGetListForOferL); // выбираем пользователей

$regRequest = array();
if ($rsUsers->SelectedRowsCount() > 0) {
    while($rsUsersa = $rsUsers->Fetch()) {        
        // echo '<pre>'; print_r($rsUsersa); echo '</pre>';
        if ($rsUsersa["EMAIL"] == $arFilter['email'] ) {
            $regRequest['Login'] = $rsUsersa["LOGIN"];
            //$regRequest['Name'] = $rsUsersa["NAME"];
            //$regRequest['LastName'] = $rsUsersa["LAST_NAME"];
            //$regRequest['Email'] = $rsUsersa["EMAIL"];
            $regRequest['Check'] = 'true';
            break;
        };
    };
} else {
   $regRequest['Email'] = 'false';
};
echo json_encode($regRequest, JSON_UNESCAPED_UNICODE);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
/**/
?>





<?
  // Variant 2.
  // Підгрузка форми авторизації
  /*  
  require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
  if($USER->IsAuthorized()) exit();

  $arFilter['email'] = htmlspecialchars($_GET['email']);

  $arPropsForGetListForOferL["SELECT"] = array("email");

  $rsUsers = CUser::GetList(($by=""), ($order=""), $arFilter, $arPropsForGetListForOferL); // выбираем пользователей

  if ($rsUsers->SelectedRowsCount() > 0) {
     while($rsUsersa = $rsUsers->Fetch()) {
        // print_r($rsUsersa);
        if ($rsUsersa["EMAIL"] == $arFilter['email'] ) {
           $regMail = true;
           break;
        };
     };
  } else {
     $regMail = false;
  };

  if ($regMail) {
      $APPLICATION->IncludeComponent("bitrix:system.auth.form", "mv.auth.form.order", 
        Array(
          "REGISTER_URL" => "/auth/",
          AUTH_URL
        ) 
      );
  };
  /**/
?>

<? 
// Variant 3.
/*
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php'); 

$arFilter['EMAIL'] = htmlspecialchars($_POST['mail']); 
$regMail = ""; 

$dbUsers = CUser::GetList($sort_by, $sort_ord, $arFilter); 
while ($arUser = $dbUsers->Fetch()) 
{ 
  $usermail = $arUser["EMAIL"]; 
} 

if($usermail == $arFilter['EMAIL']){ 
$regMail = "Y";	
}else{ 
$regMail = "N"; 
} 

echo $regMail; 

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php'); 
/**/
?> 
