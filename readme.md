# strappy - Bookstraps for WorldShare ILL

built at [Trexler Library, Muhlenberg College](http://trexler.muhlenberg.edu) by [Adam Malantonio](https://github.com/malantonio) and Jonathan Macasevich.

## what is it?

Strappy is a PHP web-app used to construct bookstraps using WorldShare ILL , used everyday by our Interlibrary Loan service. It's a single page app with two views:

1. The home view, which offers the manual construction of a strap as well as generation of the bookmarklet (we'll get to that in a second)
2. The strap landing view which constructs a book strap. Using the bookmarklet generated on the home view, this strap contains the following data:
    1. Patron Name
    2. Lending Library symbol
    3. Due Date
    4. Barcode using RequestID

## installing

On the server side

```
git clone https://github.com/TrexlerLibrary/strappy <your landing point>
```

then head to the index page to build and copy the bookmarklet to your browser.

## using
While in the `Borrowing Requests` view in the `Interlibrary Loan` module of OCLC WorldShare, open a request and click the bookmarklet. 

![](http://trexler.muhlenberg.edu/images/strappy/worldshare_ill.png)

a new tab will be opened, directing back to the strappy index page displaying a strap like such:

![](http://trexler.muhlenberg.edu/images/strappy/strap.png)

## customizing
Right now, only the header text (__Patron: Please do not remove this strap__ in the above example) and the body text below the due date (starting with __OVERDUE FINE OF $2.00 PER DAY__) are set as variables at the top of `index.php`, but feel free to tinker with the css / strap layout as you wish.

## what's next?
* a better readme (one that makes sense!)
* refactoring, refactoring, refactoring!
    * Templating?
    * Custom Fields?
