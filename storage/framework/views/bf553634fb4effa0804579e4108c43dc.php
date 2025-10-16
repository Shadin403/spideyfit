<style>
    @media screen and (max-width: 1024px) {
        #pagination-custom {
            justify-content: center !important;
        }
    }

    @media screen and (max-width: 768px) {
        #pagination-custom {
            justify-content: flex-end !important;
        }
    }
</style>

<?php if($paginator->hasPages()): ?>
    <nav class="mt-3 shop-pages d-flex justify-content-between align-items-center" role="navigation"
        aria-label="Pagination">


        <!-- Showing Results -->
        <div class="small text-muted">
            <?php echo __('Showing'); ?>

            <span class="fw-semibold"><?php echo e($paginator->firstItem()); ?></span>
            <?php echo __('to'); ?>

            <span class="fw-semibold"><?php echo e($paginator->lastItem()); ?></span>
            <?php echo __('of'); ?>

            <span class="fw-semibold"><?php echo e($paginator->total()); ?></span>
            <?php echo __('results'); ?>

        </div>

        <div class="d-flex align-items-center" id="pagination-custom">
            <!-- PREV Button -->
            <?php if(!$paginator->onFirstPage()): ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="mx-2 page-link d-inline-flex align-items-center">
                    <svg class="me-1" width="7" height="11" viewBox="0 0 7 11"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_sm" />
                    </svg>
                    <span class="fw-medium">PREV</span>
                </a>
            <?php endif; ?>

            <!-- Pagination Links -->
            <ul class="mx-2 mb-0 pagination">
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(is_string($element)): ?>
                        <li class="page-item disabled"><span class="page-link"><?php echo e($element); ?></span></li>
                    <?php endif; ?>

                    <?php if(is_array($element)): ?>
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($paginator->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <!-- NEXT Button -->
            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="mx-2 page-link d-inline-flex align-items-center">
                    <span class="fw-medium me-1">NEXT</span>
                    <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_sm" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>

    </nav>
<?php endif; ?>
<?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/vendor/pagination/custom-pagination.blade.php ENDPATH**/ ?>