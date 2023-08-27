$(document).ready(function () {
    $('#course').on('change', function () {
        var selectedCourse = $(this).val();
        $('#courseDetails').empty();
        $.ajax({
            url: 'get_course_details.php',
            type: 'POST',
            data: { course: selectedCourse },
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('#courseDetails').html(
                        '<thead>< tr ><th>Course Name</th><th>Duration</th><th>Fee</th></tr ></thead ><tbody></tbody>' +
                        '<tr>' +
                        '<td>' + data.course_name + '</td>' +
                        '<td>' + data.duration + '</td>' +
                        '<td>' + data.fee + '</td>' +
                        '</tr>'
                    );
                    $('#courseModal').modal('show');
                } else {
                    alert('Failed to fetch course details.');
                }
            }
        });
    });

    $('#selectCourse').on('click', function () {
        $('#courseModal').modal('hide'); // Close the modal
    });
});

$(document).ready(function () {
    $('#data-table').DataTable({
        "ajax": "get_data.php",
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "father_name" },
            { "data": "mother_name" },
            { "data": "state_name" },
            { "data": "city_name" },
            {
                // action button 
                "data": null,
                "render": function (data, type, full, meta) {
                    return `
                        <div class="btn-group" role="group" aria-label="Actions">
                            <span class="mr-4" onclick="viewAction(${data.id})"><i class="fa fa-eye"></i> </span>
                            <span class="mr-4" style="color:red" onclick="deleteAction(${data.id})"><i class="fa fa-trash"></i> </span>
                        </div>
                    `;
                }
            }
        ],
        "paging": true,
        "columnDefs": [
            { "targets": -1, "orderable": false }
        ]
    });
});
function viewAction(id) {
    $.ajax({
        url: 'crud/admissions/view_record.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            $('#courseDetails').html(
                '<thead>< tr ><th>Name</th><th>Email</th><th>Course</th></tr ></thead ><tbody></tbody>' +
                '<tr>' +
                '<td>' + data.name + '</td>' +
                '<td>' + data.email + '</td>' +
                '<td>' + data.course + '</td>' +
                '</tr>'
            );
            $('#courseModal').modal('show');

        }
    });
}


function deleteAction(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
            url: 'crud/admissions/delete_record.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                $('#message').html('<div class= "alert alert-danger" > ' + data.message + '</div>');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });
    }

}


