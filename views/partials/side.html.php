      <div id="sidebar">
        <div class="block">
          <h3>Current User: <?php echo($_SESSION['username']); ?></h3>
        </div>

        <div class="block notice">
          <div class="sidebar-block">
            <h4>Create Hotel</h4>
              <form id="frmBooking" action="<?php echo("{$base_url}?hotels/save"); ?>" method="post" class="form">
                <div class="group">
                  <label class="label"><b style="color: white">Hotel Name</b></label>
                  <input id="name" name="name" type="text" class="text_field" />
                </div>
                <div class="group">
                    <div class="fieldWithErrors">
                          <input type="Submit" value="Create" class="button" />
                    </div>
                </div>
             </form>
          </div>
        </div>
      </div>