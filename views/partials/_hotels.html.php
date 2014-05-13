                       <div class="group">                 
                            <div id="list_wrapper">
                                <ul class="multiple_columns">
                                  <?php foreach($hotels as $hotel): ?>
                                      <li><h5><?php echo ($hotel->name); ?></h5>
                                          [x] <a href="<?php echo("{$base_url}?hotels/{$hotel->id}/delete"); ?>" onclick="return confirm('Are you sure you want to permanently delete <?php echo($hotel->name); ?>?');">delete</a></li>
                                  <?php endforeach; ?>
                                </ul>
                            </div>                         
                       </div>                       