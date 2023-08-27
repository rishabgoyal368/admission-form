$(document).ready(function () {
    // state chaneg and get the cities
    $('#state').on('change', function () {
        var stateId = $(this).val();
        $('#city').empty();
        if (stateId !== '') {
            $.ajax({
                url: 'get_cities.php',
                type: 'POST',
                data: { state_id: stateId },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $.each(data.cities, function (key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                }
            });
        }
    });

    //calculate the age
    $('#dob').on('change', function () {
        var dob = new Date($(this).val());
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        $('#age').val(age);
    });
});
