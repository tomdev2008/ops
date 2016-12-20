<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
<style>
  .hidden2 {
    position: absolute;
    left: -9999px;
    top: 0;
  }
</style>
                <div class="span9" id="content" style=" position:absolute; top:0px ;left:30px; right:50px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">nginx信息</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
                                        <fieldset>  
                                                <div class="controls">                                               
                                                <button type="button" id="copyBtn" class="btn btn-xs btn-default">复制</button>                                               
                                                <textarea id="hiddenText" class="hidden2"></textarea>
                                                </div>   <br>                                     
                                                <div class="control-group"><pre id="contents"><?php echo $nginx_conf_upstream.$nginx_conf_upstream_tmp1.$nginx_conf_server.$nginx_conf_upstream_tmp2;?></pre></div>
               
          </fieldset>
          </div>
      </div>
      </div>
                      <!-- /block -->
        </div>
                     <!-- /validation -->
                </div>

<!--/.fluid-container-->
  <script src="http://ops.xkeshi.so/vendors/jquery-1.9.1.min.js"></script>
  <script src="http://ops.xkeshi.so/assets/scripts.js"></script>
  <script src="http://ops.xkeshi.so/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="http://ops.xkeshi.so/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/assets/styles.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
        <script type="text/javascript">
      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }

 document.getElementById("copyBtn").addEventListener("click", function () {
    copyToClipboard(document.getElementById("contents"));
  });

  function copyToClipboard (elem) {
    var target = document.getElementById("hiddenText");
    target.textContent = elem.innerText;
    target.value = elem.innerText;
    console.log(target.textContent);
    select(target);
    document.execCommand("copy");
  }

  function select (element) {
    var selectedText;

    if (element.nodeName === 'INPUT' || element.nodeName === 'TEXTAREA') {
      element.focus();
      element.setSelectionRange(0, element.value.length);
      selectedText = element.value;
    }
    else {
      if (element.hasAttribute('contenteditable')) {
        element.focus();
      }

      var selection = window.getSelection();
      var range = document.createRange();

      range.selectNodeContents(element);
      selection.removeAllRanges();
      selection.addRange(range);

      selectedText = selection.toString();
    }

    return selectedText;
  }
        </script>
