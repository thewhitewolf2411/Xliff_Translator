<html>

    <head>
        <title>Interface</title>
    </head>

    <body>
        <h2>Landing page</h2>
        <ul>
            <li><a href="/interface/convert">Convert XLS to XLIFFs</a></li>
            <li><a href="/interface/export">Export XLS from XLIFF</a></li>
        </ul>

        <form method="POST" action="{{ route('logout') }}">
                        @csrf
        <button type="submit">Logout</button>

        </form>

    </body>

</html> 


