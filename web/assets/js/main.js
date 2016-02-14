/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {
    
    //subscribe form validation
    
    $('#subscribe_form').validate({
        rules: {
            'form[login]': {
                minlength: 6,
                remote: {
                    url: "/subscribe/check/",
                    type: "post",
                    data: {
                        login: function () {
                            return $("#form_login").val();
                        }
                    },
                    dataFilter: function (response) {
                        var json = JSON.parse(response);
                        if (json.status == "200") {
                            $('#form_login').css('border', "#6d6 solid 2px");
                            $('.checkLogin').remove();
                            return true;
                        } else {
                            $('#form_login').css('border-color', "#ff0000");
                            $('#form_login').after("<span class='checkLogin'> Utilisateur deja existant</span>");
                            return false
                        }

                    }
                }
            },
            'form[password]': {
                required: true,
                minlength: 6
            },
            'form[password_verif]': {
                equalTo: "#form_password",
            },
            'form[email]': {
                required: true,
                email: true,
            },
        }


    });
    
    //Login form

    $('#loginForm').validate({
        rules: {
            'loginModal': {
                required: true,
            },
            'passwordModal': {
                required: true,
            }
        }
    });

    $('#login').click(function (e) {
        e.preventDefault();

        $.ajax({
            url: "/subscribe/login/",
            type: "POST",
            data: {login: $('#loginModal').val(),
                password: $('#passwordModal').val()
            },
            success: function (response) {
                var json = JSON.parse(response);
                if (json.status == 200) {
                    $('#myModal').modal('toggle');
                    location.reload();
                } else {
                    $('div.login-error').show();
                }
            }
        });
    });

    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('div.login-error').hide();
    });


    //Sorting   

    $('.toggleSort').change(function () {
        $('#sortForm').submit();
    });
});

