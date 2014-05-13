<?php require_once dirname(__FILE__ ) . '/header.html.php'; ?>

<?php if (!isset($_SESSION['authenticated']) or false == $_SESSION['authenticated']): ?>
    <?php require_once dirname(__FILE__) . '/../auth/login.html.php'; ?>
<?php else: ?>
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-forms"><?php echo($tab_title); ?></a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title"><?php echo($frm_title); ?></h2>
            <div class="inner">
                <?php if ('hotels' != $controller): ?>
                    <?php require_once dirname(__FILE__) . '/../partials/_bookingform.html.php'; ?>
                <?php else: ?>
                    <?php require_once dirname(__FILE__) . '/../partials/_hotels.html.php'; ?>
                <?php endif; ?>
            </div>
          </div>
        </div>

        <div id="footer">
          <div class="block">
            <p>Nest</p>
          </div>
        </div>
      </div>
      <?php require_once dirname(__FILE__) . '/../partials/side.html.php'; ?>
    </div>
<?php endif; ?>