
<hr/>
<div id="breadcrumb">
				<? if ($_SESSION['info']){?><p>
				<div class="alert alert-info" role="alert">
					
					Logged as: <!--<a href="#">--><span style="color:#006;"><? echo ucfirst($_SESSION['info']['name'])." ".ucfirst($_SESSION['info']['lastname']) ?></span><!--</a>--> <!--&gt;--> <!--- Level  &gt;--> <? /* echo $_SESSION['info']['level']*/?> 
					
				</div>
				</p><? }?>
			</div>
</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>