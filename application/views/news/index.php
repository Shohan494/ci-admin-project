<h2><?php echo $title; ?></h2>

<?php foreach ($news as $news_item): ?>

        <h3><?php echo $news_item['title']; ?></h3>
        <div class="main">
                <?php echo $news_item['text']; ?>
                <p>By user id: <?php echo $news_item['news_user_id']; ?></p>
                <p><?php if( $news_item['news_user_id'] ===  $this->ion_auth->user()->row()->id ){
                		echo 'EDIT POST';
                } ?>
                </p>
        </div>
        <p><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article</a></p>



<?php endforeach; ?>