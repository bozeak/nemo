<?php
$year = date("Y");
if (Yii::app()->user->checkAccess('3')) {
    $trans = Subdiv::model()->findAll();
    echo "

    <div class='modal'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h3>Inregistrarile:</h3>
        </div>
        <div class='modal-body'>
        ";
    foreach ($trans as $tr) {
        $datab = TDb::model()->countBySql("SELECT COUNT(*) FROM t_db WHERE subdiv=$tr->id AND YEAR(date_reg)=$year");
        if (isset(Yii::app()->user->id) && Yii::app()->user->subdiv == $tr->id)
            echo "<ul><li>" . CHtml::link(CHtml::encode($tr->name), array('tDb/list', 'subdiv' => $tr->id)) . " (" . $datab . ")</li>
            <li>" . CHtml::link(CHtml::encode('Statistica'), array('tDb/stat', 'subdiv' => $tr->id)) . "</li><li><a href='/'>Toate</a></li></ul>";
    }
    echo "</div></div>";
}
?>


<?php if (Yii::app()->user->checkAccess('2')) { ?>
<div class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Subdiviziunile</h3>
    </div>
    <div class="modal-body">
        <ul>
            <?php

            $data = Subdiv::model()->findAll();

            foreach ($data as $sub) {
                $datac = TDb::model()->countBySql("SELECT COUNT(*) FROM t_db WHERE subdiv=$sub->id AND YEAR(date_reg)=$year");
                echo "<li>" . CHtml::link($sub->name, array('tDb/list', 'subdiv' => $sub->id)) . " (" . $datac . ")
            " . CHtml::link('S', array('tDb/stat', 'subdiv' => $sub->id)) . "
</li>";
            }
            ?>
        </ul>
    </div>
</div>
<?php
}
?>