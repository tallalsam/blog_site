@extends('backend.user.layout.main')
@section('content') 
    <div class="content">
       
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="mb-4">Bloggers</h2>
                </div>
                <div class="col-md-6 text-right">
                    <button id="addbtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmodal">Add New</button>
                </div>
            </div>
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal HTML Markup -->
    <div id="addmodal" class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Add Blogger</h1>
                </div>
                <div class="modal-body">
                    <form id="addform" role="form" method="POST" action="">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <div>
                                <input type="name" class="form-control input-lg" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">E-Mail Address</label>
                            <div>
                                <input type="email" class="form-control input-lg" name="email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div>
                                <input type="password" class="form-control input-lg" name="password">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Modal HTML Markup -->
    <div id="editmodal" class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Edit Blogger</h1>
                </div>
                <div class="modal-body">
                    <form id="editform" role="form" method="POST" action="">
                        <input type="hidden" name="_token" value="">
                        <input type="hidden" name="id" id="id_input" value="">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <div>
                                <input type="name" class="form-control input-lg" id="name_input" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">E-Mail Address</label>
                            <div>
                                <input type="email" class="form-control input-lg" id="email_input" name="email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div>
                                <input type="password" class="form-control input-lg" id="pass_input" name="password">
                                <p>Leave Blank If You dont want to change Password</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <div id="delmodal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Are you Sure You want to Delete This Blogger</p>
            <input type="hidden" name="id" id="confirmDelId" value="">

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="confirmDel">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'Accept' : 'application/json',
                    'Authorization' : "Bearer {{$_COOKIE['access_token']}}",
                }
            });
    
            var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            type:"POST",
            ajax: {
              url: "{{ url('api/'.session()->get('role').'/get-bloggers-data')}}",
            //   data: function(data) {data.user_id = user_id, data.from_date = $('#from_date').val(), data.to_date = $('#to_date').val() } ,
              method: 'POST',
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
            });



            $("#addform").submit(function(e) {
                //prevent Default functionality
                e.preventDefault();

                //get the action-url of the form
                var actionurl = "{{ url('api/'.session()->get('role').'/add-blogger')}}";
                //do your own request an handle the results
                $.ajax({
                url: actionurl,
                type: 'post',
                data: $("#addform").serialize(),
                success: function(data) {
                    if(data.error != ''){
                    toastr.error(data.error);
                    }
                    else
                    {
                       $('#addmodal').modal('hide');
                       $('body').removeClass('modal-open');
                       $('.modal-backdrop').remove();
                       table.ajax.reload();

                    }
                }
                });
            });


            $(document).on("click",'.edit',function(){

                var id = $(this).attr('data-id');
                var actionurl = "{{ url('api/'.session()->get('role').'/get-blogger')}}";
                //do your own request an handle the results
                $.ajax({
                url: actionurl,
                type: 'post',
                data: {id:id},
                success: function(data) {
                    if(data.error != ''){
                    toastr.error(data.error);
                    }
                    else
                    {
                        $('#name_input').val(data.user.name);
                        $('#email_input').val(data.user.email);
                        $('#id_input').val(data.user.id);
                        $('#editmodal').modal('show');

                    }
                }
                });
            });


            $("#editform").submit(function(e) {
                //prevent Default functionality
                e.preventDefault();

                //get the action-url of the form
                var actionurl = "{{ url('api/'.session()->get('role').'/update-blogger')}}";
                //do your own request an handle the results
                $.ajax({
                url: actionurl,
                type: 'post',
                data: $("#editform").serialize(),
                success: function(data) {
                    if(data.error != ''){
                    toastr.error(data.error);
                    }
                    else
                    {
                       $('#editmodal').modal('hide');
                       $('body').removeClass('modal-open');
                       $('.modal-backdrop').remove();
                       table.ajax.reload();
                    }
                }
                });
            });


            $(document).on("click",'.delete',function(){
                var id = $(this).attr('data-id');
                $('#confirmDelId').val(id);
                $('#delmodal').modal('show');
            });


            $(document).on("click",'#confirmDel',function(){

                var id = $('#confirmDelId').val();
                var actionurl = "{{ url('api/'.session()->get('role').'/delete-blogger')}}";
                //do your own request an handle the results
                $.ajax({
                url: actionurl,
                type: 'post',
                data: {id:id},
                success: function(data) {
                    if(data.error != ''){
                    toastr.error(data.error);
                    }
                    else
                    {
                        $('#delmodal').modal('hide');
                        table.ajax.reload();
                    }
                }
                });
            });


    });
</script>
@endsection