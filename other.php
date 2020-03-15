<?php

  include('server.php');
  include('session_security.php');



  
  
 ?>



<?php include('navbar.php'); ?>
  <!-- start: Header -->
  
    <div class="container-fluid-full">
    <div class="row-fluid">
        
      <!-- start: Main Menu -->
    <?php include('sidebar.php'); ?>
      <!-- end: Main Menu -->
      
      <noscript>
        <div class="alert alert-block span10">
          <h4 class="alert-heading">Warning!</h4>
          <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
        </div>
      </noscript>
      
      <!-- start: Content -->
        <div id="content" class="span10">
      
      <div class="row-fluid">
        
        <div class="span6">
          <div style="background: gray;height: 45px;color:white;margin-bottom:7px; ">
                <h1 align="center">Create Category table</h1>
          </div>
          <div class="container-fluid">
              <div class="row">
                <div class="col-sm-4">
                  <form class="form-horizontal" method="post" action="server.php">
                      <fieldset>
                      <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name</label>
                        <div class="controls">
                        <input type="text" name="user_id">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="typeahead">Category Description </label>
                        <div class="controls">
                          <textarea rows="4" cols="50" name="category_description">

                        </textarea>
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Save
                      user</button>
                      
                      </fieldset>
                  </form>
                </div>
              </div>
            </div>
          
          <div class="clearfix"></div>    
          
        </div>
        
        <div class="span5 noMarginLeft">
          
          <div class="dark">
          
          <h1>Timeline</h1>
          
          <div class="timeline">
              <div class="container-fluid">
              <div class="row">
                <div class="col-sm-4">
                  <form class="form-horizontal" method="post" action="server.php">
                      <fieldset>
                      <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name</label>
                        <div class="controls">
                        <input type="text" name="user_id">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="typeahead">Category Description </label>
                        <div class="controls">
                          <textarea rows="4" cols="50" name="category_description">

                        </textarea>
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Save
                      user</button>
                      
                      </fieldset>
                  </form>
                </div>
                <div class="col-sm-4">
                  <form class="form-horizontal" method="post" action="server.php">
                      <fieldset>
                      <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name</label>
                        <div class="controls">
                        <input type="text" name="user_id">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="typeahead">Category Description </label>
                        <div class="controls">
                          <textarea rows="4" cols="50" name="category_description">

                        </textarea>
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Save
                      user</button>
                      
                      </fieldset>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
        
        </div>  
            
      </div>
      
       

  </div><!--/.fluid-container-->
  
        
      <!-- end: Content -->
    </div><!--/#content.span10-->
    </div><!--/fluid-row-->
    
  <?php include('footer.php'); ?>