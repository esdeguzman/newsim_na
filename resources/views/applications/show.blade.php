@extends('./layouts/super-admin')

@section('page-title')
    Application | {{ $application->name }}
@endsection

@section('nav-applications')
    active
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li ><a href="{{ route('applications.index') }}">Application</a></li>
        <li class="active">{{ $application->name }}</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default form-horizontal">
                    <div class="panel-body">
                        <h3><span class="fa fa-info-circle"></span> Information Overview</h3>
                        <p>Detailed information about the Application</p>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Id</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $application->id }}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Code</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $application->code }}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Name</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $application->name }}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Secret</label>
                            <div class="col-md-8 col-xs-7 line-height-30"><code>{{ $application->secret }}</code></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Description</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $application->description }}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Redirect URL</label>
                            <div class="col-md-8 col-xs-7 line-height-30"><a href="{{ $application->redirect }}">{{ $application->redirect }}</a></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Created By</label>
                            <div class="col-md-8 col-xs-7 line-height-30">
                                @if($user)
                                    {{ $user->first_name . ' ' . $user->last_name }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Date Created</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $application->created_at->toDayDateTimeString() }}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label line-height-30">Date Updated</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $application->updated_at->toDayDateTimeString() }}</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
