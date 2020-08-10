<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

    - <?php echo e($post->title ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>

    <div class="container-fluid">
        <div class="container">
            <div class="blog-section">
                <div class="col-xs-12 row blog-post-box blog-post-box-s">
                    <div class="col-md-3 col-xs-12">
                        <img src="<?php echo e($post->image); ?>" class="img-responsive">
                        <span class="date-section"><?php echo e(date('d F Y',$post->created_at)); ?></span>
                        <?php if(!empty($post->category)): ?>
                            <span class="date-section">
                                <a href="/blog/category/<?php echo e($post->category->id); ?>"><?php echo e($post->category->title ?? ''); ?></a>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9 col-xs-12 text-section">
                        <?php echo $post->pre_content; ?>

                        <hr>
                        <?php echo $post->content; ?>

                        <br>
                        <span><?php echo e(trans('main.tags')); ?> :</span>
                        <?php $__currentLoopData = explode(',',$post->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <i class="content-tag"> <a href="/blog/tag/<?php echo e($tag); ?>"><?php echo e($tag); ?></a> </i>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($setting['site']['blog_comment'] == 1 && $post->comment == 'enable'): ?>
                            <div class="blog-comment-section">
                                <h4><?php echo e(trans('main.comments')); ?></h4>
                                <hr>
                                <form method="post" action="/blog/post/comment/store">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>"/>
                                    <input type="hidden" name="parent" value="0"/>
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
                                            <a href="/profile/<?php echo e($comment->user_id); ?>"><?php echo e($comment->name); ?></a>
                                            <label><?php echo e(date('d F Y | H:i',$comment->created_at)); ?></label>
                                            <span><?php echo $comment->comment; ?></span>
                                            <span><a href="javascript:void(0);" answer-id="<?php echo e($comment->id); ?>" answer-title="<?php echo e($comment->name); ?>" class="pull-left answer-btn"><?php echo e(trans('main.reply')); ?></a> </span>
                                            <?php if(count($comment->childs)>0): ?>
                                                <ul class="col-md-11 col-md-offset-1 answer-comment">
                                                    <?php $__currentLoopData = $comment->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a href="/profile/<?php echo e($child->user_id); ?>"><?php echo e($child->name); ?></a>
                                                            <label><?php echo e(date('d F Y | H:i',$child->created_at)); ?></label>
                                                            <span><?php echo $child->comment ?? ''; ?></span>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('.answer-btn').click(function () {
                var parent = $(this).attr('answer-id');
                var title = $(this).attr('answer-title');
                $('input[name="parent"]').val(parent);
                scrollToAnchor('.blog-comment-section');
                $('textarea').attr('placeholder', ' Replied to ' + title);
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

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/blog/post.blade.php ENDPATH**/ ?>