<?php if(!empty($_GET)) {
  $lender  = $_GET['lender'];
  $patron  = urldecode($_GET['patron']);
  $barcode = $_GET['barcode'];
  $dueDate = urldecode($_GET['dueDate']);
}
?>
<!doctype html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<script type="text/javascript" src="code39.js"></script>

<style>
  #barcode {
    font-weight: normal; 
    font-style: normal; 
    line-height: normal; 
    font-size: 12pt;
  }
  #container {
    margin-top: 25%;
  }
  #otherthing {
    width:250px; 
    left:20px;
  }

</style>
<body>
  <div id="container" class="span4">
  <div id="otherthing">
    <h4>Patron: Please do not remove this strap</h4>
    <p>Lender Symbol: <strong><?=$lender?></strong></p>
    <p>Patron: <strong><?=$patron?></strong></p>
    <p>Barcode/ILL#</p>
    <p id="inputdata">(<?=$barcode?>)</p>
    <p>Due Date: <h3 contenteditable="true"><?=$dueDate?></h3></p>
    <p><strong>OVERDUE FINE OF $2.00 PER DAY</strong> </p>

    <p>Requests for renewal should be made on, or before due date. <p>
    <p>To request a renewal, please contact the ILL office by email at <srong>illd@muhlenberg.edu</strong> or by phone at <strong>484-664-3510</strong>.
       </br>Please include your name, the ILL/Barcode number, and book title.</p>

	<p><b>Please Do Not Shelve</b></p>

	<h4>Return to Lending Services Desk</h4>

	<h4>Patron: Please do not remove this strap</h4>

	<h5>Interlibrary loan books are subject to recall by the lending library at any time.</h5>
  </div>

<script type="text/javascript">
  function get_object(id) {
   var object = null;

   if (document.layers) {
    object = document.layers[id];

   } else if (document.all) {
    object = document.all[id];

   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   return object;
  }
get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML,0);
</script>

</body>

<!--  shooby taylor has a posse  -->


<!--  BELOW FIND THE BOOKMARKLET STUFF TO COPY AND PASTE -->

<!--
javascript:(function () {var d=document.getElementsByClassName("yui-field-dueDate"),l=document.getElementsByClassName("lendingInformationExtra"),p=document.getElementsByClassName("patronExtra"),b=document.getElementsByClassName("accordionRequestDetailsRequestId"),url,path="http://malantonio.com/strappy.php";if(!d|!d.length|!l|!l.length|!p|!p.length|!b|!b.length){return false;}d=d[d.length-1].innerHTML;l=l[l.length-1].innerHTML.replace("(Supplier: ", "").replace(")", "");p=p[p.length-1].innerHTML.replace("(", "").replace(")", "");b=b[b.length-1].innerHTML;window.open(path+"?barcode="+b+"&lender="+l+"&patron="+encodeURI(p)+"&dueDate="+encodeURI(d),"_blank");})()
-->

<!-- END OF BOOKMARKLET STUFF -->

</html>
