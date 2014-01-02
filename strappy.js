(function () {
    var d = document.getElementsByClassName("yui-field-dueDate"),
        l  = document.getElementsByClassName("lendingInformationExtra"),
        p  = document.getElementsByClassName("patronExtra"),
        b = document.getElementsByClassName("accordionRequestDetailsRequestId"),
        url, 
        path = "http://libappdev.muhlenberg.edu/strappy/"; // put in the path to yr landing page here!

    // if these don't exist, or are empty, return false
    if(!d | !d.length | !l | !l.length | !p | !p.length | !b | !b.length) {
        return false;
    }

    // else grab the innerHTML of the last element in array, 
    // cleaning up where necessary
    
    d = d[d.length - 1].innerHTML;
    l = l[l.length - 1].innerHTML.replace("(Supplier: ", "").replace(")", "");
    p = p[p.length - 1].innerHTML.replace("(", "").replace(")", "");    
    b = b[b.length - 1].innerHTML;

    // open a new window/tab and send them on their way
    window.open(path + "?barcode=" + b + "&lender=" + l + "&patron=" + encodeURI(p) + "&dueDate=" + encodeURI(d), "_blank");
})()
