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
    <table align="center" id="regtable" class="table">
        <thead>
        <tr>
            <th width="30px">Nr. d/o</th>
            <th width="120px">Nr. de înregistrare<br/>
                Data înregistrării
            </th>
            <th width="120">Solicitant</th>
            <?php if (!Yii::app()->user->isGuest) { ?>
            <th width="100px">Adresa</th>
            <th width="190px">Scurta expunere</th>
            <?php } ?>
            <th width="140px">Executor</th>
            <?php if (!Yii::app()->user->isGuest) { ?>
            <th width="240px">Nr. act / Data răspuns<br/>Tipul răspunsului</th>
            <th width="40px">Dosar</th>
            <th width="30px" style="border-right: 0px;"></th>
            <?php } ?>

        </tr>
        </thead>

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
                echo "<td>" . CHtml::link(CHtml::encode('Modifică'), array('update', 'id' => $m->id)) . "</td>"; else
                echo "<td></td>"
            ?>
            <?php } ?>
        </tr>
        <?php } ?>

    </table>
    <hr style="top: 20px"/>

    <div class="pagination pagination-centered pagination-small">
        <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'header' => false,
            'htmlOptions' => array(
                'class' => '',
            ),
        ));
        ?>
    </div>
</div>