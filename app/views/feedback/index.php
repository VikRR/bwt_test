<div class="row feedback">
    <?php foreach ($data as $k => $v): ?>
        <div class="row block">
            <div class="col-md-2 user">
                <?php if (key_exists('first_name', $v)): ?>
                    <p><?php echo $v['first_name'] . ' ' . $v['last_name']; ?></p>
                <?php else: ?>
                    <p><?php echo $v['guest']; ?></p>
                <?php endif ?>
            </div>
            <div class="col-md-10 comment">
                <p><?php echo $v['date_create']; ?></p>
                <p><?php echo $v['comment']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
