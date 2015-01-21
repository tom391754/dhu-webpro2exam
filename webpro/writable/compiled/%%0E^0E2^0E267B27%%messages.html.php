<?php /* Smarty version 2.6.28, created on 2015-01-18 11:17:24
         compiled from messages.html */ ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->_tpl_vars['title']; ?>
</title>

    <!-- Bootstrap core CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="content/css/main.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index">ルーム一覧</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <h1><?php echo $this->_tpl_vars['name']; ?>
</h1>

      <p> <?php echo $this->_tpl_vars['name']; ?>
 のメッセージの一覧です。</p>

      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-primary">
                              <div class="panel-body">
                                  <ul class="chat">
									<?php $_from = $this->_tpl_vars['resultArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['brand'] => $this->_tpl_vars['result']):
?>
										<li class="left clearfix">
										  <div class="chat-body clearfix">
											  <div class="header">
												  <small class="pull-right text-muted">
													  <span class="glyphicon glyphicon-time"></span><?php echo $this->_tpl_vars['result']['send_at']; ?>
</small>
												  </div>
												  <p>
													  <?php echo $this->_tpl_vars['result']['content']; ?>

												  </p>
											  </div>
										  </li>
									<?php endforeach; endif; unset($_from); ?>
                          </ul>
                      </div>
                      <div class="panel-footer">
                          <div class="input-group">
                              <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                              <span class="input-group-btn">
                                  <button class="btn btn-warning btn-sm" id="btn-chat">
                                      Send</button>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

    </div><!-- /.container -->

	<input type="hidden" id="maxMsgID" value="0">
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="content/js/bootstrap.min.js"></script>
	<script src="content/js/message.js"></script>
  </body>
</html>