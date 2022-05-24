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
                   <table class="table">
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
                <div class="card-header">Permissions</div>

                <div class="card-body">
                   <table class="table">
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
<!-- Button trigger modal -->


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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnAddRole" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
