<?php
namespace App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Auth;
class Google {

    protected $client;

    protected $service;

    function __construct() {
        /* Get config variables */
        $client_id = env('GOOGLE_CLIENT_ID');
        $service_account_name = env('GOOGLE_ACCOUNT_NAME');
        $key = env('GOOGLE_CLIENT_SECRET');//you can use later
      //  echo  "<pre>"; print_r(Auth::user()); die;
        $this->client = new \Google_Client();
        $this->client->setApplicationName("chat");
        $this->client->setAccessToken(Auth::user()->token);
        $this->client->setScopes(array(
              'https://mail.google.com/',
              'https://www.googleapis.com/auth/gmail.compose',
              'Google_Service_Gmail::GMAIL_READONLY'
          ));
        $this->service = new \Google_Service_Gmail($this->client);
    }

    public function getBooks(){
        $optParams = array('filter' => 'free-ebooks');
        $results = $this->service->volumes->listVolumes('Henry David Thoreau', $optParams);

        dd($results);
    }

    public function contacts(){
        $results  = $this->service->users_labels->listUsersLabels("me");
        dd($results);
    }
}

?>
