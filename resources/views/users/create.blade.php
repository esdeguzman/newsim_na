@extends('./layouts/super-admin')

@section('page-title')
    Create New User
@endsection

@section('nav-users')
    active
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li class="active">New</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        @if (count($errors) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>Saving Failed!</strong> Please check all the fields and save again.
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <form action="{{ route('users.store') }}" class="form-horizontal" method="post">
                {{ csrf_field() }}

            <div class="col-md-9 col-sm-12 col-xs-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><span class="fa fa-pencil"></span> Personal Info</h3>
                        <p>This information lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus, est quis molestie tincidunt, elit arcu faucibus erat.</p>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">First Name</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="text" value="{{ old('first_name') }}" class="form-control" name="first_name"/>
                                @if ($errors->has('first_name'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Middle Name</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="text" value="{{ old('middle_name') }}" class="form-control" name="middle_name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Last Name</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="text" value="{{ old('last_name') }}" class="form-control" name="last_name"/>
                                @if ($errors->has('last_name'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Gender</label>
                            <div class="col-md-9 col-xs-7">
                                <select class="form-control select" name="gender">
                                    <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                                    <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><span class="fa fa-briefcase"></span> Employment</h3>
                        <p>This information lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus, est quis molestie tincidunt, elit arcu faucibus erat.</p>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Employee ID</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="text" class="form-control" name="employee_id" value="{{ old('employee_id') }}"/>
                                @if ($errors->has('employee_id'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('employee_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Email</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}"/>
                                @if ($errors->has('email'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Branch</label>
                            <div class="col-md-9 col-xs-7">
                                <select class="form-control select" name="branch">
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->name }}"  @if(old('branch') == $branch->name) selected @endif>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Department</label>
                            <div class="col-md-9 col-xs-7">
                                <select class="form-control select" name="department">
                                    @foreach($departments as $department)
                                    <option value="{{ $department->name }}"  @if(old('department') == $department->name) selected @endif>({{ $department->code }}) {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Is the User a Chief?</label>
                            <div class="col-md-9 col-xs-7">
                                <label class="check"><input type="checkbox" class="icheckbox" name="chief" value="1" @if(old('chief') == '1') checked @endif/> Yes, this user is a Chief</label>
                                <span class="help-block">Check only if you are sure. Please refer to Newsim's Organizational Chart for more info.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Position</label>
                            <div class="col-md-9 col-xs-7">
                                <select class="form-control select" data-live-search="true" name="position">
                                    @foreach($positions as $position)
                                    <option value="{{ $position->name }}" @if(old('position') == $position->name) selected @endif>{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Status</label>
                            <div class="col-md-9 col-xs-7">
                                <select class="form-control select" name="employment_status">
                                    <option value="active" @if(old('employment_status') == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if(old('employment_status') == 'inactive') selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Remarks</label>
                            <div class="col-md-9 col-xs-7">
                                <textarea class="form-control" rows="3" name="remarks">{{ old('remarks') }}</textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><span class="fa fa-key"></span> Login Details</h3>
                        <p>New user will use the default username and password so no need to supply those. The user can update username and password he/she so desires.</p>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Role</label>
                            <div class="col-md-9 col-xs-7">
                                <select class="form-control select" name="account_type">
                                    <option value="super-admin" @if(old('account_type') == 'super-admin') selected @endif>Super Admin</option>
                                    <option value="admin" @if(old('account_type') == 'admin') selected @endif>Admin</option>
                                    <option value="default" @if(old('account_type') == 'default') selected @endif>Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Username</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="text" value="{{ old('username') }}" class="form-control" name="username"/>
                                @if ($errors->has('username'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Password</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="password" class="form-control" name="password"/>
                                @if ($errors->has('password'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Confirm Password</label>
                            <div class="col-md-9 col-xs-7">
                                <input type="password" class="form-control" name="confirm_password"/>
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-xs-5">
                                <button class="btn btn-primary btn-rounded pull-right" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="panel panel-default form-horizontal">
                    <div class="panel-body">
                        <h3><span class="fa fa-info-circle"></span> Overview</h3>
                        <p>Some quick info about this user</p>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Last visit</label>
                            <div class="col-md-8 col-xs-7 line-height-30">12:46 27.11.2015</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Super Admin</label>
                            <div class="col-md-8 col-xs-7 line-height-30">2</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Admin</label>
                            <div class="col-md-8 col-xs-7">3</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Default</label>
                            <div class="col-md-8 col-xs-7 line-height-30">612</div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><span class="fa fa-rocket"></span> Applications</h3>
                        <p>Click the application code to change User's Role</p>
                    </div>
                    <div class="panel-body form-horizontal form-group-separated">
                        @foreach($applications as $application)
                        <div class="form-group">
                            <label class="col-md-4 col-xs-6 control-label">{{ $application->code }}</label>
                            <div class="col-md-3 col-xs-6">
                                <label class="switch">
                                    <input type="checkbox" @if(old($application->code)) checked @endif name="{{ $application->code }}" value="{{ $application->id }}"/>
                                    <span></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <select class="form-control select" name="{{ $application->code }}_role">
                                    @if ($errors->count() > 0)
                                        <option value="super-admin" @if(old($application->code . '_role') == 'super-admin') selected @endif>Super Admin</option>
                                        <option value="admin" @if(old($application->code . '_role') == 'admin') selected @endif>Admin</option>
                                        <option value="default" @if(old($application->code . '_role') == 'default') selected @endif>Default</option>
                                        <option value="document_controller" @if(old($application->code . '_role') == 'default') selected @endif>Default</option>
                                    @else
                                        <option value="super-admin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="document_controller">Document Controller</option>
                                        <option value="default" selected>Default</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            </form>

        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="/js/plugins/form/jquery.form.js"></script>
<script type="text/javascript" src="/js/plugins/cropper/cropper.min.js"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="/js/demo_edit_profile.js"></script>
@endsection
