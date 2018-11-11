<div class="form-group col-md-12">
  <h2>Document Section</h2>                    
  <div class="form-group col-md-12">
    <label for="document_title">Title</label>
    <input type="text" class="form-control" id="document_title" name="service_documents[title]" value="<?php echo (isset($service_documents['title'])?$service_documents['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="document_terms">Document Terms</label>
    <select name="service_documents[document_terms][]" id="document_terms" multiple="" class="form-control select2-multiple">
      <option value="">Select Term</option>
      <?php 
      $document_terms = (isset($service_documents['document_terms']) && !empty($service_documents['document_terms'])?$service_documents['document_terms']:[]);
      $terms = DB::table('terms')->whereIn('term_id', $document_terms)->get()->toArray();
      if (!empty($terms)) {
        foreach ($terms as $term) {
          echo '<option value="'.$term->term_id.'" selected>'.$term->term_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>