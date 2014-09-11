<div class="select-wrapper">
    <select name='station_name' id="station-select-form" class="select-custom" onChange="changeStation(this)">
        <?php

        include('../query/dbconnect.php');

        $query = mysql_query("SELECT * FROM station") or die(mysql_error());

        if (!isset($_GET['station_name'])) 
        {
            echo "<option value='all' selected='selected'>All Stations</option>";
            while ($row = mysql_fetch_assoc($query)) 
            {
                echo("<option value='" . $row["station_name"] . "'>" . $row["station_name"] . "</option>");
            }
        } 

        else 
        {
            echo "<option value='all'>All Stations</option>";
            while ($row = mysql_fetch_assoc($query))
            {
                if ($row["station_name"] == $_GET["station_name"]) 
                {
                    echo("<option value='" . $row["station_name"] . "' selected='selected'>" . $row["station_name"] . "</option>");
                } 

                else 
                {
                    echo("<option value='" . $row["station_name"] . "'>" . $row["station_name"] . "</option>");
                }
            }
        }
        ?>
    </select>
    <script src="../jquery.min.js"></script>
    <script>
        function changeStation(selectValue) {
            formAction = $(selectValue).parents('form').attr('action');
            if (formAction == "processread.php")
            {
                value = ("viewform.php?station_name=" + selectValue.options[selectValue.selectedIndex].text
                    + "&date=" + <?php echo '"'.$_GET['date'].'"';?>);
                window.location.href=value;
            } 

            else 
            {
                value = (formAction + "?station_name=" + selectValue.options[selectValue.selectedIndex].text
                    + "&date=" + <?php echo '"'.$_GET['date'].'"';?> + "&browse=true");
                window.location.href=value;
            }
        }
    </script>
</div>