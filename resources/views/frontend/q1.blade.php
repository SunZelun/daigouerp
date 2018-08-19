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
    <div class="col-12" id="desc-div">
        <h1>下面有三道 -送-命 题</h1>
        <h3>答对有奖哦</h3>
        <br>
        <h3>准备好了开始答题！</h3>
        <button class="btn btn-outline-primary" id="start-btn">KSDT</button>
    </div>

    <div class="col-12" id="question-div" style="display: none;">
        <h3>下列哪个东西比较重要</h3>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1">
            <label class="form-check-label" for="exampleRadios1">
                化妆品
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2">
            <label class="form-check-label" for="exampleRadios2">
                包包
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="3">
            <label class="form-check-label" for="exampleRadios3">
                当然是老公啦！
            </label>
        </div>
        <br>
        <button class="btn btn-outline-success" id="submit-btn">wxhl</button>
    </div>

    <div class="col-12 ad" id="answer-div" style="display: none;">
        <hr>

        <div class="col-12 ad" id="q1div" style="display: none;">
            <button class="hide-answer">老公我错了，再给我一次机会吧！</button>
        </div>

        <div class="col-12 ad" id="q2div" style="display: none;">
            <button class="hide-answer">老公我错了，再给我一次机会吧！</button>
        </div>

        <div class="col-12 ad" id="q3div" style="display: none;">
            床下的抽屉
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#start-btn').click(function () {
        $('#desc-div').hide();
        $('#question-div').show();
    });

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

    $('.hide-answer').click(function () {
        $('.ad').hide();
    })
</script>

</body>
</html>