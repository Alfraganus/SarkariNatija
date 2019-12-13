<?php $user = \app\models\User::find()->count(); ?>
<?php $active_posts = \app\modules\admin\models\Post::find()->where(['status'=>1])->count(); ?>
<?php $passive_posts = \app\modules\admin\models\Post::find()->where(['status'=>0])->count(); ?>
<?php $user = \app\models\User::find()->count(); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?=$active_posts;?></h3>

                        <p>Active posts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?=$passive_posts;?></h3>

                        <p>Inactive posts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?=$user?></h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-pencil"></i> Last posts</li>
                    </ul>

                    <?php foreach ($latestPosts as $post): ?>
                        <a href="<?=\yii\helpers\Url::to(['post/view','id'=>$post->id])?>"><h3 class="post"><?=$post->title?></h3></a>

                    <?php endforeach;?>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->

                <!-- Chat box -->

                <!-- /.box (chat box) -->

                <!-- TO DO List -->

                <!-- /.box -->

                <!-- quick email widget -->

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
<style>
    .post {
        margin: 30px;
    }
    .post:hover {
        color: deepskyblue;
    }
</style>
    <!-- /.content -->
