<html>

    <head>
        <title>Exporter</title>
    </head>

    <style>

        select {
            width: 100px;
            height: 170px;
        }

    </style>

    <body>

        <h2>Extract terms to translate from XLF file</h2>
        <form action="/interface/exporter" method="post" enctype="multipart/form-data">
            @csrf

            <label for="file">Choose XLF file for extracting terms: </label>
            <input id="file" type="file" name="file" accept=".xlf" required />
            <input id="translation_name" name="translation_name" required /> 
            <br/>
            <br/>

            <p>Choose language column/s for which you want to set translations</p>
            <select id="multiselect" name="languages[]" size="11" multiple required>
                <option value="en">English</option>
                <option value="de">German</option>
                <option value="it">Italian</option>
                <option value="fr">French</option>
                <option value="es">Spanish</option>
                <option value="cs">Czech</option>
                <option value="zh">Chinese</option>
                <option value="pt">Portugal</option>
                <option value="pl">Poland</option>
                <option value="ru">Russian</option>
                <option value="nl">Netherlands</option>
            </select>

            <br/>
            <br/>

            <input type="submit" value="Export"/>
        </form>

        
    </body>

</html>

