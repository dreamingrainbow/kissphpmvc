<?php
namespace Modules\Primary\Controllers;
class Pages extends \Library\Controller
{
    public function home()
    {
        //$this->setNoRenderLayout();
        //$this->setNoRenderView();
        $this->test = 'something';
        //echo $this->getPartial('partial', 'Primary', array('mild'=>'else', 'test' => 'another' ));
    }
    
    public function another()
    {
        $this->setNoRenderView();
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo $this->getRequest()->getParam('segmentName');
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        
        
    }
}

