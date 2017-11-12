<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('comment/create/'.$news_item['id']); ?>
    <label for="text">Text</label>
    <textarea name="text"></textarea><br />

    <input type="submit" name="submit" value="Create a comment" />
</form>

<p>User id is : <?php echo $this->ion_auth->user()->row()->id; ?> </p>