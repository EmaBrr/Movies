<?php

function connection() {
    return $conn = new mysqli("localhost", "root", "", "movies");
}

function all() {
    $conn = connection();
    $sql = "select a.*, CONCAT(b.name, ' ', b.surname) as Director
            from movies a 
            inner join directors b 
            on a.director_id = b.id";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function store() {
    $sql = "INSERT INTO `movies`
    (`ID`, `name`, `year`, `IMDB_score`, `IMDB_TOP250`, `Main_actor`, `Director_ID`)
    VALUES (NULL, 
            '".$_POST['name']."', 
            '".$_POST['year']."',
            '".$_POST['IMDB_score']."', 
            '".$_POST['IMDB_TOP250']."',
            '".$_POST['Main_actor']."', 
            '".$_POST['Director']."'
            );";
    // echo $sql; die;
    $conn = connection();
    $conn -> query($sql);
    $conn -> close();
}

function update() {
    $conn = connection();
    $sql = "UPDATE `movies` SET 
        `name` = '".$_POST['name']."', 
        `year` = '".$_POST['year']."', 
        `IMDB_score` = '".$_POST['IMDB_score']."', 
        `IMDB_TOP250` = '".$_POST['IMDB_TOP250']."', 
        `Main_actor` = '".$_POST['Main_actor']."' 
        `Director_ID` = '".$_POST['Director']."' 
        WHERE `movies`.`name` = '".$_POST['edit']."';";
    echo $sql; die;
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function find($name){
    $conn = connection();
    $sql = "select * from movies where name = '".$name."'";
    $car = $conn->query($sql);
    $conn->close();
    return (array) $car -> fetch_assoc();
}

function destroy(){
    $conn = connection();
    $sql = "DELETE FROM `movies` WHERE `movies`.`name` = '".$_POST['destroy']."'";
    $conn->query($sql);
    $conn->close();
}

?>