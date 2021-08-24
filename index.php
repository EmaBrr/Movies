<?php

include("./functions.php");

if (isset($_POST['edit'])) {
    update();
    header("location:./");
    die;
}

if (isset($_POST['create'])) {
    store();
    header("location:./");
    die;
}

if (isset($_POST['destroy'])) {
    destroy();
    header("location:./");
    die;
}

if (isset($_GET['edit'])) {
    $movies = find($_GET['edit']);
    // print_r($movies);die;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
    <title>Movies</title>
</head>
<body>

    <h2>Wanna add?</h2>
    <div class="questionaire">
        <form action="" method="post">
            <div class="input">
                <label for="">Movie name: </label>
                <input type="text" name="name" placeholder="Movie name" value = "<?=(isset($movies)) ? $movies['name'] : ""?>">
            </div>
            <div class="input">
                <label for="">Year: </label>
                <input type="text" name="year" placeholder="Year" value = "<?=(isset($movies)) ? $movies['year'] : ""?>">
            </div>
            <div class="input">
                <label for="">IMDB score: </label>
                <input type="text" name="IMDB_score" placeholder="IMDB score" value = "<?=(isset($movies)) ? $movies['IMDB_score'] : ""?>">
            </div>
            <div class="input">
                <label for="">Included in IMDB TOP 250? (1: yes, 0: no): </label>
                <input type="number" name="IMDB_TOP250" placeholder="IMDB TOP250" min = 0 max = 1 value = "<?=(isset($movies)) ? $movies['IMDB_TOP250'] : ""?>">
            </div>
            <div class="input">
                <label for="">Main actor: </label>
                <input type="text" name="Main_actor" placeholder="Main actor" value = "<?=(isset($movies)) ? $movies['Main_actor'] : ""?>">
            </div>
            <div class="input">
                <label for="">Director: </label>
                <select class="select" name="Director" value = "<?=(isset($movies)) ? $movies['Director'] : ""?>">
                    <option value="1">Christopher Nolan</option>
                    <option value="2">Steven Spielberg</option>
                    <option value="3">Quentin Tarantino</option>
                    <option value="4">Martin Scorsese</option>
                </select>
            </div>
            <div class="buttons" style = "justify-content: center; display: flex;">
                <?php
                if (isset($movies)) {
                    echo '<button class = "update" type="submit" value="'.$movies['name'].'" name = "edit" style = "background-color: green; padding: 5px 15px; font-size: 15px;">Atnaujinti</button>';
                } else {
                    echo '<button class = "create" type="submit" value="" name = "create" style = "color: white; background-color: rgb(70, 75, 117); padding: 5px 15px; font-size: 15px;">Įrašyti naują įrašą</button>'; //nereikia value paduoti id, nes naują kuriam, tai jis id dar neturi
                }
                ?>
            </div>

        </form>
    </div> 

    <div class="results">
        <table class="table">
            <thead>
                <tr>
                    <th>Movie name</th>
                    <th>Year</th>
                    <th>IMDB score Model</th>
                    <th>Included into IMDB TOP 250?</th>
                    <th>Main actor</th>
                    <th>Director</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

            <?php
                foreach (all() as $movies) {
                    if ($movies['IMDB_TOP250'] == 1 ) {
                        $status = 'Yes';
                    } else {
                        $status = 'No';
                    };

                    echo '<tr>';
                            echo '<td align="center">' . $movies['name'] . '</td>';
                            echo '<td align="center">' . $movies['year'] . '</td>';
                            echo '<td align="center">' . $movies['IMDB_score'] . '</td>';
                            echo '<td align="center">' . $status . '</td>';
                            echo '<td align="center">' . $movies['Main_actor'] . '</td>';
                            echo '<td align="center">' . $movies['Director'] . '</td>';
                            echo '<td align="center"> 
                                    <form action="" method="get">
                                        <button class = "edit" type="submit" name = "edit" value="'. $movies['name'] .'" style = "background-color: green; padding: 5px 8px; font-size: 15px;">Edit</button>
                                    </form>
                                </td>';
                            echo '<td align="center"> 
                                    <form action="" method="post">
                                        <button class = "delete" type="submit" name = "destroy" value="'. $movies['name'] .'" style = "background-color:#FF6347; padding: 5px 8px; font-size: 15px;">Delete</button>
                                    </form>
                                </td>';
                            echo  '</tr>';  
            }
            ?>
            </tbody>
        </table>


    </div>
    
</body>
</html>
