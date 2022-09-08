@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Admin') }}</div>

                <div class="card-body">
                    <table class="table" id='dataTableList'>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-right">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_model_warning" tabindex="-1" aria-labelledby="delete_model_warning"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger" style='border-radius: 2px;'>
                <h6 class="modal-title m-0 text-white" id="exampleModalDanger1">Delete</h6>
                <a href='javascript:void(0);' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-times text-white fs-3"></i></span>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h5>Are you sure, You want to delete user?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <form name='delete-confirm-frm' method="POST" action="" accept-charset="UTF-8" style="display:inline">
                    <input name="_method" type="hidden" value="DELETE">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm delete_confirm" data-href=''>Delete</button>
                    <input type='hidden' value='' name='delete_url'>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{url('assets/js/module/admins.js')}}"></script>
<script>
    var userListIndex = "{{ route('admin-users.index') }}";
</script>
@endsection