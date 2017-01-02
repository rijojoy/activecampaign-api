<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $data = print_r($_POST, 1);
    
    $fd = @fopen("webhooks.log", "a");
    fwrite($fd, $data);
    fclose($fd);
    
  }

?>