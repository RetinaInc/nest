    <div id="box">
      <h1>Welcome to <?php echo($title); ?></h1>
      <div class="block" id="block-login">
        <h2>Login</h2>
        <div class="content login">          
          <div class="flash">
            <br />
            <?php if (isset($_SESSION['error'])): ?>
            <div class="message error">
              <p><?php echo(($_SESSION['error'])); ?></p>
            </div>
            <?php endif; ?>
          </div>
          <form action="<?php echo($base_url); ?>?auth/authenticate" method="post" class="form login">
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">User</label>
              </div>
              <div class="right">
                <input id="username" name="username" type="text" class="text_field" />
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Password</label>
              </div>
              <div class="right">
                <input id="password" name="password" type="password" class="text_field" />
              </div>
            </div>
            <div class="group navform wat-cf">
              <div class="right">
                <button class="button" type="submit">
                  <img src="<?php echo($base_url); ?>media/images/icons/key.png" alt="Save" /> Login
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>    
    </div>