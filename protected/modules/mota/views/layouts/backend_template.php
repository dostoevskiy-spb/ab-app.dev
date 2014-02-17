<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>

    <title>Mota-systems: electronic part of your business.</title>
    <link type='text/css' rel='stylesheet' media='all' href='/template/css/reset-min.css'/>


    <link rel='stylesheet/less' type='text/css' href='/template/css/admin.template.less'/>

    <script src='/js/less-1.3.0.min.js' type='text/javascript'></script>


<!--    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript'></script>-->
<!--    <script src='/js/ckeditor/ckeditor.js' type='text/javascript'></script>-->
<!--    <script src='/js/ckeditor/styles.js' type='text/javascript'></script>-->
<!--    <script src='/js/ckeditor/ckfinder/ckfinder.js' type='text/javascript'></script>-->
    <!--    <script>-->
    <!--        $(document).ready(function () {-->
    <!--            CKFinder.SetupCKEditor(null, '/js/ckeditor/ckfinder/');-->
    <!--            CKFinder.selectActionFunction = function (fileUrl, data) {-->
    <!--                alert('Selected file: ' + fileUrl);-->
    <!--                // Using CKFinderAPI to show simple dialog.-->
    <!--                this.openMsgDialog('', 'Additional data: ' + data['selectActionData']);-->
    <!--                document.getElementById(data['selectActionData']).innerHTML = fileUrl;-->
    <!--            }-->
    <!--            CKFinder.selectThumbnailActionFunction = function (fileUrl, data) {-->
    <!--                alert('Selected file: ' + fileUrl);-->
    <!--                // Using CKFinderAPI to show simple dialog.-->
    <!--                this.openMsgDialog('', 'Additional data: ' + data['selectThumbnailActionData']);-->
    <!--                document.getElementById(data['selectThumbnailActionData']).innerHTML = fileUrl;-->
    <!--            }-->
    <!--            CKFinder.callback = function( api ) {-->
    <!--                api.openMsgDialog( "", "Almost ready to go!" );-->
    <!--            };-->
    <!--            CKFinder.create();-->
    <!---->
    <!--        });-->
    <!--    </script>-->


    <!--[if IE]>
    <script type='text/javascript' src='media/js/supersleight.js'></script>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <link type='text/css' rel='stylesheet' media='all' href='/css/i_hate_ie.css'/>
    <![endif]-->
    <link rel='shortcut icon' href='/images/favicon.png'/>
</head>
<body>
<header>
    <a href='/'>
        <hgroup class='left'>
            <h1>Mota</h1>

            <h2>CMS</h2>
        </hgroup>
    </a>
    <?php if (!Yii::app()->user->isGuest) { ?>
        <nav class="left">
            <a href="/backend/logout">Выйти</a>
            <a href="<?= Yii::app()->homeUrl ?>" target='_blank' title='Откроется в новом окне'>Открыть сайт</a>
            <a href="/backend/users">Управление пользователями</a>
        </nav>
    <? } ?>
    <div class='clear'></div>
</header>
<div id='wrap'>
    <?= $content ?>
    <div class='clear'></div>
</div>
</body>
</html>