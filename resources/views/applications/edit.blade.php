@extends('./layouts/super-admin')

@section('page-title')
    Edit Application
@endsection

@section('nav-applications')
    active
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li ><a href="{{ route('applications.index') }}">Application</a></li>
        <li class="active">Edit</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ route('applications.update', $application->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Edit</strong> Application</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <p>Add class <code>.form-group-separated</code> to form wrapper to get rows separated</p>
                        </div>
                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Code</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control" name="code" value="@if($errors->count() > 0){{ old('code') }}@else{{ $application->code }}@endif"/>
                                    </div>
                                    @if ($errors->has('code'))
                                        <span class="help-block successful">
                                            <strong class="text-danger">{{ $errors->first('code') }}</strong>
                                        </span>
                                    @else
                                        <span class="help-block">Unique application code.</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control" name="name" value="@if($errors->count() > 0){{ old('name') }}@else{{ $application->name }}@endif"/>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block successful">
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @else
                                        <span class="help-block">Something recognizable by your user</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Description</label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" rows="5" name="description">@if($errors->count() > 0){{ old('description') }}@else{{ $application->description }}@endif</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block successful">
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        </span>
                                    @else
                                        <span class="help-block">Description for your application</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Redirect URL</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control" name="redirect" value="@if($errors->count() > 0){{ old('redirect') }}@else{{ $application->redirect }}@endif"/>
                                    </div>
                                    @if ($errors->has('redirect'))
                                        <span class="help-block successful">
                                            <strong class="text-danger">{{ $errors->first('redirect') }}</strong>
                                        </span>
                                    @else
                                        <span class="help-block">This is where the user gets redirected upon authorizing the application.</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default">Clear Form</button>
                            <button class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
