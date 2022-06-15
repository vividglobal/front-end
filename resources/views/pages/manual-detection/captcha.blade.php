<script>

    var getToken;
    function onSubmit(token) {
        getToken = token;
    }
    function validate(event) {
        event.preventDefault();
    }

    function onload() {
        var element = document.getElementById('submit_captcha');
        element.onclick = validate;
    }
</script>
    <form>
        <div id='recaptcha' class="g-recaptcha"
            data-sitekey= <?php echo env("RECAPTCHA_SITE_KEY") ?>
            data-callback="onSubmit"
            data-size="visible"></div>
        <div class="btn__check">
            <button id='submit_captcha'>Check</button>
        </div>
    </form>
<script>onload();</script>
