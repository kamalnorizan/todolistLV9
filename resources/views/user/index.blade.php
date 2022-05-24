@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Roles<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#mdl-addrole">
                    Add Role
                  </button></div>

                <div class="card-body">
                   <table class="table" id="tbl-role">
                       <tr>
                           <td>Role</td>
                           <td>Permissions</td>
                           <td>Action</td>
                       </tr>
                       @foreach ($roles as $role)
                       <tr>
                           <td>{{$role->name}}</td>
                           <td>{{$role->permissions}}</td>
                           <td></td>
                       </tr>
                       @endforeach
                   </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Permissions<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#mdl-addpermission">
                    Add Permission
                  </button></div>

                <div class="card-body">
                   <table class="table" id="tbl-permission">
                       <tr>
                           <td>Permission</td>
                           <td>Action</td>
                       </tr>
                       @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td></td>
                        </tr>
                       @endforeach
                   </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Title</div>

                <div class="card-body">
                   content
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl-addpermission" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="permission">Permission</label>
                  <input type="text" class="form-control" name="permission" id="permission" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button data-dismiss="modal" id="btnAddPermission" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mdl-addrole" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddRole">
                    <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" class="form-control" name="role" id="role" aria-describedby="help-role" placeholder="">
                      <small id="help-role" class="form-text text-muted">Please enter role name</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button data-dismiss="modal" id="btnAddRole" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#btnAddRole').click(function (e) {
                $.ajax({
                    type: "post",
                    url: "{{route('user.storeRole')}}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        role: $('#role').val()
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#mdl-addrole').modal('hide');
                        $('#tbl-role').append(
                            '<tr>'+
                               '<td>'+$('#role').val()+'</td>'+
                               '<td></td>'+
                               '<td>Action</td>'+
                            '</tr>'
                        );

                    }
                });
            });

            $('#btnAddPermission').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{route('user.storePermission')}}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        permission: $('#permission').val()
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#mdl-addpermission').modal('hide');
                        $('#tbl-permission').append(
                            '<tr>'+
                               '<td>'+$('#permission').val()+'</td>'+
                               '<td>Action</td>'+
                            '</tr>'
                        );
                    }
                });
            });
        });
    </script>
@endsection
