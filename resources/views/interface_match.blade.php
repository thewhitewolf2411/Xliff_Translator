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

    <h2> Find matches </h2>
    <form action="/matcher" method="post" enctype="multipart/form-data">

        @csrf

        <label for="xls_type">Select XLSX file type</label>
        <select id="xls_type" name="sheet_type" onchange="sheetSelectionChanged(this)">
            <option value="single">Single sheet XLSX file</option>
            <option value="multiple">Multiple sheets XLSX file</option>
        </select>

        <br/>
        <br/>

        <div id="sheetNameContainer">
            <label for="sheet"> Enter sheet name to read from if it is multiple sheet file </label>
            <input id="sheet" type="text" name="sheet" placeholder="Sheet to read from" />
            <br/>
            <br/>
        </div>

        <label for="file">Upload XLSX files: </label>
        <input id="file" type="file" name="file[]" accept=".xlsx" multiple required />

        <br/>
        <br/>

        <input type="submit" value="Find matches" />

    </form>

    
</body>

</html>

