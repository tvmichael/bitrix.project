<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
global $USER;
//echo "[".$USER->GetID()."] (".$USER->GetLogin().") ".$USER->GetFullName();
$MY_USER = $USER->GetFullName();
?>

<!-- ASDSA-/personal/index -->

<div class="personal-page-nav">
	<p>
		 В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки. <br>
	</p>
	<p>
	</p>
	 <?if($USER->IsAuthorized()): // Если пользователь авторизован, не выводим форму

//if($USER->IsAdmin()) {echo '<pre>'; print_r($MY_USER); echo '</pre>';} 
?>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<h2>Личная информация</h2>
		<ul class="lsnn">
			<li><a href="profile/">Изменить регистрационные данные</a></li>
		</ul>
		<h2>Заказы</h2>
		<ul class="lsnn">
			<li><a href="order/">Ознакомиться с состоянием заказов</a></li>
			<li><a href="cart/">Посмотреть содержимое корзины</a></li>
			<li><a href="order/?filter_history=Y">Посмотреть историю заказов</a></li>
		</ul>
<div>
		<h2>Подписка</h2>
		<ul class="lsnn">
			<li><a href="/subscribe/">Изменить подписку</a></li>
		</ul>
	</div>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<h2>Мы рады видеть Вас, <?=$MY_USER;?> </h2>
	</div>
	
</div>
 <?else:?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"",
	Array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => ""
	)
);?><?endif;?> &nbsp; &nbsp;<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>