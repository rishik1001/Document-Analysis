<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fileContents = $_POST["fileContents"];
  
  // Process the file contents as needed
  $lines = explode("\n", $fileContents);
  $output = "";
  foreach ($lines as $line){
    $command = "python noun1.py \"".$line."\"";
    $output1 = shell_exec($command);
    $output .= $output1 . " ";
  }
  
  // Return the processed output to the client-side
  echo $output;
}
?>