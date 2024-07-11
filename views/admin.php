<div class='main'>
    <div class="content">
        <div class="container">
            <div class="image">
                <h2>Admin Login</h2>
                <input style="color: #151313" type="text" id="username" placeholder="Benutzername" required>
                <input style="color: #151313" type="password" id="password" placeholder="Passwort" required>
                <input style="color: #151313" onclick="verify()" type="button"
                       value="Anmelden">
            </div>
        </div>
    </div>
</div>
<script>
    function verify() {

        $.ajax({
            url: "",
            type: "post",
            data: {
                actn: "verify",
                ctrl: "Admin",
                username: $("#username").val(),
                pass: $("#password").val(),
            },
            success: function (response) {
                console.log(response);
            }
        })
    }
</script>