<!DOCTYPE html>
<html>
<head>
    <title>Practical Task</title>
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
        <h1> Subscribes All Items </h1>
        <br>
         <a href="http://localhost:8000/users"> <button type="submit" class="subscribe btn-success"> Display All Item </button>	</a>
        <div id="slide-table">
         <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Contain Name</th>
	                <th>Description</th>
	                <th>Subscribes</th>
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
        ajax: "{{ route('allSubscribe.index') }}",
        columns: [
         	{data: 'containsName', name: 'containsName'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 	 
 });

</script>

</html>