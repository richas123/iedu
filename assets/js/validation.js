$.validator.setDefaults({
    submitHandler: function() {
        return true;
    }
});

$().ready(function() {

    /******* Sign Up *******/

    $("#signUpForm").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email_id: {
                required: true, 
                email: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            }
        },
        messages: {
            first_name: {
                required: "Please enter first name"
            },
            last_name: {
                required: "Please enter last name"
            },
            email_id: {
                required: "Please enter email address", 
                email: "Please enter valid email"
            },
            password: {
                required: "Please enter password"
            }
        }
    });
    
    /******* Sign In *******/

    $("#signInForm").validate({
        rules: {
            email_id: {
                required: true, 
                email: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            }
        },
        messages: {
            email_id: {
                required: "Please enter email address", 
                email: "Please enter valid email"
            },
            password: {
                required: "Please enter password"
            }
        }
    });

    /******* Change Password *******/

    $("#changePass").validate({
        rules: {
            old_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            con_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: "Please enter old password"
            },
            new_password: {
                required: "Please enter New password"
            },
            con_password: {
                required: "Please enter confrim password"
            }
        }
    });

    /******* Change Profile *******/

    $("#profileChange").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            first_name: {
                required: "Please enter First Name"
            },
            last_name: {
                required: "Please enter Last Name"
            }
        }
    });

    /******* Share App With Friends *******/

    $("#sentMail").validate({
        rules: {
            'mail-5': {
                required: true,
                email: true
            },
            'mail-msg': {
                required: true
            }
        },
        messages: {
            'mail-5': {
                required: "Please enter Email",
                email: "Please enter valid email"
            },
            'mail-msg': {
                required: "Please enter Note"
            }
        }
    });

    /******* Forget Pass *******/

    $("#forgetForm").validate({
        rules: {
            email_id: {
                required: true,
                email: true
            }
        },
        messages: {
            email_id: {
                required: "Enter email"
            }
        }
    });

    /******* Reset Password *******/

    $("#resetPass").validate({
        rules: {
            email_id: {
                required: true,
                email: true
            },
            otp: {
                required: true
            },
            new_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            con_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        messages: {
            email: {
                required: "Please enter Email"
            },
            otp: {
                required: "Please enter OTP"
            },
            new_password: {
                required: "Please enter New password"
            },
            con_password: {
                required: "Please enter confrim password"
            }
        }
    });

    /******* For Header Search *******/

    $("#searchCourse").validate({
        rules: {
            'top-search': {
                required: true
            }
        },
        messages: {
            'top-search': {
                required: "Enter value"
            }
        }
    });

    /******* For Header Search *******/

    $("#searchCourse-head").validate({
        rules: {
            'top-search': {
                required: true
            }
        },
        messages: {
            'top-search': {
                required: "Enter value"
            }
        }
    });

    /******* For Course Rate n Review *******/

    $("#courseRate").validate({
        rules: {
            message: {
                required: true
            },
            points: {
                required: true
            }
        },
        messages: {
            points: {
                required: "Please rate"
            }
        }
    });
});