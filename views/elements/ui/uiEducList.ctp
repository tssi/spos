<td>
	<span class="label">
		Educ Level:
	</span>
</td>
<td>
	<select name="data[Inquiry][educ_level_id]" id="InquiryEducLevelId" class="uiSmartList" link_to="#InquiryProgramId">
		<option value="%">
			Select Educ Level
		</option>
		<?php foreach ($educLevels as $educLevel): ?>
			<option value="<?= $educLevel['EducLevel']['id'] ?>"class="e-<?= $educLevel['EducLevel']['id'] ?>">
				<?=$educLevel[ 'EducLevel'][ 'name'] ?>
					</option>
					<?php endforeach; ?>
						</select>
						</td>
						<td>
							<span class="label">
								Program:
							</span>
						</td>
						<td>
							<select name="data[Inquiry][program_id]" id="InquiryProgramId" class="uiSmartList" link_to="#InquiryYearLevelId">
								<option value="%">
									Select Program
								</option>
								<?php foreach ($programs as $program): ?>
									<option value="<?= $program['Program']['id'] ?>" class="p-<?= $program['Program']['id'] ?> e-<?= $program['Program']['educ_level_id'] ?> ">
										<?=$program[ 'Program'][ 'name'] ?>
											</option>
											<?php endforeach; ?>
												</select>
												</td>
												<td>
													<span class="label">
														Gr/Yr Level:
													</span>
												</td>
												<td>
													<select name="data[Inquiry][year_level_id]" id="InquiryYearLevelId">
														<option value="%">
															Select Level
														</option>
														<?php foreach ($yearLevels as $yearLevel): ?>
															<option value="<?= $yearLevel['YearLevel']['id'] ?>" class="y-<?= $yearLevel['YearLevel']['id'] ?> p-<?= $yearLevel['YearLevel']['program_id'] ?>">
																<?=$yearLevel[ 'YearLevel'][ 'name'] ?>
																	</option>
																	<?php endforeach; ?>
																		</select>
																		</td>