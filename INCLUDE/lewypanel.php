<div class=menu>
    <?php include("mmiasto.php")?>
</div>
<div class=menu>
    <?php include("mpremium.php")?>
</div>
<div class=menu>
    <?php include("mogolne.php")?>
</div>
<div class=menu>
    <?php include("mosobiste.php")?>
</div>
<?php
if($_SESSION['admin']==1){
    echo "<div class=menu>";
        include("madministrator.php");
    echo "</div>";
}
?>