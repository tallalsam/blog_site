@extends('backend.user.layout.main')
@section('content') 
    <div class="content">
       
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="mb-4">Blogs</h2>
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
                        <th>Blogger</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@php
    $user = session()->get('user');
@endphp

    <!-- Modal HTML Markup -->
    <div id="addmodal" class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Add Blog</h1>
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

                        @if(session()->get('role') == 'blogger')
                            <input type="hidden" class="form-control input-lg" name="blogger_id" value="{{$user['id']}}">
                        @else
                            <div class="form-group">
                                <label class="control-label">Blogger</label>
                                <div>
                                    <select class="form-control sec" id="add_blogger_select" name="blogger_id">
                                        <option value="" disabled>Select Blogger</option>
                                    </select>
                                </div>
                            </div>

                        @endif
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div>
                                    <textarea class="form-control input-lg" name="description" rows="4" cols="50">
                                    </textarea>
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
                    <h1 class="modal-title">Edit Blog</h1>
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
                        
                        @if(session()->get('role') == 'blogger')
                            <input type="hidden" class="form-control input-lg" id="blogger_id_input" name="blogger_id" value="{{$user['id']}}">
                        @else
                            <div class="form-group">
                                <label class="control-label">Blogger</label>
                                <div>
                                    <select class="form-control sec" id="blogger_select" name="blogger_id">
                                        <option value="" disabled>Select Blogger</option>
                                    </select>
                                </div>
                            </div>

                        @endif
                        

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div>
                                
                                <textarea class="form-control input-lg" name="description" id="description_input"  rows="4" cols="50">
                            </textarea>
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
            <p>Are you Sure You want to Delete This Blog</p>
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

            var id = null;
            @if(session()->get('role') != 'blogger')
                $.ajax({
                    url: "{{ url('api/'.session()->get('role').'/get-all-bloggers')}}",                      
                    type: 'POST',                                  
                    data: {
                    },
                    success: function(response){    // response contains json object in it
                        var data = response.user;

                        var options = '';
                        for(var i=0;i<data.length; i++)
                        {
                            options += "<option value='"+data[i].id+"'> '"+data[i].name+ "'</option>";              
                        }

                        $("#blogger_select").html(options);    // It will put the dynamic <option> set into the dropdown
                        $("#add_blogger_select").html(options);    // It will put the dynamic <option> set into the dropdown
                    }
                });
                @else

                id = "{{$user['id']}}";
            @endif


    
            var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            type:"POST",
            ajax: {
              url: "{{ url('api/'.session()->get('role').'/get-blogs-data')}}",
              data: function(data) {data.id = id} ,
              method: 'POST',
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'blogger', name: 'blogger'},
                {data: 'description', name: 'description'},
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
                var actionurl = "{{ url('api/'.session()->get('role').'/add-blog')}}";
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
                var actionurl = "{{ url('api/'.session()->get('role').'/get-blog')}}";
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
                        $('#description_input').val(data.user.description);
                        $('#id_input').val(data.user.id);
                        @if(session()->get('role') == 'blogger')
                            $('#blogger_id_input').val(data.user.blogger_id);
                        @else
                            $("#blogger_select option[value='"+data.user.blogger_id+"']").prop('selected', true);

                        @endif
                        $('#editmodal').modal('show');

                    }
                }
                });
            });


            $("#editform").submit(function(e) {
                //prevent Default functionality
                e.preventDefault();

                //get the action-url of the form
                var actionurl = "{{ url('api/'.session()->get('role').'/update-blog')}}";
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
                var actionurl = "{{ url('api/'.session()->get('role').'/delete-blog')}}";
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