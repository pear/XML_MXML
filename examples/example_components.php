<?php

/**
 * Components example.
 *
 * @package    XML_MXML
 * @author     Markus Nix <mnix@docuverse.de>
 */

require_once 'XML/MXML.php';
 

try
{
    $doc = XML_MXML::createDocument();
    $doc->enableValidation(true);
    $app = $doc->createElement('application', array('width' => 600, 'height' => 400));
    $doc->addRoot($app);
    
    $xml = $doc->createElement('xml', array('id' => 'treeModel', 'source' => '../assets/tree.xml'));
    $app->appendChild($xml);
    
    $tnv = $doc->createElement('tabnavigator', array('widthFlex' => 1, 'heightFlex' => 1));
    
    // DataInput
    $vbox = $doc->createElement('vbox', array('label' => 'DataInput', 'marginLeft' => 8, 'widthFlex' => 1, 'heightFlex' => 1));
    
    $txi  = $doc->createElement('textinput');
    $text = $txi->addText();
    $text->setCData('This is a TextInput');
    $vbox->appendChild($txi);

    $txa  = $doc->createElement('textarea', array('width' => 150, 'height' => 100));
    $text = $txa->addText();
    $text->setCData('This is a TextArea');
    $vbox->appendChild($txa);
    
    $nst  = $doc->createElement('numericstepper', array('minimum' => 2003, 'maximum' => 2010, 'stepSize' => 1, 'value' => 2003, 'width' => 60));
    $vbox->appendChild($nst);

    $chb  = $doc->createElement('checkbox', array('label' => 'HTML'));
    $vbox->appendChild($chb);

    $lbl  = $doc->createElement('label', array('text' => 'What year were women first allowed to compete in the Boston Marathon?'));
    $vbox->appendChild($lbl);
     
    $rdb  = $doc->createElement('radiobutton', array('groupName' => 'year', 'id' => 'option1', 'label' => 1952));
    $vbox->appendChild($rdb);
     
    $rdb  = $doc->createElement('radiobutton', array('groupName' => 'year', 'id' => 'option1', 'label' => 1962));
    $vbox->appendChild($rdb);
      
    $rdb  = $doc->createElement('radiobutton', array('groupName' => 'year', 'id' => 'option1', 'label' => 1972));
    $vbox->appendChild($rdb);

    $btn  = $doc->createElement('button', array('label' => 'Check Answer', 'click' => 'alert(option3.selected? \'Correct Answer\' : \'Wrong Answer\', \'Result\')'));
    $vbox->appendChild($btn);
    
    $tnv->appendChild($vbox);
    
    // Lists
    $vbox = $doc->createElement('vbox', array('label' => 'Lists', 'marginLeft' => 8, 'widthFlex' => 1, 'heightFlex' => 1));

    $script = $doc->createElement('script');
    $script->setCData('var cards = [ {label:"Visa", data:1}, {label:"American Express", data:2}, {label:"Master Card", data:3} ];');
    $vbox->appendChild($script);
    
    $cmbx = $doc->createElement('combobox', array('dataProvider' => '{cards}', 'width' => 200));
    $vbox->appendChild($cmbx);
    
    $mdl  = $doc->createElement('model', array('id' => 'statesModel', 'source' => '../assets/states.xml'));
    $vbox->appendChild($mdl);

    $list = $doc->createElement('list', array('id' => 'source', 'dataProvider' => '{statesModel.state}', 'multipleSelection' => true));
    $vbox->appendChild($list);

    $tnv->appendChild($vbox);
    
    // Dates
    $vbox = $doc->createElement('vbox', array('label' => 'Dates', 'marginLeft' => 8, 'widthFlex' => 1, 'heightFlex' => 1));
    
    $dtf  = $doc->createElement('datefield', array('width' => 100));
    $vbox->appendChild($dtf);
    
    $dtc  = $doc->createElement('datechooser');
    $vbox->appendChild($dtc);             
    
    $tnv->appendChild($vbox);
    
    // Tree
    $vbox = $doc->createElement('vbox', array('label' => 'Tree', 'marginLeft' => 8, 'widthFlex' => 1, 'heightFlex' => 1));
    
    $tree = $doc->createElement('tree', array('dataProvider' => '{treeModel}', 'widthFlex' => 1, 'heightFlex' => 1));
    $vbox->appendChild($tree);
    
    $tnv->appendChild($vbox);
    
    // Data Grid
    $vbox = $doc->createElement('vbox', array('label' => 'Data Grid', 'marginLeft' => 8, 'widthFlex' => 1, 'heightFlex' => 1));
    
    $mdl  = $doc->createElement('model', array('id' => 'employeeModel', 'source' => '../assets/employees.xml') );
    $vbox->appendChild($mdl);
    
    $dgd  = $doc->createElement('datagrid', array('height' => 300, 'widthFlex' => 1, 'heightFlex' => 1, 'dataProvider' => '{employeeModel.employee}'));
    $vbox->appendChild($dgd);
    
    $tnv->appendChild($vbox);
    
    // Navigators
    $vbox = $doc->createElement('vbox', array('label' => 'Navigators', 'marginLeft' => 8, 'widthFlex' => 1, 'heightFlex' => 1));
    
    $lbl  = $doc->createElement('link', array('label' => 'About Macromedia', 'click' => 'getUrl("http://www.macromedia.com", "_blank")'));
    $vbox->appendChild($lbl);
    
    $acrd = $doc->createElement('accordion', array('heightFlex' => 1));
    $acrd->appendStructure(array(
        array(
            'name'       => 'canvas',
            'attributes' => array('label' => 'Address')
        ),
        array(
            'name'       => 'canvas',
            'attributes' => array('label' => 'Shipping Method')
        ),
        array(
            'name'       => 'canvas',
            'attributes' => array('label' => 'Payment Method')
        )
    ));
        
    $vbox->appendChild($acrd);
    $tnv->appendChild($vbox);
    $app->appendChild($tnv);
} catch (Exception $e) {
    die($e->getMessage());    
}


if ($_GET['mode'] == 'source') {
    highlight_file( __FILE__ );
} else if ($_GET['mode'] == 'dump') {
    echo "<pre>";
    echo $doc->dump();
    echo "</pre>";
} else {
    $doc->send();
}

?>
