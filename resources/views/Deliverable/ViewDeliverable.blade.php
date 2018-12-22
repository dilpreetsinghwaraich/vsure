<?php $service = \App\Services::find($serviceRequest->service_id); ?>
<h2><?php echo '#'.$serviceRequest->ticket.' '.$service->service_title; ?></h2>
	<div class="content-main">
	<div class="col-lg-12 col-xs-12">
	   	<div class="row">
	   		<?php 
	   		if (!empty($deliverables)) {
	   			foreach ($deliverables as $deliverable) {
	   			?>
   					<div class="documents-page-document-main col-lg-3 col-md-6 col-sm-6 col-xs-12">
   						<?php 
   						  $file = $deliverable->document;
   						  $ext = pathinfo($file, PATHINFO_EXTENSION);
   						  switch ($ext) {
   						    case 'jpg':
   						    case 'jpeg':
   						    case 'png':
   						      ?><a href="<?php echo asset('/').'/'.$file ?>" target="_blank"><img src="<?php echo asset('/').'/'.$file ?>" ></a><?php
   						      break;
   						    case 'doc':
   						      ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/doc.png') ?>" ></a><?php
   						      break; 
   						    case 'pdf':
   						      ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/pdf.png') ?>"></a><?php
   						      break; 
   						    case 'xlsx':
   						    case 'csv':
   						      ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/xlsz.png') ?>" ></a><?php
   						      break; 
   						      default:
   						          ?>
   						            <a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/document.png') ?>"></a>
   						          <?php
   						      break;
   						    }
   						?>
   						<p class="document-name"><?php echo $deliverable->title ?></p>
   						<a class="document-date"><?php echo date('M, d Y h:i A', strtotime($deliverable->created_at)); ?></a>
   					</div>
	   			<?php
	   			}
	   		}
	   		?>
	   	</div>
	</div>
</div>
