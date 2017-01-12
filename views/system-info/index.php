<?php
/**
 * Copyright (c) 2017.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 1/4/2017
 * Time: 4:32 PM
 */
/**
 * @var \probe\provider\AbstractProvider $provider
 * @var \Phalcon\Mvc\View $this
 */
use ntesic\boilerplate\helpers\Text;
?>
    <div id="system-information-index">
        <div class="row connectedSortable">
            <div class="col-lg-6 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Processor' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'Processor' ?></dt>
                            <dd><?php echo $provider->getCpuModel() ?></dd>

                            <dt><?php echo 'Processor Architecture' ?></dt>
                            <dd><?php echo $provider->getArchitecture() ?></dd>

                            <dt><?php echo 'Number of cores' ?></dt>
                            <dd><?php echo $provider->getCpuCores() ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Operating System' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'OS' ?></dt>
                            <dd><?php echo $provider->getOsType() ?></dd>

                            <dt><?php echo 'OS Release' ?></dt>
                            <dd><?php echo $provider->getOsRelease() ?></dd>

                            <dt><?php echo 'Kernel version' ?></dt>
                            <dd><?php echo $provider->getOsKernelVersion() ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Time' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'System Date' ?></dt>
                            <dd><?php echo date('H:i:s', time()) ?></dd>

                            <dt><?php echo 'System Time' ?></dt>
                            <dd><?php echo date('Y-m-d', time()) ?></dd>

                            <dt><?php echo 'Timezone' ?></dt>
                            <dd><?php echo date_default_timezone_get() ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Network' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'Hostname' ?></dt>
                            <dd><?php echo $provider->getHostname() ?></dd>

                            <dt><?php echo 'Internal IP' ?></dt>
                            <dd><?php echo $provider->getServerIP() ?></dd>

                            <dt><?php echo 'External IP' ?></dt>
                            <dd><?php echo $provider->getExternalIP() ?></dd>

                            <dt><?php echo 'Port' ?></dt>
                            <dd><?php echo $provider->getServerVariable('SERVER_PORT') ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Software' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'Web Server' ?></dt>
                            <dd><?php echo $provider->getServerSoftware() ?></dd>

                            <dt><?php echo 'PHP Version' ?></dt>
                            <dd><?php echo $provider->getPhpVersion() ?></dd>

                            <dt><?php echo 'DB Type' ?></dt>
                            <dd><?php echo $provider->getDbType($this->db->getInternalHandler()) ?></dd>

                            <dt><?php echo 'DB Version' ?></dt>
                            <dd><?php echo $provider->getDbVersion($this->db->getInternalHandler()) ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Memory' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'Total memory' ?></dt>
                            <dd><?php echo Text::asSize($provider->getTotalMem()) ?></dd>

                            <dt><?php echo 'Free memory' ?></dt>
                            <dd><?php echo Text::asSize($provider->getFreeMem()) ?></dd>

                            <dt><?php echo 'Total Swap' ?></dt>
                            <dd><?php echo Text::asSize($provider->getTotalSwap()) ?></dd>

                            <dt><?php echo 'Free Swap' ?></dt>
                            <dd><?php echo Text::asSize($provider->getFreeSwap()) ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-hdd-o"></i>
                        <h3 class="box-title"><?php echo 'Disk' ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo 'Total Disk Size' ?></dt>
                            <dd><?php echo $provider->getDiskTotal() ?></dd>

                            <dt><?php echo 'Free Disk Size' ?></dt>
                            <dd><?php echo $provider->getDiskFree() ?></dd>

                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo gmdate('H:i:s', $provider->getUptime()) ?>
                        </h3>
                        <p>
                            <?php echo 'Uptime' ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="small-box-footer">
                        &nbsp;
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $provider->getLoadAverage() ?>
                        </h3>
                        <p>
                            <?php echo 'Load average' ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <div class="small-box-footer">
                        &nbsp;
                    </div>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php echo '';//User::find()->count() ?>
                        </h3>
                        <p>
                            <?php echo 'User Registrations' ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo '';//Yii::$app->urlManager->createUrl(['/user/index']) ?>"
                       class="small-box-footer">
                        <?php echo 'More info' ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div id="cpu-usage" class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?php echo 'CPU Usage' ?>
                        </h3>
                        <div class="box-tools pull-right">
                            <?php echo 'Real time' ?>
                            <div class="realtime btn-group" data-toggle="btn-toggle">
                                <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                    <?php echo 'On' ?>
                                </button>
                                <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                    <?php echo 'Off' ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart" style="height: 300px;">
                        </div>
                    </div><!-- /.box-body-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div id="memory-usage" class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?php echo 'Memory Usage' ?>
                        </h3>
                        <div class="box-tools pull-right">
                            <?php echo 'Real time' ?>
                            <div class="btn-group realtime" data-toggle="btn-toggle">
                                <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                    <?php echo 'On' ?>
                                </button>
                                <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                    <?php echo 'Off' ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart" style="height: 300px;">
                        </div>
                    </div><!-- /.box-body-->
                </div>
            </div>
        </div>
    </div>
<?= $this->assets->outputJs('system-info') ?>