<script>
//Section patch to link YearLevel uiSmartList
$(document).ready(function(){
	$('#InquiryYearLevelId').attr('link_to','#InquirySectionId').addClass('uiSmartList').change();
});
</script>
<td>
	<span class="label">
		Section:
	</span>
</td>
<td>
	<span style = "display:none">
	<select name="data[Inquiry][section_id]" id="InquirySectionId">
		<option value="%">
			Select Section
		</option>
		<?php foreach ($sections as $section): ?>
			<option value="<?= $section['Section']['id'] ?>" class="s-<?= $section['Section']['id'] ?> y-<?= $section['Section']['year_level_id'] ?>">
			<?=$section['Section'][ 'name'] ?>
			</option>
		<?php endforeach; ?>
	</select>
	</span>
	<select class="uiDumbList" id="DInquirySectionId" listen_to="#InquirySectionId">
	</select>
</td>