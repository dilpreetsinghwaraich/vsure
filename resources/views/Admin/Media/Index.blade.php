<div class="row">
  <div class="col-md-4">
    <div class="row">
      <div class="masonry-item col-md-12">
        <div class="bgc-white p-20 bd">
          <div class="">
            <?php echo Form::open(array('url' => 'admin/save/media/', 'method' => 'post', 'files'=>true,'id'=>'media_imege')) ?>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="question_terms">Image</label>
                  <input type="file" name="image[]" multiple="" class="form-control" required="" onChange="jQuery('#media_imege').submit();">
                </div>
              </div> 
            </form>
          </div>
        </div>
      </div>
    </div> 
  </div>
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">All Media</h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20" style="    display: inline-block;">
          <?php 
          $sno = 1;
          foreach ($posts as $post)
          {
            ?>
            <div style="width: 16.66667%; float: left;border: 2px solid;" class="view_media_image" data-post_id="<?php echo $post->post_id; ?>">
              <?php if (!empty($post->image)) {
                ?>
                <img src="<?php echo asset('/').$post->image ?>" style="width: 100%;height: 200px;" alt="<?php echo $post->post_title; ?>">
                <?php
              } ?>
            </div>
            <?php 
            $sno++;
          }
          ?>
    </div>
    {{ $posts->links() }}
  </div>
</div>   
<style type="text/css">
.view_media_image{
  cursor: pointer;
}
.media_popup {
    width: 100%;
    height: 100%;
    background: #00000091;
    position: fixed;
    left: 0px;
    top: 0px;
    display: none;  
}
.media_popup_model {
    width: 700px;
    height: 400px;
    background: #fff;
    position: absolute;
    left: 0;
    top: 70px;
    right: 0;
    margin: auto;
}
a.hide_media_popup {
    position: absolute;
    right: 0px;
    top: 0px;
    font-size: 25px;
    z-index: 9999;
}
</style>       
<div class="media_popup">  
  <div class="media_popup_model">
    <a href="javascript:void(0)" class="hide_media_popup">X</a>
    <div class="media_popup_body">
    </div>
  </div>
</div>