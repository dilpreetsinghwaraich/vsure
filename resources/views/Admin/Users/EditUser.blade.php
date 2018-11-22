
      <h4 class="c-grey-900 mT-10 mB-30">All Users</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/user/update/'.$user->user_id, 'method' => 'post')) ?>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->name ?>" placeholder="Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email ?>" required placeholder="Email">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user->phone ?>" placeholder="Phone">                  
                  </div>
                  <div class="form-group col-md-6">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?php echo $user->company ?>" placeholder="Company">
                  </div>
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $user->country ?>" placeholder="Country">                  
                  </div>
                  <div class="form-group col-md-6">
                    <label for="company">State</label>
                    <input type="text" class="form-control" id="state" name="state" value="<?php echo $user->state ?>" placeholder="State">
                  </div>
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="phone">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $user->city ?>" placeholder="City">                  
                  </div>
                  <div class="form-group col-md-6">
                    <label for="company">Role</label>
                    <select name="role" class="form-control">
                      <option value="">Select</option>
                      <option value="admin" <?php echo $user->role == 'admin' ?'selected' : ''; ?>>Admin</option>
                      <option value="subscriber"  <?php echo $user->role == 'editor' ?'selected' : ''; ?>>Editor</option>                      
                      <option value="subscriber"  <?php echo $user->role == 'subcriber' ?'selected' : ''; ?>>Subscriber</option>                      
                    </select>
                  </div>
                </div>                       
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    