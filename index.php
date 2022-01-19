<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap Modal crud</title>
    <!--css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: skyblue;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>

<body>




    </button>

    <!-- Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="completename" class="form-label">Name</label>
                        <input type="email" class="form-control" id="completename">

                    </div>
                    <div class="mb-3">
                        <label for="completemobile" class="form-label">Mobile</label>
                        <input type="email" class="form-control" id="completemobile">
                    </div>
                    <div class="mb-3">
                        <label for="completeemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="completeemail">
                    </div>
                    <div class="mb-3">
                        <label for="completeplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="completeplace">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal" onclick="adduser()">Submit</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--update modal-->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="updatename" class="form-label">Name</label>
                        <input type="email" class="form-control" id="updatename">

                    </div>
                    <div class="mb-3">
                        <label for="updatemobile" class="form-label">Mobile</label>
                        <input type="email" class="form-control" id="updatemobile">
                    </div>
                    <div class="mb-3">
                        <label for="updateemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateemail">
                    </div>
                    <div class="mb-3">
                        <label for="updateplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="updateplace">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal" onclick="updateDetails()">Update</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <h1 class="text-center">PHP CURD OPERATION CREATED BY SWARAJ</h1>

        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#completeModal">
            Add user
        </button>
        <div id="dispalyDataTable"></div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        //jquery for display data after refresh
        $(document).ready(function() {
            displayData();
        })
        //jquery end

        //displa function
        function displayData() {
            var displayData = "true";
            $.ajax({
                url: "display.php",
                type: 'post',
                data: {
                    displaySend: displayData
                },
                success: function(data, status) {
                    $('#dispalyDataTable').html(data);

                }
            })
        }

        function adduser() {
            var nameAdd = $('#completename').val()
            var mobileAdd = $('#completemobile').val()
            var emailAdd = $('#completeemail').val()
            var placeAdd = $('#completeplace').val()

            $.ajax({
                url: "insert.php",
                type: 'post',
                data: {
                    nameSend: nameAdd,
                    mobileSend: mobileAdd,
                    emailSend: emailAdd,
                    placeSend: placeAdd
                },
                success: function(data, status) {
                    //function to display data
                    // console.log(status);
                    // $('#completeModal').modal('hide');

                    displayData();

                }
            })
        }
        //Delete record
        function DeleteUser(deleteid) {
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    deleteSend: deleteid
                },


                success: function(data, status) {
                    displayData();

                }
            });
        }
        //update function
        function GetDetails(updateid) {
            $('#hiddendata').val(updateid);
            $.post("update.php", {
                updateid: updateid
            }, function(data, status) {
                var userid = JSON.parse(data);
                $('#updatename').val(userid.name);
                $('#updatemobile').val(userid.mobile);
                $('#updateemail').val(userid.email);
                $('#updateplace').val(userid.place);
            });
            $('#updateModal').modal("show");


        }
        //update event function
        function updateDetails() {
            var updatename = $('#updatename').val();
            var updatemobile = $('#updatemobile').val();
            var updateemail = $('#updateemail').val();
            var updateplace = $('#updateplace').val();

            var hiddendata = $('#hiddendata').val();

            $.post("update.php", {
                updatename: updatename,
                updatemobile: updatemobile,
                updateemail: updateemail,
                updateplace: updateplace,
                hiddendata: hiddendata

            }, function(data, status) {
                $('#updateModal').modal('hide');
                displayData();

            });

        }
    </script>
</body>

</html>