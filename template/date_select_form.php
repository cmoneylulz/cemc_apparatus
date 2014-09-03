<?php
/**
 * Created by PhpStorm.
 * User: Christopher Wilson
 * Date: 11/8/13
 * Time: 8:45 AM
 */

    $month_list = array ("January", "February", "March", "April", "May", "June",
                         "July", "August", "September", "October", "November", "December");
    $date = getdate();
    $current_year = $date['year'];

?>

<div class="select-wrapper">
    <select name="start_month" id="month-select-form" class="select-custom">
    <?php
        foreach ($month_list as $key=>$month) {
            $value = $key + 1;
            echo("<option value='".$value."'>".$month."</option>");
        }
    ?>
    </select>
</div>


<div class="select-wrapper">
    <select name="start_day" id="day-select-form" class="select-custom">
    <?php
        for($i=1; $i<32; $i++) {
            echo("<option value='".$i."'>".$i."</option>");
        }
    ?>
    </select>
</div>


<div class="select-wrapper">
    <select name="start_year" id="year-select-form" class="select-custom">
    <?php
        for($i=2000; $i<=$current_year; $i++){
            echo("<option value='".$i."'>".$i."</option>");
        }
    ?>
    </select>
</div>
