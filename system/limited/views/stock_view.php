<div class="container-fluid">
	<!-- start .page-content -->
	<div class="page-content">
		<?php echo $this->load->view('admin/include/menu_satu'); ?>
		<div class="isi-status" id="">
			<div class="content-inti" id="reload">
				<iframe id="iframe1" marginheight="0" frameborder="0" width="100%" height="1000px" onLoad="autoResize('iframe1');" src="https://docs.google.com/spreadsheet/pub?key=0Au7cP9NP6Bs-dE94V0ktRVZqNzk5Mi03azlhVUdkZGc&output=html&widget=true"></iframe>
			</div>
		</div>
	</div>
	<!-- end .page-content -->
</div>

<script language="JavaScript">
<!--
function autoResize(id){
    var newheight;
    var newwidth;

    if(document.getElementById){
        newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
        newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
    }

    document.getElementById(id).height= (newheight) + "px";
    document.getElementById(id).width= (newwidth) + "px";
}
//-->
</script>