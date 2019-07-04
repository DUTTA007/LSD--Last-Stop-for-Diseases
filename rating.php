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
        var formValues = $(this).serialize();
        $.post("setRating.php", formValues, function(data){
            $("#result").html(data);
        });
    });
        $("#b").click(function(event){
        event.preventDefault();
        var formValues = $(this).serialize();
        $.post("setRating2.php", formValues, function(data){
            $("#result").html(data);
        });
    });
});
</script>
</head>
<body>
    <button id="a">+</button>
    <button id="b">-</button>
    <div id="result"></div>
</body>
</html>