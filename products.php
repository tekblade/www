<html><head><title>CRUD Tutorial - Customer's list</title></head><body>
<?php
define('DEBUG', false);											// Debug mode
define('PS_SHOP_PATH', "localhost/");		// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'WD8GDELF9VQVNF5VHFBHEARP1LMJJEV2');	// Auth key (Get it in your Back Office)
require_once('./PSWebServiceLibrary.php');
$GLOBALS['a'] = 'someItem';
$GLOBALS['id'] = 0; 
try
{	
	
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	$opt['resource'] = 'products';
	$xml = $webService->get($opt);
	
	$resources = $xml->products->children();


}
catch (PrestaShopWebserviceException $e)
{
  echo 'Other error: <br />' . $e->getMessage();
}
	
	echo '<h1>Admins panel for updating the quantity of products in magazine</h1>';
	echo '<table>';
	echo '<tr><th>ITEMS</th><th></th><th></th></tr>';
	if(isset($resources)){
	foreach ($resources as $resource){
		$webService = new PrestaShopWebservice("localhost/api/products/".$resource->attributes()->id, PS_WS_AUTH_KEY, DEBUG);
		$opt['resource'] = 'product';
		$xml = $webService->get($opt);
		$detailsResources = $xml->product->children();
		//echo $detailsResources[0]->name->children(). '</br>' ;
		foreach($detailsResources as $key=>$resource){
			if($key=='name'){
				$GLOBALS['a']=$resource;
			}
		}
		foreach($detailsResources as $key=>$resource){
			if($key=='id'){
				$GLOBALS['id']=$resource;
				
			}
		}
		foreach($detailsResources as $key=>$resource){
			if($key=='quantity'){
			echo '<tr><td>' . $GLOBALS['a']->children() . '<td>';
			echo '<form action="update.php" method="post">';
			echo '<td><input type="text" name="'.$key.'" value="' . $resource . '"/></td>';
			echo '<input type="hidden" name="id" value="'.$GLOBALS['id'].'"/>';
			echo '<td><input type="submit" value="update" /></td>';
			echo '</form>';
			echo '</tr>';	
			}
		
		}
	}
	}
	echo '</table>'
?>


</body></html>
