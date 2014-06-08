<?php 
ini_set('display_errors', 'off');

// text wrapped in <h4> tags above book information
$_HEADER_TEXT = "Patron: Please do not remove this strap";
$_STRAP_BODY = "
      <p><strong>OVERDUE FINE OF $2.00 PER DAY</strong> </p>

      <p>Requests for renewal should be made on, or before due date. <p>
      <p>To request a renewal, please contact the ILL office by email at <srong>illd@muhlenberg.edu</strong> or by phone at <strong>484-664-3510</strong>.
      </br>Please include your name, the ILL/Barcode number, and book title.</p>

      <p><b>Please Do Not Shelve</b></p>

      <h4>Return to Lending Services Desk</h4>

      <h4>Patron: Please do not remove this strap</h4>

      <h5>Interlibrary loan books are subject to recall by the lending library at any time.</h5>
      ";

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

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">

<style>
  #barcode {
    font-weight: normal; 
    font-style: normal; 
    line-height: normal; 
    font-size: 10px;
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
      <?php if ( isset($_HEADER_TEXT) ) { ?>
      <h4><?php echo $_HEADER_TEXT; ?></h4>
      <?php } ?>
      <p>Lender Symbol: <strong><?php echo $lender; ?></strong></p>
      <p>Patron: <strong><?php echo $patron; ?></strong></p>
      <p>Barcode/ILL#</p>
      <p id="barcode">(<?php echo $barcode; ?>)</p>
      <p>Due Date: <h3 class="dueDate" contenteditable="true"><?php echo $dueDate; ?></h3></p>
      <?php if ( isset($_STRAP_BODY) ) { echo $_STRAP_BODY; } ?>
      
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
                    <button type="submit" class="btn btn-default">Generate your strap!</button>
                </div>
           </div>
        </form>
        <hr>

        <div class="accordion" id="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#collapseOne">
                Build the bookmarklet
              </a>
            </div>

            <div id="collapseOne" class="accordion-body collapse">
              <div class="accordion-inner">
                <fieldset class="form-inline">                
                  <input id="path" type="text" placeholder="Path to strappy.php file"  value="http://<?php echo $_SERVER['SERVER_NAME'] .$_SERVER['PHP_SELF']; ?>" class="input-xlarge">
                  <input id="title" type="text" placeholder="Title for bookmarklet (default: 'Strappy')" class="input-xlarge"/>
                  <button id="bkmklt-btn" class="btn btn-success">Generate Bookmarklet</button>
                </fieldset>
                <div class="container-fluid">
                  <div id="bookmarklet"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>


<?php } ?>

<?php if ( empty($_GET) ) { ?>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script>
function buildLink() {
    var strappy_path = document.getElementById('path').value || ''
      , strappy_path = !/^http:\/\//.test(strappy_path) ? 'http://' + strappy_path : strappy_path
      , bookmarklet = document.getElementById('bookmarklet')
      , bkmrk = '(function () {var d=document.getElementsByClassName("yui-field-dueDate"),l=document.getElementsByClassName("lendingInformationExtra"),p=document.getElementsByClassName("patronExtra"),b=document.getElementsByClassName("accordionRequestDetailsRequestId"),url,path="' + strappy_path + '";if(!d|!d.length|!l|!l.length|!p|!p.length|!b|!b.length){return false;}d=d[d.length-1].innerHTML;l=l[l.length-1].innerHTML.replace("(Supplier: ", "").replace(")", "");p=p[p.length-1].innerHTML.replace("(", "").replace(")", "");b=b[b.length-1].innerHTML;window.open(path+"?barcode="+b+"&lender="+l+"&patron="+encodeURI(p)+"&dueDate="+encodeURI(d),"_blank");})()'
      , a, arrow, i, clear
        ;

        removeChildren(bookmarklet);
        bookmarklet.className = '';

        a = document.createElement('a');
        a.href = 'javascript:' + bkmrk;
        a.innerText = document.getElementById('title').value || 'strappy';
        a.id = 'bookmark';
        a.className = 'label label-info';
        a.style.fontWeight = '400';
        a.style.padding = '5px';

        arrow = document.createElement('span');
        i = document.createElement('i');
        i.className = 'icon-arrow-left';
        i.style.marginLeft = '10px';
        arrow.appendChild(i);
        arrow.innerHTML += ' drag this button into your bookmarks bar'


        clear = document.createElement('a');
        clear.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('path').value = '';
            bookmarklet.removeChild(a);
            bookmarklet.removeChild(arrow);
            bookmarklet.removeChild(clear);
            //bookmarklet.removeChild(e.target);
            bookmarklet.className = '';
        });
        clear.href = '#';
        clear.innerText = 'click to clear';
        clear.style.display = 'block';

        bookmarklet.className = 'well';
        bookmarklet.appendChild(a);
        bookmarklet.appendChild(arrow);
        bookmarklet.appendChild(clear);
}
    
document.getElementById('bkmklt-btn').addEventListener('click', buildLink);
</script>

<?php } else { ?>
<script type="text/javascript" src="connectcode-javascript-code39.js"></script>
<script >
  var barcode = document.getElementById('barcode')
    , dueDate = document.querySelector('.dueDate')
      ;

  if ( barcode ) {

    barcode.innerHTML = DrawHTMLBarcode_Code39(
      barcode.innerHTML, // data
      0,                 // checkDigit
      'yes',             // humanReadable
      'in',              // units
      0,                 // minBarWidth
      3,                 // width
      .35,               // height
      3,                 // barWidthRatio
      'bottom',          // textLocation
      'center',          // textAlignment
      '',                // textStyle
      'black',           // foreColor  
      'white'            // backColor
    );
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
  }
</script>
<?php } ?>

</body>
</html>
