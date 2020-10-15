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
<section id="<?php echo "extable-form-$day" ?>" class="extable-form <?php echo $day==$wp_day ? 'show-block' : 'hide' ?>">
  <table class="extable w3-table w3-animate-opacity">
    <tbody>           
      <?php foreach ($wp_data[$day] as $key => $ex_day): ?>
        <tr class="extable-row extable-row-exercise">
          <td class="extable-col extable-col-title">
            <div class="w3-input w3-border-0">
              <i class="icon2-pin"></i>&nbsp;&nbsp;
              <b class="extable-ex_title">
                <?php
                  $ex_id = $ex_day['ex_id'];
                  $ex_title = $exercises_data[$ex_id]['ex_title'];
                  echo $ex_title;
                ?>
              </b>
            </div>
          </td>
          <td class="extable-col extable-col-instr">
          	<textarea class="extable-ex_instr w3-input w3-border-0" name="ex_instr" maxlength=255 readonly data-og-value><?php echo $ex_day['wp_ex_details'] ?></textarea>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</section>