<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
table {
    table-layout: fixed;
}

table td {
    max-width: 100%;
    overflow-wrap: break-word;        
}
CSS;
$this->registerCss($css);

?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $currentUserRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'id', 'visible' => isset($currentUserRoles['admin'])],
            'title',
            'created_at',
            'updated_at',
            ['attribute' => 'category.name', 'label' => 'Category name',
                'headerOptions' => ['style' => 'color: #337ab7;']],
            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
