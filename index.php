<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Beer Comments</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Beer comments</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.html">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#create-account-modal" class="" data-toggle="modal" data-target="#create-account-modal">Create account</a></li>
          <li><a href="#login-modal" class="btn btn-primary login-button" data-toggle="modal" data-target="#login-modal">Login</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="alert alert-info text-center">Beer Comments</h1>
        </div>
      </div>
      <div class="row">
        <!-- Card start -->
        <div class="col-xs-12 col-sm-6">
          <div class="card">
            <div class="col-xs-3">
              <img class="card-image" src="assets/img/carlsberg.jpg" alt="Carlsberg">
            </div>
            <div class="col-xs-8 padding-top">
              <p class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque fugit natus facere similique obcaecati magni, laudantium excepturi voluptate blanditiis vitae, ad ducimus quasi rerum eveniet mollitia consequatur esse temporibus vel.
              </p>
              <div>
                <a class="btn-card-comments" href="#">Comments</a>
              </div>
            </div>
            <div class="col-xs-1 text-center padding-none card-rating">
              <div class="vote-count" data-count="0">0</div>
              <i class="glyphicon glyphicon-chevron-up text-success vote-control vote-up"></i>
              <i class="glyphicon glyphicon-chevron-down text-danger vote-control vote-down"></i>
            </div>
            <!-- COMMENTS PART OF THE CARD - HIDDEN AT START -->
            <div class="card-comments col-xs-12" style="display:none;">
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Card end -->
        <!-- Card start -->
        <div class="col-xs-12 col-sm-6">
          <div class="card">
            <div class="col-xs-3">
              <img class="card-image" src="assets/img/becks.jpg" alt="Becks">
            </div>
            <div class="col-xs-8 padding-top">
              <p class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque fugit natus facere similique obcaecati magni, laudantium excepturi voluptate blanditiis vitae, ad ducimus quasi rerum eveniet mollitia consequatur esse temporibus vel.
              </p>
              <div>
                <a class="btn-card-comments" href="#">Comments</a>
              </div>
            </div>
            <div class="col-xs-1 text-center padding-none card-rating">
              <div class="vote-count" data-count="0">0</div>
              <i class="glyphicon glyphicon-chevron-up text-success vote-control vote-up"></i>
              <i class="glyphicon glyphicon-chevron-down text-danger vote-control vote-down"></i>
            </div>
            <!-- COMMENTS PART OF THE CARD - HIDDEN AT START -->
            <div class="card-comments col-xs-12" style="display:none;">
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Card end -->
        <!-- Card start -->
        <div class="col-xs-12 col-sm-6">
          <div class="card">
            <div class="col-xs-3">
              <img class="card-image" src="assets/img/Heineken.jpg" alt="Heineken">
            </div>
            <div class="col-xs-8 padding-top">
              <p class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque fugit natus facere similique obcaecati magni, laudantium excepturi voluptate blanditiis vitae, ad ducimus quasi rerum eveniet mollitia consequatur esse temporibus vel.
              </p>
              <div>
                <a class="btn-card-comments" href="#">Comments</a>
              </div>
            </div>
            <div class="col-xs-1 text-center padding-none card-rating">
              <div class="vote-count" data-count="0">0</div>
              <i class="glyphicon glyphicon-chevron-up text-success vote-control vote-up"></i>
              <i class="glyphicon glyphicon-chevron-down text-danger vote-control vote-down"></i>
            </div>
            <!-- COMMENTS PART OF THE CARD - HIDDEN AT START -->
            <div class="card-comments col-xs-12" style="display:none;">
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Card end -->
      </div>
    </div>
  </section>

  <!-- Modals -->
  <!-- Login modal -->
  <div id="login-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center">Login</h4>
        </div>
        <div class="modal-body">
          <form action="login.php" method="POST">
            <div class="form-group">
              <label for="login-email">Email address</label>
              <input type="email" class="form-control" id="login-email" name="login-email" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="login-password">Password</label>
              <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Create account modal -->
  <div id="create-account-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center">Create an account</h4>
        </div>
        <div class="modal-body">
          <form action="create-account.php" method="POST">
            <div class="form-group">
              <label for="create-account-name">Display name</label>
              <input type="text" class="form-control" id="create-account-name" name="create-account-name" placeholder="Name" required>
            </div>
            <div class="form-group">
              <label for="create-account-email">Email address</label>
              <input type="email" class="form-control" id="create-account-email" name="create-account-email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="create-account-password">Password</label>
              <input type="password" class="form-control" id="create-account-password" name="create-account-password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="create-account-confirm-password">Confirm password</label>
              <input type="password" class="form-control" id="create-account-confirm-password" name="create-account-confirm-password" placeholder="Password again" required>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" required> I agree with the TOS.
              </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- jQuery3 -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- App -->
  <script src="assets/js/app.js"></script>
</body>

</html>
