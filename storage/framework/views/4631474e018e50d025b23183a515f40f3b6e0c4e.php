
<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

- <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row visualizador-media">
    <div class="container">
        <div class="row">
            <div class="col-md-12 volver-atras-media">
                <br>
                <div class="row">
                    <a href="javascript:history.back()">
                        <h4><i class="fa fa-arrow-left"> </i><span> Cursos</span></h4>
                    </a>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h2><b><?php echo e($product->title); ?></b></h2>
                    </div>
                    <!--<div class="col-md-4">
                        <?php if($product->support == 1): ?>
                        <button class="btn btn-next-media pull-right">
                            <h5><b>Soporte</b></h5>
                        </button>
                        <?php endif; ?>
                    </div>-->
                </div>
                <br>
                <div class="row">
                    <iframe style="height: 700px; width: 100%;"
                        src="https://zoom.us/wc/<?php echo e($meeting->zoom_meeting ?? $meeting); ?>/join?prefer=0&un=TWluZGF1Z2Fz"
                        sandbox="allow-forms allow-scripts allow-same-origin" allow="microphone; camera" allowfullscreen
                        scrolling="no"></iframe>
                </div>
                <!-- <br>
                <div class="row">
                    <button class="btn btn-next-media pull-right">
                        <h4>Siguiente <i class="fa fa-arrow-right"></i></h4>
                    </button>
                </div>-->
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 content-media-curso">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($meta['price'])): ?>
                                <form>
                                    <?php echo e(csrf_field()); ?>

                                    <?php if(isset($user) && $product->user_id == $user['id']): ?>
                                    <a class="btn btn-orange product-btn-buy sbox3" id="buy-btn"
                                        href="/user/content/edit/<?php echo e($product->id); ?>"><?php echo e(trans('main.edit_course')); ?></a>
                                    <a class="btn btn-blue product-btn-buy sbox3" id="buy-btn"
                                        href="/user/content/part/list/<?php echo e($product->id); ?>"><?php echo e(trans('main.add_video')); ?></a>
                                    <?php elseif(!$buy): ?>
                                    <?php if(!empty($product->price) and $product->price != 0): ?>
                                    <div class="radio">
                                        <input type="radio" id="radio-2" name="buy_mode" data-mode="download"
                                            value="<?php echo e(price($product->id,$product->category_id,$meta['price'])['price']); ?>"
                                            checked>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty($product->price) and $product->price != 0): ?>
                                    <a class="btn btn-success" id="buy-btn" data-toggle="modal" data-target="#buyModal"
                                        href=""><?php echo e(trans('main.pay')); ?></a>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <?php if(!empty($product->price) and $product->price != 0): ?>
                                    <a class="btn btn-success"
                                        href="javascript:void(0);"><?php echo e(trans('main.purchased_item')); ?></a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if($product->content_type == 'Fundal' || $product->content_type == 'fundal'): ?>
                                
                                <?php else: ?>
                                <?php if(isset($meta['price']) && $product->price != 0): ?>
                                <h2>Precio:
                                    <?php echo e(currencySign()); ?><?php echo e(price($product->id,$product->category_id,$meta['price'])['price']); ?>

                                </h2>
                                <?php else: ?>
                                <h2><?php echo e(trans('main.free')); ?></h2>
                                <br>
                                <a class="btn btn-success" href="/inscribirse/product/<?php echo e($product->id); ?>">Inscribirse</a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Enlace de Zoom:</h2>
                                <br>
                                <span><a
                                        href="https://zoom.us/wc/<?php echo e($meeting->zoom_meeting ?? $meeting); ?>/join?prefer=0&un=TWluZGF1Z2Fz">https://zoom.us/wc/<?php echo e($meeting->zoom_meeting ?? $meeting); ?>/join?prefer=0&un=TWluZGF1Z2Fz</a></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Comparte en tus redes sociales:</h2>
                                <br>
                                <div class="addthis_inline_share_toolbox"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Etiquetas</h2>
                                <br>
                                <?php $__currentLoopData = explode(',', $product->tag); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <h4><span class="label label-tag-cursos"> <span class="circle-tag-cursos"></span>
                                        <?php echo e($tag); ?></span></h4>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Categor&iacute;a</h2>
                                <br>
                                <h4><span class="label label-tag-media-categoria"> <span
                                            class="circle-tag-media-categoria"></span>
                                        <?php echo e($product->category->title); ?></span></h4>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="buyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo e(trans('main.purchase')); ?></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p><?php echo e(trans('main.select_payment_method')); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="buy_method" value="download">
                            <div class="radio">
                                <input type="radio" class="buy-mode" id="mode-1" value="credit" name="buyMode">
                                &nbsp;
                                <label class="radio-label" for="mode-1"><?php echo e(trans('main.account_charge')); ?>&nbsp;<b
                                        id="credit-remain-modal">(<?php echo e(currencySign()); ?><?php echo e($user['credit']); ?>)</b></label>
                            </div>
                            <?php if(get_option('gateway_paypal') == 1): ?>
                            <div class="radio">
                                <input type="radio" class="buy-mode" id="mode-2" value="paypal" name="buyMode">
                                &nbsp;
                                <label class="radio-label" for="mode-2"> Paypal </label>
                            </div>
                            <?php endif; ?>
                            <div class="radio">
                                <input type="radio" class="buy-mode" id="mode-7" value="paycom" name="buyMode">
                                &nbsp;
                                <label class="radio-label" for="mode-7"> Credit/Debit Card </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive table-base-price">
                        <table class="table table-hover table-factor-modal">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo e(trans('main.amount')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.discount')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.tax')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.total_amount')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><?php echo e($meta['price']); ?></td>
                                    <?php if(isset($meta['price']) && $meta['price'] > 0 && price($product->id,
                                    $product->category->id, $meta['price']) > 0): ?>
                                    <td class="text-center">
                                        <?php echo e(round((($meta['price'] - price($product->id, $product->category->id, $meta['price'])['price']) * 100) / $meta['price'])); ?>

                                    </td>
                                    <?php endif; ?>
                                    <td class="text-center">0</td>
                                    <td class="text-center">
                                        <?php echo e(price($product->id,$product->category->id,$meta['price'])['price']); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive table-post-price table-post-price-s">
                        <table class="table table-hover table-factor-modal" style="margin-bottom: 0;padding-bottom: 0;">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo e(trans('main.amount')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.discount')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.tax')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.total_amount')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><?php echo e($meta['post_price']); ?></td>
                                    <?php if(isset($meta['post_price']) && $meta['post_price']>0): ?>
                                    <td class="text-center">
                                        <?php echo e(round((($meta['post_price'] - price($product->id,$product->category->id,$meta['post_price'])['price']) * 100) / $meta['post_price'])); ?>

                                    </td>
                                    <td class="text-center">۰</td>
                                    <td class="text-center">۰</td>
                                    <td class="text-center">
                                        <?php echo e(price($product->id,$product->category->id,$meta['post_price'])['price']); ?>

                                    </td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div id="giftCard">
                    <form method="post" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-9 tab-con">
                                <input type="text" dir="ltr" class="form-control text-center"
                                    placeholder="Discount or Gift code" name="gift-card" id="gift-card">
                            </div>
                            <div class="col-md-3 tab-con">
                                <button type="button" name="gift-card-check" id="gift-card-check"
                                    class="btn btn-custom pull-left"><?php echo e(trans('main.validate')); ?></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center" id="gift-card-result"></div>
                        </div>
                    </form>
                </div>
                <?php if(isset($user)): ?>
                <div id="modal-user-category">
                    <span><?php echo e(trans('main.you_are_in')); ?></span>
                    <b><?php echo e($user['category']['title']); ?></b>
                    <span><?php echo e(trans('main.group_and')); ?></span>
                    <b><?php echo e($user['category']['off']); ?>٪</b>
                    <span> <?php echo e(trans('main.extra_discount')); ?></span>
                </div>
                <?php endif; ?>
            </div>
            <?php if(checkSubscribeSell($product)): ?>
            <div class="modal-body">
                <h6 style="font-weight:bold;">You Can Subscribe..... Select Items</h6>
                <div class="h-10"></div>
                <?php if($product->price_3 > 0): ?><a href="/product/subscribe/<?php echo $product->id; ?>/3/credit"
                    p-id="<?php echo $product->id; ?>" s-type="3" class="btn-subscribe btn btn-custom">3 month :
                    <?php echo currencySign(); ?><?php echo $product->price_3; ?></a><?php endif; ?>
                <?php if($product->price_6 > 0): ?><a href="/product/subscribe/<?php echo $product->id; ?>/6/credit"
                    p-id="<?php echo $product->id; ?>" s-type="6" class="btn-subscribe btn btn-custom">6 month :
                    <?php echo currencySign(); ?><?php echo $product->price_6; ?></a><?php endif; ?>
                <?php if($product->price_9 > 0): ?><a href="/product/subscribe/<?php echo $product->id; ?>/9/credit"
                    p-id="<?php echo $product->id; ?>" s-type="9" class="btn-subscribe btn btn-custom">9 month :
                    <?php echo currencySign(); ?><?php echo $product->price_9; ?></a><?php endif; ?>
                <?php if($product->price_12 > 0): ?><a href="/product/subscribe/<?php echo $product->id; ?>/12/credit"
                    p-id="<?php echo $product->id; ?>" s-type="12" class="btn-subscribe btn btn-custom">12 month :
                    <?php echo currencySign(); ?><?php echo $product->price_12; ?></a><?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom pull-left"
                    data-dismiss="modal"><?php echo e(trans('main.cancel')); ?></button>
                <a href="javascript:void(0);" class="btn btn-custom pull-left"
                    id="buyBtn"><?php echo e(trans('main.purchase')); ?></a>
                <a href="javascript:void(0);" class="btn btn-custom pull-right"
                    onclick="$('#giftCard').slideToggle(200);"><?php echo e(trans('main.have_giftcard')); ?></a>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="paycomModal" tabindex="-1" role="dialog" aria-labelledby="paycomModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Credit/Debit card pay</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="CredomaticPost" method="get" action="/bank/paycom/pay/<?php echo e($product->id); ?>/" />
                <Input type="hidden" id='time' name="time" />
                <input type="hidden" id='item_price' name="item_price" value="<?php echo e($product->price); ?>">
                <input type="hidden" id='method_creditDebit' name="method_creditDebit">
                <!--<Input type="text" name="username" value="jbonillap201"/>
                                <Input type="text" name="type" value=" auth"/>
                                <Input type="text" name="key_id" value="38723344"/>
                                <Input type="text" name="hash" value="6145cc70aabac5e5cad36fc2f249ad5a" >
                                <Input type="text" name="time" value="1598045400"/>
                                <Input type="text" name="amount" value="1.00"/>
                                <Input type="text" name="orderid" value="123456"/>
                                <Input type="text" name="processor_id" value="INET000"/>
                                <Input type="text" name="ccexp" value="0425"/>
                                <Input type="text" name="cvv" value="944"/>
                                <Input type="text" name="avs" value="12av el bosque 2-56 zona 11 de Mixco"/>-->
                <div class="form-row">
                    <div class="form-group col">
                        <label for="ccnumber">Card Number</label>
                        <input type="ccnumber" class="form-control" id="ccnumber" aria-describedby="ccnumberHelp"
                            placeholder="0000 0000 0000 0000" name="ccnumber">
                        <small id="ccnumberHelp" class="form-text text-muted">Enter your card number.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="ccexp">Exp date</label>
                            <input type="ccexp" class="form-control" id="ccexp" aria-describedby="ccexpHelp"
                                placeholder="01/20" name="ccexp">
                            <small id="ccexpHelp" class="form-text text-muted">Enter the expiration date of your
                                card</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="ccccv">CVV</label>
                            <input type="ccccv" class="form-control" id="ccccv" aria-describedby="ccccvHelp"
                                placeholder="000" name="ccccv">
                            <small id="ccccvHelp" class="form-text text-muted">Enter the code that is below of your
                                card.</small>
                        </div>
                    </div>
                </div>
                <!--<div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-ccexp">Exp Date</span>
                                </div>
                                <input type="text" value="0425" name="ccexp" class="form-control" placeholder="01/20" aria-label="ccexp" aria-describedby="addon-ccexp">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-cvv">CVV</span>
                                </div>
                                <input type="text" value="944" name="cvv" class="form-control" placeholder="CVV" aria-label="cvv" aria-describedby="addon-cvv">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-avs">Address</span>
                                </div>
                                <input type="text" value="12av el bosque 2-56 zona 11 de Mixco" name="avs" class="form-control" placeholder="Address" aria-label="avs" aria-describedby="addon-avs">
                            </div>-->
                <!--<Input type="hidden" name="redirect" value="https://proacademydos.local/PaycomTester"/>-->
                <input type="submit" class="btn btn-primary" value="Pay">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input[type=radio][name=buyMode]').change(function () {
            var payment = $(this).val();
            if (payment == 'paycom') {
                console.log('paycom test');
                $('#buyBtn').attr({
                    'href': '#',
                    'data-toggle': 'modal',
                    'data-target': '#paycomModal',
                    'data-dismiss': 'modal'
                });
                var currentDate = new Date().getTime();
                var timetofinish = new Date(currentDate + 5 * 60 * 1000).getTime();
                $('#time').val(Math.round(timetofinish / 1000));
                $('#method_creditDebit').val($('#buy_method').val());
            } else {
                var buyLink = '/bank/' + payment + '/pay/<?php echo e($product->id); ?>/' + $('#buy_method')
                    .val();
                $('#buyBtn').attr('href', buyLink);
            }
        })
    });

</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f88eadd1f615a3d"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/product/productWeb.blade.php ENDPATH**/ ?>