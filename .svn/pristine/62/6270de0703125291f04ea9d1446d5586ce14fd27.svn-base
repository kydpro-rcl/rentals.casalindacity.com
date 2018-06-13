<?php
/* start some pages functiones */

 function get_paging_info($tot_rows,$pp,$curr_page)
{
    $pages = ceil($tot_rows / $pp); // calc pages

    $data = array(); // start out array
    $data['si']        = ($curr_page * $pp) - $pp; // what row to start at
    $data['pages']     = $pages;                   // add the pages
    $data['curr_page'] = $curr_page;               // Whats the current page

    return $data; //return the paging data

}

 
 
 function numeros_de_paginas($paging_info,$max=7, $page_name){
	 
        if($paging_info['curr_page'] < $max)
            $sp = 1;
        elseif($paging_info['curr_page'] >= ($paging_info['pages'] - floor($max / 2)) )
            $sp = $paging_info['pages'] - $max + 1;
        elseif($paging_info['curr_page'] >= $max)
            $sp = $paging_info['curr_page']  - floor($max/2);
?>
<link rel="stylesheet" href="css/paginacion.css" >
<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->

<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">-->

<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->

<hr/>
<nav>

  <ul class="pagination">
   <?php if($paging_info['curr_page'] > 1) : ?>
   <li><a href='<?=$page_name?>?pag=1' title='Page 1'>First</a></li>
   <li><a href='<?=$page_name?>?pag=<?php echo ($paging_info['curr_page'] - 1); ?>' title='Page <?php echo ($paging_info['curr_page'] - 1); ?>'>Previous</a></li>
    <?php endif; ?>
   
	 <!-- If the current page >= $max then show link to 1st page -->
    <?php if($paging_info['curr_page'] >= $max) : ?>

       <li> <a href='<?=$page_name?>?pag=1' title='Page 1'>1</a>
       <li>
			<a  aria-label="Next">
				<span aria-hidden="true">...</span>
			</a>
	   </li>

    <?php endif; ?>

    <!-- Loop though max number of pages shown and show links either side equal to $max / 2 -->
    <?php for($i = $sp; $i <= ($sp + $max -1);$i++) : ?>

        <?php
            if($i > $paging_info['pages'])
                continue;
        ?>

        <?php if($paging_info['curr_page'] == $i) : ?>

            <li class="active"><a  ><?php echo $i; ?></a></li>

        <?php else : ?>

           <li> <a href='<?=$page_name?>?pag=<?php echo $i; ?>' title='Page <?php echo $i; ?>'><?php echo $i; ?></a></li>

        <?php endif; ?>

    <?php endfor; ?>


    <!-- If the current page is less than say the last page minus $max pages divided by 2-->
    <?php if($paging_info['curr_page'] < ($paging_info['pages'] - floor($max / 2))) : ?>

        <li>
			<a aria-label="Previous">
				<span aria-hidden="true">...</span>
			</a>
		</li>
        <li><a href='<?=$page_name?>?pag=<?php echo $paging_info['pages']; ?>' title='Page <?php echo $paging_info['pages']; ?>'><?php echo $paging_info['pages']; ?></a></li>

    <?php endif; ?>
 
	<?php if($paging_info['curr_page'] < $paging_info['pages']) : ?>
	 <li><a href='<?=$page_name?>?pag=<?php echo ($paging_info['curr_page'] + 1); ?>' title='Page <?php echo ($paging_info['curr_page'] + 1); ?>'>Next</a></li>
	 <li><a href='<?=$page_name?>?pag=<?php echo $paging_info['pages']; ?>' title='Page <?php echo $paging_info['pages']; ?>'>Last</a></li>
	<?php endif; ?>
  </ul>
</nav>

<!---end pages-->

 <?php
 }
 ?>

