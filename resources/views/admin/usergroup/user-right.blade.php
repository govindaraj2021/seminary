@extends('admin.layouts.main') 
@section('title', 'UserGroup Permission') 
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a class="mb-xs mt-xs mr-xs btn btn-primary" href="{{ route('admin.usergroup.index') }}">List All</a>
                </div>
                <div class="panel-actions">

                    {{-- <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a> --}}
                </div>

                <h2 class="panel-title">UserGroup Permission</h2>
            </header>
            <div class="table-responsive">
                @if(!empty($menus[0]))
                <form action="{{ route('admin.permission.update', $group_id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <table class="table table-hover mb-none">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Modules</th>
                                    <th>Modules Right</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $key => $menu)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>
                                        <input type="checkbox" name="menu_id[]" value="{{ $menu->id }}" @foreach($user_rights as $user_right) @if($user_right->id
                                        === $menu->id) checked @break @endif @endforeach />
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <footer class="panel-footer">
                        <button type="submit" class="btn btn-primary">Submit </button>
                    </footer>
                </form>
                @else
                <div class="panel-body">
                    <h3>there is no menus to show</h3>
                </div>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
 
@section('sripts')
@endsection