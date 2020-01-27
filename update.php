<html><head><title>CRUD Tutorial - Customer's list</title></head><body>
<?php
define('DEBUG', true);											// Debug mode
define('PS_SHOP_PATH', "localhost");		// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'WD8GDELF9VQVNF5VHFBHEARP1LMJJEV2');	// Auth key (Get it in your Back Office)
require_once('./PSWebServiceLibrary.php');
$webService = new PrestaShopWebservice("localhost/api/products/".$_POST['id'], PS_WS_AUTH_KEY, DEBUG);
$opt = array('resource' => 'product');
$opt['id'] = $_POST ['id'];
$xml = $webService->get( $opt );
$resources = $xml->children()->children();
$resources->quantity=$_POST['quantity'];
$opt = array('resource' => 'product');
$opt['putXml'] = $xml->asXML();
$opt['id'] = $_POST[ 'id' ];
$xml = $webService->edit($opt);

?>



</body></html>