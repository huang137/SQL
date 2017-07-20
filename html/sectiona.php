
<?php // sectiona.php

  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  echo <<<_END
  <form action="sectiona.php" method="post"><pre>
    First name: <input type="text" name="fname">
    Last name:  <input type="text" name="lname">
    User Type:  <select name="type">
                 <option value="user" >user</option>
                 <option value="admin" >admin</option>
               </select>
    Email:      <input type="text" name="email">
    Password:   <input type="text" name="password"><br>
    <input type="submit" value="Submit">
  </pre></form>
_END;

  if (isset($_POST['fname'])   &&
      isset($_POST['lname'])    &&
      isset($_POST['type']) &&
      isset($_POST['email'])     &&
      isset($_POST['password']))
  {

    $query = $conn->prepare('INSERT INTO user_profiles VALUES(?,?,?,?,?,?)');
    $query->bind_param('ssssss', $fname, $lname, $type, $timestamp, $email, $password);
    $fname   = get_post($conn, 'fname');
    $lname    = get_post($conn, 'lname');
    $type = get_post($conn, 'type');
    $email     = get_post($conn, 'email');
    $password     = get_post($conn, 'password');
    $timestamp = date('Y-m-d G:i:s');
    //$query->execute();
    if ($query->execute()) { 
       echo "Insert successful.";
    } else {
       echo "Insert error.";
    }
  }

  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>