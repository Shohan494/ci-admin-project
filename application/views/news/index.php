<table border='1' cellpadding='4'>
    <tr>
        <td><strong>Title</strong></td>
        <td><strong>Content</strong></td>
        <td><strong>News Writer Id</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($news as $news_item): ?>
        <tr>
            <td><?php echo $news_item['title']; ?></td>
            <td><?php echo $news_item['text']; ?></td>
            <td>By user id: <?php echo $news_item['news_user_id']; ?></td>
            <td>
                <a href="<?php echo site_url('news2/'.$news_item['id']); ?>">View</a> | 
                <a href="<?php echo site_url('news2/edit/'.$news_item['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('news2/delete/'.$news_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</br>
</table>
</br>