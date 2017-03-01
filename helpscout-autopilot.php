<?php

include 'src/HelpScoutApp/DynamicApp.php';

$app = new \HelpScoutApp\DynamicApp('HELPSCOUT-SECRET-KEY-HERE');	// Set HelpScout Secret key
if ($app->isSignatureValid()){
    $customer = $app->getCustomer();
    $user     = $app->getUser();
    $convo    = $app->getConversation();
    $mailbox  = $app->getMailbox();


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api2.autopilothq.com/v1/contact/".$customer->getEmail());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "autopilotapikey: AUTOPILOT-API-KEY-HERE"	// Set Autopilot API key
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($response);
	
	//Set our date format
    $createdAt = explode("T", $obj->created_at);
    $createdAt = date('d M, Y', strtotime(str_replace('-','/', $createdAt[0])));
	
	// My Autopilot custom fields. You may want to remove or adjust these for your case	
    foreach ($obj->custom_fields as $custom_field){
        if($custom_field->kind == "ID"){
            $acc_id = $custom_field->value;
        }
        if($custom_field->kind == "Platform Field"){
            $platform = $custom_field->value;
        }
        if($custom_field->kind == "Fan Score"){
            $fanScore = $custom_field->value;
        }
    }

	
    $profileLink = "https://app.autopilothq.com/#contacts/profile/".$obj->contact_id;
	
	// TIme to output the html for Help Scout sidebar
    $html = array(
        '<h4 class="blue">Company</h4>',
        '<p>'.$obj->Company.'</p>',
        '<h4 class="blue">Phone</h4>',
        '<p>'.$obj->Phone.'</p>',
        '<h4 class="blue">Email</h4>',
        '<p>'.$obj->Email.'</p>',
        '<h4 class="blue">Website</h4>',
        '<p>'.$obj->Website.'</p>',
        '<h4 class="blue">Country</h4>',
        '<p>'.$obj->MailingCountry.'</p>',
        '<h4 class="blue">Date Added to Autopilot</h4>',
        '<p>'.$createdAt.'</p>',
		// My Autopilot custom fields. You may want to remove or adjust these for your case 
        '<h4 class="blue">Stripe ID</h4>',
        '<p>'.$acc_id.'</p>',
        '<h4 class="blue">Platform</h4>',
        '<p>'.$platform.'</p>',
        '<h4 class="blue">Fan Score</h4>',
        '<p>'.$fanScore.'</p>',
		// Useful link to the contact in Autopilot
        '<p><a href="'.$profileLink.'">View in Autopilot</a>'
    );

    echo $app->getResponse($html);

}