<?php

    require_once 'database.php';

    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
      
        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $userinfo = [
          'email' => $google_account_info['email'],
          'first_name' => $google_account_info['givenName'],
    'last_name' => $google_account_info['familyName'],
    'gender' => $google_account_info['gender'],
    'full_name' => $google_account_info['name'],
    'picture' => $google_account_info['picture'],
    'verifiedEmail' => $google_account_info['verifiedEmail'],
    'token' => $google_account_info['id'],
        ];
        echo "<script>alert("+$userinfo+");</script>";
        if ($userinfo['email']=='smritiuser@gmail.com'){
            header("Location: add_faculty.php");
        }
}else{

    header("Location: admin_login.php");
}
