<html><head><title>CRUD Tutorial - Update example</title></head><body>
<?php
define('DEBUG', true);
define('PS_SHOP_PATH', 'localhost/api/products/');
define('PS_WS_AUTH_KEY', 'WD8GDELF9VQVNF5VHFBHEARP1LMJJEV2');
require_once('./PSWebServiceLibrary.php');
echo $_POST['id'];
$webService = new PrestaShopWebservice("localhost/api/products/".$_POST['id'], PS_WS_AUTH_KEY, DEBUG);
$opt['resource'] = 'product';
$xml = $webService->get($opt);
$detailsResources = $xml->product->children();
foreach ($detailsResources as $nodeKey => $node) {
    if($nodeKey=='quantity')
		$detailsResources->$nodeKey = $_POST[$nodeKey];
}
?>
</body></html>
