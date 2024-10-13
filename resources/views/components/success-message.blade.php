<!-- Styles a alert success message if the message session occurs-->
@if(session('message'))
<div class="alert-success">
    <!-- Displays the given message -->
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" onclick="closeButton()">
        &times;
    </button>
</div>

@endif

<script>
//A function to close the message if the button is selected
function closeButton() {
    document.querySelector('.alert-success').style.display = 'none';
}
</script>

<style>
/* Styles the alert message */
.alert-success {
    border-style: solid;
    border-radius: 20px;
    background-color: lightgreen;
    text-align: center;
}

/* Styles the close button */
.close {
    background-color: lightcoral;
    border-color: red;
    border-radius: 5px;
    opacity: 0.75;
}
</style>