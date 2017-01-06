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
    'EAAZAiRFnI2WMBAJOKyEmn5w17ZAxqWa91n8fSAY4ZCqnZAH0jZBKOBrbZBplPHuncvLgmTSPmBeOBnvjONgAIVj5jNVD6WeZAVM1TeUuyeMOXzKucmCFKZBqeoJaZCmXF9Qb2QrIaeTBZAQN9cB29bllbXMJG3tTZARbWfhhgu7lo4FYAZDZD' // Your user access token
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
    
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
  
   $type = isset($_GET['type'])?$_GET['type']:'';
   //$fname = $_POST['contact']['first_name'];
   //$lname = $_POST['contact']['last_name'];
   $email = $_POST['contact']['email'];

   switch($type)
   {
     case "delete":
     $emails = array(
                $email,
              );

     $audience = new CustomAudience($customAudienceId);

     $audience->removeUsers($emails, CustomAudienceTypes::EMAIL);
     break;
     
     default:
     $users = array(
      array($email)
     
      );
                   // $fname, $lname,
      $schema = array(
       // CustomAudienceMultikeySchemaFields::FIRST_NAME,
       // CustomAudienceMultikeySchemaFields::LAST_NAME,
        CustomAudienceMultikeySchemaFields::EMAIL,
      );

     $audience = new CustomAudienceMultiKey($customAudienceId);
     $audience->addUsers($users, $schema);


   }
  
   
  }

?>