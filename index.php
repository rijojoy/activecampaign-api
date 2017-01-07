<?php
  error_reporting(E_ALL);
  require("vendor/autoload.php");
  use FacebookAds\Api;
  use FacebookAds\Object\AdAccount;
  use FacebookAds\Object\CustomAudience;
  use FacebookAds\Object\Fields\CustomAudienceFields;
  use FacebookAds\Object\Values\CustomAudienceSubtypes;

  /** For Custom Audience Users **/
  use FacebookAds\Object\CustomAudienceMultiKey;
  use FacebookAds\Object\Values\CustomAudienceTypes;
  use FacebookAds\Object\Fields\CustomAudienceMultikeySchemaFields;

  // Initialize a new Session and instantiate an Api object
  Api::init(
    '1796895563897187', // App ID
    'a3c242e4a28b11ff32e0c724bef19769', // App Secret
    'EAAZAiRFnI2WMBAKw8VoKai802coJDPngHXb6gtQ0YlqBJZB7mg7IqpEVuc8On7qsXTibbvZCA59NtTZBMBzaP2wUm4vDuS9ZC4xWnGeqKzmRFcEblOqcPMYaPcLXHn44d3zMCn6d0R6Sm9fL44hYj7yq1tE7Fl0scilZBCHZCCb4wZDZD' // Your user access token
  );
 /*
     // Create Custom Audience Group

  $audience = new CustomAudience(null, 'act_71626298');

  $audience->setData(array(
    CustomAudienceFields::NAME => 'Test',
    CustomAudienceFields::SUBTYPE => CustomAudienceSubtypes::CUSTOM,
    CustomAUdienceFields::DESCRIPTION => 'People who bought from my website',
  ));

$audience->create();

*/

  // Add Users to custom audience
    $customAudienceId = 6082751342528;
    $data = print_r($_GET, 1);
    
    $fd = @fopen("webhooks.log", "a");
    fwrite($fd, $data);
    fclose($fd);
   //$_POST['contact']['email'] = 'rijotest14@test.com'; 
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
  
   $type = isset($_GET['type'])?$_GET['type']:'';
   //$fname = $_POST['contact']['first_name'];
   //$lname = $_POST['contact']['last_name'];
   $email = $_POST['contact']['email'];
   $schema = array(
       // CustomAudienceMultikeySchemaFields::FIRST_NAME,
       // CustomAudienceMultikeySchemaFields::LAST_NAME,
        CustomAudienceMultikeySchemaFields::EMAIL,
      );

   switch($type)
   {
     case "delete":
     $users = array(
                 array($email),
              );

     $audience = new CustomAudienceMultiKey($customAudienceId);

     $audience->removeUsers($users, $schema);
     break;

     default:
     $users = array(
      array($email)
     
      );
                   // $fname, $lname,
     

     $audience = new CustomAudienceMultiKey($customAudienceId);
     $audience->addUsers($users, $schema);


   }
  
   
  }

?>