<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CBadgesCheck extends CBitrixComponent
{
    private $arrayResult = [];

    /**
     * Processing parameters unique to badge component.
     *
     * @param array $params       Component parameters.
     * @return array
     */
    public function onPrepareComponentParams($arParams)
    {
        // $params = parent::onPrepareComponentParams($arParams);        
        //Bitrix\Main\Diag\Debug::writeToFile(array('class' => $params),"","/test.one/log.txt");
        //$this->arResult['BADGE_ARRAY'] = $this->arParams['BADGE_ARRAY'];

        $this->arrayResult = $arParams['BADGE_ARRAY'];
        $arParams['BADGE_ARRAY'] = [];
        return $arParams;
    }

    public function sqr($x)
    {

    }

    
    public function executeComponent(){
        if($this->startResultCache())
        {
            
            //$this->arResult = $this->arParams;
            $this->arResult = $this->arRemember;
            

            //Bitrix\Main\Diag\Debug::writeToFile(array('result' => $this->arResult),"","/test.one/log.txt");
            $this->includeComponentTemplate();
        }
        //return $this->arResult;
    }

}?>