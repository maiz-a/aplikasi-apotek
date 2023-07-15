<?php

$conn = mysqli_connect('localhost', 'root', 'rahasia7', 'apotek_syifa2');

function get($query)
{
  global $conn;

  $query = mysqli_query($conn, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
  }

  return $rows;
}

function get_where($query)
{
  global $conn;

  $query = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($query);
  return $row;
}

function get_one($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}


function create($query)
{
  global $conn;

  $query = mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function update($query)
{
  global $conn;

  $query = mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function delete($query)
{
  global $conn;

  $query = mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function register()
{
  global $conn;

  $username = 'admin';
  $password = password_hash('password', PASSWORD_DEFAULT);
  $created_at = date('Y-m-d H:i:s');

  mysqli_query($conn, "INSERT INTO users VALUES('', '1', '$username', '$password', '', '$created_at')");
  return mysqli_affected_rows($conn);
}
?>
