
				<td>
					<span class="label">SY:</span>
				</td>
				<td>
				<?php $default_sy = $SystemsDefault['SystemsDefault']['sy']; 
					  $disp_sy = $default_sy .'-'. ($default_sy+1);
				?>
					<?php
						echo $this->Form->input('disp_sy',array ('label'=>false,'class'=>'large readonly','id'=>'sy','readonly'=>'readonly','value'=>$disp_sy));
						echo $this->Form->input('sy',array ('label'=>false,'type'=>'hidden','class'=>'large','value'=>$default_sy));
					?>
					<input type="hidden" class="readonly" name="data[Inquiry][def_sy]" id="def_sy" value="<?=$default_sy  ?>" autocomplete="off"/>
				</td>
				<td>
					<span class="label">Sem: </span>
				</td>
				<td>
					<?php
						echo $this->Form->input('semester_id',array ('label'=>false,'class'=>'large','id'=>'semesters'));
					?>
				</td>
			</tr>