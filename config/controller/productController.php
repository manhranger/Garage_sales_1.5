<?php
	//error_reporting(0);
	include"../config/config.inc.php";
	$_SESSION['namePage']="productt";
	error_reporting(0);
    $limitItem=5;
    if(isset($_GET["page"])){	
        $current=$_GET["page"];
	}else{
        $current=1;
	}
    $start=($current-1)*$limitItem;
	mysqli_set_charset("utf8");
	
	//filter selected
	$typePro = "";$province = "";
	if(isset($_GET["typePro"])===true){
		$typePro = $_GET["typePro"];
	}
	if(isset($_GET["province"])===true){
		$province = $_GET["province"];
	}
    $sql="SELECT * FROM `products` inner join `user` where `user`.`username` = `products`.`username` and `status_2`= 1 ORDER BY `products`.`ProductID` DESC";
    $products=mysqli_query($connect,$sql);
	
?>
<script>
function onLoad(proTypeSelected,province){
	myFunctionFilter(limit=5);
}
function myFunctionFilter(limit) {
  var input, filter, i, txtValue, typeItem,items=0;
  filterType = $('#filterTypeSelect').find(":selected").val().toUpperCase();
  typeItem = document.getElementsByClassName("typeItem");
  pageLinks = document.getElementsByClassName("pageLinks");
  
  filterProvince = $('#filterProvinceSelect').find(":selected").val().toUpperCase();
  provinceItem = document.getElementsByClassName("provinceItem");
  
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myFilter");
  box = document.getElementsByClassName("box");
  title = div.getElementsByTagName("h3");
  
  for (i = 0; i < title.length; i++) {
      txtValue = title[i].textContent;
      txtType = typeItem[i].textContent;
	  txtProvince = provinceItem[i].textContent;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        if (txtType.toUpperCase().indexOf(filterType) > -1) {
          if (txtProvince.toUpperCase().indexOf(filterProvince) > -1) {
			  box[i].style.display = "";items++;
		  }else {
			  box[i].style.display = "none";
		  }
        }else {
          box[i].style.display = "none";
        }
      } else {
        box[i].style.display = "none";
      }
  }
  for( i = 0 ; i < pageLinks.length ; i++)
  {
	  if(i< Math.ceil(items/limit) )
	  {
		  pageLinks[i].className = pageLinks[i].className.replace (/ hidden/g,"");
	  }else{
	  	pageLinks[i].className = pageLinks[i].className + " hidden";
	  }
  }
  Pagging(1,limit);
}
</script>
<script>
var pageNum;
movePage = document.getElementsByClassName("movePage");
		  function Pagging(pageNumber,limit) {	
		  	var i , items = 0 ; pageNum = pageNumber ;
			box = document.getElementsByClassName("box");
			pageLinks = document.getElementsByClassName("pageLinks");
			displays = document.getElementsByClassName("displayy");
			for(i=0;i<box.length;i++)
			{
				if(box[i].style.display != "none"){
					displays[i].className = displays[i].className.replace(" hidden","");
					if(items >= limit*pageNumber){
						displays[i].className = displays[i].className + " hidden";
					}else if(items < (limit*pageNumber-limit)){
						items++;
						displays[i].className = displays[i].className + " hidden";
					}else{
						items++;
					}
				}
			}
			for( i = 0 ; i < pageLinks.length ; i++)
		  	{
				pageLinks[i].className = pageLinks[i].className.replace (/ currentPage| disabled/g,"");
				  if( i + 1 == pageNumber ){
					pageLinks[i].className = pageLinks[i].className + " currentPage";
			  	  }
				  if(pageNumber==1){
					  pageLinks[i].className = pageLinks[i].className + " ";
				  }
		  	}
          }
		  function nextPage(lastPage,limit){
			  if(pageNum+1<=lastPage){
				  Pagging(pageNum+1,limit);
			  }else{
			  }
		  }
		function prePage(limit){
		  	if(pageNum-1>=1){
				  Pagging(pageNum-1,limit);
			  }else{
			  }
		}
</script>