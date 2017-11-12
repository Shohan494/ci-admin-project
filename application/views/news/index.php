<table border='1' cellpadding='5'>
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
            <td>By User Id: <?php echo $news_item['news_user_id']; ?></td>
            <td>
                <a href="<?php echo site_url('news2/'.$news_item['id']); ?>">View</a> |

                <?php if( $news_item['news_user_id'] === $this->ion_auth->user()->row()->id): ?>
                <a href="<?php echo site_url('news2/edit/'.$news_item['id']); ?>">Edit</a> |
                <a href="<?php echo site_url('news2/delete/'.$news_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a> |
                <?php endif; ?>
                <a href="<?php echo site_url('comment/create/'.$news_item['id']); ?>">Comment</a>
            </td>
        </tr>
<?php endforeach; ?>
</br>
</table>
</br>
</br>
<table border='1' cellpadding='5'>
    <tr>
        <td><strong>Comment</strong></td>
        <td><strong>News Id</strong></td>
        <td><strong>Comment Writer Id</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($comments as $comments_item): ?>
        <tr>
            <td><?php echo $comments_item['text']; ?></td>
            <td><?php echo $comments_item['news_id']; ?></td>
            <td>By User Id: <?php echo $comments_item['comment_user_id']; ?></td>
            <td>
                Blank for actions
            </td>
        </tr>
<?php endforeach; ?>
</br>
</table>
</br>
<?php echo anchor("auth/logout", 'Logout') ;?>
</br></br>

