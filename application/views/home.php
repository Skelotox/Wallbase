<div class="container">
    <div id="connectedUsername"></div>
    <div class="jumbotron">
        <h1>Bienvenue sur Wallbase</h1>
        <p>
            Wallbase est de site de partage ou il est possible de visioner les plus belles images ou photos.
        </p>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btn-login").click(function () {
            $('#connexion').modal('hide');
            var username = $("#login-username").val();
            var password = $("#login-password").val();
            $.ajax({
                type: "POST",
                url: "<?php base_url(); ?>" + "index.php/HomeController/login",
                dataType: "json",
                data: {Jname: username, Jpassword: password},
                success: function (res) {
                    if (res) {
                        $('#navConnexion').hide();
                        $('#right-nav').append(
                            $('<li>').append(
                                $('<a>').attr('href', '<?php echo base_url() ?>index.php/UserController').append(
                                    $('<span>').attr('id', 'deco').append(res['username'])
                                )));

                        $('#right-nav').append(
                            $('<li>').append(
                                $('<a>').attr('href', '<?php echo base_url(); ?>index.php/HomeController/logout').append(
                                    $('<span>').attr('id', 'deco').append("Deconnexion")
                                )));
                        var html = '<div class="alert alert-success alert-dismissable page-alert">';
                        html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
                        html += 'Bonjour ' + res['username'] + ', vous êtes maintenant connecté';
                        html += '</div>';
                        $(html).hide().prependTo('#connectedUsername').slideDown();

                        $('.page-alert .close').click(function (e) {
                            e.preventDefault();
                            $(this).closest('.page-alert').slideUp();
                        });
                    }
                }
            });
        });
    });
</script>