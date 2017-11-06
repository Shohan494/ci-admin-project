<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/updatedata'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" value= "<?php echo $updated_data['title'] ?>" /><br />

    <label for="text">Text</label>
    <input type="input" name="text" value= "<?php echo $updated_data['text'] ?>" /><br />

    <input type="hidden" name="id" value="<?php echo $updated_data['id'] ?>">

    <input type="submit" name="submit" value="Update news item" />

</form>

<p>User id is : <?php echo $this->ion_auth->user()->row()->id; ?> </p>