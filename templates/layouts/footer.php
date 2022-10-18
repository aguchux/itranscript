<div class="js-fix-footer bg-white border-top-2">
    <div class="container page-section py-lg-48pt">

        <div class="row">

            <div class="col-6 col-md-4 mb-24pt mb-md-0">
                <h4 class="text-70">Portal & Account Menu</h4>
                <nav class="nav nav-links nav--flush flex-column">
                    <a class="nav-link" href="#">» Profile Creation Form</a>
                    <a class="nav-link" href="#">» Application Status</a>
                    <a class="nav-link" href="#">» Transcript Validation</a>
                    <a class="nav-link" href="#">» Help Desk</a>
                </nav>
            </div>
            <div class="col-6 col-md-4 mb-24pt mb-md-0">
                <h4 class="text-70">Payments & Receipts</h4>
                <nav class="nav nav-links nav--flush flex-column">
                    <a class="nav-link" href="#">» Payment Options</a>
                    <a class="nav-link" href="#">» Shipping Options</a>
                    <a class="nav-link" href="#">» Payment Rates</a>
                    <a class="nav-link" href="#">» Payment Receipts</a>
                </nav>
            </div>
            <div class="col-6 col-md-4 mb-32pt mb-md-0">
                <h4 class="text-70">Help & Instructions</h4>
                <nav class="nav nav-links nav--flush flex-column">
                    <a class="nav-link" href="#">» Transcript Application Guide</a>
                    <a class="nav-link" href="#">» Transcript Verification Guide</a>
                    <a class="nav-link" href="#">» Transcript Validation Guide</a>
                    <a class="nav-link" href="#">» Transcript Delivery Guide</a>
                </nav>
            </div>
        </div>

    </div>
    <div class="bg-footer page-section py-lg-32pt">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5 mb-24pt mb-md-0">
                    <p class="text-white-70 mb-1"><strong>Powered by: <a class="text-white" href="https://golojan.net/" target="_blank">De-Golojan</a></strong></p>
                    <nav class="nav nav-links nav--flush">
                        <a href="#" class="nav-link mr-8pt text-light">ESUT's Online Transcript System</a>
                    </nav>
                </div>

                <div class="col-md-9 col-sm-7 text-md-right">
                    <p class="mb-8pt d-flex align-items-md-center justify-content-md-end">
                        <a href="" class="text-white-70 text-underline mr-16pt">Terms</a>
                        <a href="" class="text-white-70 text-underline">Privacy policy</a>
                    </p>
                    <p class="text-white-50 mb-0">Copyright 2019 &copy; Enugu State University of Science & Technology. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- // END Header Layout Content -->

</div>
<!-- // END Header Layout -->


<!-- jQuery -->
<script src="<?= $assets ?>admin\vendor\jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= $assets ?>admin\vendor\popper.min.js"></script>
<script src="<?= $assets ?>admin\vendor\bootstrap.min.js"></script>
<!-- Perfect Scrollbar -->
<script src="<?= $assets ?>admin\vendor\perfect-scrollbar.min.js"></script>
<!-- DOM Factory -->
<script src="<?= $assets ?>admin\vendor\dom-factory.js"></script>
<!-- MDK -->
<script src="<?= $assets ?>admin\vendor\material-design-kit.js"></script>
<!-- Fix Footer -->
<script src="<?= $assets ?>admin\vendor\fix-footer.js"></script>
<!-- Chart.js -->
<script src="<?= $assets ?>admin\vendor\Chart.min.js"></script>
<!-- App JS -->
<script src="<?= $assets ?>admin\js\app.js"></script>
<!-- Highlight.js -->
<script src="<?= $assets ?>admin\js\hljs.js"></script>
<script src="<?= $assets ?>myhq\js\index.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/intlTelInput.min.js" integrity="sha512-p7KMhWOBzQOB7XHRi5pMula0Z4n8zxb09+ftlz+4lor1ZwmEp8SGi9Ki/JQ4VTrJEImAyrnw2vnE5faPPu3c0w==" crossorigin="anonymous"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        initialCountry: 'ng',
        nationalMode: false,
        autoHideDialCode: false,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/utils.min.js"
    });
</script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#MyDatatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });

    function pdfForElement(id) {
        function ParseContainer(cnt, e, p, styles) {
            var elements = [];
            var children = e.childNodes;
            if (children.length != 0) {
                for (var i = 0; i < children.length; i++) p = ParseElement(elements, children[i], p, styles);
            }
            if (elements.length != 0) {
                for (var i = 0; i < elements.length; i++) cnt.push(elements[i]);
            }
            return p;
        }

        function ComputeStyle(o, styles) {
            for (var i = 0; i < styles.length; i++) {
                var st = styles[i].trim().toLowerCase().split(":");
                if (st.length == 2) {
                    switch (st[0]) {
                        case "font-size": {
                            o.fontSize = parseInt(st[1]);
                            break;
                        }
                        case "text-align": {
                            switch (st[1]) {
                                case "right":
                                    o.alignment = 'right';
                                    break;
                                case "center":
                                    o.alignment = 'center';
                                    break;
                            }
                            break;
                        }
                        case "font-weight": {
                            switch (st[1]) {
                                case "bold":
                                    o.bold = true;
                                    break;
                            }
                            break;
                        }
                        case "text-decoration": {
                            switch (st[1]) {
                                case "underline":
                                    o.decoration = "underline";
                                    break;
                            }
                            break;
                        }
                        case "font-style": {
                            switch (st[1]) {
                                case "italic":
                                    o.italics = true;
                                    break;
                            }
                            break;
                        }
                    }
                }
            }
        }

        function ParseElement(cnt, e, p, styles) {
            if (!styles) styles = [];
            if (e.getAttribute) {
                var nodeStyle = e.getAttribute("style");
                if (nodeStyle) {
                    var ns = nodeStyle.split(";");
                    for (var k = 0; k < ns.length; k++) styles.push(ns[k]);
                }
            }

            switch (e.nodeName.toLowerCase()) {
                case "#text": {
                    var t = {
                        text: e.textContent.replace(/\n/g, "")
                    };
                    if (styles) ComputeStyle(t, styles);
                    p.text.push(t);
                    break;
                }
                case "b":
                case "strong": {
                    //styles.push("font-weight:bold");
                    ParseContainer(cnt, e, p, styles.concat(["font-weight:bold"]));
                    break;
                }
                case "u": {
                    //styles.push("text-decoration:underline");
                    ParseContainer(cnt, e, p, styles.concat(["text-decoration:underline"]));
                    break;
                }
                case "i": {
                    //styles.push("font-style:italic");
                    ParseContainer(cnt, e, p, styles.concat(["font-style:italic"]));
                    //styles.pop();
                    break;
                    //cnt.push({ text: e.innerText, bold: false });
                }
                case "span": {
                    ParseContainer(cnt, e, p, styles);
                    break;
                }
                case "br": {
                    p = CreateParagraph();
                    cnt.push(p);
                    break;
                }
                case "table": {
                    var t = {
                        table: {
                            widths: [],
                            body: []
                        }
                    }
                    var border = e.getAttribute("border");
                    var isBorder = false;
                    if (border)
                        if (parseInt(border) == 1) isBorder = true;
                    if (!isBorder) t.layout = 'noBorders';
                    ParseContainer(t.table.body, e, p, styles);

                    var widths = e.getAttribute("widths");
                    if (!widths) {
                        if (t.table.body.length != 0) {
                            if (t.table.body[0].length != 0)
                                for (var k = 0; k < t.table.body[0].length; k++) t.table.widths.push("*");
                        }
                    } else {
                        var w = widths.split(",");
                        for (var k = 0; k < w.length; k++) t.table.widths.push(w[k]);
                    }
                    cnt.push(t);
                    break;
                }
                case "tbody": {
                    ParseContainer(cnt, e, p, styles);
                    //p = CreateParagraph();
                    break;
                }
                case "tr": {
                    var row = [];
                    ParseContainer(row, e, p, styles);
                    cnt.push(row);
                    break;
                }
                case "td": {
                    p = CreateParagraph();
                    var st = {
                        stack: []
                    }
                    st.stack.push(p);

                    var rspan = e.getAttribute("rowspan");
                    if (rspan) st.rowSpan = parseInt(rspan);
                    var cspan = e.getAttribute("colspan");
                    if (cspan) st.colSpan = parseInt(cspan);

                    ParseContainer(st.stack, e, p, styles);
                    cnt.push(st);
                    break;
                }
                case "div":
                case "p": {
                    p = CreateParagraph();
                    var st = {
                        stack: []
                    }
                    st.stack.push(p);
                    ComputeStyle(st, styles);
                    ParseContainer(st.stack, e, p);

                    cnt.push(st);
                    break;
                }
                default: {
                    console.log("Parsing for node " + e.nodeName + " not found");
                    break;
                }
            }
            return p;
        }

        function ParseHtml(cnt, htmlText) {
            var html = $(htmlText.replace(/\t/g, "").replace(/\n/g, ""));
            var p = CreateParagraph();
            for (var i = 0; i < html.length; i++) ParseElement(cnt, html.get(i), p);
        }

        function CreateParagraph() {
            var p = {
                text: []
            };
            return p;
        }
        content = [];
        ParseHtml(content, document.getElementById(id).outerHTML);
        return pdfMake.createPdf({
            content: content
        });
    }
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5f85817b4704467e89f70085/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
    <?php if ($Self->auth) : ?>
        Tawk_API.visitor = {
            name: '<?= "{$UserInfo->surname}, {$UserInfo->firstname}" ?>',
            email: '<?= $UserInfo->email ?>',
            hash: '<?= hash_hmac("sha256", $UserInfo->email, "5f85817b4704467e89f70085") ?>'
        };
    <?php endif; ?>
</script>
<!--End of Tawk.to Script-->


<!-- App Settings (safe to remove) -->
<script src="<?= $assets ?>admin\js\app-settings.js"></script>
</body>

</html>