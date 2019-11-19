<?php $base_url="http://localhost/rishtawebb/"; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px; position:fixed; z-index:5; ">
			<nav class="navbar-inverse" style=" background-color:#A00000;">
				<div class="container-fluid">
					<div class="row" style="font-family:Arial">
					
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-8" id="logoMargin">
							<a href="<?php echo $base_url?>" style="text-decoration:none">
								<span id="logoText1">RISHTA<span id="logoText2">WEB</span></span>
							</a>
						</div>
						<div class="col-lg-9  col-md-9 col-sm-9 col-xs-4" style="padding:0px">
							<div class="col-xs-12" style="padding:0px">
							
								<span class="navbar-toggle" data-toggle="collapse" data-target="#target" id="navbarToggleButton">
									<span id="iconBar" class="icon-bar"></span> <span id="iconBar" class="icon-bar"></span> <span id="iconBar" class="icon-bar"></span>
								</span>	
							</div>	
						</div>
						
						<div class="col-lg-9  col-md-9 col-sm-9 col-xs-12" style="padding:0px; background-color:#A00000">
							<div class="collapse navbar-collapse" id="target" style="border-top:0px solid #800000">
								<ul class=" nav navbar-nav navbar-right" >
									<li><a href="<?php echo $base_url?>searchguest.php"><i class="fas fa-search nav-icons" style="margin-right:15px"></i>Search</a></li>
									<li><a href="<?php echo $base_url?>all-categories.php"><i class="fas fa-list-ul nav-icons" style="margin-right:15px"></i>Category</a></li>
									<li><a href="<?php echo $base_url?>login.php"><i class="fas fa-sign-in-alt nav-icons" style="margin-right:15px"></i>Login</a></li>
									<li style="background-color:#f96714; border-radius:2px" id="createAccountNow" >
										<a href="<?php echo $base_url?>CompleteSignUp.php"><i class="fas fa-user-plus nav-icons" style="margin-right:15px"></i>Create Account Now</a>
									</li>
								</ul>
							</div>	
						</div>
						
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>




<!-- login modal -->
<div class="modal fade" id="loginmodel" role="dialog">
	<div class="modal-dialog ">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title vp-modal-flex-title">Login or Register to send Message!</h4>
		</div>
		<div class="modal-body" style="margin-top: 14px; height: 95px">
			<div class="vp-modal-flex">
				<div>
					<a href="<?php echo $base_url;?>login.php" class="vp-modal-flex-btn">
						Login
					</a>
				</div>
				<div>
					<a href="<?php echo $base_url;?>completesignup.php" class="vp-modal-flex-btn">
						Register Now
					</a>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>