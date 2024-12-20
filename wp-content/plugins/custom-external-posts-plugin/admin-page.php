<div class="wrap">
    <h1>Custom External Posts</h1>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'success') : ?>
        <div class="updated">
            <p>Posts have been successfully saved!</p>
        </div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error') : ?>
        <div class="error">
            <p>There was an error saving the posts. Please try again.</p>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="save_custom_posts">
        <?php wp_nonce_field('save_custom_posts_nonce'); ?>

        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <h3>Post <?php echo $i; ?></h3>
            <p>
                <label for="title_<?php echo $i; ?>">Title</label>
                <input type="text" name="title_<?php echo $i; ?>" id="title_<?php echo $i; ?>" required />
            </p>
            <p>
                <label for="image_url_<?php echo $i; ?>">Image URL</label>
                <input type="url" name="image_url_<?php echo $i; ?>" id="image_url_<?php echo $i; ?>" required />
            </p>
            <p>
                <label for="is_enabled_<?php echo $i; ?>">Enable</label>
                <input type="checkbox" name="is_enabled_<?php echo $i; ?>" id="is_enabled_<?php echo $i; ?>" checked />
            </p>
        <?php endfor; ?>

        <p>
            <button type="submit" class="button button-primary">Save</button>
        </p>
    </form>
</div>