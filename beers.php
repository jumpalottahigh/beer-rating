<?php
  // Fetch from the beer table and show data
  foreach($connect->query('SELECT * FROM beers') as $beer_row) {
    echo '<!-- Card start -->
          <div class="col-xs-12 col-sm-6">
            <div class="card" data-beer-id="'.$beer_row['id'].'">
              <div class="col-xs-4">
                <img class="card-image" src="'.$beer_row['image_url'].'" alt="">
              </div>
              <div class="col-xs-7 padding-top">
                <h4 class="card-heading text-info">'.$beer_row['name'].'</h4>
                <p class="card-description">
                  '.$beer_row['description'].'
                </p>
                <div class="text-left">
                  <a class="btn btn-primary btn-card-comments" href="comments.php?beer='.$beer_row['name'].'">Comments</a>
                </div>
              </div>
              <div class="col-xs-1 text-center padding-none card-rating">
                <div class="vote-count" data-score="'.$beer_row['score'].'">'.$beer_row['score'].'</div>';

    // Only display voting controls to logged in users.
    if (isset($_SESSION['email'])) {
      // Grab user votes and compare to beer id to figure out which beers the user has already voted for
      foreach($connect->query('SELECT * FROM users WHERE email = "'.$_SESSION['email'].'"') as $r) {
        // Create an array with user votes
        $userBeerVotes = explode(',', $r['votes']);

        // If the user has voted for the beer with the particular id, it will exist in the array
        // Generate the UI accordingly
        if (in_array($beer_row['id'], $userBeerVotes)) {
          echo '<i class="fa fa-caret-down text-danger vote-control vote-down" aria-hidden="true"></i>';
        } else {
          echo '<i class="fa fa-caret-up text-success vote-control vote-up" aria-hidden="true"></i>';
          echo '<i class="fa fa-caret-down text-danger vote-control vote-down" aria-hidden="true"></i>';
        }

      }

    }

    echo '</div>
        </div>
      </div>
      <!-- Card end -->';
  }
?>
