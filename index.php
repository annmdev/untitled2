<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web 1</title>
    <style>
        body{
            margin: 0;
        }

        header{
            font-family: monospace;
            background-color: white;
            font-size: large;
            height: 56px;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
        }

        header:hover{
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.25);
        }

        .header-container{
            position: relative;
            height: 56px;
            text-align: center;
        }

        .header-data{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding-left: 16px;
        }

        .header-data div{
            display: inline;
        }

        .main-container{
            width: 100%;
            font-family: monospace;
        }

        .main-container > tr > td{
            vertical-align: top;
        }

        #up-space{
            width: 100%;
            height: 100px;
        }

        #left-space, #right-space{
            width: 15%;
        }

        #left-column{
            width: 30%;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
        }

        #left-column img{
            width: 100%;
            height: auto;
            max-width: 420px;
        }

        #right-column{
            width: 40%;
            padding: 8px;
        }

        #left-column:hover{
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.25);
        }

        .main-form-container{
            width: 100%;
            height: 100%;
            padding-left: 16px;
        }


        label{
            display: block;
            padding-bottom: 16px;
            font-size: 1.3em;
        }

        .next-text{
            font-size: 1.6em;
            padding: 16px 0;
            font-weight: bold;
        }

        .input_err{
            display: inline-block;
            padding: 4px 8px;
            background: lightpink;
            margin: 8px;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
        }

        input[type="text"]{
            width: 100%;
            min-width: 30px;
            margin: 8px 0;
            padding: 8px;
            border: 2px solid black;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
        }

        input[type="text"]:focus {
            background-color: aliceblue;
        }

        .submit_btn{
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            cursor: pointer;
            float: right;

            font-family: monospace;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <div class="header-data">
            <div id="header-name">Студент: Анна Михайлова</div>
            <div id="header-group">Группа: P3232</div>
            <div id="header-variant">Вариант: 313306</div>
        </div>
    </div>
</header>

<table class="main-container">

    <tr>
        <td id="up-space" colspan="4"></td>
    </tr>

    <tr>
        <td id="left-space"></td>
        <td id="left-column">
            <img src="areas.png" alt="area">
        </td>

        <td id="right-column">
            <div class="main-form-container">
                <div class="next-text">Следующий запрос:</div>
                <form class="form-args" action="result.php" method="post">
                    <label>
                        Изменение R:
                        <input type="text" name="arg-r">
                    </label>
                    <label>
                        Изменение X:
                        <input type="radio" name="arg-x" value="-3">-3
                        <input type="radio" name="arg-x" value="-2">-2
                        <input type="radio" name="arg-x" value="-1">-1
                        <input type="radio" name="arg-x" value="0">0
                        <input type="radio" name="arg-x" value="1">1
                        <input type="radio" name="arg-x" value="2">2
                        <input type="radio" name="arg-x" value="3">3
                        <input type="radio" name="arg-x" value="4">4
                        <input type="radio" name="arg-x" value="5">5
                    </label>
                    <label>
                        Изменение Y:
                        <input type="text" name="arg-y">
                    </label>
                    <input class="submit_btn" type="submit" value="Отправить">
                </form>
            </div>
        </td>
        <td id="right-space"></td>
    </tr>
</table>

<script>
    let form = document.querySelector('.form-args');
    let inputX = form.querySelectorAll('input[name="arg-x"]');
    let inputR = form.querySelector('input[name="arg-r"]');
    let inputY = form.querySelector('input[name="arg-y"]');
    let submit = form.querySelector('input[type="submit"]');

    inputR.addEventListener('input', function () {
        if (!(/^\d+\.?\d*$/.test(inputR.value))) inputR.value = inputR.value.substr(0, inputR.value.length - 1)
    })

    inputY.addEventListener('input', function () {
        if (!(/^-?\d*\.?\d*$/.test(inputY.value))) inputY.value = inputY.value.substr(0, inputY.value.length - 1)
    })

    form.addEventListener('submit', function (event) {
        clearErr();

        if (!inputR.value || !(inputR.value > 1 && inputR.value < 4)) {
            generateErr("r is wrong", event);
            inputR.style.borderColor = "red";
        }
        if (!inputY.value || !(inputY.value > -5 && inputY.value < 5)) {
            generateErr("y is wrong", event);
            inputY.style.borderColor = "red";
        }
        let checked = false;
        for (let i = 0; i < inputX.length; i++) {
            if (inputX[i].checked) {
                checked = true;
                break;
            }
        }
        if (!checked) {
            generateErr('x is don\'t stated', event);
        }
    });

    function clearErr() {
        inputR.style.borderColor = "black"
        inputY.style.borderColor = "black"
        let errMessages = document.querySelectorAll(".input_err")
        for (const err of errMessages) {
            err.remove()
        }
    }

    function generateErr(text, event) {
        event.preventDefault();
        let errMessage = document.createElement("div");
        errMessage.textContent = text;
        errMessage.className = "input_err"
        submit.after(errMessage);
    }

</script>

</body>
</html>
