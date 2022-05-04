<?php

// use Database\Models\BookModel;
// $books = BookModel::all();

// foreach($books as $book){
//     echo $book['title']." ".$book['edition']." ".$book['no_of_copies']." ".$book['language']." ".$book['condition']."<br/>";
// }
// echo " workking right now";

    require_once (__DIR__."/../layout/navbar.php");
?>

<link rel="stylesheet" href="/public/css/table.css">
<table>
<thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Password</th>
    </tr>
</thead>
<tbody>


        <tr>
            <td data-label="Name">{{ $value->name }}</td>
            <td data-label="Email Address">{{ $value->email }}</td>
            <td data-label="Phone Number">{{ $value->phone_num }}</td>
            <td data-label="Password">Password</td>
        </tr>

        <tr>
            <td data-label="Name">{{ $value->name }}</td>
            <td data-label="Email Address">{{ $value->email }}</td>
            <td data-label="Phone Number">{{ $value->phone_num }}</td>
            <td data-label="Password">Password</td>
        </tr>

        <tr>
            <td data-label="Name">{{ $value->name }}</td>
            <td data-label="Email Address">{{ $value->email }}</td>
            <td data-label="Phone Number">{{ $value->phone_num }}</td>
            <td data-label="Password">Password</td>
        </tr>

        <tr>
            <td data-label="Name">{{ $value->name }}</td>
            <td data-label="Email Address">{{ $value->email }}</td>
            <td data-label="Phone Number">{{ $value->phone_num }}</td>
            <td data-label="Password">Password</td>
        </tr>

        <tr>
            <td data-label="Name">{{ $value->name }}</td>
            <td data-label="Email Address">{{ $value->email }}</td>
            <td data-label="Phone Number">{{ $value->phone_num }}</td>
            <td data-label="Password">Password</td>
        </tr>

        <tr>
            <td data-label="Name">{{ $value->name }}</td>
            <td data-label="Email Address">{{ $value->email }}</td>
            <td data-label="Phone Number">{{ $value->phone_num }}</td>
            <td data-label="Password">Password</td>
        </tr>
</tbody>
</table>
