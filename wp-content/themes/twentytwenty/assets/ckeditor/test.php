

<form action="" method="post" enctype="multipart/form-data">
	<textarea name="text"></textarea>
	<button name="submit" value="submit">submit</button>
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace( 'text' );

	
</script>


<?php
if(isset($_POST['submit'])) {
	print_r($_POST);
}
?>
