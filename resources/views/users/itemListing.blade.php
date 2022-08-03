<!DOCTYPE html>
<html>
<head>
    <title>All Item Master</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="{{asset('customer/customer.js')}}"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style type="text/css">
    	
   	  #user_data {
		    display: none;
		    width: 62%;
		    margin-left: 16%;
		    margin-top: 6%;
		  }
		  .errors{
		      color: red;
		  };
		  div#formCostomer {
		    background: burlywood;
		  }

		  button.addUser.btn-primary {
		      margin-left: 87%;
		      margin-bottom: 2%;
		  }
		  a#softdelete {
		      width: 54%;
		  }
		  a#edit {
		      width: 42%;
		  }

		  img#filesize {
		      width: 100px;
		      height: 70px;
		      margin-top: 5px;
		  }
		}
    </style>
 
</head>
<body>
    <div class="container">
        <br>
        <h1> User All Items </h1>
        <br>
        <div id="slide-table">
        <a href="displaySubscribe"> <button type="submit" class="subscribe btn-success"> displaySubscribe </button>	</a>
        <button type="submit" class="addUser btn-primary"> Add Item </button>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Contain Name</th>
	                <th>Description</th>
	                <th>RedUrl</th>
	                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    </div>
</body>
    
    <div id="formCostomer">
     
        <form id="user_data" class="form-horizontal" enctype="multipart/form-data">
           {{ csrf_field() }}
           <h2> Items Form </h2>
           <div class="row">
                 <input type="hidden" class="form-control" name="id" id="userId">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Contains Name</label>
                    <input type="text" class="form-control" name="containsName" id="containsName" placeholder="Fill containsName">
                    <span id="contains_name_err" class="errors"> </span>
                </div>

                <div class="col-auto">
                    <label class="visually-hidden" for="name">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Fill Description">
                    <span id="description_err" class="errors"> </span>
                </div>

                <div class="col-auto">
                    <label class="visually-hidden" for="name">Redirect Url</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="Fill Url">
                    <span id="url_err" class="errors"> </span>
                </div>

            </div><br>
            <button type="submit" class="btn btn-primary" name="submit">Add Users</button>
        </form>
    </div>

<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
        {data: 'id', name: 'id'},
         {data: 'containsName', name: 'containsName'},
            {data: 'description', name: 'description'},
            {data: 'redUrl', name: 'redUrl'},

           {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 
    // Add New Customer 
    $(".addUser").on("click",function(e) {
         $("#user_data").show();
    });


    $(".data-table").on("click", ".edit", function () {  
        $("#user_data").show();
        $('#contains_name_err').text('');
        $('#description_err').text('');
        $('#url_err').text('');

        var id = $(this).closest('tr').find('td:eq(0)').text();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: 'editUser',
            type: 'post',
            data: {_token: CSRF_TOKEN,id: id},
            success: function(response){ console.log(response);
                var len = response.length;
                for(var i = 0 ; i < len; i++ ){
                    $('#userId').val(response[i].id);
                    $('#containsName').val(response[i].containsName);
                    $('#description').val(response[i].description);
                    $('#url').val(response[i].redUrl);
                }
            }
        });
    });


    // update Data 


    $('#user_data').submit(function(e) {
        e.preventDefault(); 
        var UserId  = $('#userId').val();
        var contains_name  = $('#containsName').val();
        var description= $('#description').val();
        var url = $('#url').val();
     
        // For Update 
     	if(UserId != ""){
            if(contains_name ==""){
                $('#contains_name_err').text('Field Is Required');
            }if(description ==""){
                $('#description_err').text('Field Is Required');
            }
            if(url ==""){
                $('#url_err').text('Field Is Required');
            }
            else{
                $.ajax({
                    url: 'updateUser',
                    type: 'post',
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                     success: function(response){
                        $('.data-table').DataTable().ajax.reload();
                        $("#user_data").fadeOut();
                        $('#user_data')[0].reset();
                            toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success("Update Customer Data..!!!!");
                    }
                });
            }
        }else{	    
            if(contains_name ==""){
                $('#contains_name_err').text('Field Is Required');
            }if(description ==""){
                $('#description_err').text('Field Is Required');
            }
            if(url ==""){
                $('#url_err').text('Field Is Required');
            }
            else{
                $.ajax({
                    url: 'addItems',
                    type: 'post',
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                     success: function(response){
                        $('.data-table').DataTable().ajax.reload();
                        $("#user_data").fadeOut();
                        $('#user_data')[0].reset();
                        $('#contains_name_err').text('');
                        $('#description_err').text('');
                        $('#url_err').text('');
                            toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success("Add User Data..!!!!");
                    }
                });
            }
        }
    });

// For SoftDelete 

$(".data-table").on("click", ".softdelete", function (e) {  
     var del_id = $(this).closest('tr').find('td:eq(0)').text();
        if (confirm("Are you sure Delete Items?")) {
            $.ajax({
                url: 'delete',
                type: 'get',
                data: {
                    'id':del_id },
                success: function(response){
                    $('.data-table').DataTable().ajax.reload();
                        toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.success("Delete Data Success..!!!!");
                }
            });
        } else{
          toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.warning("Cancle Delete..!!!!");
        }
    });
 });

</script>

</html>