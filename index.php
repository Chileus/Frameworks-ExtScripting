<?php


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    buttonClick();
});

function buttonClick()
{
    $(aButton).click(function(){
    getJSON();
    });
}
function getJSON()
{
     $.getJSON("data.php", function(result){
            $.each(result, function(name, value){
                $(aDiv).append(name + ":" + value + "<br/>");
            });
        });
   
}
</script>
</head>
<body>

<button id="aButton">Get JSON data</button>

<div id="aDiv"></div>


    
    </body>
</html>
