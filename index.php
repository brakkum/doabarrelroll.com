<?php

    if (isset($_POST["form-submit"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        if (!$name || !$email || !$message) {
            $success = false;
            $response = "Please fill out all the fields.";
        } else {

            include_once("email.php");
            // send email
            if (!isset($email_address)) {
                die("email_address is not set");
            }
            $to = $email_address;
            $subject = "New DABR Message";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <$email>" . "\r\n";
            $body = "
                <!doctype html>
                    <html>
                    <head>
                        <meta name=\"viewport\" content=\"width=device-width\">
                        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
                        <title>DABR Email</title>
                        <style>
                            @media only screen and (max-width: 620px) {
                                table[class=body] h1 {
                                    font-size: 28px !important;
                                    margin-bottom: 10px !important;
                                }
                                table[class=body] p,
                                table[class=body] ul,
                                table[class=body] ol,
                                table[class=body] td,
                                table[class=body] span,
                                table[class=body] a {
                                    font-size: 16px !important;
                                }
                                table[class=body] .wrapper,
                                table[class=body] .article {
                                    padding: 10px !important;
                                }
                                table[class=body] .content {
                                    padding: 0 !important;
                                }
                                table[class=body] .container {
                                    padding: 0 !important;
                                    width: 100% !important;
                                }
                                table[class=body] .main {
                                    border-left-width: 0 !important;
                                    border-radius: 0 !important;
                                    border-right-width: 0 !important;
                                }
                                table[class=body] .btn table {
                                    width: 100% !important;
                                }
                                table[class=body] .btn a {
                                    width: 100% !important;
                                }
                                table[class=body] .img-responsive {
                                    height: auto !important;
                                    max-width: 100% !important;
                                    width: auto !important;
                                }
                            }
                    
                            /* -------------------------------------
                                PRESERVE THESE STYLES IN THE HEAD
                            ------------------------------------- */
                            @media all {
                                .ExternalClass {
                                    width: 100%;
                                }
                                .ExternalClass,
                                .ExternalClass p,
                                .ExternalClass span,
                                .ExternalClass font,
                                .ExternalClass td,
                                .ExternalClass div {
                                    line-height: 100%;
                                }
                                .apple-link a {
                                    color: inherit !important;
                                    font-family: inherit !important;
                                    font-size: inherit !important;
                                    font-weight: inherit !important;
                                    line-height: inherit !important;
                                    text-decoration: none !important;
                                }
                                #MessageViewBody a {
                                    color: inherit;
                                    text-decoration: none;
                                    font-size: inherit;
                                    font-family: inherit;
                                    font-weight: inherit;
                                    line-height: inherit;
                                }
                                .btn-primary table td:hover {
                                    background-color: #34495e !important;
                                }
                                .btn-primary a:hover {
                                    background-color: #34495e !important;
                                    border-color: #34495e !important;
                                }
                            }
                        </style>
                    </head>
                    <body class=\"\" style=\"background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\">
                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"body\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6; margin-top: 5vh;\">
                        <tr>
                            <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">&nbsp;</td>
                            <td class=\"container\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;\">
                                <div class=\"content\" style=\"box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;\">
                                    <!-- START CENTERED WHITE CONTAINER -->
                                    <span class=\"preheader\" style=\"color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;\">This is preheader text. Some clients will show this text as a preview.</span>
                                    <table class=\"main\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;\">
                                        <!-- START MAIN CONTENT AREA -->
                                        <tr>
                                            <td class=\"wrapper\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;\">
                                                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;\">
                                                    <tr>
                                                        <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">
                                                            <h2>From: $name</h2>
                                                            <h2>Email: $email</h2>
                                                            <p style=\"font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;\">$message</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- END MAIN CONTENT AREA -->
                                    </table>
                                    <!-- END CENTERED WHITE CONTAINER -->
                                </div>
                            </td>
                            <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top;\">&nbsp;</td>
                        </tr>
                    </table>
                    </body>
                </html>
            ";
            mail($to, $subject, $body, $headers);
            $success = true;
            $response = "Thanks for your message!";
        }
    } else {
        $success = false;
        $response = "";
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144567954-8"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-144567954-8');
        </script>
        <meta charset="UTF-8">
        <meta name="description" content="Heroes of the Lylat System! A groove-based VGM band covering deep cuts and mashing them up with popular songs.">
        <meta name="keywords" content="video, game, videogame, band, music, do, a, barrel, roll, do a barrel roll, dabr, DABR, live, performance, sample, star, fox, 64, star fox 64, fox mccloud, peppy hare, slippy toad, falco lombardi, arwing, andross, nintendo 64, super nintendo, playstation">
        <meta name="author" content="Daniel Brakke">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Do A Barrel Roll!</title>
        <meta property="og:site_name" content="Do A Barrel Roll!" />
        <meta property="og:url" content="https://doabarrelroll.com/" />
        <meta property="og:description" content="Heroes of the Lylat System! A groove-based VGM band covering deep cuts and mashing them up with popular songs." />
        <meta property="og:image" content="https://doabarrelroll.com/assets/dabr.jpg" />
        <meta property="og:title" content="Do A Barrel Roll!" />
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,700i&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/main.css" />
    </head>
    <body>
        <div class="background-wrapper">
            <div class="page">
                <header>
                    <div class="dabr-logo">

                    </div>
                </header>
                <section class="social-links-container">
                    <h2 class="text">
                        Find us:
                    </h2>
                    <div class="social-links">
                        <?php
                            $social_links = [
                                "twitter" => "https://twitter.com/DABROfficial",
                                "facebook" => "https://www.facebook.com/DABROfficial",
                                "bandcamp" => "http://dabr.bandcamp.com/",
                                "youtube" => "https://www.youtube.com/doabarrelrollmusic",
                                "twitch" => "https://www.twitch.tv/videogameband",
                                "instagram" => "https://www.instagram.com/dabrofficial/",
                                "spotify" => "https://open.spotify.com/artist/4Up1ybknVBXuIvmAFVnPES"
                            ];

                            foreach ($social_links as $brand => $link) :
                        ?>
                            <div class="social-media-container">
                                <a href="<?php echo $link; ?>" target="_blank">
                                    <i class="fab fa-<?php echo $brand ?> fa-5x"></i>
                                </a>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </section>
                <hr />
                <section class="contact">
                    <div class="contact-section">
                        <?php if ($success) : ?>
                            <h2 class="text centered">
                                <?php echo $response; ?>
                            </h2>
                        <?php else: ?>
                            <h2 class="text">Contact Us:</h2>
                            <h2 style="color: #FFA3A9; font-size: 25px;"><?php echo $response; ?></h2>
                            <div class="contact-form contact-item">
                                <form action="" method="post" class="form ">
                                    <input type="hidden" name="form-submit" />
                                    <div class="field">
                                        <div class="control">
                                            <label class="label text small">
                                                Name
                                                <input name="name" type="text" class="input" placeholder="Name">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="control">
                                            <label class="label text small">
                                                Email
                                                <input name="email" type="text" class="input" placeholder="Email">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label text small">
                                            Message
                                        </label>
                                        <div class="control">
                                            <textarea name="message" class="textarea"></textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="buttons is-pulled-right">
                                            <button class="button">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="contact-section">
                        <div class="picture contact-item">

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>
