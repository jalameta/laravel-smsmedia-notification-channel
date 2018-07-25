# SMSMedia Laravel Notification Channel.
---

Add this to your laravel project
```
    composer require globalcipta/laravel-sms-media-channel
```

edit `config/services.php` and add this config.

```
 ...
 
 'smsmedia' => [
     /*
      |--------------------------------------------------------------------------
      | Service URL
      |--------------------------------------------------------------------------
      |
      | Service URL provided by SMS Media
      | 
      */
             
      'base_url' => env('SERVICE_SMSMEDIA_BASE_URL', null),
      
      /*
       |--------------------------------------------------------------------------
       | Sender ID/ Masking
       |--------------------------------------------------------------------------
       |
       | Sender ID or SMS masking for your application
       | 
       */
                   
       'sender_id' => env('SERVICE_SMSMEDIA_SENDER_ID', null),
      
     /*
      |--------------------------------------------------------------------------
      | Authentication method
      |--------------------------------------------------------------------------
      |
      | Authentication method used by sms media client, this could be `auth` or `token`
      | 
      */
       
      'mode' => 'auth',
      
      /*
       |--------------------------------------------------------------------------
       | Credentials
       |--------------------------------------------------------------------------
       |
       | If you're choosing `auth` method then you should supply BOTH username and password,
       | but if you're opting for token method you only have to provide token.
       |
       */

      'credentials' => [
          'username' => env('SERVICE_SMSMEDIA_USERNAME', null),
          'password' => env('SERVICE_SMSMEDIA_PASSWORD', null),
          'token' => env('SERVICE_SMSMEDIA_TOKEN', null)
      ]
  ],
  
 ...
```
