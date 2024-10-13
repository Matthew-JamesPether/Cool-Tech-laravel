<!-- Displays the cookie content -->
<div class="cookie-notice">
    <p>This website uses cookies to ensure you get the best experience on our website.</p>
    <button class="btn btn-primary" onclick="acceptCookies()">Accept</button>
</div>

<!-- A script that displays the cookie content if the user has not selected accept -->
<script>
function acceptCookies() {
    document.querySelector('.cookie-notice').style.display = 'none';
    document.cookie = "cookie_notice_accepted=true; path=/";
}

window.onload = function() {
    if (document.cookie.indexOf('cookie_notice_accepted=true') === -1) {
        document.querySelector('.cookie-notice').style.display = 'block';
    } else {
        document.querySelector('.cookie-notice').style.display = 'none';
    }
}
</script>

<!-- Styles the cookie notice -->
<style>
.cookie-notice {
    position: fixed;
    width: 1245px;
    background: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
    display: none;
    z-index: 1;
}
</style>