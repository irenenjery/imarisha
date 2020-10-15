<?php
/**
Data to bind:
- $day, where days = ['mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun']
- $wp_day, the workoutplan day selected, eg 'mon'
- $wp_data, the daily workoutplan data
- $exercises_data
- $extable_actionbtns_plugin, the src of btns that edit extable rows
- $prog_id
Scripts:
- <script src='./public/javascripts/im.js'></script>
- <script src='./public/javascripts/extable.js'></script>
*/
?>
<form id="<?php echo "extable-form-$day" ?>" class="extable-form <?php echo $day==$wp_day ? 'show-block' : 'hide' ?>" name="extable-form" method="POST" action="extable-mod.php">
  <table class="extable w3-table w3-animate-opacity">
    <tbody>
      <tr class="stud new-elem extable-row extable-row-exercise w3-animate-opacity">
        <td class="extable-col extable-col-title">
          <div class="w3-input w3-border-0">
            <i class="icon2-pin"></i>&nbsp;&nbsp;
            <b class="extable-ex_title">No title</b>
            <input class="extable-wp_id" type="text" name="wp_id" value="" hidden>
            <input class="extable-ex_id" type="text" name="ex_id" value="" hidden>
          </div>
        </td>
        <td class="extable-col extable-col-instr">
        	<textarea class="extable-ex_instr w3-input w3-border-0" name="ex_instr" maxlength=255 readonly>No instructions provided</textarea>
        </td>
        <td class="extable-col extable-col-actionbtns w3-center">
          <?php require $extable_actionbtns_plugin ?>
        </td>
      </tr>              
      <?php foreach ($wp_data[$day] as $key => $ex_day): ?>
        <tr class="extable-row extable-row-exercise">
          <td class="extable-col extable-col-title">
            <div class="w3-input w3-border-0">
              <i class="icon2-pin"></i>&nbsp;&nbsp;
              <b class="extable-ex_title">
                <?php
                  $wp_id = $ex_day['wp_id'];
                  $ex_id = $ex_day['ex_id'];
                  $ex_title = $exercises_data[$ex_id]['ex_title'];
                  echo $ex_title;
                ?>
              </b>
              <input class="extable-wp_id" type="text" name="wp_id" value="<?php echo $wp_id ?>" hidden>
              <input class="extable-ex_id" type="text" name="ex_id" value="<?php echo $ex_id ?>" hidden>
            </div>
          </td>
          <td class="extable-col extable-col-instr">
          	<textarea class="extable-ex_instr w3-input w3-border-0" name="ex_instr" maxlength=255 readonly data-og-value><?php echo $ex_day['wp_ex_details'] ?></textarea>
          </td>
          <td class="extable-col extable-col-actionbtns w3-center">
            <?php require $extable_actionbtns_plugin ?>
          </td>
        </tr>
      <?php endforeach ?>
      <tr class="extable-row extable-row-submit w3-white">
        <td class="extable-col extable-col-submit-container" colspan="3">
          <!-- Hidden form data -->
          <input type="hidden" name="wp-day" value="<?php echo $day ?>">
          <input type="hidden" name="prog-id" value="<?php echo $prog_id ?>">
          <input class="insert-count" type="hidden" name="insert-count" value="0">
          <input class="update-count" type="hidden" name="update-count" value="0">
          <input class="delete-count" type="hidden" name="delete-count" value="0">
          <input class="delete-wp_ids" type="hidden" name="delete-wp_ids" value="">
          <!-- End of Hidden form data -->

          <div class="extable-btn w3-right extable-btn-submit show-inline-block">
            <button type="submit" class="w3-btn w3-green disabled" disabled><i class="icon-paper-plane" style="font-size: 0.8em"></i>&nbsp;&nbsp;Submit changes</button>
          </div>
        </td>
      </tr>
      <tr class="extable-row extable-row-addExercise">
        <td class="extable-col extable-col-select-ex">
          <select class="extable-select-ex w3-select w3-border" name="extable-select-ex">
            <option value="none" disabled selected>Add exercise</option>
            <?php foreach ($exercises_data as $ex_id => $ex): ?>
              <option value="<?php echo $ex_id ?>">
                <?php echo $ex['ex_title'] ?>                        
              </option>
            <?php endforeach ?>
          </select>
          <div class="select-ex-error w3-text-red hide">
            You must select an exercise
          </div>
        </td>
        <td class="extable-col extable-col-add-instr">
        	<textarea class="extable-add-instr w3-input w3-border-0" maxlength=255 rows="2" placeholder="Add exercise instructions e.g sets, reps&nbsp;&nbsp;(max 255 chars)"></textarea>	
        </td>
        <td class="extable-col extable-col-addbtns w3-center">
          <div class="extable-btn extable-btn-add">
            <a class="w3-btn w3-text-green w3-border w3-border-green"><i class="icon2-pin"></i></a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</form>