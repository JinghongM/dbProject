<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<table border="1" id="tableA">
    <tr>
        <td>cell 1</td>
        <td>cell 2</td>
    </tr>
    <tr>
        <td>cell 3</td>
        <td>cell 4</td>
    </tr>
</table>
<table border="1" id="tableB">
    <tr>
        <td>cell 5</td>
        <td>cell 6</td>
    </tr>
    <tr>
        <td>cell 7</td>
        <td>cell 8</td>
    </tr>
</table>
<input type="button" id="showTableA" value="Table A">
<input type="button" id="showTableB" value="Table B">
<script type="text/javascript">
    var tableA = document.getElementById("tableA");
var tableB = document.getElementById("tableB");

var btnTabA = document.getElementById("showTableA");
var btnTabB = document.getElementById("showTableB");

btnTabA.onclick = function () {
    tableA.style.display = "table";
    tableB.style.display = "none";
}
btnTabB.onclick = function () {
    tableA.style.display = "none";
    tableB.style.display = "table";
}
</script>
</body>
</html>