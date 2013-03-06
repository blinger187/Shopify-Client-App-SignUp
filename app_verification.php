<?php
include("shopify.php");
?>
<div style="font-family:'Lucida Console', Monaco, monospace; font-size:8px; width:400px; margin:0px auto; margin-top:25px;">
<?php
	if(isset($_POST['shop_name'])){
		// this process can be automated with cURL
		// next revision will show include this
		
		$shop_name=$_POST['shop_name'];
		$scope="write_products,read_products"; 	// more scope options available @ http://api.shopify.com/authentication.html
		?>
		<div>
          	<strong>Continue</strong>.<br />
			this process can be automated with cURL without the need of submitting another form. This will be added in the next revision.
          </div>    
		<div>
               <form action="https://<?php echo $shop_name; ?>.myshopify.com/admin/oauth/authorize" method="GET">
                    <input type="hidden" name="client_id" value="<?php echo $Shopify->api_key; ?>"/>
                    <input type="hidden" name="scope" value="<?php echo $scope; ?>"/>
                    <input type="submit" value="Continue" />
               </form>
		</div>
<?php
	} else if(isset($_GET['code'])){
	
		$data= array();
		$shop_url=$_GET['shop'];
		$code=$_GET['code'];
		$access_token = $Shopify->getToken($shop_url, $code);
		echo "<br>==============<pre>";
		var_dump($access_token); // take this and store it the access token for your app somewhere.
		echo "<br>==============</pre>";

?>
          <div>
          	<strong>Save this access_token with the shop name for future use.</strong><br />
         </div>    
<?php } else {	?>
		<div>
          	<strong>Add your store name.</strong><br />
               to continue with the app installation process.
         </div>    
          <div>
               <form action="" method="POST">
                    <input type="text" name="shop_name" value=''/>.myshopify.com
                    <input type="submit" value="Continue" />
               </form>
          </div>
<?php
} 
?>
</div>