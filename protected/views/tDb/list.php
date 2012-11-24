<?php
/* @var $this TDbController */
/* @var $dataProvider CActiveDataProvider */
$br_sub = Subdiv::model()->find('id=:subdiv', array(':subdiv' => $_GET['subdiv']));
$this->breadcrumbs = array(
    $br_sub->name,
);
?>
<?php
$this->renderPartial('_usermenu');

?>
<div align="center">
    <table align="center" id="regtable">
        <tr class="thead">
            <td width="30px">Nr. d/o</td>
            <td width="120px">Nr. de înregistrare<br/>
                Data înregistrării
            </td>
            <td width="120">Solicitant</td>
            <?php if (!Yii::app()->user->isGuest) { ?>
            <td width="100px">Adresa</td>
            <td width="190px">Scurta expunere</td>
            <?php } ?>
            <td width="140px">Executor</td>
            <?php if (!Yii::app()->user->isGuest) { ?>
            <td width="240px">Nr. act / Data răspuns<br/>Tipul răspunsului</td>
            <td width="40px">Dosar</td>
            <td width="30px" style="border-right: 0px;"></td>
            <?php } ?>


        </tr>

        <?php foreach ($models as $m) { ?>
        <tr id="regtablerow">
            <td><?php
                if (!Yii::app()->user->isGuest)
                    echo CHtml::link(CHtml::encode($m->id), array('view', 'id' => $m->id));
                else
                    echo $m->id;
                ?></td>
            <td><?php if (!empty($m->nr_reg)) echo $m->nr_reg; ?><br/>
                <?php echo Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'), $m->date_reg); ?>
            </td>
            <td><?php if (!empty($m->elab)) echo $m->elab; ?></td>
            <?php if (!Yii::app()->user->isGuest) { ?>
            <td><?php if (!empty($m->address)) echo $m->address; ?></td>
            <td><?php if (!empty($m->content)) echo $this->textLimit($m->content, 60, ' ...'); ?></td>
            <?php } ?>
            <td><?php
                if (!empty($m->responsabil2))
                    echo $m->responsabil2->grad0->md . " " . $m->responsabil2->fullname . "<br />" . $m->responsabil2->contacts; ?></td>

            <?php if (!Yii::app()->user->isGuest) { ?>
            <td>
                <?php
                if (!empty($m->nr_respons))
                    echo $m->nr_respons . " din " .
                        Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'), $m->date_respons) . "<br />" . $m->respons_type2->name;
                ?>
            </td>
            <td><?php if (!empty($m->dossier))
                echo $m->dossier;
                ?></td>


            <?php
            if (Yii::app()->user->checkAccess('2'))
                echo "<td>" . CHtml::link(CHtml::encode('Modifică'), array('update', 'id' => $m->id)) . "<br />
                " . CHtml::linkButton('Ștergeți', array(
                    'submit' => $this->createUrl('delete', array('id' => $m->id)),
                    'confirm' => "Sînteți siguri că doriți să ștergeți înregistrarea " . $m->id . " din registru?",
                    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken)))

                    . "</td>";
            elseif (Yii::app()->user->checkAccess('3') && $m->author == Yii::app()->user->id)
                echo "<td>" . CHtml::link(CHtml::encode('Modifică'), array('update', 'id' => $m->id)) . "</td>";
            else
                echo "<td></td>"
            ?>
            <?php } ?>
        </tr>
        <?php } ?>

    </table>
    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));

    ?>
</div>