<script>
	function callAlert(nameNotice,text){
	  $(function() {
		const Toast = Swal.mixin({
		  toast: true,
		  position: 'top-end',
		  showConfirmButton: false,
		  timer: 3000
		});
		$(function(){
		  Toast.fire({
			icon: nameNotice,
			title: text,
		  })
		});
	  });
	}
</script>
<?php
    function optionArea($connect){
        $output = "";
        $sql = "SELECT DISTINCT `provincesName` FROM `districts`";
        $excute = mysqli_query($connect,$sql);
        while($temp = mysqli_fetch_assoc($excute)){
            $output = $output.'
                <option>'.$temp["provincesName"].'</option>
            ';
        }
        return $output;
      }
?>