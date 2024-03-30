<div class="row">
  <?php include 'admin_counters.php'; ?>
  <?php include 'admin_links.php'; ?>
  <?php include 'editors_choice.php'; ?>
  <?php include 'admin_stats.php'; ?>
</div><!-- /.row -->

<!-- admin_counters.php -->
<div class="col-lg-3">
  <div class="panel panel-warning">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <i class="fa fa-desktop fa-5x"></i>
        </div>
        <div class="col-xs-6 text-right">
          <p class="announcement-heading"><?= $webDetailsCount; ?></p>
          <p class="announcement-text"><strong>Web Details!</strong></p>
        </div>
      </div>
    </div>
    <a href="titles_view.php" class="panel-footer-link">
      <div class="panel-footer announcement-bottom">
        <div class="row">
          <div class="col-xs-6">
            View
          </div>
          <div class="col-xs-6 text-right">
            <i class="fa fa-arrow-circle-right"></i>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- admin_links.php -->
<div class="col-lg-3">
  <div class="panel panel-success">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <i class="fa fa-link fa-5x"></i>
        </div>
        <div class="col-xs-6 text-right">
          <p class="announcement-heading"><?= $linksCount; ?></p>
          <p class="announcement-text"><strong>Links</strong></p>
        </div>
      </div>
    </div>
    <a href="links_view.php" class="panel-footer-link">
      <div class="panel-footer announcement-bottom">
        <div class="row">
          <div class="col-xs-6">
            View
          </div>
          <div class="col-xs-6 text-right">
            <i class="fa fa-arrow-circle-right"></i>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- editors_choice.php -->
<div class="col-lg-3">
  <div class="panel panel-info">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <i class="fa fa-trophy fa-5x"></i>
        </div>
        <div class="col-xs-6 text-right">
          <p class="announcement-heading"><?= $editorsChoiceCount; ?></p>
          <p class="announcement-text"><strong>Editor's Choice</strong></p>
        </div>
      </div>
    </div>
    <a href="editors_choice_view.php" class="panel-footer-link">
      <div class="panel-footer announcement-bottom">
        <div class="row">
          <div class="col-xs-6">
            view
          </div>
          <div class="col-xs-6 text-right">
            <i class="fa fa-arrow-circle-right"></i>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- admin_stats.php -->
<div class="col-lg-3">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <i class="fa fa-bar-chart-o fa-5x"></i>
        </div>
        <div class="col-xs-6 text-right">
          <p class="announcement-heading"><?= $adminStatsCount; ?></p>
          <p class="announcement-text"><strong>Admin Stats</strong></p>
        </div>
      </div>
    </div>
    <a href="../adminstats" class="panel-footer-link">
      <div class="panel-footer announcement-bottom">
        <div class="row">
          <div class="col-xs-6">
            View
          </div>
          <div class="col-xs-6 text-right">
            <i class="fa fa-arrow-circle-right"></i>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>
