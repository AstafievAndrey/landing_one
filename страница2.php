<?php
   function ValidateEmail($email)
   {
      $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
      return preg_match($pattern, $email);
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $mailto = 'yourname@address.com';
      $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
      $subject = 'Contact Information';
      $message = 'Values submitted from web site form:';
      $success_url = '';
      $error_url = '';
      $error = '';
      $eol = "\n";
      $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
      $boundary = md5(uniqid(time()));

      $header  = 'From: '.$mailfrom.$eol;
      $header .= 'Reply-To: '.$mailfrom.$eol;
      $header .= 'MIME-Version: 1.0'.$eol;
      $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
      $header .= 'X-Mailer: PHP v'.phpversion().$eol;
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address is invalid!\n<br>";
      }

      if (!empty($error))
      {
         $errorcode = file_get_contents($error_url);
         $replace = "##error##";
         $errorcode = str_replace($replace, $error, $errorcode);
         echo $errorcode;
         exit;
      }

      $internalfields = array ("submit", "reset", "send", "captcha_code");
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }

      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
          foreach ($_FILES as $key => $value)
          {
             if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
      exit;
   }
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Безымянная страница</title>
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -128px;
   float:left
}
div#container
{
   width: 348px;
   height: 257px;
   margin: 0 auto;
   position: relative;
   clear: left;
}
body
{
   font-size: 8px;
   line-height: 1.1875;
   margin: 0;
   padding: 0;
   background-color: transparent;
   color: #000000;
}
</style>
<link href="wb.validation.css" rel="stylesheet" type="text/css">
<style type="text/css">
@font-face
{
   font-family: 'PT Sans';
   src: url('PTS55F.eot');
   src: url('PTS55F.eot?#iefix') format('embedded-opentype'),
        url('PTS55F.svg#PTSans-Regular') format('svg'),
        url('PTS55F.ttf') format('truetype'),
        url('PTS55F.woff') format('woff');
}
@font-face
{
   font-family: 'TruthCYR Light';
   src: url('TruthCYR-Light.eot');
   src: url('TruthCYR-Light.eot?#iefix') format('embedded-opentype'),
        url('TruthCYR-Light.svg#TruthCYR-Light') format('svg'),
        url('TruthCYR-Light.ttf') format('truetype'),
        url('TruthCYR-Light.woff') format('woff');
}
@font-face
{
   font-family: 'Lyno Stan CYR';
   src: url('Lyno_Stan_CYR.eot');
   src: url('Lyno_Stan_CYR.eot?#iefix') format('embedded-opentype'),
        url('Lyno_Stan_CYR.svg#LynoStanCYR') format('svg'),
        url('Lyno_Stan_CYR.ttf') format('truetype'),
        url('Lyno_Stan_CYR.woff') format('woff');
}
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style type="text/css">
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox1
{
   border: 1px #94C02F solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   padding: 0px 5px 0px 40px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 1px #94C02F solid;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   padding: 0px 5px 0px 40px;
   text-align: left;
   vertical-align: middle;
}
#Image6
{
   border: 0px #000000 solid;
}
#Image7
{
   border: 0px #000000 solid;
}
#Image8
{
   border: 0px #000000 solid;
}
#Button1
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 2px;
   -webkit-border-radius: 2px;
   border-radius: 2px;
   background-color: transparent;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
#wb_Text10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text10 div
{
   text-align: center;
}
</style>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect-slide.min.js"></script>
<script type="text/javascript" src="wb.validation.min.js"></script>
<script type="text/javascript" src="wwb9.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   $("#Form1").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#Editbox1").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '40',
      color_text: '#000000',
      color_hint: '#00FF00',
      color_error: '#FF6347',
      color_border: '#FFFF00',
      nohint: true,
      font_family: 'Arial',
      font_size: '13px',
      position: 'topright',
      offsetx: 0,
      offsety: 0,
      bubble_class: 'tooltip',
      effect: 'slide',
      error_text: 'Введите Ваше имя'
   });
   $("#Editbox2").validate(
   {
      required: true,
      type: 'text',
      length_min: '6',
      length_max: '15',
      color_text: '#000000',
      color_hint: '#00FF00',
      color_error: '#FF6347',
      color_border: '#FFFF00',
      nohint: true,
      font_family: 'Arial',
      font_size: '13px',
      position: 'centerright',
      offsetx: 0,
      offsety: 0,
      bubble_class: 'tooltip',
      effect: 'slide',
      error_text: 'Введите Ваш телефон'
   });
});
</script>
</head>
<body>
<div id="space"><br></div>
<div id="container">
<div id="wb_Shape1" style="position:absolute;left:0px;top:0px;width:344px;height:245px;z-index:6;">
<img src="images/img0001.png" id="Shape1" alt="" style="border-width:0;width:344px;height:245px;"></div>
<div id="wb_Form1" style="position:absolute;left:12px;top:12px;width:315px;height:180px;z-index:7;">
<form name="contact6" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
<input type="text" id="Editbox1" style="position:absolute;left:6px;top:11px;width:255px;height:38px;line-height:38px;z-index:0;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox2" style="position:absolute;left:6px;top:62px;width:255px;height:39px;line-height:39px;z-index:1;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image6" style="position:absolute;left:18px;top:18px;width:22px;height:27px;z-index:2;">
<img src="images/name.png" id="Image6" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image7" style="position:absolute;left:17px;top:67px;width:18px;height:28px;z-index:3;">
<img src="images/phone.png" id="Image7" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image8" style="position:absolute;left:16px;top:115px;width:278px;height:58px;z-index:4;">
<img src="images/button2.png" id="Image8" alt="" style="width:278px;height:58px;"></div>
<input type="submit" id="Button1" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:15px;top:115px;width:279px;height:58px;z-index:5;">
</form>
</div>
<div id="wb_Text10" style="position:absolute;left:41px;top:192px;width:250px;height:34px;text-align:center;z-index:8;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
</div>
</body>
</html>