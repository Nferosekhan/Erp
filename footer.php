<!--<footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.pairscript.com" class="font-weight-bold" target="_blank">Pairscript</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>-->
      <div class="modal fade" id="dummymodalshowing" tabindex="-1" role="dialog" style="visibility: hidden;">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Details</h5>
<span type="button" onclick="funescustomerview()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
<div class="modal-body mbsub">
</div>
<div class="modal-footer mfsub" style="margin: 0px 9px !important;border-top: 1px solid #b6bcc5 !important;">
</div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="loadingmodal" tabindex="-1" role="dialog" aria-labelledby="loadingmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="loadingmodalLabel" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 18px;">
          Fetching Data, Please Wait...
        </p>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -33px;">
          <span aria-hidden="true" style="font-size: 21px;font-weight: 600;">
            &times;
          </span>
        </button>
      </div>
      <div class="modal-body" style="height: max-content;">
        <div id="loadimgbig">
          <img src="loading.gif" alt="Loading..." style="width: 100%;">
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
 $(document).ready(function () {
    $('.automodalchecking').one("click",function () {
        setTimeout(function() {
            $('#dummymodalshowing').modal('show');
        },100);
        setTimeout(function() {
            $('#dummymodalshowing').modal('hide');
        },1000);
    });
});
</script>