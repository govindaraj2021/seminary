@extends('admin.layouts.main') 
@section('title', 'User Group List') 
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endsection
 
@section('content')

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="{{ route('admin.usergroup.create') }}" class="btn btn-primary">Add New</a >
        </div>
    
            <h2 class="panel-title">User Group List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Permission</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usergroups as $key => $usergroup)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $usergroup->name}}</td>
                            <td><a href="{{ route('admin.usergroup.status', $usergroup->id) }}" ><i class="fa fa-{{ $usergroup->status ? 'check' : 'times'}}"></i></a></td>
            <td>
                <a href="{{ route('admin.usergroup.permission', $usergroup->id) }}"><i class="fa fa-unlock-alt"></i></a></td>
            <td><a href="{{ route('admin.usergroup.edit', $usergroup->id) }}"><i class="fa fa-edit"></i></a></td>
            <td>
                <form action="{{ route('admin.usergroup.destroy', $usergroup->id) }}" method="post">
                    {{ method_field('DELETE') }} {{ csrf_field() }}
                    <button type="submit" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                </form>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
</section>
<div id="deleteModel" class="modal-block mfp-hide">
    <section class="panel">
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>Are you sure you want to delete this user??</p>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <form method="POST" id="delete-form">
                        @method('DELETE') @csrf
                        <button type="submit" class="btn btn-primary modal-confirm">Confirm</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </form>
                </div>
            </div>
        </footer>
    </section>
</div>
@endsection
 
@section('scripts')
<script src="{{ asset('admin/assets/vendor/select2/select2.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
<script>
    (function( $ ) {

        'use strict';

        var datatableInit = function() {
            var $table = $('#datatable-tabletools');

            $table.dataTable();

        };

        $(function() {
            datatableInit();
        });

    }).apply( this, [ jQuery ]);
    $(function() {
        $('.delete-model').on('click', function(){
            var target_id = $(this).data('id');
            var delete_route = '{{ route('admin.usergroup.index') }}'+'/'+target_id;
            var delete_form = $('#delete-form');

            delete_form.attr("action", delete_route);
        });

        $(document).on('click', '.modal-dismiss', function (e) {
            var delete_form = $('#delete-form');
            delete_form.removeAttr("action");
        });
    });

</script>
@endsection