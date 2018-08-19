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
        <h3>ruguo sk d sh l zen me b</h3>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1" disabled="disabled">
            <label class="form-check-label" for="exampleRadios1">
                jiu sk
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2" disabled="disabled">
            <label class="form-check-label" for="exampleRadios2">
                jiu lg
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="3" disabled="disabled">
            <label class="form-check-label" for="exampleRadios3">
                b lg f sk s yq jiu shang l
            </label>
        </div>
        <br>
        <button class="btn btn-outline-success" id="submit-btn">wxhl</button>
    </div>

    <div class="col-12 ad" id="answer-div" style="display: none;">
        <hr>

        <div class="col-12 ad" id="q1div" style="display: none;">
            <button class="hide-answer">LGw c le chong x</button>
        </div>

        <div class="col-12 ad" id="q2div" style="display: none;">
            <button class="hide-answer">LGw c le chong x</button>
        </div>

        <div class="col-12 ad" id="q3div" style="display: none;">
            <label for="">shu z ta gz</label>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#submit-btn').click(function () {
        if (!$("input[name='exampleRadios']:checked").val()) {
            alert("bixuhuid");
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
            alert("bixuhuid");
        }
    });

    $('.hide-answer').click(function () {
        $('.ad').hide();
    })
</script>

</body>
</html>