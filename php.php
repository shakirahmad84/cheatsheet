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

// The $this Keyword
<?php
class Fruit {
  public $name;
  function set_name($name) {
    $this->name = $name;
  }
}
$apple = new Fruit();
$apple->set_name("Apple");
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
 # Static Methods
 # Static Properties