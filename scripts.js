$(document).ready(function () {

    $('#cms-form').validate({
        rules: {
            input_name: 'required',
            input_email: {
                required: true,
                email: true,
            },
            input_number: 'required',
            input_location: 'required'
        },
        messages: {
            input_name: 'This field is required!',
            input_email: 'Please enter a valid email!',
            input_number: 'This field is required',
            input_location: 'This field is required'
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});