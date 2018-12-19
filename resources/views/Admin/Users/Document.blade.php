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
	</style>
	<div class="masonry-item col-md-12">
	  	<div class="bgc-white p-20 bd" style="display: inline-block;">
	    	<div class="mT-30">
			<?php 
			if (!empty($documents)) {
				foreach ($documents as $document) {
					?>
					<div class="documents-page-document-main" style="width: 30%; float: left;">
						<img src="<?php echo asset('/'.$document->file); ?>" style="width: 70px;height: 70px;">
						<p class="document-name"><?php echo $document->type ?></p>
						<a class="document-date"><?php echo date('M, d Y h:i A', strtotime($document->created_at)); ?></a>
					</div>
					<?php
				}
			}
			?>
			</div>
		</div>
	</div>
</div>