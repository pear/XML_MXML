<?php

/**
 * Menubar example (from file).
 *
 * @package    XML_MXML
 * @author     Markus Nix <mnix@docuverse.de>
 */

require_once 'XML/MXML.php';
 

try {
    $doc = XML_MXML::loadFile('menubar.xml');
    $doc->validateDocument();
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
