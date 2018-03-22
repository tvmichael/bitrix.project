<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Mask");
?>


<script src="dist/inputmask/phone-codes/phone.js"></script>

<form>
  <div>
    <label for="phone">Phone</label>
    <!-- or set via JS -->
    <input id="phone" type="text" />
  </div>
</form>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>