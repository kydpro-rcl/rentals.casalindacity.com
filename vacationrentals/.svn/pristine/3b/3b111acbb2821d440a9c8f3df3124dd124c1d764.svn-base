<?php
//print_r($seasons);
?>

<h2 class="property-page-section-title" id="Rates">Rates</h2>
<small>
	* Rates are subject to change without notice. Pricing not includes taxes, additional options or fees.
	
</small>


    <!-- rates table -->
    <div class="table-responsive">
		<table class="property-default-rates table table-striped">
			
			<!-- Header Row -->
			<tr>
				<td><strong>Vacation Rental Standard Pricing</strong>
				</td>
				
				
					<td><strong>Sun</strong></td>
					<td><strong>Mon</strong></td>
					<td><strong>Tue</strong></td>
					<td><strong>Wed</strong></td>
					<td><strong>Thu</strong></td>
					<td><strong>Fri</strong></td>
					<td><strong>Sat</strong></td>
				
					<td><strong>Weekly</strong></td>
				
					<td>&nbsp;</td>
				
					<td align="center"><strong>Min Nights</strong></td>
				
			</tr>

			
				<tr>	
					<td>No Peak Season
				<br/>
				<?php foreach($seasons AS $s){
					if($s['type']==1){
						echo "<P style='padding:-7px; margin:-7px; margin-left:0px; color: #24baf4;'><span style='font-size:10px'>FROM: ".mes($s['start_mont'])." ".$s['start_day']." TO: ".mes($s['end_mont'])." ".$s['end_day']."</span></P>";
					}
				} ?>
				</td>
					
						<td><?=($v['p_low']);?></td>
						<td><?=($v['p_low']);?></td>
						<td><?=($v['p_low']);?></td>
						<td><?=($v['p_low']);?></td>
						<td><?=($v['p_low']);?></td>
						<td><?=($v['p_low']);?></td>
						<td><?=($v['p_low']);?></td>	
					
						<td><?=number_format((($v['p_low'])*7),0);?></td>
					
						<td>&nbsp;</td>
					
						<td align="center">2</td>
					
				</tr>
				<tr>	
					<td>Shoulder Season<br/>
				<?php foreach($seasons AS $s){
					if($s['type']==2){
						echo "<P style='padding:-7px; margin:-7px; margin-left:0px; color: #24baf4;'><span style='font-size:10px'>FROM: ".mes($s['start_mont'])." ".$s['start_day']." TO: ".mes($s['end_mont'])." ".$s['end_day']."</span></P>";
					}
				} ?></td>
					
					
						
						<td><?=($v['p_shoulder']);?></td>
						<td><?=($v['p_shoulder']);?></td>
						<td><?=($v['p_shoulder']);?></td>
						<td><?=($v['p_shoulder']);?></td>
						<td><?=($v['p_shoulder']);?></td>
						<td><?=($v['p_shoulder']);?></td>
						<td><?=($v['p_shoulder']);?></td>
			
					
						<td><?=number_format((($v['p_shoulder'])*7),0);?></td>
					
					  <td>&nbsp;</td>
					
						<td align="center">2</td>
					
				</tr>
				<tr>	
					<td>Peak Season<br/>
				<?php foreach($seasons AS $s){
					if($s['type']==3){
						echo "<P style='padding:-7px; margin:-7px; margin-left:0px; color: #24baf4;'><span style='font-size:10px'>FROM: ".mes($s['start_mont'])." ".$s['start_day']." TO: ".mes($s['end_mont'])." ".$s['end_day']."</span></P>";
					}
				} ?></td>
					
					
						
						<td><?=($v['p_high']);?></td>
						<td><?=($v['p_high']);?></td>
						<td><?=($v['p_high']);?></td>
						<td><?=($v['p_high']);?></td>
						<td><?=($v['p_high']);?></td>
						<td><?=($v['p_high']);?></td>
						<td><?=($v['p_high']);?></td>
			
					
						<td><?=number_format((($v['p_high'])*7),0);?></td>
					
					  <td>&nbsp;</td>
					
						<td align="center">2</td>
					
				</tr>
				
				
				
			
		</table>
    </div>