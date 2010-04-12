<?php

/**
 * Menubar example.
 *
 * @package    XML_MXML
 * @author     Markus Nix <mnix@docuverse.de>
 */

require_once 'XML/MXML.php';
 

$script_text = <<<EOF
function menuHandler(event) {
    alert("Label: "+event.menuItem.attributes.label+" Data: "+event.menuItem.attributes.data, "Clicked menu item");
}
EOF;

$menu_structure = array(
    array(
        'name'       => 'menuitem',
        'attributes' => array( 'label' => 'Menu1' ),
        'children'   => array(
            array(
                'name'       => 'menuitem',
                'attributes' => array( 'label' => 'MenuItem 1-A', 'data' => '1A' )
            ),
            array(
                'name'       => 'menuitem',
                'attributes' => array( 'label' => 'MenuItem 1-B', 'data' => '1B' )
            )
        )
    ),
    array(
        'name'       => 'menuitem',
        'attributes' => array( 'label' => 'Menu2' ),
        'children'   => array(
            array(
                'name'       => 'menuitem',
                'attributes' => array( 'label' => 'MenuItem 2-A', 'data' => '2A' )
            ),
            array(
                'name'       => 'menuitem',
                'attributes' => array( 'type' => 'separator' )
            ),            
            array(
                'name'       => 'menuitem',
                'attributes' => array( 'label' => 'MenuItem 2-B', 'data' => '2B' ),
                'children'   => array(
                    array(
                        'name'       => 'menuitem',
                        'attributes' => array( 'label' => 'MenuItem 3-A', 'data' => '3A', type => 'radio', 'groupName' => 'one' )
                    ),
                    array(
                        'name'       => 'menuitem',
                        'attributes' => array( 'label' => 'MenuItem 3-B', 'data' => '3B', type => 'radio', 'groupName' => 'one' )
                    ),
                    array(
                        'name'       => 'menuitem',
                        'attributes' => array( 'label' => 'MenuItem 3-C', 'data' => '3C', type => 'radio', 'groupName' => 'one' )
                    )
                )
            )
        )
    )
);


try
{
    $doc = XML_MXML::createDocument();
    $doc->enableValidation(true);
    $app = $doc->createElement('application');
    $doc->addRoot($app);
    
    $script = $doc->createElement('script');
    $script->setCData($script_text);
    
    $mb  = $doc->createElement('MenuBar', array('width' => 450, 'change' => 'menuHandler(event)'));
    $dp  = $doc->createElement('DataProvider');
    $xml = $doc->createElement('XML');
    $xml->appendStructure($menu_structure);    
    
    $dp->appendChild($xml);
    $mb->appendChild($dp);
    
    $app->appendChild($script);
    $app->appendChild($mb);
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
