<?php
$line = "John Smith is a software engineer at Microsoft, which is located in Redmond, Washington.";
$command = "python noun1.py \"".$line."\"";
$output = shell_exec($command);
echo $output;
?>