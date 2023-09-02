<!DOCTYPE html>
<html lang="en">

        <head>
                <meta charset="UTF-8">

                <?php
                        $nonce = base64_encode(random_bytes(16));
                        header("Content-Security-Policy: default-src 'self' www.youtube.com play.google.com cdnjs.cloudflare.com;font-src 'self' cdnjs.cloudflare.com fonts.googleapis.com;script-src 'strict-dynamic' 'nonce-$nonce' cdnjs.cloudflare.com; style-src 'strict-dynamic' 'nonce-$nonce' cdnjs.cloudflare.com fonts.gstatic.com; base-uri 'self'; object-src 'none'; frame-ancestors 'none'; frame-src 'self' www.youtube.com");
                        header("Permissions-Policy: accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()");
                        $pin1 = hash("sha256", "test");
                        $pin2 = hash("sha256", "tost");
                        header("Public-Key-Pins: pin-sha256=\"$pin1\"; pin-sha256=\"$pin2\"; max-age=31536000; includeSubDomains");
                        header("X-Frame-Options: SAMEORIGIN");
                        header("X-XSS-Protection: 1; mode=block");
                        header("X-Content-Type-Options: nosniff");
                        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
                ?>
                <meta name="viewport" content="width=device-width, initial-scale=1">

              <link rel="stylesheet" nonce="<?php echo $nonce ?>" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
             

        <title>CSP TEST</title>

        </head>


          <h1 style="font-family:'Reem Kufi',san-serif"> چونتنت سچوريتي ڤوليچي /  داسر كسلامتن كندوڠن </h1>

          <h2>Laman ini digunakan untuk menguji Content Security Policy/ Dasar Keselematan Kandungan</h2>

          <i class="fa-brands fa-youtube"></i> <br/>

<!--
<iframe width="560" height="315" src="https://www.youtube.com/embed/m1KM_DxQXWM?si=xVSUJysB-lNmUUMe&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->

          <br/>

          <i class="fa-solid fa-tower-cell"></i><br/>


       </body>
</html>
          
