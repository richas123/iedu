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
                required: "Enter the First Name"
            },
            last_name: {
                required: "Enter the Last Name"
            },
            email_id: {
                required: "Enter a Valid Email Address", 
                email: "Enter a Valid Email Address"
            },
            password: {
                required: "Enter Password"
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
                required: "Enter a Valid Email Address", 
                email: "Enter a Valid Email Address"
            },
            password: {
                required: "Enter Password"
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
                required: "Current Password"
            },
            new_password: {
                required: "New Password"
            },
            con_password: {
                required: "Re-type New Password"
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
                required: "Enter the First Name"
            },
            last_name: {
                required: "Enter the Last Name"
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
                required: "Enter a Valid Email Address",
                email: "Enter a Valid Email Address"
            },
            'mail-msg': {
                required: "Enter Note"
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
                required: "Enter a Valid Email Address"
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
                required: "Enter a Valid Email Address"
            },
            otp: {
                required: "Enter OTP"
            },
            new_password: {
                required: "New Password"
            },
            con_password: {
                required: "Re-type New Password"
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
                required: "Enter Value for Search"
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
                required: "Enter Value for Search"
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