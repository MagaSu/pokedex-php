<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Pokemon font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Miltonian+Tattoo&display=swap"
      rel="stylesheet"
    />

    <!-- Montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400&display=swap"
      rel="stylesheet"
    />

    <!-- Styles -->
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <link rel="icon" href="assets/pokeball.png" type="image/png" />
    <title>Pokedex</title>
  </head> -->
  <?php
    $pokemonId = '';
    if(isset($_GET['searchValue'])){
      $pokemonId = $_GET['searchValue'];
    }
    if ($pokemonId == ''){
      $pokemonId = 1;
    }
    if (isset($pokemonId)){
      $api_url = "https://pokeapi.co/api/v2/pokemon/$pokemonId";
    } else {
      $api_url = "https://pokeapi.co/api/v2/pokemon/1";
    }

    $json_data = file_get_contents($api_url);
    $response_data = json_decode($json_data);

    $id = $response_data->id;
    $name = $response_data->name;
    $img = $response_data->sprites->front_default;
    $type = $response_data->types[0]->type->name;
    $height = $response_data->height;
    $weight = $response_data->weight;
    $hp = $response_data->stats[0]->base_stat;
    $xp = $response_data->base_experience;
    $moves = $response_data->moves;
    array_splice($moves, 4)


    // $img =
    // $response_data->sprites->other->dream_world->front_default == null
    //   ? $response_data->sprites->other->["official-artwork"]->front_default
    //   : $response_data->sprites->other->dream_world->front_default

  ?>
  <body>
    <div class="background">
      <video
        id="video-bg"
        width="100%"
        height="auto"
        preload="auto"
        autoplay
        loop
      >
        <source src="assets/pokeball.mp4" type="video/mp4" />
      </video>
    </div>
    <div id="cover"></div>
    <div id="content">
      <div class="container">
        <div class="intro">
          <h1 class="intro-title">Pokedex</h1>
        </div>
        <div id="search-section">
          <form class="search-form" action="" method="GET">
          <button id="previous" type="button" class="btn">Previous</button>
            <input id="input" name="searchValue" placeholder="Search Pokemon" type="text" />
            <button id="search" type="submit" class="btn">Search</button>
            <button id="next" type="button" class="btn">Next</button>
          </form>
        </div>
        <!-- <div id="loading-animation" class="lds-hourglass"></div> -->
        <div id="pokemon-display">
          <div id="show-error" class="disabled">
            <h1 id="error-title">Error 404</h1>
          </div>
          <div id="pokemon-content">
            <div id="pokemon">
              <div id="preview">
                <h1 id="pokemon-name"><?php echo $name ?></h1>
                <img id="pokemon-img" src="<?php echo $img ?>" />
              </div>
              <div id="info">
                <div class="pokemon-info-list">
                  <h3 id="info-title"></h3>
                  <div class="info-block">
                    <div class="qualities">
                      <p id="pokemon-type">Type: <?php echo $type ?></p>
                      <p id="pokemon-xp">Damage: <?php echo $xp ?>xp</p>
                      <p id="pokemon-hp">Health: <?php echo $hp ?>hp</p>
                    </div>
                    <div class="characteristic">
                      <p id="pokemon-id">ID: <?php echo $id ?></p>
                      <p id="pokemon-height">Height: <?php echo $height ?>m</p>
                      <p id="pokemon-weight">Weight: <?php echo $weight ?>kg</p>
                    </div>
                  </div>
                </div>
                <div class="pokemon-moves-list">
                  <h3 id="moves-title"></h3>
                  <ul id="pokemon-moves">
                    <?php 
                      foreach ($moves as $key=>$move){
                        $x = $key + 1;
                        echo "<li id=move$x>{$move->move->name}</li>";
                      }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>