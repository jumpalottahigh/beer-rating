<?php
  // Fetch from the beer table and show data
  foreach($connect->query('SELECT * FROM beers') as $row) {
    echo '<!-- Card start -->
    <div class="col-xs-12 col-sm-6">
      <div class="card">
        <div class="col-xs-4">
          <img class="card-image" src="'.$row['image_url'].'" alt="">
        </div>
        <div class="col-xs-7 padding-top">
          <h4 class="card-heading text-info">'.$row['name'].'</h4>
          <p class="card-description">
            '.$row['description'].'
          </p>
          <div class="text-left">
            <a class="btn btn-primary btn-card-comments" href="comments.php?beer='.$row['name'].'">Comments</a>
          </div>
        </div>
        <div class="col-xs-1 text-center padding-none card-rating">
          <div class="vote-count" data-count="0">0</div>
          <i class="fa fa-caret-up text-success vote-control vote-up" aria-hidden="true"></i>
          <i class="fa fa-caret-down text-danger vote-control vote-down" aria-hidden="true"></i>
        </div>
      </div>
    </div>
    <!-- Card end -->';
  }
?>
