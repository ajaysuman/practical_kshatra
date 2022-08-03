<!DOCTYPE html>
<html>
<head>
    <title>Subscribe All Item</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('customer/customer.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style type="text/css">
        button.subscribe.btn-success {
            margin-left: 86%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <br>
        <h1> Show Items With Subscription Button </h1>
        <br>
        <div id="slide-table">
             <a href="http://localhost:8000/users"> <button type="submit" class="subscribe btn-success"> Display All Item </button> </a>
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
    

<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('displaySubscribe.index') }}",
        columns: [
        {data: 'id', name: 'id'},
         {data: 'containsName', name: 'containsName'},
            {data: 'description', name: 'description'},
            {data: 'redUrl', name: 'redUrl'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 	
 	$(".data-table").on("click", ".subscribe", function (e) { 
        e.preventDefault(); 
        var UserId  = $(this).closest('tr').find('td:eq(0)').text();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: 'subscribeUser',
            type: 'post',
            data: {_token: CSRF_TOKEN,id: UserId},
            success: function(response){  
            	toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success("Success..!!!!");
            	 	setTimeout(function(){
 					window.location.replace("http://localhost:8000/users");}, 3000);
 		    }
        });    	
 	});
 });

</script>

</html>