<div class="container-fluid">
    <div class="row ucp-menu-item">
        <div class="container">
            <?php if($alert['sell_all'] > 0 and (!isset($userMeta['seller_apply']) or $userMeta['seller_apply'] == '0')): ?>
                <div class="col-md-12 col-xs-12">
                    <div class="alert alert-danger">
                        <p><?php echo get_option('seller_not_apply',''); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="seven-cols">
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/dashboard" class="item-box sbox3" id="dashboard-hover">
                        <span class="micon mdi mdi-gauge"></span>
                        <span><?php echo e(trans('main.dashboard')); ?></span>
                    </a>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/content" class="item-box sbox3" id="buy-hover">
                        <span class="micon mdi mdi-library-video"></span>
                        <span><?php echo e(trans('main.courses')); ?></span>
                    </a>
                </div>
                <div class="h-10 visible-xs"></div>
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/channel" class="item-box sbox3" id="channel-hover">
                        <span class="micon mdi mdi-bullhorn"></span>
                        <span><?php echo e(trans('main.channels')); ?></span>
                    </a>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/balance" class="item-box sbox3" id="balance-hover">
                        <span class="micon mdi mdi-finance"></span>
                        <span><?php echo e(trans('main.financial')); ?></span>
                    </a>
                </div>
                <div class="h-10 visible-xs"></div>
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/ticket" class="item-box sbox3" id="ticket-hover">
                        <span class="micon mdi mdi-headset"></span>
                        <span><?php echo e(trans('main.support')); ?></span>
                    </a>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/article" class="item-box sbox3" id="article-hover">
                        <span class="micon mdi mdi-notebook"></span>
                        <span><?php echo e(trans('main.articles')); ?></span>
                    </a>
                </div>
                <div class="h-10 visible-xs"></div>
                <div class="col-md-1 col-sm-6 col-xs-6 tab-con">
                    <a href="/user/profile" class="item-box sbox3" id="profile-hover">
                        <span class="micon mdi mdi-settings"></span>
                        <span><?php echo e(trans('main.settings')); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\proacademy\resources\views/web/default/user/layout/menu.blade.php ENDPATH**/ ?>