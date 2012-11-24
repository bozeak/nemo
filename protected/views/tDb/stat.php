<?php
$year = date("Y");

$br_sub = Subdiv::model()->find('id=:subdiv',array(':subdiv'=>$_GET['subdiv']));
//$this->widget('zii.widgets.CBreadcrumbs', array(
//    'links'=>array(
$this->breadcrumbs = array(
        $br_sub->name=>array('tDb/list', 'subdiv'=>$_GET['subdiv']),
        'Date statistice',
//    ),
//)
);

    $count_all = TDb::model()->count('subdiv=:subdiv AND YEAR(date_reg)=:year',array(':subdiv'=>$_GET['subdiv'], ':year'=>date('Y')));
    $count_closed = TDb::model()->count('subdiv=:subdiv AND nr_respons!=0 AND YEAR(date_reg)=:year',array(':subdiv'=>$_GET['subdiv'], ':year'=>date('Y')));
    $count_unclosed = TDb::model()->count('subdiv=:subdiv AND nr_respons=0 AND YEAR(date_reg)=:year',array(':subdiv'=>$_GET['subdiv'], ':year'=>date('Y')));
    $count_error = TDb::model()->count('subdiv=:subdiv AND responsabil=0 AND nr_respons!=0 AND YEAR(date_reg)=:year',array(':subdiv'=>$_GET['subdiv'], ':year'=>date('Y')));
?>

<h2>Date statistice privind înregistrările introduse de <em><?php $subd_name = Subdiv::model()->find('id=:id',array(':id'=>$_GET['subdiv'])); 
echo $subd_name['name']; ?></em></h2>

<p class="strong">Total înregistrări: <i><?php echo CHtml::link($count_all, array('tDb/list', 'subdiv'=>$_GET['subdiv'])); ?></i></p>

<p class="strong">Închise: <i><?php echo CHtml::link($count_closed, array('tDb/list','subdiv'=>$_GET['subdiv'],'inchis'=>true)); ?></i></p>
<p class="strong">Neînchise: <i><?php echo CHtml::link($count_unclosed, array('tDb/list','subdiv'=>$_GET['subdiv'],'neinchis'=>true)); ?></i></p>
<p class="strong">Cu erori: <i><?php echo CHtml::link($count_error, array('tDb/list','subdiv'=>$_GET['subdiv'],'erori'=>true)); ?></i></p>

<div class="table-wrapper">
    <div class="table-left">
        <h2>Dupa tipul incheierii:</h2>
        <table class="stat-tip">
            <?php
            $tip = Tipraspuns::model()->findAll();                                
            foreach ($tip as $tr) {
             /**
             * Начинаем выщитывать количество записей по типу заявления
             */
                $count_tr = TDb::model()->count('subdiv=:subdiv AND respons_type=:respons_type AND YEAR(date_reg)=:year',
                        array(':subdiv'=>$_GET['subdiv'],':respons_type'=>$tr->id, ':year'=>date('Y')));
                    echo "<tr><td>" . $tr->name . "</td>
                    <td><i>".CHtml::link($count_tr, array('tDb/list','subdiv'=>$_GET['subdiv'],'tr'=>$tr->id))."</i></td></tr>";
                
            }
            ?>
        </table>
    </div>
    <div class="table-right">
        <h2>Dupa responsabil:</h2>
        <table class="stat-resp">
<?php
$responsabil = Responsabil::model()->findAll('subdiv=:subdiv',array(':subdiv'=>$_GET['subdiv']));
foreach ($responsabil as $rp) {
    $count_rp = TDb::model()->count('subdiv=:subdiv AND responsabil=:responsabil AND YEAR(date_reg)=:year',
                        array(':subdiv'=>$_GET['subdiv'],':responsabil'=>$rp->id, ':year'=>date('Y')));
    
    echo "<tr><td>" . $rp->fullname . "</td>
    <td>".CHtml::link($count_rp, array('tDb/list','subdiv'=>$_GET['subdiv'],'rp'=>$rp->id))."</td></tr>";
}
?>
        </table>
    </div>
</div>
