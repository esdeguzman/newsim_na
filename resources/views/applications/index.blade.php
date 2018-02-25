@extends('./layouts/super-admin')

@section('page-title')
    Applications
@endsection

@section('nav-applications')
    active
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="active">Applications</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">
                <!-- START BORDERED TABLE SAMPLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Applications</h3>
                        <ul class="panel-controls">
                            <li><button type="button" class="btn btn-success btn-rounded" onclick="location.href='{{ route('applications.create') }}';">Create new App</button></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" id="table-application">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Secret</th>
                                    <th>Redirect URL</th>
                                    <th with="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr>
                                        <td>{{ $application->id }}</td>
                                        <td>{{ $application->code }}</td>
                                        <td><a href="{{ route('applications.show', $application->id) }}">{{ $application->name }}</a></td>
                                        <td><code>{{ $application->secret }}</code></td>
                                        <td>{{ $application->redirect }}</td>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-sm" onclick="location.href='{{ route('applications.edit', $application->id) }}';"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-sm" type="button" name="button" onclick="delete_application({{ $application->id }})"><span class="fa fa-times"></span></button>
                                        </td>
                                        <form method="POST" action="{{ route('applications.destroy', $application->id) }}" accept-charset="UTF-8" id="formDelete{{ $application->id }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
										</form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END BORDERED TABLE SAMPLE -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- START BORDERED TABLE SAMPLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Authorized Applications</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Application</th>
                                    <th>Scope</th>
                                    <th>Date Created</th>
                                    <th Width="120">
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tokens as $token)
                                    <tr>
                                        <td>{{ $token->user->fullName() }}</td>
                                        <td>{{ '(' . $token->client->code . ') ' . $token->client->name }}</td>
                                        <td>Default</td>
                                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $token->created_at)->toDayDateTimeString() }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-rounded btn-sm" onclick="delete_token({{ $token->client_id }})">Revoke</button>
                                        </td>
                                        <form method="POST" action="{{ route('applications.destroy', $token->client_id) }}" accept-charset="UTF-8" id="formRevokeToken{{ $token->client_id }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="token_id" value="{{ $token->id }}">
										</form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END BORDERED TABLE SAMPLE -->
            </div>
        </div>

    </div>

    <!-- DELETE APPLICATION MESSAGE BOX-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete-application">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Delete <strong>Application</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to delete this Application?</p>
                    <p>Press Yes to delete application.</p>
                </div>
                <div class="mb-footer">
    				<div class="pull-right">
    					<button class="btn btn-success btn-lg mb-control-yes">Yes</button>
    					<button class="btn btn-default btn-lg mb-control-close">No</button>
    				</div>
			    </div>
            </div>
        </div>
    </div>
    <!-- DELETE APPLICATION END MESSAGE BOX-->

    <!-- REVOKE TOKEN MESSAGE BOX-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-revoke-token">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Revoke <strong>Access Token</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to revoke access token of this Application?</p>
                    <p>Press Yes to revoke access token.</p>
                </div>
                <div class="mb-footer">
    				<div class="pull-right">
    					<button class="btn btn-success btn-lg mb-control-yes">Yes</button>
    					<button class="btn btn-default btn-lg mb-control-close">No</button>
    				</div>
			    </div>
            </div>
        </div>
    </div>
    <!-- REVOKE TOKEN END MESSAGE BOX-->

@endsection

@section('scripts')

<script type="text/javascript">
    function delete_application(row) {

        var box = $("#mb-delete-application");
        box.addClass("open");

        box.find(".mb-control-yes").on("click",
            function(){
                box.removeClass("open");
                document.getElementById('formDelete' + row).submit();
            }
        );
    }

    function delete_token(row) {

        var box = $("#mb-revoke-token");
        box.addClass("open");

        box.find(".mb-control-yes").on("click",
            function(){
                box.removeClass("open");
                document.getElementById('formRevokeToken' + row).submit();
            }
        );
    }
</script>
@endsection
