              <form id="frmBooking" action="<?php echo("{$base_url}{$action}"); ?>" method="post" class="form">
                <div class="group">
                  <label class="label">Booking Reference</label>
                  <input id="booking_ref" name="booking_ref" type="text" class="text_field" />
                </div>
                <?php if ('reports' != $controller): ?>
                <div class="group">
                  <label class="label">Currency</label>
                  <select id="currency" name="currency" class="select_field">
                      <option value="EUR">EUR</option>
                      <option value="EUR">GBP</option>
                  </select>
                </div>
                <?php endif;?>
                <div class="group">
                  <label class="label">Booking Value</label>
                  <input id="value" name="value" type="text" class="text_field" />
                </div>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Hotel</label>
                    <!-- span class="error">can't be blank</span -->
                  </div>
                  <select id="hotel_id" name="hotel_id" class="select_field<?php echo($required); ?>">
                      <option value=""> -- select hotel --</option>
                      <?php foreach ($hotels as $hotel): ?>
                          <option value="<?php echo($hotel->id); ?>"><?php echo($hotel->name); ?></option>
                      <?php endforeach; ?>
                  </select>
                  <!-- span class="description">Ex: a simple text</span -->
                </div>

                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="non_booking_calls">Non-Booking Calls</label>
                    <!-- span class="error">can't be blank</span -->
                  </div>
                  <select id="non_booking_calls" name="non_booking_calls" class="select_field">
                      <option value=""> -- select source  --</option>
                      <?php foreach ($non_booking_types as $nbt): ?>
                          <option value="<?php echo($nbt); ?>"><?php echo($nbt); ?></option>
                      <?php endforeach; ?>
                  </select>
                  <!-- span class="description">Ex: a simple text</span -->
                </div>

                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="non_booking_calls">Non-Booking Reason</label>
                    <!-- span class="error">can't be blank</span -->
                  </div>
                  <select id="non_booking_reason" name="non_booking_reason" class="select_field">
                      <option value=""> -- select source  --</option>
                      <?php foreach ($non_booking_reasons as $nbr): ?>
                          <option value="<?php echo($nbr); ?>"><?php echo($nbr); ?></option>
                      <?php endforeach; ?>
                  </select>
                  <!-- span class="description">Ex: a simple text</span -->
                </div>

                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Enquiry Source</label>
                    <!-- span class="error">can't be blank</span -->
                  </div>
                  <select id="enquiry_source" name="enquiry_source" class="select_field<?php echo($required); ?>">
                      <option value=""> -- select source  --</option>
                      <?php foreach ($sources as $source): ?>
                          <option value="<?php echo($source->name); ?>"><?php echo($source->name); ?></option>
                      <?php endforeach; ?>
                  </select>
                  <!-- span class="description">Ex: a simple text</span -->
                </div>                
                
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Booking Source</label>
                    <!-- span class="error">can't be blank</span -->
                  </div>
                  <select id="booking_source" name="booking_source" class="select_field<?php echo($required); ?>">
                      <option value=""> -- select source  --</option>
                      <?php foreach ($sources as $source): ?>
                          <option value="<?php echo($source->name); ?>"><?php echo($source->name); ?></option>
                      <?php endforeach; ?>
                  </select>
                  <!-- span class="description">Ex: a simple text</span -->
                </div>

                <?php if ('reports' == $controller): ?>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="post_title">Call Agent</label>
                    <!-- span class="error">can't be blank</span -->
                  </div>
                  <select id="user" name="user" class="select_field<?php echo($required); ?>">
                      <option value=""> -- select agent --</option>                      
                      <?php foreach ($users as $user): ?>
                          <option value="<?php echo($user->id); ?>"><?php echo($user->username); ?></option>
                      <?php endforeach; ?>
                      <option value="all"> >> all agents </option>
                  </select>
                  <!-- span class="description">Ex: a simple text</span -->
                </div>
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="date_created_from"> Created Date From </label>                    
                  </div>
                  <input type="date" id="date_created_from" name="date_created_from" class="date_field" placeholder="Day/Month/Year - e.g. 20/11/2012" />
                  <br />
                  <div class="fieldWithErrors">
                    <label class="label" for="date_created_to"> Created Date To</label>                    
                  </div>                  
                  <input type="date" id="date_created_to" name="date_created_to" class="date_field" placeholder="Day/Month/Year - e.g. 20/11/2012" />
                </div>
                <?php endif; ?>                
                <div class="group">
                  <div class="fieldWithErrors">
                    <label class="label" for="date_from"> Date From</label>                    
                  </div>
                  <input type="date" id="date_from" name="date_from" class="date_field" placeholder="Day/Month/Year - e.g. 20/11/2012" />
                  <br />
                  <div class="fieldWithErrors">
                    <label class="label" for="date_from"> Date To</label>                    
                  </div>                  
                  <input type="date" name="date_to" class="date_field" placeholder="Day/Month/Year - e.g. 20/11/2012" />
                </div>

                <div class="fieldWithErrors">
                      <input id="smb001" type="submit" value="<?php echo($button); ?>" class="button" />
                </div>
              </form>