<?php 
ini_set('display_errors', 'off');
if(!empty($_GET)) {
  $lender  = $_GET['lender'];
  $patron  = urldecode($_GET['patron']);
  $barcode = $_GET['barcode'];
  $dueDate = urldecode($_GET['dueDate']);
}
?>
<!doctype html>
<html lang="en">
<head>
<!-- Begin yr ILL strap template here -->

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

<?php if (!empty($_GET)) { ?>

  <div id="container" class="span4">
    <div id="otherthing">
      <h4>Patron: Please do not remove this strap</h4>
      <p>Lender Symbol: <strong><?=$lender?></strong></p>
      <p>Patron: <strong><?=$patron?></strong></p>
      <p>Barcode/ILL#</p>
      <p id="barcode">(<?=$barcode?>)</p>
      <p>Due Date: <h3 class="dueDate" contenteditable="true"><?=$dueDate?></h3></p>
      <p><strong>OVERDUE FINE OF $2.00 PER DAY</strong> </p>

      <p>Requests for renewal should be made on, or before due date. <p>
      <p>To request a renewal, please contact the ILL office by email at <srong>illd@muhlenberg.edu</strong> or by phone at <strong>484-664-3510</strong>.
         </br>Please include your name, the ILL/Barcode number, and book title.</p>

  	<p><b>Please Do Not Shelve</b></p>

  	<h4>Return to Lending Services Desk</h4>

  	<h4>Patron: Please do not remove this strap</h4>

  	<h5>Interlibrary loan books are subject to recall by the lending library at any time.</h5>
    </div>
  </div>

<?php } else { ?>
    <div class="container-fluid">
        <form class="form form-horizontal" action="." method="get">
            <legend>Build an Interlibrary Loan strap</legend>

            <div class="control-group">
                <label class="control-label" for="lender">Lender Symbol</label>
                <div class="controls">
                    <input type="text" id="lender" name="lender" required />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="patron">Patron Name</label>
                <div class="controls">
                    <input type="text" id="patron" name="patron" required />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="barcode">Barcode #</label>
                <div class="controls">
                    <input type="text" id="barcode" name="barcode" required />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="dueDate">Due Date</label>
                <div class="controls">
                    <input type="date" id="dueDate" name="dueDate" required />
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button type="submit">Generate your strap!</button>
                </div>
           </div>
        </form>
    </div>

<?php } ?>


<script type="text/javascript">
  var barcode = document.getElementById('barcode')
    , dueDate = document.querySelector('.dueDate');

  barcode.innerHTML = DrawCode39Barcode(barcode.innerHTML, 0);
  var spans = document.querySelectorAll('#barcode div span');
  
  /*
   *  because we can, let's escape the asterisks that appear b/c of code39.js
   */
  spans[(spans.length - 1)].innerText = spans[(spans.length - 1)].innerText.replace(/\*/g, '')
  
  /* 
   * if no due date is provided from worldcat, let's draw the user's attention to it
   *   and have them fill it in
   */

  if ( dueDate.innerHTML === "" ) {
    alert("Hey I need a due date!");
    dueDate.focus();
  }
</script>

</body>
</html>
