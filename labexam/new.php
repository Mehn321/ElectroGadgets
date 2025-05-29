<?php
// Start session - must be at the beginning before any output
session_start();

// Basic PHP syntax and variables
$string_var = "Hello World";
$integer_var = 42;
$float_var = 3.14;
$boolean_var = true;
$null_var = null;
$array_var = ["apple", "banana", "orange"];
$associative_array = [
    "name" => "John Doe",
    "age" => 30,
    "email" => "john@example.com"
];

// Constants
define("PI", 3.14159);
const APP_NAME = "My PHP Application";

// Output methods
echo "<h2>Output Methods</h2>";
echo "Using echo: $string_var <br>";
print("Using print: $integer_var <br>");
printf("Formatted output: %.2f <br>", $float_var);
var_dump($array_var); // Detailed output with type information
echo "<br>";

// String operations
echo "<h2>String Operations</h2>";
$first_name = "John";
$last_name = "Doe";
$full_name = $first_name . " " . $last_name; // Concatenation
echo "Concatenation: $full_name <br>";
echo "String length: " . strlen($full_name) . "<br>";
echo "Uppercase: " . strtoupper($full_name) . "<br>";
echo "Lowercase: " . strtolower($full_name) . "<br>";
echo "Replace: " . str_replace("John", "Jane", $full_name) . "<br>";
echo "Substring: " . substr($full_name, 0, 4) . "<br>";

// Arithmetic operations
echo "<h2>Arithmetic Operations</h2>";
$a = 10;
$b = 3;
echo "Addition: " . ($a + $b) . "<br>";
echo "Subtraction: " . ($a - $b) . "<br>";
echo "Multiplication: " . ($a * $b) . "<br>";
echo "Division: " . ($a / $b) . "<br>";
echo "Modulus: " . ($a % $b) . "<br>";
echo "Exponentiation: " . ($a ** $b) . "<br>";

// Comparison operators
echo "<h2>Comparison Operators</h2>";
echo "Equal: " . ($a == $b) . "<br>";
echo "Identical: " . ($a === $b) . "<br>";
echo "Not equal: " . ($a != $b) . "<br>";
echo "Not identical: " . ($a !== $b) . "<br>";
echo "Greater than: " . ($a > $b) . "<br>";
echo "Less than: " . ($a < $b) . "<br>";
echo "Greater than or equal: " . ($a >= $b) . "<br>";
echo "Less than or equal: " . ($a <= $b) . "<br>";

// Logical operators
echo "<h2>Logical Operators</h2>";
$x = true;
$y = false;
echo "AND: " . ($x && $y) . "<br>";
echo "OR: " . ($x || $y) . "<br>";
echo "NOT: " . (!$x) . "<br>";

// Conditional statements
echo "<h2>Conditional Statements</h2>";
$score = 85;

// If-else statement
if ($score >= 90) {
    echo "Grade: A<br>";
} elseif ($score >= 80) {
    echo "Grade: B<br>";
} elseif ($score >= 70) {
    echo "Grade: C<br>";
} elseif ($score >= 60) {
    echo "Grade: D<br>";
} else {
    echo "Grade: F<br>";
}

// Switch statement
$day = "Monday";
switch ($day) {
    case "Monday":
        echo "It's the start of the work week<br>";
        break;
    case "Friday":
        echo "It's almost the weekend<br>";
        break;
    case "Saturday":
    case "Sunday":
        echo "It's the weekend<br>";
        break;
    default:
        echo "It's a weekday<br>";
}

// Ternary operator
$age = 20;
$status = ($age >= 18) ? "Adult" : "Minor";
echo "Status: $status<br>";

// Null coalescing operator
$user = null;
$username = $user ?? "Guest";
echo "Username: $username<br>";

// Loops
echo "<h2>Loops</h2>";

// For loop
echo "For loop: ";
for ($i = 0; $i < 5; $i++) {
    echo "$i ";
}
echo "<br>";

// While loop
echo "While loop: ";
$j = 0;
while ($j < 5) {
    echo "$j ";
    $j++;
}
echo "<br>";

// Do-while loop
echo "Do-while loop: ";
$k = 0;
do {
    echo "$k ";
    $k++;
} while ($k < 5);
echo "<br>";

// Foreach loop
echo "Foreach loop with indexed array: ";
foreach ($array_var as $fruit) {
    echo "$fruit ";
}
echo "<br>";

echo "Foreach loop with associative array: ";
foreach ($associative_array as $key => $value) {
    echo "$key: $value, ";
}
echo "<br>";

// Functions
echo "<h2>Functions</h2>";

// Basic function
function greet($name) {
    return "Hello, $name!";
}
echo greet("Alice") . "<br>";

// Default parameters
function calculateTotal($price, $tax = 0.1) {
    return $price + ($price * $tax);
}
echo "Total: $" . calculateTotal(100) . "<br>";
echo "Total with custom tax: $" . calculateTotal(100, 0.05) . "<br>";

// Variable scope
$global_var = "I'm global";
function testScope() {
    $local_var = "I'm local";
    global $global_var;
    echo "Inside function: $global_var<br>";
    echo "Inside function: $local_var<br>";
}
testScope();
echo "Outside function: $global_var<br>";
// echo "Outside function: $local_var<br>"; // This would cause an error

// Arrays
echo "<h2>Arrays</h2>";

// Indexed array operations
$colors = ["red", "green", "blue"];
echo "Array count: " . count($colors) . "<br>";
array_push($colors, "yellow"); // Add to end
array_unshift($colors, "purple"); // Add to beginning
echo "After adding elements: " . implode(", ", $colors) . "<br>";

$last_color = array_pop($colors); // Remove from end
$first_color = array_shift($colors); // Remove from beginning
echo "After removing elements: " . implode(", ", $colors) . "<br>";
echo "Removed elements: $first_color, $last_color<br>";

// Array functions
$numbers = [5, 3, 8, 1, 9, 4];
sort($numbers);
echo "Sorted numbers: " . implode(", ", $numbers) . "<br>";

$reversed = array_reverse($numbers);
echo "Reversed: " . implode(", ", $reversed) . "<br>";

$filtered = array_filter($numbers, function($n) {
    return $n > 3;
});
echo "Filtered (> 3): " . implode(", ", $filtered) . "<br>";

$mapped = array_map(function($n) {
    return $n * 2;
}, $numbers);
echo "Mapped (doubled): " . implode(", ", $mapped) . "<br>";

$sum = array_reduce($numbers, function($carry, $n) {
    return $carry + $n;
}, 0);
echo "Sum: $sum<br>";

// Multidimensional arrays
$students = [
    ["name" => "Alice", "grade" => 85],
    ["name" => "Bob", "grade" => 92],
    ["name" => "Charlie", "grade" => 78]
];
echo "Students:<br>";
foreach ($students as $student) {
    echo "- {$student['name']}: {$student['grade']}<br>";
}

// Date and Time
echo "<h2>Date and Time</h2>";
echo "Current date: " . date("Y-m-d") . "<br>";
echo "Current time: " . date("H:i:s") . "<br>";
echo "Current timestamp: " . time() . "<br>";
echo "Date from timestamp: " . date("Y-m-d H:i:s", time()) . "<br>";
echo "Date 7 days from now: " . date("Y-m-d", time() + (7 * 24 * 60 * 60)) . "<br>";

// Form handling
echo "<h2>Form Handling</h2>";
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    
    <input type="submit" value="Submit">
</form>

<?php
// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    
    if (empty($name)) {
        echo "<p style='color: red;'>Name is required</p>";
    } elseif (empty($email)) {
        echo "<p style='color: red;'>Email is required</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color: red;'>Invalid email format</p>";
    } else {
        echo "<p>Form submitted successfully!</p>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
    }
}

// File handling
echo "<h2>File Handling</h2>";

// Writing to a file
$file_path = "example.txt";
$file = fopen($file_path, "w") or die("Unable to open file!");
fwrite($file, "Hello, World!\n");
fwrite($file, "This is a test file created by PHP.\n");
fclose($file);
echo "File written successfully.<br>";

// Reading from a file
$file = fopen($file_path, "r") or die("Unable to open file!");
echo "File contents:<br>";
while(!feof($file)) {
    echo fgets($file) . "<br>";
}
fclose($file);

// File information
echo "File size: " . filesize($file_path) . " bytes<br>";
echo "File last modified: " . date("Y-m-d H:i:s", filemtime($file_path)) . "<br>";

// Database operations
echo "<h2>Database Operations (MySQL)</h2>";
echo "Example code for database operations:<br>";
?>

<pre>
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Insert data
$sql = "INSERT INTO users (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Select data
$sql = "SELECT id, firstname, lastname FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

// Update data
$sql = "UPDATE users SET lastname='Smith' WHERE id=1";
$conn->query($sql);

// Delete data
$sql = "DELETE FROM users WHERE id=1";
$conn->query($sql);

// Close connection
$conn->close();
</pre>

<?php
// Sessions and cookies
echo "<h2>Sessions and Cookies</h2>";

// Session variables
$_SESSION["user_id"] = 123;
$_SESSION["username"] = "john_doe";
echo "Session variables set.<br>";
echo "Session ID: " . session_id() . "<br>";
echo "Session variables: user_id=" . $_SESSION["user_id"] . ", username=" . $_SESSION["username"] . "<br>";

// Cookies
setcookie("user_preference", "dark_mode", time() + (86400 * 30), "/"); // 30 days
echo "Cookie set.<br>";
echo "Note: Cookies can be accessed on subsequent page loads.<br>";

// Error handling
echo "<h2>Error Handling</h2>";

// Error reporting settings
echo "Current error reporting level: " . error_reporting() . "<br>";
echo "Example of error handling with try-catch:<br>";
?>

<pre>
try {
    // Code that might throw an exception
    $result = 10 / 0; // This will cause a division by zero error
} catch (Exception $e) {
    // Handle the exception
    echo "Caught exception: " . $e->getMessage();
} finally {
    // This code always runs
    echo "Process completed";
}
</pre>

<?php
// Custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "Custom error: [$errno] $errstr - $errfile:$errline<br>";
    return true; // Don't execute PHP's internal error handler
}
// set_error_handler("customErrorHandler");

// Object-Oriented Programming
echo "<h2>Object-Oriented Programming</h2>";
?>

<?php>
// Class definition
class Person {
    // Properties
    public $name;
    private $age;
    protected $email;
    
    // Constructor
    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }
    
    // Methods
    public function greet() {
        return "Hello, my name is {$this->name}";
    }
    
    // Getter and setter
    public function getAge() {
        return $this->age;
    }
    
    public function setAge($age) {
        if ($age >= 0 && $age <= 120) {
            $this->age = $age;
        }
    }
    // Static method
        public static function getSpecies() {
            return "Homo sapiens";
        }
        
        // Destructor
        public function __destruct() {
            // Cleanup code
            // echo "Person object destroyed";
        }
    }
    
    // Inheritance
    class Student extends Person {
        private $studentId;
        private $grade;
        
        public function __construct($name, $age, $email, $studentId, $grade) {
            parent::__construct($name, $age, $email);
            $this->studentId = $studentId;
            $this->grade = $grade;
        }
        
        public function getStudentInfo() {
            return "Student ID: {$this->studentId}, Grade: {$this->grade}";
        }
        
        // Method overriding
        public function greet() {
            return parent::greet() . " and I'm a student";
        }
    }
    
    // Interface
    interface Printable {
        public function printInfo();
    }
    
    // Class implementing an interface
    class Document implements Printable {
        private $title;
        
        public function __construct($title) {
            $this->title = $title;
        }
        
        public function printInfo() {
            return "Document: {$this->title}";
        }
    }
    
    // Abstract class
    abstract class Shape {
        protected $color;
        
        public function __construct($color) {
            $this->color = $color;
        }
        
        abstract public function calculateArea();
        
        public function getColor() {
            return $this->color;
        }
    }
    
    // Concrete class extending abstract class
    class Circle extends Shape {
        private $radius;
        
        public function __construct($color, $radius) {
            parent::__construct($color);
            $this->radius = $radius;
        }
        
        public function calculateArea() {
            return pi() * $this->radius * $this->radius;
        }
    }
    
    // Using traits
    trait Loggable {
        public function log($message) {
            echo "Log: $message<br>";
        }
    }
    
    class User {
        use Loggable;
        
        private $username;
        
        public function __construct($username) {
            $this->username = $username;
            $this->log("User $username created");
        }
    }
    ?>
    
    <?php
    // Using the OOP examples
    echo "Creating a Person object:<br>";
    $person = new Person("John Doe", 30, "john@example.com");
    echo $person->greet() . "<br>";
    echo "Age: " . $person->getAge() . "<br>";
    echo "Species: " . Person::getSpecies() . "<br>";
    
    echo "<br>Creating a Student object:<br>";
    $student = new Student("Jane Smith", 20, "jane@example.com", "S12345", "A");
    echo $student->greet() . "<br>";
    echo $student->getStudentInfo() . "<br>";
    
    echo "<br>Using an interface:<br>";
    $document = new Document("PHP Tutorial");
    echo $document->printInfo() . "<br>";
    
    echo "<br>Using an abstract class:<br>";
    $circle = new Circle("Red", 5);
    echo "Circle color: " . $circle->getColor() . "<br>";
    echo "Circle area: " . $circle->calculateArea() . "<br>";
    
    echo "<br>Using traits:<br>";
    $user = new User("admin");
    $user->log("User logged in");
    
    // Regular expressions
    echo "<h2>Regular Expressions</h2>";
    $pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $email = "test@example.com";
    if (preg_match($pattern, $email)) {
        echo "Valid email format: $email<br>";
    } else {
        echo "Invalid email format: $email<br>";
    }
    
    $text = "The quick brown fox jumps over the lazy dog";
    echo "Original text: $text<br>";
    echo "Replace 'fox' with 'cat': " . preg_replace("/fox/", "cat", $text) . "<br>";
    
    $pattern = "/\b(\w+)\b/";
    preg_match_all($pattern, $text, $matches);
    echo "Words found: " . count($matches[0]) . "<br>";
    echo "First three words: " . implode(", ", array_slice($matches[0], 0, 3)) . "<br>";
    
    // JSON handling
    echo "<h2>JSON Handling</h2>";
    $person_array = [
        "name" => "John Doe",
        "age" => 30,
        "email" => "john@example.com",
        "address" => [
            "street" => "123 Main St",
            "city" => "Anytown",
            "zip" => "12345"
        ],
        "hobbies" => ["reading", "hiking", "photography"]
    ];
    
    // Convert array to JSON
    $json_data = json_encode($person_array, JSON_PRETTY_PRINT);
    echo "Array to JSON:<br>";
    echo "<pre>" . htmlspecialchars($json_data) . "</pre>";
    
    // Convert JSON to array
    $decoded_data = json_decode($json_data, true);
    echo "JSON to array:<br>";
    echo "Name: " . $decoded_data["name"] . "<br>";
    echo "City: " . $decoded_data["address"]["city"] . "<br>";
    echo "Hobbies: " . implode(", ", $decoded_data["hobbies"]) . "<br>";
    
    // XML handling
    echo "<h2>XML Handling</h2>";
    $xml_string = <<<XML
    <?xml version="1.0" encoding="UTF-8"?>
    <bookstore>
      <book category="fiction">
        <title>Harry Potter</title>
        <author>J.K. Rowling</author>
        <price>19.99</price>
      </book>
      <book category="non-fiction">
        <title>The Art of Computer Programming</title>
        <author>Donald Knuth</author>
        <price>59.99</price>
      </book>
    </bookstore>
    XML;
    
    // SimpleXML
    $xml = simplexml_load_string($xml_string);
    echo "Parsing XML with SimpleXML:<br>";
    echo "First book title: " . $xml->book[0]->title . "<br>";
    echo "First book author: " . $xml->book[0]->author . "<br>";
    echo "Second book price: $" . $xml->book[1]->price . "<br>";
    
    // Iterating through XML
    echo "All books:<br>";
    foreach ($xml->book as $book) {
        echo "- " . $book->title . " by " . $book->author . " ($" . $book->price . ")<br>";
    }
    
    // Namespaces
    echo "<h2>Namespaces</h2>";
    ?>
    
    <pre>
    // File: MyApp/Utilities/Calculator.php
    namespace MyApp\Utilities;
    
    class Calculator {
        public function add($a, $b) {
            return $a + $b;
        }
        
        public function subtract($a, $b) {
            return $a - $b;
        }
    }
    
    // File: MyApp/Models/User.php
    namespace MyApp\Models;
    
    class User {
        private $name;
        
        public function __construct($name) {
            $this->name = $name;
        }
        
        public function getName() {
            return $this->name;
        }
    }
    
    // Using namespaced classes
    use MyApp\Utilities\Calculator;
    use MyApp\Models\User as UserModel;
    
    $calc = new Calculator();
    echo $calc->add(5, 3); // 8
    
    $user = new UserModel("John");
    echo $user->getName(); // John
    
    // Using fully qualified names
    $calc2 = new \MyApp\Utilities\Calculator();
    </pre>
    
    <?php
    // Security best practices
    echo "<h2>Security Best Practices</h2>";
    ?>
    
    <pre>
    // 1. Sanitize input
    $user_input = $_POST['user_input'] ?? '';
    $sanitized_input = htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');
    
    // 2. Prepared statements for database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // 3. Password hashing
    $password = "user_password";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Verify password
    if (password_verify($password, $hashed_password)) {
        echo "Password is valid!";
    }
    
    // 4. CSRF protection
    // Generate token
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    
    // In form
    echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
    
    // Validate token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF attack detected");
    }
    
    // 5. Secure cookies
    session_set_cookie_params([
        'lifetime' => 3600,
        'path' => '/',
        'domain' => 'example.com',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    </pre>
    
    <?php
    // PHP configuration and environment
    echo "<h2>PHP Configuration</h2>";
    echo "PHP Version: " . phpversion() . "<br>";
    echo "Loaded Extensions: " . implode(", ", get_loaded_extensions()) . "<br>";
    echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
    echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
    echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";
    echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
    echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
    echo "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
    
    // Debugging techniques
    echo "<h2>Debugging Techniques</h2>";
    ?>
    
    <pre>
    // 1. Error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // 2. var_dump() for detailed variable information
    $variable = ["name" => "John", "age" => 30];
    var_dump($variable);
    
    // 3. print_r() for readable array output
    print_r($variable);
    
    // 4. debug_backtrace() for call stack
    $trace = debug_backtrace();
    print_r($trace);
    
    // 5. Custom debug function
    function debug($var, $exit = false) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if ($exit) exit;
    }
    
    // 6. Logging to file
    error_log("Error message", 3, "error.log");
    </pre>
    
    <?php
    // Performance optimization
    echo "<h2>Performance Optimization</h2>";
    ?>
    
    <pre>
    // 1. Use opcode caching (OPcache)
    // php.ini configuration:
    // opcache.enable=1
    // opcache.memory_consumption=128
    // opcache.interned_strings_buffer=8
    // opcache.max_accelerated_files=4000
    
    // 2. Minimize database queries
    // Bad:
    foreach ($users as $user) {
        $query = "SELECT * FROM orders WHERE user_id = " . $user['id'];
        // Execute query for each user
    }
    
    // Good:
    $user_ids = array_column($users, 'id');
    $query = "SELECT * FROM orders WHERE user_id IN (" . implode(',', $user_ids) . ")";
    // Execute single query for all users
    
    // 3. Use caching for expensive operations
    $cache_key = 'user_stats_' . $user_id;
    $result = cache_get($cache_key);
    if ($result === false) {
        $result = calculate_expensive_stats($user_id);
        cache_set($cache_key, $result, 3600); // Cache for 1 hour
    }
    
    // 4. Optimize loops
    // Bad:
    $count = count($large_array);
    for ($i = 0; $i < $count; $i++) {
        // Process each item
    }
    
    // Good:
    $count = count($large_array);
    for ($i = 0; $i < $count; ++$i) {
        // Process each item (pre-increment is slightly faster)
    }
    
    // 5. Use single quotes for strings without variables
    $name = 'John'; // Slightly faster than double quotes
    
    // 6. Avoid using @ error suppression operator
    // It significantly slows down code execution
    </pre>
    
    <?php
    // Common PHP frameworks
    echo "<h2>Common PHP Frameworks</h2>";
    echo "<ul>";
    echo "<li><strong>Laravel</strong> - Full-featured MVC framework with elegant syntax</li>";
    echo "<li><strong>Symfony</strong> - Component-based framework, very flexible</li>";
    echo "<li><strong>CodeIgniter</strong> - Lightweight framework with small footprint</li>";
    echo "<li><strong>Yii</strong> - High-performance component-based framework</li>";
    echo "<li><strong>CakePHP</strong> - Rapid development framework with code generation</li>";
    echo "<li><strong>Zend/Laminas</strong> - Enterprise-ready framework</li>";
    echo "<li><strong>Slim</strong> - Micro-framework for simple applications and APIs</li>";
    echo "<li><strong>Lumen</strong> - Micro-framework by Laravel for microservices and APIs</li>";
    echo "</ul>";
    
    // Composer and package management
    echo "<h2>Composer and Package Management</h2>";
    ?>
    
    <pre>
    // composer.json example
    {
        "name": "vendor/project",
        "description": "Project description",
        "type": "project",
        "require": {
            "php": ">=7.4",
            "monolog/monolog": "^2.0",
            "g