<script>
    var captchaToken = null;
    function onSubmit(token) {
        captchaToken = token;

    }
    function validate(event) {
        event.preventDefault();
    }

    function onload() {
        var element = document.getElementById('submit_form');
    }
</script>

<form>
    <div id='recaptcha' class="g-recaptcha"
        data-sitekey= <?php echo env("RECAPTCHA_SITE_KEY") ?>
        data-callback="onSubmit"
        data-size="visible"></div>
</form>

<script>onload();</script>
