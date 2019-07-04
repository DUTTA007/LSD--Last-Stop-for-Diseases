<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery post() Demo</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#a").click(function(event){
        event.preventDefault();
        var formValues = $(this).text();
        console.log(formValues);
        $.post("disease.php", formValues, function(data){
            $("#result").html(data);
        });
    });
        $("#b").click(function(event){
        event.preventDefault();
        var formValues2 = $(this).text();
            console.log(formValues2);
        $.post("posts.php", formValues2, function(data){
            $("#result").html(data);
        });
    });
});
</script>
</head>
<body>
    <a id="a" name="a">a</a>
    <a id="b" name="b">b</a>
</body>
</html>