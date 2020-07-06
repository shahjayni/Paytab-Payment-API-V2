<?php

/*
 * Trying to create a pay page
 */

require_once 'paytabs.php';

$pt = new paytabs("johndoe@email.com", "plCSu6xg2MZJzzs5gd2gOxtk1aPIbjXAFzt9G");


$auth = $pt->authentication();

echo "FOLLOWING IS THE AUTHENTICATION RESPONSE: <br />";print_R($auth);echo "<hr>";
if($auth->response_code == 4000) {

    $page = $pt->create_pay_page(array(
        //PayTabs Merchant Account Details
    	//"merchant_email" => "victoria.menown@preecemay.com",						 // PayTabs Merchant Account's email address
        //'merchant_secretKey' => "ii3KZS9YvCTbAX77HIvaZhJb14MhDXeVfiGeaPdFr6R24Y9MGEXGWHRXMDfpBtlQM25XRjDjqulusvh9aeP6VH4Hlj7WNtNzvTwm", // Secret Key can be fount at PayTabs Merchant Dashboard > Mobile Payments > Secret Key
        'merchant_id' => "10021578",
        //'secret_key' => "ii3KZS9YvCTbAX77HIvaZhJb14MhDXeVfiGeaPdFr6R24Y9MGEXGWHRXMDfpBtlQM25XRjDjqulusvh9aeP6VH4Hlj7WNtNzvTwm",
        
    	//Customer's Personal Information
    	'title' => "John Doe", 			// Customer's Name on the invoice
    	'cc_first_name' => "John", 		//This will be prefilled as Credit Card First Name
        'cc_last_name' => "Doe", 		//This will be prefilled as Credit Card Last Name
    	'email' => "customer@email.com",
        'cc_phone_number' => "973",
    	'phone_number' => "33333333",
        
    	//Customer's Billing Address (All fields are mandatory)
    	//When the country is selected as USA or CANADA, the state field should contain a String of 2 characters containing the ISO state code otherwise the payments may be rejected. 
    	//For other countries, the state can be a string of up to 32 characters.
    	'billing_address' => "Juffair, Manama, Bahrain",
        'city' => "Manama",
        'state' => "Capital",
        'postal_code' => "97300",
        'country' => "BHR",
       
        //Customer's Shipping Address (All fields are mandatory)
    	
    	'address_shipping' => "Juffair, Manama, Bahrain",
        'city_shipping' => "Manama",
        'state_shipping' => "Capital",
        'postal_code_shipping' => "97300",
        'country_shipping' => "BHR",
       
        //Product Information
        "products_per_title"=>"Mobile Phone", //Product title of the product. If multiple products then add “||” separator
        'currency' => "BHD",				//Currency of the amount stated. 3 character ISO currency code 
    	"unit_price"=>"10",					//Unit price of the product. If multiple products then add “||” separator.
        'quantity' => "1",					//Quantity of products. If multiple products then add “||” separator
    	'other_charges' => "0",				//Additional charges. e.g.: shipping charges, taxes, VAT, etc.
    	'amount' => "10.00",  				//Amount of the products and other charges, it should be equal to: amount = (sum of all products’ (unit_price * quantity)) + other_charges
    										//This field will be displayed in the invoice as the sub total field

    	'discount'=>"0",					//Discount of the transaction. The Total amount of the invoice will be= amount - discount

    	
    	"msg_lang" => "english",			//Language of the PayPage to be created. Invalid or blank entries will default to English.(Englsh/Arabic)
        
        
        "reference_no" => "1231231",		//Invoice reference number in your system
        "site_url" => "http://localhost", //The requesting website be exactly the same as the website/URL associated with your PayTabs Merchant Account
        'return_url' => "http://localhost.com/Paytab API V2 Examples/index.php",
        "cms_with_version" => "API USING PHP"
    ));

    echo "FOLLOWING IS THE PAGE RESPONSE: <br />";print_r($page);echo "<hr>";
    if($page && $page->response_code == '4012' ) {
        echo '<script type="text/javascript">
               window.location = "'.$page->payment_url.'"
          </script>';
    } else {
        echo 'page creation error';
    }
    /*$result = $pt->verify_payment($page->p_id);
    echo "FOLLOWING IS THE VERIFICATION RESPONSE: <br />";print_r ($result);echo "<hr>";*/
} else {
    echo 'authentication errror';
}
/*$_SESSION['paytabs_api_key'] = $result->api_key;
*/
?>