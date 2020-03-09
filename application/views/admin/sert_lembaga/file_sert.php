<?php
$id_lab = $sert['idlab'];

?>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-file-o"></i> &nbsp; Sertifikat Detail</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url().'admin/identitas_lab/edit/'.$id_lab; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        
      </div>
    </div>
  </div>
  <?php 
    $file_sert = base_url().'uploads/images/sert_lembaga/'.$sert['sertlbscan'];
  ?>

   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div style="text-align:center;margin-bottom:15px;">
        <button class="btn btn-default" id="prev">Previous</button>
        <button class="btn btn-default" id="next">Next</button>
        &nbsp; &nbsp;
        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
      </div>
      <canvas id="the-canvas" style="width:100%"></canvas>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>

<!-- DataTables -->


<script type="text/javascript">
   // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = '<?=$file_sert;?>';

    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 3,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
      pageRendering = true;
      // Using promise to fetch the page
      pdfDoc.getPage(num).then(function(page) {
        var viewport = page.getViewport({scale: scale});
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);

        // Wait for rendering to finish
        renderTask.promise.then(function() {
          pageRendering = false;
          if (pageNumPending !== null) {
            // New page rendering is pending
            renderPage(pageNumPending);
            pageNumPending = null;
          }
        });
      });

      // Update page counters
      document.getElementById('page_num').textContent = num;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
      if (pageRendering) {
        pageNumPending = num;
      } else {
        renderPage(num);
      }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
      if (pageNum <= 1) {
        return;
      }
      pageNum--;
      queueRenderPage(pageNum);
    }
    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
      if (pageNum >= pdfDoc.numPages) {
        return;
      }
      pageNum++;
      queueRenderPage(pageNum);
    }
    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;

      // Initial/first page rendering
      renderPage(pageNum);
    });

</script>

<script>
    $("#identitas_lab").addClass('active');
  </script>
