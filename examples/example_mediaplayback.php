<?php

/**
 * Media Playback example.
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
    
    $mpb = $doc->createElement('MediaPlayback', array(
        'width'  => 300, 
        'height' => 300, 
        'contentPath' => '../assets/clip.flv', 
        'controllerPolicy' => 'on'
    ));
    
    $app->appendChild($mpb);
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
