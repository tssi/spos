<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/recon',
	'ss/ssUtil',
	'ss/timeago'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
.pbtm {
	padding-bottom: 12px !important;
}

.wWider label{
	width: 27px;
}
.w60px{
	width: 60px !important;
}
.w90px{
	width: 90px !important;
}


</style>
<div id="myDialog"></div>
<div id="progress-bar"></div>
<div class="tab w100">
	<div class="tab-header">Ending Reconciliation Inventory</div>
	<div class="tab-content">
		<div class="canteen form formNeat w98 mCenter pt5">
			<?php echo $this->Form->create('EndingReconciliation',array('action'=>'add', 'id'=>'recon_merch'));?>
				<?php echo $this->Form->input('user',array('type'=>'hidden', 'id'=>false, 'value'=>$user['userFull']));?>
				<?php echo $this->Form->input('type',array('type'=>'hidden', 'id'=>false, 'value'=>'MERCH'));?>
				<?php echo $this->Form->input('ref_no',array('type'=>'hidden', 'id'=>'MERCH_REF_NO', 'value'=>'null'));?>
				<?php echo $this->Form->input('id',array('type'=>'hidden', 'id'=>'Id'));?>
				<!--Ending Reconciliation Inventory-->	
				<div class="w100">
					<div class="fLeft w50 classic soft">
						<div class="fLeft w45">
							<?php echo $this->Form->input('date',array('class'=>'w50','label'=>array('class'=>'w60px'), 'value'=>date('Y-m-d'))); ?>			
						</div>
						<div class="fRight w55">
							<?php echo $this->Form->input('Merch.begin_date',array('class'=>'w46','label'=>array('class'=>'w90px', 'text'=>'Beginning'))); ?>
						</div>
						<div class='fClear'></div>
						<div class="fLeft w45 ">
							&nbsp
						</div>
						<div class="fRight w55">
							<?php echo $this->Form->input('Merch.end_date',array('class'=>'w46','label'=>array('class'=>'w90px', 'text'=>'Ending'))); ?>
						</div>
						<div class='fClear'></div>
					</div>
					<div class="fRight w50 classic soft hide">
						<div class="fLeft w50 ">
							<?php echo $this->Form->input('Merch.begin_actual',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Actual'))); ?>
						</div>
						<div class="fRight w50">
							<?php echo $this->Form->input('Merch.begin_computer',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Computer'))); ?>
						</div>
						<div class='fClear'></div>
						<div class="fLeft w50 ">
							<?php echo $this->Form->input('Merch.end_actual',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Actual'))); ?>
						</div>
						<div class="fRight w50">
							<?php echo $this->Form->input('Merch.end_computer',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Computer'))); ?>
						</div>
						<div class='fClear'></div>
					</div>
					<div class='fClear'></div>	
				</div>
				
				<div class="tab record metro nmLeft w100 mCenter">
					<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
								Merchandise
					</h2>
					<div class="tab-content nmBottom5">
						<div class="recordHeader pbtm btmShadow posRelative pbtm">
							<div class="fLeft w15">
								<div class="fLeft w100 ">Beginning</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w85 ">
									<div class="fLeft w30">
										<div class="fLeft w50 ">
											<div class="fLeft w100 "></div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w70">
										<div class="fLeft w40 ">
											<div class="fLeft w50 "></div>
											<div class="fRight w50 ">Ending</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w60">
											<div class="fLeft w60 ">Variance</div>
											<div class="fRight w40 "></div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
							<div class="wrapper pbtm">
								<div class="fLeft w15 ">
									<div class="fLeft w100">
										<div class="fLeft w50 ">Computer</div>
										<div class="fRight w50 ">Actual</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w85 ">
									<div class="fLeft w50">
										<div class="fLeft w55 ">
											<div class="fLeft w100">Desc</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w45">
											<div class="fLeft w50 ">Sold</div>
											<div class="fRight w50 ">Computer</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w50">
										<div class="fLeft w40 ">
											<div class="fLeft w50 ">Actual</div>
											<div class="fRight w50 ">Computer</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w60">
											<div class="fLeft w30 ">Actual</div>
											<div class="fRight w70">Remarks</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
						</div>
						
						<div class="iscroll w100" id="ending_recon" style='margin-top: -26px;'>
							<div class="iscrollWrapper">							
								<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
									<li class="mainInput">
										<div class="fLeft w15 ">
											<div class="fLeft w100">		
												<div class="hide id_product">
													<?php echo $this->Form->input('EndingReconciliationDetail.%.id_product',array('type'=>'hidden','id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
												</div>
												<div class="fLeft w50 begC">
													<?php echo $this->Form->input('EndingReconciliationDetail.%.beginning_computer',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
												</div>
												<div class="fRight w50 begA">
													<?php echo $this->Form->input('EndingReconciliationDetail.%.beginning_actual',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
												</div>	
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w85 ">
											<div class="fLeft w50">
												<div class="fLeft w60">
													<div class="fLeft w100 desc">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.desc',array('id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fRight w40">
													<div class="fLeft w50 sold">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.sold',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fRight w50 endC">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.ending_computer',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fRight w50">
												<div class="fLeft w40 ">
													<div class="fLeft w50 endA">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.ending_actual',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fRight w50 varC">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.variance_computer',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fRight w60">
													<div class="fLeft w30 varA">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.variance_actual',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fRight w70 rem">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.remarks',array('id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
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
						
						<div class="fLeft pt5 Progress">
							<pre><b>Progress: </b><span><span></pre>
						</div>
						<div class="fRight pt5 topaz">
							<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb','id'=>'PerLineSubmmittingButton'));?>
						</div>
						<div class="fClear"></div>
					</div>
					
				</div>
			<?php echo $this->Form->end(); ?>
			<br/>
			<?php echo $this->Form->create('EndingReconciliation',array('action'=>'add', 'id'=>'recon_meal'));?>
				<?php echo $this->Form->input('user',array('type'=>'hidden', 'id'=>false, 'value'=>$user['userFull']));?>
				<?php echo $this->Form->input('type',array('type'=>'hidden', 'id'=>false, 'value'=>'MEALS'));?>
				<?php echo $this->Form->input('ref_no',array('type'=>'hidden', 'id'=>'MEALS_REF_NO', 'value'=>'null'));?>
				<div class="w100">
					<div class="fLeft w50 classic soft">
						<div class="fLeft w45"></div>
						<div class="fRight w55">
							<?php echo $this->Form->input('Meal.begin_date',array('class'=>'w46','label'=>array('class'=>'w90px', 'text'=>'Beginning'))); ?>
						</div>
						<div class='fClear'></div>
						<div class="fLeft w45 ">&nbsp </div>
						<div class="fRight w55">
							<?php echo $this->Form->input('Meal.end_date',array('class'=>'w46','label'=>array('class'=>'w90px', 'text'=>'Ending'))); ?>
						</div>
						<div class='fClear'></div>
					</div>
					<div class="fRight w50 classic soft hide">
						<div class="fLeft w50 ">
							<?php echo $this->Form->input('Meal.begin_actual',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Actual'))); ?>
						</div>
						<div class="fRight w50">
							<?php echo $this->Form->input('Meal.begin_computer',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Computer'))); ?>
						</div>
						<div class='fClear'></div>
						<div class="fLeft w50 ">
							<?php echo $this->Form->input('Meal.end_actual',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Actual'))); ?>
						</div>
						<div class="fRight w50">
							<?php echo $this->Form->input('Meal.end_computer',array('class'=>'w50','label'=>array('class'=>'w60px', 'text'=>'Computer'))); ?>
						</div>
						<div class='fClear'></div>
					</div>
					<div class='fClear'></div>	
				</div>
				<br/>
				<div class="tab record metro nmLeft w100 mCenter">
					<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
								Meals
					</h2>
					<div class="tab-content nmBottom5">
						<div class="recordHeader pbtm btmShadow posRelative pbtm">
							<div class="fLeft w15">
								<div class="fLeft w100 ">Beginning</div>	
								<div class="fClear"></div>
							</div>
							<div class="fRight w85 ">
								<div class="fLeft w30">
									<div class="fLeft w50 ">
										<div class="fLeft w100 "></div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w70">
									<div class="fLeft w40 ">
										<div class="fLeft w50 "></div>
										<div class="fRight w50 ">Ending</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w60">
										<div class="fLeft w60 ">Variance</div>
										<div class="fRight w40 "></div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
								
							</div>
							<div class="fClear"></div>
							<div class="wrapper pbtm">
								<div class="fLeft w15 ">
									<div class="fLeft w100">
										<div class="fLeft w50 ">Computer</div>
										<div class="fRight w50 ">Actual</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w85 ">
									<div class="fLeft w50">
										<div class="fLeft w55 ">
											<div class="fLeft w100">Desc</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w45">
											<div class="fLeft w50 ">Sold</div>
											<div class="fRight w50 ">Computer</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w50">
										<div class="fLeft w40 ">
											<div class="fLeft w50 ">Actual</div>
											<div class="fRight w50 ">Computer</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w60">
											<div class="fLeft w30 ">Actual</div>
											<div class="fRight w70">Remarks</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
						</div>
						
						<div class="iscroll w100" id="ending_recon_meals" style='margin-top: -26px;'>
							<div class="iscrollWrapper">							
								<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
									<li class="mainInput">
										<div class="fLeft w15 ">
											<div class="fLeft w100">
												<div class="hide id_product">
													<?php echo $this->Form->input('EndingReconciliationDetail.%.id_product',array('type'=>'hidden','id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
												</div>
												<div class="fLeft w50 begC">
													<?php echo $this->Form->input('EndingReconciliationDetail.%.beginning_computer',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
												</div>
												<div class="fRight w50 begA">
													<?php echo $this->Form->input('EndingReconciliationDetail.%.beginning_actual',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
												</div>	
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w85 ">
											<div class="fLeft w50">
												<div class="fLeft w60">
													<div class="fLeft w100 desc">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.desc',array('id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fRight w40">
													<div class="fLeft w50 sold">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.sold',array('id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
													</div>
													<div class="fRight w50 endC">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.ending_computer',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fRight w50">
												<div class="fLeft w40 ">
													<div class="fLeft w50 endA">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.ending_actual',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fRight w50 varC">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.variance_computer',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fRight w60">
													<div class="fLeft w30 varA">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.variance_actual',array('id'=>false, 'label'=>false, 'class'=>'taRight', 'readonly'=>'readonly')); ?>
													</div>
													<div class="fRight w70 rem">
														<?php echo $this->Form->input('EndingReconciliationDetail.%.remarks',array('id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
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
						
						<div class="fRight pt5 topaz">
							<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button','id'=>false));?>
						</div>
						<div class="fClear"></div>
					</div>
					
				</div>
				<div class="fClear"></div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>


<?php echo $this->Form->create('EndingReconciliation',array('action'=>'report', 'id'=>'Report','target'=>'_blank'));?>
	<?php echo $this->Form->input('id',array('id'=>'ReportEndingReconciliationId')); ?>
<?php echo $this->Form->end(); ?>
