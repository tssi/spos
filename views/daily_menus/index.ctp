<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric', 'ui/uiSmartSearch', 'ss/ssUtil', 'biz/menu'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch', 'context/jquery-contextmenu'));
?>
<style>

li.clickInput .dim input{
	background-color: #DFDFDF !important;
    color: #B4B5B6;
}

li.clickInput .current input{
	background-color: white !important;
    color: #B4B5B6;
}



</style>
<div id="dialog"></div>
<div class="tab">	
	<div class="tab-header">Daily Menus</div>	
	<div class="tab-content">	
		<div class="canteen form formNeat w95 mCenter">
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
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
							<div class="iscroll w100" id="masterList">
								<div class="iscrollWrapper">
									<ul class="recordDatagrid tab-content on w100 h175px b1sg  nbLeft  nbRight">			
										<li class="mainInput">
											<div class='hide'>
												<div class="menu_item_id">
													<div class="input">											
														<?php echo $this->Form->input('id',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
													</div>
												</div>
												<div class="code">
													<div class="input">											
														<?php echo $this->Form->input('code',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
													</div>
												</div>
												<div class="appSrv">
													<div class="input">											
														<?php echo $this->Form->input('approx_srv',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
													</div>
												</div>
												<div class="money AVGprice">
														<?php echo $this->Form->input('avg_price',array('readonly'=>'readonly','label'=>false,'id'=>false, 'class'=>'monetary')); ?>
												</div>
											</div>
											
											<div class="fLeft w55 desc">
												<?php echo $this->Form->input('Description',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?>
											</div>	
											<div class="fRight w45">
												<div class="fLeft w40 unit">
														<div class="input select">
														<?php echo $this->Form->input('unit',array('readonly'=>'readonly','label'=>false,'id'=>false, 'div'=>false, 'class'=>'view-mode')); ?>  
														<?php echo $this->Form->select('unit', $units, null, array('readonly'=>'readonly', 'empty'=>false, 'label'=>false,'id'=>false, 'class'=>'hide edit-mode'));?>
														</div>
												</div>
												<div class="fRight w60 money price">
													<?php echo $this->Form->input('selling_price',array('readonly'=>'readonly','label'=>false,'id'=>false, 'class'=>'monetary')); ?>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</li>
									</ul>		
								</div>
							</div>
						</div>
					</div>
					<div class="w100 metro soft ">
						<div class="wrapper pt5 topaz">
							<div class="w100 ">
								<?php echo $this->Form->input('Search', array('class'=>'uiSmartSearch','search-on'=>'#masterList ul.recordDataGrid li.clickInput','id'=>'desc')); ?>
							</div>
							<div class="taRight pt5 topaz hide">
								<?php echo $this->Form->submit('Menus',array('type'=>'button','class'=>'selected fwb goto-button'));?>
							</div>	
						</div>
					</div>
				</div>
				<?php echo $this->Form->create('DailyMenu', array('action'=>'add'));?>
				<div class="fRight w60 pt5">
					<div class="fwb fsMedium pbtm w100 classic soft">
						<div class="w10 fLeft">&nbsp;</div>
						<div class="w90 fRight">
							<div class="fLeft w60 input text">
								Date: &nbsp; <input name="data[DailyMenu][date]" class="datepicker" id="dailyMenuDate" style="width:80%"/>
							</div>
							<div class="fRight w40 pt5 topaz">
								<?php echo $this->Form->submit('Go',array('type'=>'button','class'=>'selected fwb', 'id'=>'go_button'));?>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					
					<div class="tab record metro nmLeft">
						<h2 class="recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
							Menu for the Day
						</h2>					
						<div class="tab-content nmBottom posRelative" >	
							<div class="recordHeader pbtm btmShadow">
								<div class="fLeft w45 recordHeader">
									<div class="fLeft w75">Description</div>
									<div class="fRight w25">Price</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w55 recordHeader">
									<div class="fLeft w45">
										<div class="fLeft w50">Est. Cost</div>
										<div class="fRight w50 ">Unit</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w55">
										<div class="fLeft w40 ">App. Srv.</div>
										<div class="fRight w59 text-left">Srv. Left</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
							<div class="iscroll w100" id="menu">
								<div class="iscrollWrapper">
										<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
											<li class="mainInput">
												<div class="fLeft w30">
													<div class="hide daily_menu_id">
														<div class="input">
															<?php echo $this->Form->input('DailyMenu.%.id',array('readonly'=>'readonly','label'=>false,'type'=>'hidden','id'=>false)); ?>
														</div>
													</div>
													<div class="hide menu_item_id">
														<div class="input">
															<?php echo $this->Form->input('DailyMenu.%.menu_item_id',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
														</div>
													</div>
													<div class="hide code">
														<div class="input">
															<?php echo $this->Form->input('code',array('readonly'=>'readonly','label'=>false, 'type'=>'hidden','id'=>false)); ?>
														</div>
													</div>
													<div class="fLeft w100 desc VIEWdesc">
														<div class="input">
															<?php echo $this->Form->input('desc',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?>
														</div>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fRight w70 ">
													<div class="fLeft w40">
														<div class="fLeft w50 price money VIEWprice ">
															<?php echo $this->Form->input('DailyMenu.%.selling_price',array('readonly'=>'readonly','label'=>false,'id'=>false,'class'=>'editable')); ?>
														</div>
														<div class="fRight w50 AVGprice money">
															<?php echo $this->Form->input('avg_price',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?>
														</div>
														 <div class="fClear"></div>
													</div>
													<div class="fRight w60">
														<div class="fLeft w30 unit">
															<?php echo $this->Form->input('DailyMenu.%.unit',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?>
														</div>
														<div class="fRight w70">
															<div class="fLeft w70">
																<div class="fLeft w50 appSrv money">
																	<div class="input text required">
																		<?php echo $this->Form->input('DailyMenu.%.approx_srv',array('readonly'=>'readonly','label'=>false,'id'=>false, 'value'=>'X','class'=>'editable numeric')); ?>
																	</div>
																</div>
																<div class="fRight w50 srvLeft money">
																		<?php echo $this->Form->input('DailyMenu.%.srv_left',array('readonly'=>'readonly','label'=>false,'id'=>false,'class'=>'editable')); ?>
																</div>
																<div class="fClear"></div>
															</div>
															<div class="fLeft w15 action">
																<a class="edit-product">
																	<img src="/canteen/img/icons/pencil.png">
																</a>
															</div>
															<div class="fRight w15 ">
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
					</div>
					<div class="fRight w30">
						<div class="fLeft pt5 topaz w100 ">
							<?php echo $this->Form->submit('Save',array('type'=>'button','id'=>'submit_button','class'=>'selected fwb submit-button'));?>
							<?php echo $this->Form->submit('Cancel',array('type'=>'reset','id'=>'cancel_button','class'=>'selected fwb'));?>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
					
				</div>
				<div class="fClear"></div>	
				<?php echo $this->Form->end(); ?>
				<?php echo $this->Form->create('MenuItem', array('action'=>'edit', 'div'=>false, 'id'=>'MenuForm'));?>
					<?php echo $this->Form->input('id', array('type'=>'hidden', 'div'=>false, 'class'=>'menuId'));?>
					<?php echo $this->Form->input('item_code', array('type'=>'hidden', 'div'=>false));?>
					<?php echo $this->Form->input('name', array('type'=>'hidden', 'div'=>false));?>
					<?php echo $this->Form->input('unit_id', array('type'=>'hidden', 'div'=>false));?>
					<?php echo $this->Form->input('selling_price', array('type'=>'hidden', 'div'=>false));?>
				<?php echo $this->Form->end(); ?>
		</div>		
	</div>	
<div id="myDialog"></div>
</div>
