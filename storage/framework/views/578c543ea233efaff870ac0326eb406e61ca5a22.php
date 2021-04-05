
<?php $__env->startSection('title'); ?>
    <?php echo e($setting['site']['site_title']); ?>

    - <?php echo e($post->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum/post/new" class="float-right" style="float: right"><button class="btn btn-info"><?php echo e(trans('main.forum_btn_new_thread')); ?></button></a>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum/post/category/<?php echo e($post->category->id); ?>" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- <?php echo e(trans('main.forum_goback')); ?></h4></a>
        </div>        
    </div>

    <br>

<section class="card"">
    <div class="card-body" style="background-color: white;">
        <div class="col-md-12 col-xs-12 col-lg-12">
            <span><?php echo e(date('d F Y',$post->create_at)); ?><b> - </b><?php echo e($post->user->name); ?></span>
        </div>
        <br>
        <div class="col-md-12 col-xs-12 col-lg-12" style="background-color: white;">
            <?php echo e($post->pre_content); ?>

            <hr>
            <?php echo e($post->content); ?>

            <br>
                <div class="blog-comment-section">
                    
                    <hr>
                    <form method="post" action="/user/forum/post/comment/store">
                    <?php echo csrf_field(); ?>
                        <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>"/>
                        <input type="hidden" name="parent" value="0" />
                        <div class="form-group">
                            <label><?php echo e(trans('main.your_comment')); ?></label>
                            <textarea class="form-control" name="comment" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-custom pull-left" value="Send">
                        </div>
                    </form>

                    <ul class="comment-box">
                        <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="/profile/<?php echo e($comment->user_id or ''); ?>"><?php echo e($comment->user->name); ?></a>
                                <label><?php echo e(date('d F Y | H:i',$comment->create_at)); ?></label>
                                <span><?php echo e($comment->comment); ?></span>
                                <span><a href="javascript:void(0);" answer-id="<?php echo e($comment->id); ?>" answer-title="<?php echo e($comment->name or ''); ?>" class="pull-left answer-btn"><?php echo e(trans('main.reply')); ?></a> </span>
                                <?php if(count($comment->childs)>0): ?>
                                    <ul class="col-md-11 col-md-offset-1 answer-comment">
                                        <?php $__currentLoopData = $comment->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="/profile/<?php echo e($child->user_id or ''); ?>"><?php echo e($child->name); ?></a>
                                                <label><?php echo e(date('d F Y | H:i',$child->create_at)); ?></label>
                                                <span><?php echo e($child->comment); ?></span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
        </div>
    </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('.answer-btn').click(function () {
                var parent = $(this).attr('answer-id');
                var title = $(this).attr('answer-title');
                $('input[name="parent"]').val(parent);
                scrollToAnchor('.blog-comment-section');
                $('textarea').attr('placeholder',' Replied to '+title);
            });
        });
    </script>
    <?php if(!isset($user)): ?>
        <script>
            $(document).ready(function () {
                $('input[type="submit"]').click(function (e) {
                    e.preventDefault();
                    $('input[type="submit"]').val('Please login to your account to leave comment.')
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/forum/post.blade.php ENDPATH**/ ?>