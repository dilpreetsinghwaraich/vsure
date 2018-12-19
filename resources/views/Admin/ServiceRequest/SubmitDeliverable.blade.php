<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30"><?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <section id="feature" class="vsure-company-details-page wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="text-center">
          <div class="logedin-notifications-page">
            <div class="row" style="text-align: left;">
              <?php echo Form::open(array('url' => 'admin/submit/service/request/deliverable/'.$serviceRequest->ticket,'method' => 'post', 'files' => true)) ?>
                <div class="form-group">
                  <label>Enter Title</label>
                  <input type="text" name="title" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                  <label>Upload Document</label>
                  <input type="file" name="document" placeholder="Title" class="form-control">
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-info">
              </form
            </div>
          </div>
        </div>
      </section>
      <section class="vsure-company-details-page wow fadeIn delay-05s animated" style="margin-top: 40px;">
        <div class="row">
          <style type="text/css">
            a.document-date {
                background: #3bb14b;
                padding: 10px 20px;
                margin: 10px 0;
                display: inline-block;
                border-radius: 50px;
                color: #fff !important;
                box-shadow: 0px 2px 7px 0 #ccc;
            }
            p.document-name {
                font-size: 15px;
                color: #585454;
                font-family: 'roboto';
            }
            .documents-page-document-main img {
                border: 4px solid#405199;
                border-radius: 50%;
                max-width: 160px;
                max-height: 160px;
            }
            .documents-page-document-main {
              width: 200px; float: left; padding:20px; border: 1px solid; margin: 2px;
            }
          </style>
          <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd" style="display: inline-block;">
              <?php 
              if (!empty($deliverables)) {
                foreach ($deliverables as $deliverable) {
                  ?>
                <div class="mT-30 documents-page-document-main">
                  <div class=""  style="text-align: center;">
                    <?php 
                      $file = $deliverable->document;
                      $ext = pathinfo($file, PATHINFO_EXTENSION);
                      switch ($ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" target="_blank"><img src="<?php echo asset('/').'/'.$file ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break;
                        case 'doc':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/doc.png') ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break; 
                        case 'pdf':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/pdf.png') ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break; 
                        case 'xlsx':
                        case 'csv':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/xlsz.png') ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break; 
                          default:
                              ?>
                                <img src="<?php echo asset('/public/images/document.png') ?>" class="img-responsive" style="width: 200px; height: 200px;">
                              <?php
                          break;
                        }
                          ?>
                    <p class="document-name"><?php echo $deliverable->title ?></p>
                    <a class="document-date"><?php echo date('M, d Y h:i A', strtotime($deliverable->created_at)); ?></a>
                    <a class="document-date" href="<?php echo url('admin/delete/service/request/deliverable/'.$deliverable->deliverable_id) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                </div>
                  <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>          
