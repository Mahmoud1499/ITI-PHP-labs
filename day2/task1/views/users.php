<?php
$users = read_from_file();
// var_dump($users);
// $users = explode(";", $users);
// var_dump($usersArray);
$users = convert_file_to_array();

foreach ($users as $user) {
    $user_details = explode(",", $user);
    echo "<h3>Visit Date : $user_details[0]</h3> ";
    echo "<h3>IP Address: $user_details[1]</h3> ";
    echo "<h3>Email : $user_details[2]</h3> ";
    echo "<h3>Name : $user_details[3]</h3> ";
    echo "<hr>";
}