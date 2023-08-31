<?php

if(!function_exists('getSettingItem')){
    function getSettingItem(){
        return false;
    }
}

?><!DOCTYPE html>
<html>
    <head>
        <title><?= getSettingItem('ComName'); ?> .: Site Under Maintenance :.</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style type="text/css">
            body { background: #c3c3c3; color: #555; text-align: center; margin-top: 100px; }            
            body { font-family: Arial; }            
            .boxing { border: 1px solid #cdcdcd; background: #FFF; margin: 50px 250px; border-radius: 25px; }
            h1 { font-size: 25pt; color: #950303;  }
            p { font-size: 10pt; color: #555; }
            em { color: #950303; }
        </style>
    </head>
    <body>
        <div class="boxing">
            <h1>.: Site Under Maintenance :.</h1>

            <p>We are currently performing scheduled maintenance on our 
                website to improve your experience.</p>

            <p>During this time, our website will be temporarily unavailable. 
                We apologize for any inconvenience this may cause.</p>

            <p>Rest assured that we are working diligently to bring the site 
                back up as soon as possible. Please check back later.</p>

            <p>If you have any urgent inquiries or need assistance, you can 
                still reach out to us via email at 

                <?= getSettingItem('IncomingEmail'); ?>
            </p>

            <p>Thank you for your understanding and patience.</p>

            <hr/>
            <p>
                <em>Work Started @<?= date('dS M, Y h:iA'); ?>. 
                    It may take between 5 to 10 min only. </em>
            </p>
        </div>
    </body>
</html>