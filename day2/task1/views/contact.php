<html>

<head>
    <title> contact form </title>
</head>

<body>
    <h3> Contact Form </h3>
    <div id="after_submit">
        <?php

        ?>
    </div>
    <form id="contact_form" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

        <div class="row">
            <label class="required" for="name">Your name:</label><br />
            <input id="name" class="input" name="name" type="text" value="<?= remember_variable("name") ?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="email">Your email:</label><br />
            <input id="email" class="input" name="email" type="text" value="<?= remember_variable("email") ?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="message">Your message:</label><br />
            <textarea id="message" class="input" name="message" value="" e rows="7" cols="30"><?= remember_variable("message") ?></textarea><br />

        </div>

        <input id="submit" name="submit" type="submit" value="Send email" />
        <input id="clear" name="clear" type="reset" value="clear form" />

    </form>
</body>

</html>