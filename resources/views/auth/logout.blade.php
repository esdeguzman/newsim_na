<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Logout | NA</title>
    </head>
    <body>
        You are being log out. please wait...

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        <script type="text/javascript" src="{{ url('js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript">
            $(function(){
                $("#logout-form").submit();
            });
        </script>
    </body>
</html>
