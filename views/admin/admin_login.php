<div class='main'>
    <div class="content">
        <div class="container">
            <a class="HomeButton" href='http://<?= $config->domain; ?>'>
                <img class='homeButton' src='http://<?= $config->domain; ?>/img/icons/home.svg'/>
            </a>
        </div>
    </div>
    <div id="loginContainer" class="content">
        <div class="container">
            <h2>Admin Login</h2>
            <input class="submitOnEnter" style="color: #151313" type="text" id="username" placeholder="Benutzername"
                   required>
            <input class="submitOnEnter" style="color: #151313" type="password" id="password" placeholder="Passwort"
                   required>
            <input style="color: #151313" onclick="verify()" type="button" value="Anmelden">
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
                ctrl: "Admin/Admin",
                username: $("#username").val(),
                pass: $("#password").val(),
            },
            success: function (response) {
                var verifyresponse = JSON.parse(response);
                if (verifyresponse["verify"] == false) {
                    $("#loginContainer").append('<div class="errorContainer" style="background-color:firebrick; margin-top:3px; padding: 1em">' +
                        ' <h2 class="errorMessage">Wrong Password</h2>' +
                        '</div>');
                    $(".errorContainer").delay(2000).fadeOut(3000, function () {
                        this.remove()
                    });
                } else {
                    submitMainForm("Admin/Admin_home", "render")
                }
            }
        })
    }

    $(".submitOnEnter").on("keyup", function (event) {
        if (event.which === 13) {
            verify();
        }
    });
</script>