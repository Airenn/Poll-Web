<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>test</title>
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap-table/dist/css/bootstrap-table.min.css" rel="stylesheet" >
    </head>

    <body>
        <table data-toggle="table" data-url="data1.json" data-height="299" data-sort-name="name" data-sort-order="desc">
    <thead>
        <tr>
            <th data-field="id" data-align="right" data-sortable="true">Item ID</th>
            <th data-field="name" data-align="center" data-sortable="true">Item Name</th>
            <th data-field="price" data-sortable="true">Item Price</th>
        </tr>
    </thead>
</table>
        
        <script src="bootstrap/dist/js/jquery.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="bootstrap-table/dist/js/bootstrap-table.min.js"></script>
    </body>
</html>