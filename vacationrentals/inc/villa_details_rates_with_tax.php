<h2 class="property-page-section-title" id="Rates">Rates</h2>
<small>
	* Rates are subject to change without notice. Pricing includes taxes, but not additional options or fees.
	
</small>


    <!-- rates table -->
    <div class="table-responsive">
		<table class="property-default-rates table table-striped">
			
			<!-- Header Row -->
			<tr>
				<td><strong>Vacation Rental Standard Pricing</strong></td>
				
				
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
					<td>No Peak Season</td>
					
						<td><?=($v['p_low']*1.18);?></td>
						<td><?=($v['p_low']*1.18);?></td>
						<td><?=($v['p_low']*1.18);?></td>
						<td><?=($v['p_low']*1.18);?></td>
						<td><?=($v['p_low']*1.18);?></td>
						<td><?=($v['p_low']*1.18);?></td>
						<td><?=($v['p_low']*1.18);?></td>	
					
						<td><?=number_format((($v['p_low']*1.18)*7),0);?></td>
					
						<td>&nbsp;</td>
					
						<td align="center">2</td>
					
				</tr>
				
				<tr>	
					<td>Peak Season</td>
					
					
						
						<td><?=($v['p_high']*1.18);?></td>
						<td><?=($v['p_high']*1.18);?></td>
						<td><?=($v['p_high']*1.18);?></td>
						<td><?=($v['p_high']*1.18);?></td>
						<td><?=($v['p_high']*1.18);?></td>
						<td><?=($v['p_high']*1.18);?></td>
						<td><?=($v['p_high']*1.18);?></td>
			
					
						<td><?=number_format((($v['p_high']*1.18)*7),0);?></td>
					
					  <td>&nbsp;</td>
					
						<td align="center">2</td>
					
				</tr>
				
			
		</table>
    </div>