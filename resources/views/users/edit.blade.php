@extends('./layouts/super-admin')

@section('page-title')
    Edit User
@endsection

@section('nav-users')
    active
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li class="active">Edit</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <!-- <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>Important!</strong> Most of the information of the user is unedittable, that is because user data are being managed by the Human Resource Information System.
                </div>
            </div>
        </div> -->

        <div class="row">
            <form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="POST">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
            <div class="col-md-3 col-sm-4 col-xs-5">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <h3><span class="fa fa-user"></span> {{ $user->fullName() }}</h3>
                        <p>{{ $user->position }} / {{ strtoupper($user->role) }}</p>
                        <div class="text-center" id="user_image">
                            <img src="{{ url($user->photo) }}" class="img-thumbnail"/>
                        </div>
                    </div>

                    <div class="panel-body form-group-separated">

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-12 col-xs-12">--}}
                                {{--<a href="#" class="btn btn-primary btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_photo">Change Photo</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">#ID</label>
                            <div class="col-md-8 col-xs-7">
                                <input type="text" value="{{ $user->id }}" class="form-control" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Role</label>
                            <div class="col-md-8 col-xs-7">
                                <select class="form-control select" name="account_type">
                                    @if ($errors->count() > 0)
                                        <option value="super-admin" @if(old('account_type') == 'super-admin') selected @endif>Super Admin</option>
                                        <option value="admin" @if(old('account_type') == 'admin') selected @endif>Admin</option>
                                        <option value="default" @if(old('account_type') == 'default') selected @endif>Default</option>
                                    @else
                                        <option value="super-admin" @if($user->type == 'super-admin') selected @endif>Super Admin</option>
                                        <option value="admin" @if($user->type == 'admin') selected @endif>Admin</option>
                                        <option value="default" @if($user->type == 'default') selected @endif>Default</option>
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Username</label>
                            <div class="col-md-8 col-xs-7">
                                <input type="text" value="@if ($errors->count() > 0){{ old('username') }}@else{{ $user->username }}@endif" class="form-control" name="username"/>
                                @if ($errors->has('username'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <a href="{{ route('change-password', $user->id) }}" class="btn btn-danger btn-block btn-rounded" value="Reset Password">Reset Password</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-sm-8 col-xs-7">

                    <div class="panel panel-default">

                        <div class="panel-body">
                            <h3><span class="fa fa-pencil"></span> Personal Info</h3>
                            <p>This information lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus, est quis molestie tincidunt, elit arcu faucibus erat.</p>
                        </div>

                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">First Name</label>
                                <div class="col-md-9 col-xs-7">
                                    <input type="text" value="@if ($errors->count() > 0){{ old('first_name') }}@else{{ $user->first_name }}@endif" class="form-control" name="first_name"/>
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
                                    <input type="text" value="@if ($errors->count() > 0){{ old('middle_name') }}@else{{ $user->middle_name }}@endif" class="form-control" name="middle_name"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">Last Name</label>
                                <div class="col-md-9 col-xs-7">
                                    <input type="text" value="@if ($errors->count() > 0){{ old('last_name') }}@else{{ $user->last_name }}@endif" class="form-control" name="last_name"/>
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
                                        @if ($errors->count() > 0)
                                            <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                                            <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                                        @else
                                            <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if($user->gender == 'female') selected @endif>Female</option>
                                        @endif
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
                                    <input type="text" class="form-control" name="employee_id" value="@if ($errors->count() > 0){{ old('employee_id') }}@else{{ $user->employee_id }}@endif"/>
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
                                    <input type="text" class="form-control" name="email" value="@if ($errors->count() > 0){{ old('email') }}@else{{ $user->email }}@endif"/>
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
                                            @if ($errors->count() > 0)
                                                <option value="{{ $branch->name }}"  @if(old('branch') == $branch->name) selected @endif>{{ $branch->name }}</option>
                                            @else
                                                <option value="{{ $branch->name }}"  @if($user->branch == $branch->name) selected @endif>{{ $branch->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">Department</label>
                                <div class="col-md-9 col-xs-7">
                                    <select class="form-control select" data-live-search="true" name="department">
                                        @foreach($departments as $department)
                                            @if ($errors->count() > 0)
                                                <option value="{{ $department->name }}"  @if(old('department') == $department->name) selected @endif>({{ $department->code }}) {{ $department->name }}</option>
                                            @else
                                                <option value="{{ $department->name }}"  @if($user->department == $department->name) selected @endif>({{ $department->code }}) {{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">Is the User a Chief?</label>
                                <div class="col-md-9 col-xs-7">
                                    <label class="check"><input type="checkbox" class="icheckbox" name="chief" value="1" @if($errors->count() > 0) @if(old('chief') == '1') checked @endif @else @if($user->chief == 1) checked @endif @endif/> Yes, this user is a Chief</label>
                                    <span class="help-block">Check only if you are sure. Please refer to Newsim's Organizational Chart for more info.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">Position</label>
                                <div class="col-md-9 col-xs-7">
                                    <select class="form-control select" data-live-search="true" name="position">
                                        @foreach($positions as $position)
                                            @if ($errors->count() > 0)
                                                <option value="{{ $position->name }}" @if(old('position') == $position->name) selected @endif>{{ $position->name }}</option>
                                            @else
                                                <option value="{{ $position->name }}" @if($user->position == $position->name) selected @endif>{{ $position->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">Status</label>
                                <div class="col-md-9 col-xs-7">
                                    <select class="form-control select" name="employment_status">
                                        @if ($errors->count() > 0)
                                            <option value="active" @if(old('employment_status') == 'active') selected @endif>Active</option>
                                            <option value="inactive" @if(old('employment_status') == 'active') selected @endif>Inactive</option>
                                        @else
                                            <option value="active" @if($user->employment_status == 'active') selected @endif>Active</option>
                                            <option value="inactive" @if($user->employment_status == 'inactive') selected @endif>Inactive</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-5 control-label">Remarks</label>
                                <div class="col-md-9 col-xs-7">
                                    <textarea class="form-control" rows="3" name="remarks">@if ($errors->count() > 0){{ old('remarks') }}@else{{ $user->remarks }}@endif</textarea>
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
                        <p>Sample of settings block</p>
                    </div>

                    <div class="panel-body form-horizontal form-group-separated">
                        @foreach($applications as $application)
                        <div class="form-group">
                            <label class="col-md-4 col-xs-6 control-label">{{ $application->code }}</label>
                            <div class="col-md-3 col-xs-6">
                                <label class="switch">
                                    <?php $checked = false; ?>
                                    @foreach($user->roles as $role)
                                        @if($application->id == $role->client_id)
                                            <?php $checked = true; ?>
                                        @endif
                                    @endforeach
                                    <input type="checkbox" @if($checked == true) checked @endif name="{{ $application->code }}" value="{{ $application->id }}"/>
                                    <span></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <select class="form-control select" name="{{ $application->code }}_role">
                                    @if ($errors->count() > 0)
                                        <option value="super-admin" @if(old($application->code . '_role') == 'super-admin') selected @endif>Super Admin</option>
                                        <option value="admin" @if(old($application->code . '_role') == 'admin') selected @endif>Admin</option>
                                        <option value="default" @if(old($application->code . '_role') == 'default') selected @endif>Default</option>
                                    @else
                                        <?php $type = 'default' ?>
                                        @foreach($user->roles as $role)
                                            @if($application->id == $role->client_id)
                                                <?php $type = $role->type ?>
                                            @endif
                                        @endforeach
                                        <option value="super-admin" @if($type == 'super-admin') selected @endif>Super Admin</option>
                                        <option value="admin" @if($type == 'admin') selected @endif>Admin</option>
                                        <option value="default" @if($type == 'default') selected @endif>Default</option>
                                        <option value="document-controller" @if($type == 'document-controller') selected @endif>Document Controller</option>
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

    <!-- MODALS -->
    <div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="smallModalHead">Change photo</h4>
                </div>
                <form id="cp_crop" method="post" action="assets/crop_image.php">
                <div class="modal-body">
                    <div class="text-center" id="cp_target">Use form below to upload file. Only .jpg files.</div>
                    <input type="hidden" name="cp_img_path" id="cp_img_path"/>
                    <input type="hidden" name="ic_x" id="ic_x"/>
                    <input type="hidden" name="ic_y" id="ic_y"/>
                    <input type="hidden" name="ic_w" id="ic_w"/>
                    <input type="hidden" name="ic_h" id="ic_h"/>
                </div>
                </form>
                <form id="cp_upload" method="post" enctype="multipart/form-data" action="assets/upload_image.php">
                <div class="modal-body form-horizontal form-group-separated">
                    <div class="form-group">
                        <label class="col-md-4 control-label">New Photo</label>
                        <div class="col-md-4">
                            <input type="file" class="fileinput btn-info" name="file" id="cp_photo" data-filename-placement="inside" title="Select file"/>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="cp_accept">Accept</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- EOF MODALS -->
@endsection

@section('scripts')
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="/js/plugins/form/jquery.form.js"></script>
<script type="text/javascript" src="/js/plugins/cropper/cropper.min.js"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>
@endsection
