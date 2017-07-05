<?php
namespace Modules\HelloWorld\Controllers;
use \Library\Controller;
class HelloWorld extends Controller
{
    public function home()
    {

        $this->setNoRenderView();
        $this->test = 'something';

        echo $this->test;
        echo $this->getRequest()->getParam('var1');
        //echo $this->getPartial('partial', 'Primary', array('mild'=>'else', 'test' => 'another' ));
    }
}
?>