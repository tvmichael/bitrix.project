<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CBadgesCheck extends CBitrixComponent
{
    /**
     * Processing parameters unique to badge component.
     *
     * @param array $params       Component parameters.
     * @return array
     */
    public function onPrepareComponentParams($arParams)
    {
        // $params = parent::onPrepareComponentParams($arParams);        
        // Bitrix\Main\Diag\Debug::writeToFile(array('params' => $params),"","/test.one/log.txt");
        return $arParams;
    }

    public function sqr($x)
    {

    }

    
    public function executeComponent(){
        if($this->startResultCache())
        {
            
            $this->arResult = $this->arParams;

            //Bitrix\Main\Diag\Debug::writeToFile(array('result' => $this->arResult),"","/test.one/log.txt");
            $this->includeComponentTemplate();
        }
        return $this->arResult;
    }

}?>