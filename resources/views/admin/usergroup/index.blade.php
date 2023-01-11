@extends('admin.layouts.main')

@if(isset($updating) && $updating)
    @section('title', 'Update Usergroup')
@else
    @section('title', 'Add Usergroup')
@endif


@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="{{ route('admin.usergroup.index') }}" class="btn btn-primary">List All</a> 
                </div>
                <h2 class="panel-title">@if(isset($updating) && $updating)
                    Update Usergroup
                    @else
                    Add Usergroup
                    @endif
                </h2>
            </header>
            @if(isset($updating) && $updating)
                <form action="{{ route('admin.usergroup.update', $usergroup->id) }}" method="POST">
                @method('PUT')   
            @else
                <form action="{{ route('admin.usergroup.store') }}" method="POST">
            @endif
            @csrf
                <div class="panel-body">
                    <div class="form-group
                        @if($errors->has('name'))
                            has-error
                        @endif
                    ">
                        <label class="col-md-3 control-label" for="inputDefault">User Group Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" id="Name" value="{{$usergroup->name ?? old('name') }}">
                            @if($errors->has('name'))
                            <label for="name" class="error">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
</div>

@endsection