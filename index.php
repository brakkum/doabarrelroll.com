<?php

require 'vendor/autoload.php';
require 'email.php';
require 'api_key.php';

use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;

function getPostIfSet($param)
{
    return isset($_POST[$param]) ? $_POST[$param] : "";
}

if (isset($_POST["form-submit"])) {
        $name        = $_POST["name"];
        $input_email = $_POST["email"];
        $message     = $_POST["message"];

        if (!$name || !$input_email || !$message) {
            $success = false;
            $response = "Please fill out all the fields.";
        } else {

            include_once("email_address.php");
            // send email
            if (!isset($email_address) || !isset($DABR_SENDGRID_API_KEY)) {
                die("email_address or api_key is not set");
            }

            // sendgrid
            $email = new Mail();
            $email->setFrom("dabr@brakke.dev");
            $email->setSubject("New DABR Message");
            $email->addTo($email_address);
            $email->addTo("brakscript@gmail.com");
            $email->addContent("text/plain", get_email($name, $input_email, $message));
            $email->addContent(
                "text/html", get_email($name, $input_email, $message)
            );

            $sendgrid = new SendGrid($DABR_SENDGRID_API_KEY);

            try {
                $response = $sendgrid->send($email);
                if ($response->statusCode() >= 300) {
                    $success = false;
                    $response = "Sorry, something went wrong.";
                } else {
                    $success = true;
                    $response = "Thanks for your message!";
                }
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
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
                                                <input name="name" type="text" class="input" placeholder="Name" value="<?php echo getPostIfSet("name") ?>">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="control">
                                            <label class="label text small">
                                                Email
                                                <input name="email" type="text" class="input" placeholder="Email" value="<?php echo getPostIfSet("email") ?>">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label text small">
                                            Message
                                        </label>
                                        <div class="control">
                                            <textarea name="message" class="textarea"><?php echo getPostIfSet("message") ?></textarea>
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
