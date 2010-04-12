<?php

/**
 * Hello world example.
 *
 * @package    XML_MXML
 * @author     Markus Nix <mnix@docuverse.de>
 */

require_once 'XML/MXML.php';
 

try
{
    $doc = XML_MXML::createDocument();
    $doc->enableValidation(true);
    $app = $doc->createElement('application');
    $doc->addRoot($app);
    
    $lbl = $doc->createElement('Label', array('text' => 'Hello World'));
    $app->appendChild($lbl);

    $lbl = $doc->createElement('Label');
    
    // add attributes with ArrayAccess
    $lbl['text'] = 'Hello World';
    $lbl['fontSize'] = 40;
    
    $app->appendChild($lbl);
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
