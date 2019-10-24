<html>

    <head>
        <title>Convertor</title>
    </head>

    <style>

        #sheetNameContainer {
            display: none;
        }

    </style>

    <script>

        function sheetSelectionChanged(data) {

            var currentValue = data.value;

            if (currentValue === "single") {
                document.getElementById("sheetNameContainer").style="display: none";
                document.getElementById("sheet").required = false;
            } else if (currentValue === "multiple") {
                document.getElementById("sheetNameContainer").style="display: block";
                document.getElementById("sheet").required = true;
            }

        }

    </script>

    <body>

        <h2> Translate XLF file </h2>
        <form action="/convertor" method="post" enctype="multipart/form-data">

            @csrf

            <label for="xls_type">Select XLS(X) file type</label>
            <select id="xls_type" name="sheet_type" onchange="sheetSelectionChanged(this)">
                <option value="single">Single sheet XLS(X) file</option>
                <option value="multiple">Multiple sheets XLS(X) file</option>
            </select>

            <br/>
            <br/>

            <div id="sheetNameContainer">
                <label for="sheet"> Enter sheet name to read from if it is multiple sheet file </label>
                <input id="sheet" type="text" name="sheet" placeholder="Sheet to read from" />
                <br/>
                <br/>
            </div>

            <label for="file">Upload XLF and XLS(X) files: </label>
            <input id="file" type="file" name="file[]" accept=".xls, .xlsx, .xlf" multiple required />

            <br/>
            <br/>

            <p>Set if is it demo sample or not: </p>
            <select id="demo_select" name="demo" size="2">
                <option value="true" selected>True</option>
                <option value="false">False</option>
            </select>

            <br/>
            <br/>

            <input type="submit" value="Translate" />

        </form>

    </body>

</html>

