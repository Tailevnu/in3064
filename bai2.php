<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
        <?php
        $x=$_GET['x'];
        $y=$_GET['y'];
        //arithmetic operations
        $z=$x+$y;
        $p=$x-$y;
        $c=$x*$y;
        $d=$x/$y;
        $m=$x%$y;
        echo "x=". $x . "<br/>";
        echo "y=". $y . "<br/>";
        echo "Sum of x and y is:". $z . "<br/>";
        echo "Subtraction of x and y is:". $p . "<br/>";
        echo "Multiplication of x and y is:". $c . "<br/>";
        echo "Division of x and y is:". $d . "<br/>";
        echo "Modulus of x and y is:". $m . "<br/>";
      //Comparison operations
        echo "x == y:". ($x==$y) . "<br/>";
        echo "x != y:". ($x!=$y) . "<br/>";
        echo "x > y:". ($x>$y) . "<br/>";
        echo "x < y:". ($x<$y) . "<br/>";
        echo "x >= y:". ($x>=$y) . "<br/>";
        echo "x <= y:". ($x<=$y) . "<br/>";
      ?>
</body>
</html>