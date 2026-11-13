
var firstNumber = 0;
var operator = "";
var newNumber = true;


/* ==============================
   NHẬP SỐ
   ============================== */
function addNumber(number)
{
    var display = document.getElementById("display");


    if (newNumber || display.value == "0")
    {
        display.value = number;
        newNumber = false;
    }
    else
    {
        display.value += number;
    }
}


/* ==============================
   NHẬP DẤU CHẤM
   ============================== */
function addDecimal()
{
    var display = document.getElementById("display");


    if (newNumber)
    {
        display.value = "0.";
        newNumber = false;
    }
    else if (!display.value.includes("."))
    {
        display.value += ".";
    }
}


/* ==============================
   CHỌN PHÉP TOÁN
   ============================== */
function setOperator(op)
{
    var display = document.getElementById("display");


    firstNumber = parseFloat(display.value);

    operator = op;

    newNumber = true;
}


/* ==============================
   TÍNH KẾT QUẢ
   ============================== */
function calculate()
{
    var display = document.getElementById("display");

    var secondNumber;
    var result;


    if (operator == "")
    {
        return;
    }


    secondNumber = parseFloat(display.value);


    switch (operator)
    {
        case "+":
            result = firstNumber + secondNumber;
            break;


        case "-":
            result = firstNumber - secondNumber;
            break;


        case "*":
            result = firstNumber * secondNumber;
            break;


        case "/":

            if (secondNumber == 0)
            {
                display.value = "Không thể chia 0";
                operator = "";
                newNumber = true;
                return;
            }

            result = firstNumber / secondNumber;
            break;
    }


    display.value = result;

    operator = "";

    newNumber = true;
}


/* ==============================
   PHẦN TRĂM
   ============================== */
function percent()
{
    var display = document.getElementById("display");

    var number = parseFloat(display.value);


    display.value = number / 100;

    newNumber = true;
}


/* ==============================
   CĂN BẬC HAI
   ============================== */
function squareRoot()
{
    var display = document.getElementById("display");

    var number = parseFloat(display.value);


    if (number < 0)
    {
        display.value = "Lỗi";
        newNumber = true;
        return;
    }


    display.value = Math.sqrt(number);

    newNumber = true;
}


/* ==============================
   BÌNH PHƯƠNG
   ============================== */
function square()
{
    var display = document.getElementById("display");

    var number = parseFloat(display.value);


    display.value = Math.pow(number, 2);

    newNumber = true;
}


/* ==============================
   ĐỔI DẤU
   ============================== */
function changeSign()
{
    var display = document.getElementById("display");

    var number = parseFloat(display.value);


    display.value = number * (-1);
}


/* ==============================
   SIN
   ============================== */
/*
   Math.sin() sử dụng radian.
   Đổi độ sang radian:

   độ * Math.PI / 180
*/
function sinValue()
{
    var display = document.getElementById("display");

    var degree = parseFloat(display.value);

    var radian = degree * Math.PI / 180;


    display.value = Math.sin(radian);

    newNumber = true;
}


/* ==============================
   COS
   ============================== */
function cosValue()
{
    var display = document.getElementById("display");

    var degree = parseFloat(display.value);

    var radian = degree * Math.PI / 180;


    display.value = Math.cos(radian);

    newNumber = true;
}


/* ==============================
   TAN
   ============================== */
function tanValue()
{
    var display = document.getElementById("display");

    var degree = parseFloat(display.value);

    var radian = degree * Math.PI / 180;


    display.value = Math.tan(radian);

    newNumber = true;
}


/* ==============================
   XÓA TOÀN BỘ
   ============================== */
function clearDisplay()
{
    document.getElementById("display").value = "0";

    firstNumber = 0;

    operator = "";

    newNumber = true;
}


/* ==============================
   XÓA KÝ TỰ CUỐI
   ============================== */
function deleteLast()
{
    var display = document.getElementById("display");


    if (display.value.length > 1)
    {
        display.value =
            display.value.substring(
                0,
                display.value.length - 1
            );
    }
    else
    {
        display.value = "0";

        newNumber = true;
    }
}


/* ==============================
   NHẬP BẰNG BÀN PHÍM
   ============================== */
document.addEventListener("keydown", function(event)
{
    var key = event.key;


    /* Các phím số */
    if (key >= "0" && key <= "9")
    {
        addNumber(key);
    }


    /* Dấu chấm */
    else if (key == ".")
    {
        addDecimal();
    }


    /* Phép toán */
    else if (
        key == "+" ||
        key == "-" ||
        key == "*" ||
        key == "/"
    )
    {
        setOperator(key);
    }


    /* Enter = */
    else if (key == "Enter")
    {
        calculate();
    }


    /* Backspace */
    else if (key == "Backspace")
    {
        deleteLast();
    }


    /* Escape = C */
    else if (key == "Escape")
    {
        clearDisplay();
    }
});

