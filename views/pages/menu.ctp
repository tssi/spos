<?php
	echo $this->Html->script(array('jquery-contextmenu','ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric', 'ui/uiSmartSearch', 'biz/menu'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
    <div class="cmenu1" style="display:none;width:200px;background-color:white;border:1px solid black;padding:5px;">
		This is my custom context menu
	</div>
	<div class="canteen form formNeat w100">
		<div class="wLong">
			<div class="fLeft w35">
				<div class="record metro tab nmLeft">
					<h2 class="recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
						Menu Master List
					</h2>
					<div class="tab-content nmBottom posRelative" >
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w60 mtop pBtm">
								<div class="w100 recordHeader">Description</div>
							</div>
							<div class="fRight w40 mtop">
								<div class="fLeft w20 recordHeader">Unit</div>
								<div class="fRight w80 recordHeader">Price</div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="iscroll w100" id="masterList">
							<div class="iscrollWrapper">
								<ul class="recordDatagrid tab-content on w100 h175px b1sg  nbLeft  nbRight">
									
                                    <li class="mainInput">
										<div class="fLeft hide menu_item_id">
											<div class="input">
										  <?php echo $this->Form->input('id',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
											</div>
										</div>
										<div class="fLeft w60 desc">
											<?php echo $this->Form->input('Description',array('readonly'=>'readonly','label'=>false)); ?>
										</div>
										
										<div class="fRight w40">
											<div class="fLeft w40 unit"><?php echo $this->Form->input('unit',array('readonly'=>'readonly','label'=>false)); ?></div>
											<div class="fRight w60 price"><?php echo $this->Form->input('Price',array('readonly'=>'readonly','label'=>false)); ?></div>
										</div>
										<div class="fClear"></div>
									</li>
								</ul>		
							</div>
						</div>
					</div>
				</div>
				<div class="fLeft w100 metro soft ">
					<div class="wrapper pt5 topaz">
						
						<div class="fLeft  w100 "><?php echo $this->Form->input('Search', array('class'=>'uiSmartSearch','search-on'=>'#masterList ul.recordDataGrid li.clickInput')); ?></div>
						
						<div class="fClear"></div>				
					</div>
				</div>
			</div>
			<?php echo $this->Form->create('DailyMenu', array('action'=>'add'));?>
			<div class="fRight w60 pt5">
				<div class="fwb fsMedium fRight pbtm w100 classic soft">
					<div class="w20 fRight">&nbsp;</div>
					<div class="w70 fRight"><?php echo $this->Form->input('DailyMenu.date',array( 'class'=>'datepicker')); ?></div>
					<div class="fClear"></div>
				</div>
				<div class="fClear"></div>
				<div class="tab record metro nmLeft">
					<h2 class="recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
						Menu for the Day
					</h2>
					
					<div class="tab-content nmBottom posRelative" >	
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w40 recordHeader">
								<div class="fLeft w100">Description</div>
							</div>
							<div class="fRight w60 recordHeader">
								<div class="fLeft w50">
									<div class="fRight w60">Price</div>
								</div>
								<div class="fRight w50">
									<div class="fLeft w40">App. Srv.</div>
									<div class="fRight w60">Unit.</div>
								</div>
                                <div class="fRight w25 "></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="iscroll w100" id="menu">
							<div class="iscrollWrapper">
									<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
									
										<li class="mainInput">
											
											<div class="fLeft w40 ">
												<div class="hide menu_item_id">
												  <?php echo $this->Form->input('DailyMenu.%.menu_item_id',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
												</div>
												<div class="fLeft w100 desc">
													<?php echo $this->Form->input('desc',array('readonly'=>'readonly','label'=>false)); ?>
												</div>
												 
											</div>
											<div class="fRight w60 ">
												<div class="fLeft w50">
													
													<div class="fRight w50 price">
														<?php echo $this->Form->input('DailyMenu.%.selling_price',array('readonly'=>'readonly','label'=>false)); ?>
													</div>
													 <div class="fClear"></div>
												</div>
												<div class="fRight w50">
													<div class="fLeft w50 appSrv">
														<?php echo $this->Form->input('DailyMenu.%.approx_srv',array('readonly'=>'readonly','label'=>false)); ?>
													</div>
													<div class="fRight w50 unit">
                                                        <div class="fLeft w80 ">
														  <?php echo $this->Form->input('unit',array('readonly'=>'readonly','label'=>false)); ?>
                                                        
                                                        </div>
                                                        <div class="fRight w20 ">
        												    <a class="recordDelete" href="#">X</a>
											             </div>
                       	                                <div class="fClear"></div>
													</div>
                                                    
													 <div class="fClear"></div>
									   			</div>
												<div class="fClear"></div>
									      </div>
										  <div class="fClear"></div>
										</li>
									
									</ul>	
							</div>
						</div>
					</div>
					<?php echo $this->Form->end(); ?>
				</div><div class="fClear"></div>
				<div class="fRight pt5 topaz">
					<?php echo $this->Form->submit('Save',array('type'=>'button','id'=>'submit_button','class'=>'selected fwb submit-button'));?>
					<?php echo $this->Form->submit('Cancel',array('type'=>'reset','id'=>'cancel_button','class'=>'selected fwb'));?>
				</div>
				<div class="fClear"></div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>		
	</div>	