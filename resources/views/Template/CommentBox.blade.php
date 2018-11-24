<div class="post_comment">
  @if (Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    <?php Session::forget('success') ?>
  @endif
  @if (Session::has('warning'))
    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
    <?php Session::forget('warning') ?>
  @endif
  <div class="post_comment_title">Post Comment</div>
  <div class="row">
    <?php 
    $currentUser = Helper::getCurrentUser();
    ?>
    <div class="col-xl-8">
      <div class="post_comment_form_container">
        <?php echo Form::open(array('url' => 'post/save/comment', 'method' => 'post')) ?>
          <input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>">
          <input type="text" class="comment_input comment_input_name" name="comment_author_name" value="<?php echo $currentUser->name; ?>" placeholder="Your Name" required>
          <input type="email" class="comment_input comment_input_email" name="comment_author_email" value="<?php echo $currentUser->email; ?>" placeholder="Your Email" required>
          <textarea class="comment_text" placeholder="Your Comment" name="comment_content" required></textarea>
          <button type="submit" class="comment_button">Post Comment</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="comments">
  <div class="comments_title">Comments <span>(<?php echo count($comments); ?>)</span></div>
  <div class="row">
    <div class="col-xl-8">
      <div class="comments_container">
        <ul class="comment_list">
        <?php 
        foreach ($comments as $comment) {
          $author = Helper::getUser($comment->user_id);
          if (!empty($author->image)) {
            $authorimage = asset('/').'/'.$author->image;
          }else{
            $authorimage = asset('/').'public/images/comment_author_1.jpg';
          } 
        ?> 
          <li class="comment">
            <div class="comment_body">
              <div class="comment_panel d-flex flex-row align-items-center justify-content-start">
                <div class="comment_author_image">
                  <div><img src="<?php echo $authorimage; ?>" alt="<?php echo $comment->comment_author_name ?>"></div>
                </div>
                <small class="post_meta">
                  <a><?php echo $comment->comment_author_name ?></a>
                  <span><?php echo date('M, d Y  h:i A', strtotime($comment->created_at)); ?></span>
                </small>
              </div>
              <div class="comment_content">
                <p><?php echo $comment->comment_content ?></p>
              </div>
            </div>
          </li>
        <?php 
        }
        ?>
        </ul>
      </div>
      {{ $comments->links() }}
    </div>
  </div>
</div>