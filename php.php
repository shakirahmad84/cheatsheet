<?php
// Function Lists
1. echo to output the text

// NO keywords (e.g. if, else, while, echo, etc.), classes, functions, and user-defined functions are case-sensitive.
<?php
ECHO "Hello World!<br>";
echo "Hello World!<br>";
EcHo "Hello World!<br>";
?>

// Comments
<?php
// This is a single-line comment
# This is also a single-line comment
/*
This is a multiple-lines comment block
that spans over multiple
lines
*/
// You can also use comments to leave out parts of a code line
$x = 5 /* + 15 */ + 5;
echo $x;
?>

// Variables



/******************************
 *********** PHP OOP **********
 # Classes and Objects
 # Constructor
 # Destructor
 # Access Modifiers
 # Inheritance
 # Constants
 # Abstract Classes
 # Traits
 # Static Methods
 # Static Properties
 ******************************/

 # Classes and Objects
 <?php
 class Fruit {
   // Properties
   public $name;
   public $color;
 
   // Methods
   function set_name($name) {
     $this->name = $name;
   }
   function get_name() {
     return $this->name;
   }
 }
 
 $apple = new Fruit();
 $banana = new Fruit();

 $apple->set_name('Apple');
 $banana->set_name('Banana');
 
 echo $apple->get_name();
 echo "<br>";
 echo $banana->get_name();
 ?>

 <?php
class Fruit {
  // Properties
  public $name;
  public $color;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
  function set_color($color) {
    $this->color = $color;
  }
  function get_color() {
    return $this->color;
  }
}

$apple = new Fruit();

$apple->set_name('Apple');
$apple->set_color('Red');

echo "Name: " . $apple->get_name();
echo "<br>";
echo "Color: " . $apple->get_color();
?>


<?php
class Fruit {
  public $name;
}

$apple = new Fruit();

$apple->name = "Apple";
?>

// instanceof
<?php
$apple = new Fruit();
var_dump($apple instanceof Fruit);
?>

 # Constructor
 <?php
class Fruit {
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }
  function get_name() {
    return $this->name;
  }
  function get_color() {
    return $this->color;
  }
}

$apple = new Fruit("Apple", "red");

echo $apple->get_name();
echo "<br>";
echo $apple->get_color();
?>
 # Destructor
 <?php
class Fruit {
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }
  function __destruct() {
    echo "The fruit is {$this->name} and the color is {$this->color}.";
  }
}

$apple = new Fruit("Apple", "red");
?>

 # Access Modifiers
 <?php
class Fruit {
  public $name;
  public $color;
  public $weight;

  function set_name($n) {  // a public function (default)
    $this->name = $n;
  }
  protected function set_color($n) { // a protected function
    $this->color = $n;
  }
  private function set_weight($n) { // a private function
    $this->weight = $n;
  }
}

$mango = new Fruit();
$mango->set_name('Mango'); // OK
$mango->set_color('Yellow'); // ERROR
$mango->set_weight('300'); // ERROR
?>
 # Inheritance



 # Constants



 # Abstract Classes






 # Traits
 <?php
 trait message1 {
 public function msg1() {
     echo "OOP is fun! ";
   }
 }
 
 class Welcome {
   use message1;
 }
 
 $obj = new Welcome();
 $obj->msg1();
 ?>

<?php
trait message1 {
  public function msg1() {
    echo "OOP is fun! ";
  }
}

trait message2 {
  public function msg2() {
    echo "OOP reduces code duplication!";
  }
}

class Welcome {
  use message1;
}

class Welcome2 {
  use message1, message2;
}

$obj = new Welcome();
$obj->msg1();
echo "<br>";

$obj2 = new Welcome2();
$obj2->msg1();
$obj2->msg2();
?>


 # Static Methods
 <?php
 class greeting {
   public static function welcome() {
     echo "Hello World!";
   }
 }
 
 // Call static method
 greeting::welcome();
 ?>

 <?php
class greeting {
  public static function welcome() {
    echo "Hello World!";
  }

  public function __construct() {
    self::welcome();
  }
}

new greeting();
?>

<?php
class greeting {
  public static function welcome() {
    echo "Hello World!";
  }
}

class SomeOtherClass {
  public function message() {
    greeting::welcome();
  }
}
?>

<?php
class domain {
  protected static function getWebsiteName() {
    return "W3Schools.com";
  }
}

class domainW3 extends domain {
  public $websiteName;
  public function __construct() {
    $this->websiteName = parent::getWebsiteName();
  }
}

$domainW3 = new domainW3;
echo $domainW3 -> websiteName;
?>

 # Static Properties
<?php
class pi {
  public static $value = 3.14159;
}

// Get static property
echo pi::$value;
?>

<?php
class pi {
  public static $value=3.14159;
  public function staticValue() {
    return self::$value;
  }
}

$pi = new pi();
echo $pi->staticValue();
?>

<?php
class pi {
  public static $value=3.14159;
}

class x extends pi {
  public function xStatic() {
    return parent::$value;
  }
}

// Get value of static property directly via child class
echo x::$value;

// or get value of static property via xStatic() method
$x = new x();
echo $x->xStatic();
?>