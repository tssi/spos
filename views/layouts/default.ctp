<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en" class="chrome  win"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
   <title>
		<?php echo $SystemsDefault['SCHOOL_NAME']; ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon',$SystemsDefault['ISMS_ICON'], array('type' =>'icon'));
		echo $this->Html->css('style/style');
		echo $this->Html->script(array('ss/ssScript','ss/ssUtil'));
	?>
	 <!--[if IE 6]><?php echo $this->Html->css('style/styleIE6');?><![endif]-->
    <!--[if IE 7]><?php echo $this->Html->css('style/styleIE7');?><![endif]-->
	<?php
		echo $this->Html->css(array('ss/ssSystem','ss/ssForm','ss/ssTable','ss/ssMetrics','ss/ssOrient','ss/ssInterface'));
		echo $this->Html->css('jquery/jqueryUI');
		echo $this->Html->script(array('jquery/jquery','jquery/jqueryUI','jquery/jqueryLivequery','jquery/jqueryForm','jquery/jqueryJSON'));
		echo $scripts_for_layout;
	?>
   

</head>
<body>
<div id="art-page-background-simple-gradient">
        <div id="art-page-background-gradient"></div>
    </div>
    <div id="art-main">
        <div class="art-sheet">
            <div class="art-sheet-tl"></div>
            <div class="art-sheet-tr"></div>
            <div class="art-sheet-bl"></div>
            <div class="art-sheet-br"></div>
            <div class="art-sheet-tc"></div>
            <div class="art-sheet-bc"></div>
            <div class="art-sheet-cl"></div>
            <div class="art-sheet-cr"></div>
            <div class="art-sheet-cc"></div>
            <div class="art-sheet-body">
                <div class="art-header">
                    <div class="art-header-png"></div>
                    <div class="art-header-jpeg"></div>
                    <div id="art-flash-area">
                    <div id="art-flash-container">
                   
                    </div>
                    </div>
                    <div class="art-logo">
						<div id="schoolLogo" class="logo">
						<?php
							echo $this->Html->image($SystemsDefault['SCHOOL_LOGO'],array("width"=>"130px"));
							
						?>
						</div>
						<div  id="systemLogo" class="logo">
						<?php
							echo $this->Html->image($SystemsDefault['ISMS_LOGO']);
						?>
						</div>
						
                    </div>
					<?php if($user){?>                   
					   <div id="userPane"> Welcome <?php echo $user['first_name'].' '.$user['last_name']; ?>!</div>
		   
					 <?php } ?>   
              </div>
                <div class="art-nav">
                	<div class="l"></div>
                	<div class="r"></div>
					<?php echo $tree->generate($navigation_layout,array('model'=>'Navigation','alias'=>'title','class'=>'art-menu','element'=>'ui/uiNavigation')); ?> 
   			   </div>
				<!-- Content  Start-->
                <div class="art-content-layout">
					 <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
                            <div class="art-post">
                                <div class="art-post-tl"></div>
                                <div class="art-post-tr"></div>
                                <div class="art-post-bl"></div>
                                <div class="art-post-br"></div>
                                <div class="art-post-tc"></div>
                                <div class="art-post-bc"></div>
                                <div class="art-post-cl"></div>
                                <div class="art-post-cr"></div>
                                <div class="art-post-cc"></div>
                                <div class="art-post-body">
									<div class="art-post-inner">
										<!-- <h2 class="art-postheader">Welcome</h2> -->
										<div class="art-postcontent">
											<div class="art-content-layout overview-table">
											<?php echo $this->Session->flash(); ?>
											<?php echo $content_for_layout; ?>
										</div>
										</div>
										<div class="cleared"></div>
									</div>
									<div class="cleared"></div>
								</div>
							</div>
						</div>
					</div>
                </div>
				<!-- Content End-->
                <div class="cleared"></div><div class="art-footer">
                    <div class="art-footer-inner">
                        <div class="art-footer-text">
                            <p><a href="#">The Simplified Solutions Inc.</a><br>
                                Copyright &copy; <?php echo date('Y'); ?> --- All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="art-footer-background"></div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
        <p class="art-page-footer"></p>
    </div>
    


</body></html>