<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

</head>
<body class="passport-authorize">

    You will be redirected shortly.
    <!-- Authorize Button -->
    <form id="form-authorize" method="post" action="/oauth/authorize">
        {{ csrf_field() }}

        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">

    </form>

    <script type="text/javascript" src="{{ url('js/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $("#form-authorize").submit();
        });
    </script>
</body>
</html>
