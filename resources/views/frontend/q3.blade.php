<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Da Ti</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
<div class="container pt-2">
    <div class="col-12" id="question-div">
        <h3>最后一题 老公在你心目中的形象是？</h3>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1">
            <img src="images/wyz.jpg" alt="" style="width:50px;">
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2">
            <img src="images/huojianhua.jpg" alt="" style="width:50px;">
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="3">
            <img src="images/zhl.jpg" alt="" style="width:50px;">
        </div>

        <br>
        <button class="btn btn-outline-success" id="submit-btn">我想好了</button>
    </div>

    <div class="col-12 ad" id="answer-div" style="display: none;">
        <hr>

        <div class="col-12 ad" id="q1div" style="display: none;">
            <label>储藏室最大的箱子</label>
        </div>

        <div class="col-12 ad" id="q2div" style="display: none;">
            <label>储藏室最大的箱子</label>
        </div>

        <div class="col-12 ad" id="q3div" style="display: none;">
            <label>储藏室最大的箱子</label>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#submit-btn').click(function () {
        if (!$("input[name='exampleRadios']:checked").val()) {
            alert("必须回答！");
            return false;
        }

        var answer = $('input[name=exampleRadios]:checked').val();

        $('.ad').hide();

        if (answer == "1") {
            $('#answer-div').show();
            $('#q1div').show();
        } else if(answer == "2") {
            $('#answer-div').show();
            $('#q2div').show();
        } else if(answer == "3") {
            $('#answer-div').show();
            $('#q3div').show();
        } else {
            alert("必须回答！");
        }
    });
</script>

</body>
</html>