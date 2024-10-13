<!-- Displays the footer content -->
<div class="footer">
    <a href="{{ url('/search') }}">Search Page</a> | <a href="{{ url('/legal') }}">Legal Page</a>
    <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
</div>

<!-- Styles the footer content -->
<style>
#footer-container {
    top: 25px;
    position: relative;
}

/* Styles the footer */
.footer {
    background: #f8f9fa;
    height: 100%;
    text-align: center;
    padding: 20px;

}

/* Styles the links in the footer */
a {
    padding: 10px;
    text-decoration: none;
}
</style>