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
<title>Краски</title>
<meta name="keywords" content="Создание сайта S.Nemiroff https://vk.com/elohim_lymi">
<meta name="author" content="Nemiroff">
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -4375px;
   float:left
}
div#container
{
   width: 970px;
   height: 8750px;
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
   background-color: #FFFFFF;
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
@-webkit-keyframes animate-fade-in-left
{
   0% { -webkit-transform:  rotate(0deg) translate(-100px,0px); opacity: 0;  }
   100% { -webkit-transform:  rotate(0deg); opacity: 1;  }
}
@-moz-keyframes animate-fade-in-left
{
   0% { -moz-transform:  rotate(0deg) translate(-100px,0px); opacity: 0;  }
   100% { -moz-transform:  rotate(0deg); opacity: 1;  }
}
@-o-keyframes animate-fade-in-left
{
   0% { -o-transform:  rotate(0deg) translate(-100px,0px); opacity: 0;  }
   100% { -o-transform:  rotate(0deg); opacity: 1;  }
}
@-ms-keyframes animate-fade-in-left
{
   0% { -ms-transform:  rotate(0deg) translate(-100px,0px); opacity: 0;  }
   100% { -ms-transform:  rotate(0deg); opacity: 1;  }
}
@keyframes animate-fade-in-left
{
   0% { transform:  rotate(0deg) translate(-100px,0px); opacity: 0;  }
   100% { transform:  rotate(0deg); opacity: 1;  }
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
#Image62
{
   border: 0px #000000 solid;
}
#Image60
{
   border: 0px #000000 solid;
}
#Layer3
{
   background-color: transparent;
   background-image: url(images/hab-600-45.png);
   background-repeat: no-repeat;
   background-position: center top;
}
#Layer1
{
   background-color: transparent;
   background-image: url(images/fon1.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#Image1
{
   border: 0px #000000 solid;
   -webkit-animation: animate-fade-in-left 1500ms linear 0ms 1 normal;
   -moz-animation: animate-fade-in-left 1500ms linear 0ms 1 normal;
   -ms-animation: animate-fade-in-left 1500ms linear 0ms 1 normal;
   animation: animate-fade-in-left 1500ms linear 0ms 1 normal;
}
#Layer2
{
   background-color: transparent;
   background-image: url(images/setka.png);
   background-repeat: repeat;
   background-position: center top;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text1 div
{
   text-align: center;
}
#Layer5
{
   background-color: #00031B;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#Line1
{
   border-width: 0;
   height: 71px;
   width: 8px;
}
#Image2
{
   border: 0px #000000 solid;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text5 div
{
   text-align: left;
}
#Image3
{
   border: 0px #000000 solid;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text6 div
{
   text-align: left;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text7 div
{
   text-align: left;
}
#Image4
{
   border: 0px #000000 solid;
}
#wb_Text8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text8 div
{
   text-align: left;
}
#Image5
{
   border: 0px #000000 solid;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text9 div
{
   text-align: left;
}
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
#Image9
{
   border: 0px #000000 solid;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text11 div
{
   text-align: left;
}
#Image10
{
   border: 0px #000000 solid;
}
#Image11
{
   border: 0px #000000 solid;
}
#Image12
{
   border: 0px #000000 solid;
}
#Image13
{
   border: 0px #000000 solid;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text12 div
{
   text-align: center;
}
#wb_Text13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text13 div
{
   text-align: center;
}
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text14 div
{
   text-align: center;
}
#wb_Text15 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text15 div
{
   text-align: center;
}
#wb_Text16 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text16 div
{
   text-align: left;
}
#Image15
{
   border: 0px #000000 solid;
}
#Image16
{
   border: 0px #000000 solid;
}
#Image17
{
   border: 0px #000000 solid;
}
#Image18
{
   border: 0px #000000 solid;
}
#Image19
{
   border: 0px #000000 solid;
}
#Image20
{
   border: 0px #000000 solid;
}
#Image14
{
   border: 0px #000000 solid;
}
#Image21
{
   border: 0px #000000 solid;
}
#Image22
{
   border: 0px #000000 solid;
}
#Image23
{
   border: 0px #000000 solid;
}
#Image24
{
   border: 0px #000000 solid;
}
#Image25
{
   border: 0px #000000 solid;
}
#Image26
{
   border: 0px #000000 solid;
}
#wb_Text17 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text17 div
{
   text-align: left;
}
#wb_Text18 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text18 div
{
   text-align: left;
}
#wb_Text19 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text19 div
{
   text-align: left;
}
#wb_Text20 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text20 div
{
   text-align: left;
}
#wb_Text21 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text21 div
{
   text-align: left;
}
#wb_Text22 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text22 div
{
   text-align: left;
}
#Layer6
{
   background-color: transparent;
   background-image: url(images/bg.jpg);
   background-repeat: repeat;
   background-position: left top;
}
#wb_Text23 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text23 div
{
   text-align: left;
}
#Line2
{
   border-width: 0;
   height: 8px;
   width: 83px;
}
#Line3
{
   border-width: 0;
   height: 8px;
   width: 83px;
}
#Image27
{
   border: 0px #000000 solid;
}
#Image28
{
   border: 0px #000000 solid;
}
#wb_Text24 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text24 div
{
   text-align: left;
}
#wb_Text25 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text25 div
{
   text-align: left;
}
#wb_Text26 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text26 div
{
   text-align: left;
}
#Image29
{
   border: 0px #000000 solid;
}
#Line4
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line5
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line6
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line7
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line8
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line9
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line10
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line11
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line12
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line13
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line14
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line15
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line16
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line17
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line18
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line19
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line20
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line21
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#wb_Text27 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text27 div
{
   text-align: left;
}
#wb_Text28 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text28 div
{
   text-align: left;
}
#wb_Text29 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text29 div
{
   text-align: left;
}
#wb_Text30 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text30 div
{
   text-align: left;
}
#wb_Text31 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text31 div
{
   text-align: left;
}
#wb_Text32 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text32 div
{
   text-align: left;
}
#wb_Text33 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text33 div
{
   text-align: left;
}
#wb_Text34 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text34 div
{
   text-align: left;
}
#wb_Text35 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text35 div
{
   text-align: left;
}
#wb_Text36 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text36 div
{
   text-align: left;
}
#wb_Text37 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text37 div
{
   text-align: left;
}
#wb_Text38 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text38 div
{
   text-align: left;
}
#wb_Text39 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text39 div
{
   text-align: left;
}
#wb_Text40 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text40 div
{
   text-align: left;
}
#wb_Text41 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text41 div
{
   text-align: left;
}
#wb_Text42 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text42 div
{
   text-align: left;
}
#wb_Text43 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text43 div
{
   text-align: left;
}
#wb_Text44 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text44 div
{
   text-align: left;
}
#Line22
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#Line23
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#wb_Text45 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text45 div
{
   text-align: left;
}
#Line24
{
   border-width: 0;
   height: 8px;
   width: 281px;
}
#wb_Text46 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text46 div
{
   text-align: left;
}
#Image30
{
   border: 0px #000000 solid;
}
#Image31
{
   border: 0px #000000 solid;
}
#Image32
{
   border: 0px #000000 solid;
}
#Image33
{
   border: 0px #000000 solid;
}
#Image34
{
   border: 0px #000000 solid;
}
#Image35
{
   border: 0px #000000 solid;
}
#Image36
{
   border: 0px #000000 solid;
}
#Image37
{
   border: 0px #000000 solid;
}
#Image38
{
   border: 0px #000000 solid;
}
#Image39
{
   border: 0px #000000 solid;
}
#Image40
{
   border: 0px #000000 solid;
}
#Image41
{
   border: 0px #000000 solid;
}
#Image42
{
   border: 0px #000000 solid;
}
#Image43
{
   border: 0px #000000 solid;
}
#Image44
{
   border: 0px #000000 solid;
}
#Image45
{
   border: 0px #000000 solid;
}
#Image46
{
   border: 0px #000000 solid;
}
#Image47
{
   border: 0px #000000 solid;
}
#Image48
{
   border: 0px #000000 solid;
}
#Image49
{
   border: 0px #000000 solid;
}
#Image50
{
   border: 0px #000000 solid;
}
#Image51
{
   border: 0px #000000 solid;
}
#Image52
{
   border: 0px #000000 solid;
}
#Layer7
{
   background-color: transparent;
   background-image: url(images/fon6.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#Layer8
{
   background-color: transparent;
   background-image: url(images/setka.png);
   background-repeat: repeat;
   background-position: center top;
}
#wb_Text47 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text47 div
{
   text-align: left;
}
#wb_Text48 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text48 div
{
   text-align: center;
}
#Editbox3
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
#Editbox4
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
#Image53
{
   border: 0px #000000 solid;
}
#Image54
{
   border: 0px #000000 solid;
}
#Image55
{
   border: 0px #000000 solid;
}
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_Text49 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text49 div
{
   text-align: center;
}
#Button2
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
#Image56
{
   border: 0px #000000 solid;
}
#InlineFrame1
{
   border: 1px #00008B solid;
}
#Layer9
{
   background-color: transparent;
   background-image: url(images/mwr0Bg.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#Layer10
{
   background-color: transparent;
   background-image: url(images/br_bot.png);
   background-repeat: repeat-x;
   background-position: center top;
}
#Layer11
{
   background-color: transparent;
   background-image: url(images/bg_footer.png);
   background-repeat: repeat;
   background-position: left top;
}
#wb_Text50 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text50 div
{
   text-align: left;
}
#Line25
{
   border-width: 0;
   height: 8px;
   width: 83px;
}
#Line26
{
   border-width: 0;
   height: 8px;
   width: 83px;
}
#Image57
{
   border: 0px #000000 solid;
}
#Image58
{
   border: 0px #000000 solid;
}
#wb_Text51 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text51 div
{
   text-align: left;
}
#Line27
{
   border-width: 0;
   height: 8px;
   width: 83px;
}
#Line28
{
   border-width: 0;
   height: 8px;
   width: 83px;
}
#Image59
{
   border-width: 0;
}
#wb_Text52 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text52 div
{
   text-align: left;
}
#wb_Text53 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text53 div
{
   text-align: left;
}
#wb_Text54 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text54 div
{
   text-align: left;
}
#wb_Text55 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text55 div
{
   text-align: left;
}
#Line29
{
   border-width: 0;
   height: 8px;
   width: 460px;
}
#Line30
{
   border-width: 0;
   height: 8px;
   width: 919px;
}
#Image61
{
   border-width: 0;
}
#wb_Text56 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text56 div
{
   text-align: left;
}
#wb_Text57 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text57 div
{
   text-align: left;
}
#wb_Text58 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text58 div
{
   text-align: left;
}
#Line31
{
   border-width: 0;
   height: 8px;
   width: 460px;
}
#wb_Text59 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text59 div
{
   text-align: left;
}
#Line32
{
   border-width: 0;
   height: 8px;
   width: 919px;
}
#Image63
{
   border: 0px #000000 solid;
}
#Image64
{
   border: 0px #000000 solid;
}
#wb_Text60 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text60 div
{
   text-align: left;
}
#wb_Text61 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text61 div
{
   text-align: left;
}
#wb_Text62 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text62 div
{
   text-align: left;
}
#Line33
{
   border-width: 0;
   height: 8px;
   width: 460px;
}
#wb_Text63 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text63 div
{
   text-align: left;
}
#Line34
{
   border-width: 0;
   height: 8px;
   width: 919px;
}
#Layer12
{
   background-color: transparent;
   background-image: url(images/bl_3.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#wb_Text64 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text64 div
{
   text-align: left;
}
#Image65
{
   border: 0px #000000 solid;
}
#Image66
{
   border: 0px #000000 solid;
}
#Image67
{
   border: 0px #000000 solid;
}
#Image68
{
   border: 0px #000000 solid;
}
#Image69
{
   border: 0px #000000 solid;
}
#wb_Text65 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text65 div
{
   text-align: center;
}
#wb_Text66 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text66 div
{
   text-align: center;
}
#wb_Text67 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text67 div
{
   text-align: center;
}
#wb_Text68 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text68 div
{
   text-align: center;
}
#wb_Text69 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text69 div
{
   text-align: center;
}
#wb_Text70 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text70 div
{
   text-align: left;
}
#Image70
{
   border: 0px #000000 solid;
}
#Image71
{
   border-width: 0;
}
#Image72
{
   border-width: 0;
}
#Image73
{
   border-width: 0;
}
#Image74
{
   border-width: 0;
}
#Image75
{
   border-width: 0;
}
#Image76
{
   border-width: 0;
}
#wb_Text71 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text71 div
{
   text-align: left;
}
#wb_Text72 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text72 div
{
   text-align: left;
}
#wb_Text73 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text73 div
{
   text-align: left;
}
#wb_Text74 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text74 div
{
   text-align: left;
}
#wb_Text75 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text75 div
{
   text-align: left;
}
#wb_Text76 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text76 div
{
   text-align: left;
}
#Line35
{
   border-width: 0;
   height: 8px;
   width: 332px;
}
#Line36
{
   border-width: 0;
   height: 8px;
   width: 332px;
}
#Line37
{
   border-width: 0;
   height: 8px;
   width: 332px;
}
#Line38
{
   border-width: 0;
   height: 8px;
   width: 332px;
}
#Line39
{
   border-width: 0;
   height: 8px;
   width: 332px;
}
#Line40
{
   border-width: 0;
   height: 8px;
   width: 332px;
}
#Layer13
{
   background-color: transparent;
   background-image: url(images/fon2.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#Layer14
{
   background-color: transparent;
   background-image: url(images/setka.png);
   background-repeat: repeat;
   background-position: center top;
}
#wb_Form3
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox5
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
#Editbox6
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
#Image77
{
   border: 0px #000000 solid;
}
#Image78
{
   border: 0px #000000 solid;
}
#Image79
{
   border: 0px #000000 solid;
}
#wb_Text77 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text77 div
{
   text-align: center;
}
#Button3
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
#InlineFrame2
{
   border: 1px #C0C0C0 solid;
}
#wb_Text78 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text78 div
{
   text-align: center;
}
#wb_Text79 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text79 div
{
   text-align: left;
}
#Image80
{
   border: 0px #000000 solid;
}
#Layer15
{
   background-color: transparent;
   background-image: url(images/fon1.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#Image81
{
   border: 0px #000000 solid;
}
#wb_Text80 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text80 div
{
   text-align: left;
}
#wb_Form4
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox7
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
#Editbox8
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
#Image82
{
   border: 0px #000000 solid;
}
#Image83
{
   border: 0px #000000 solid;
}
#Image84
{
   border: 0px #000000 solid;
}
#wb_Text81 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text81 div
{
   text-align: center;
}
#Button4
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
#wb_Text82 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text82 div
{
   text-align: left;
}
#Image85
{
   border: 0px #000000 solid;
}
#Layer16
{
   background-color: transparent;
   background-image: url(images/polosa1.jpg);
   background-repeat: repeat;
   background-position: center top;
}
#wb_Text83 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text83 div
{
   text-align: left;
}
#Image86
{
   border: 0px #000000 solid;
}
#Image87
{
   border: 0px #000000 solid;
}
#wb_Text84 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text84 div
{
   text-align: center;
}
#Layer4
{
   background-color: transparent;
   background-image: url(images/polosq4.png);
   background-repeat: repeat;
   background-position: center top;
}
</style>
<script type="text/javascript" src="swfobject.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect-slide.min.js"></script>
<script type="text/javascript" src="wb.validation.min.js"></script>
<script type="text/javascript" src="wb.rotate.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.0.css" type="text/css">
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
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
   $("#Editbox3").validate(
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
   $("#Editbox4").validate(
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
   $("#Form2").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#Form3").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#Editbox5").validate(
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
   $("#Editbox6").validate(
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
   $("#Form4").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#Editbox7").validate(
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
   $("#Editbox8").validate(
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
<style>
#fancybox-wrap {}
#fancybox-outer {background: none !important;}
div#fancy-bg-n {background: none !important;}
div#fancy-bg-ne {background: none !important;}
div#fancy-bg-e {background: none !important;}
div#fancy-bg-se {background: none !important;}
div#fancy-bg-s {background: none !important;}
div#fancy-bg-sw {background: none !important;}
div#fancy-bg-w {background: none !important;}
div#fancy-bg-nw {background: none !important;}
</style>
<script src="jquery.js"></script>
		<script src="script.js"></script>
		
		<style>
			#indexLayer1 {background-attachment: fixed !important;}
			#indexLayer3 {background-attachment: fixed !important;}                                       #indexLayer8 {background-attachment: fixed !important;}
#indexLayer13 {background-attachment: fixed !important;}
		</style>
<link rel="stylesheet" href="animate.css">
		<script src="wow.js"></script>	
		<script>
			new WOW().init();
		</script

 <script>
$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash,
	    $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
});
</script>
</head>
<body>
<div id="space"><br></div>
<div id="container">
<div id="wb_Image62" style="position:absolute;left:571px;top:5661px;width:373px;height:252px;filter:alpha(opacity=0);-moz-opacity:0.00;opacity:0.00;z-index:227;">
<img src="images/telik1.png" id="Image62" alt="" style="width:373px;height:252px;"></div>
<div id="wb_Image60" style="position:absolute;left:16px;top:5290px;width:373px;height:252px;filter:alpha(opacity=0);-moz-opacity:0.00;opacity:0.00;z-index:228;">
<img src="images/telik1.png" id="Image60" alt="" style="width:373px;height:252px;"></div>

<div id="wb_Text16" style="position:absolute;left:80px;top:1314px;width:809px;height:62px;z-index:230;text-align:left;" class="wow fadeIn" data-wow-duration="2s" data-wow-offset="100">
<span style="color:#00008B;font-family:'PT Sans';font-size:48px;">Почему Вы захотите <strong>с нами работать</strong></span></div>
<div id="wb_Image15" style="position:absolute;left:18px;top:1404px;width:126px;height:144px;z-index:231;">
<img src="images/ramka1.png" id="Image15" alt="" style="width:126px;height:144px;"></div>
<div id="wb_Image16" style="position:absolute;left:18px;top:1568px;width:126px;height:144px;z-index:232;">
<img src="images/ramka1.png" id="Image16" alt="" style="width:126px;height:144px;"></div>
<div id="wb_Image17" style="position:absolute;left:18px;top:1734px;width:126px;height:144px;z-index:233;">
<img src="images/ramka1.png" id="Image17" alt="" style="width:126px;height:144px;"></div>
<div id="wb_Image18" style="position:absolute;left:18px;top:1901px;width:126px;height:144px;z-index:234;">
<img src="images/ramka1.png" id="Image18" alt="" style="width:126px;height:144px;"></div>
<div id="wb_Image19" style="position:absolute;left:18px;top:2064px;width:126px;height:144px;z-index:235;">
<img src="images/ramka1.png" id="Image19" alt="" style="width:126px;height:144px;"></div>
<div id="wb_Image20" style="position:absolute;left:18px;top:2236px;width:126px;height:144px;z-index:236;">
<img src="images/ramka1.png" id="Image20" alt="" style="width:126px;height:144px;"></div>
<div id="wb_Image14" style="position:absolute;left:443px;top:1385px;width:524px;height:995px;z-index:237;">
<img src="images/baby1.png" id="Image14" alt="" style="width:524px;height:995px;"></div>
<div id="wb_Image21" style="position:absolute;left:33px;top:1441px;width:89px;height:68px;z-index:238;">
<img src="images/icon1.png" id="Image21" alt="" style="width:89px;height:68px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image22" style="position:absolute;left:38px;top:1598px;width:72px;height:76px;z-index:239;">
<img src="images/icon2.png" id="Image22" alt="" style="width:72px;height:76px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image23" style="position:absolute;left:31px;top:1779px;width:100px;height:57px;z-index:240;">
<img src="images/icon3.png" id="Image23" alt="" style="width:100px;height:57px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image24" style="position:absolute;left:40px;top:1937px;width:79px;height:70px;z-index:241;">
<img src="images/icon4.png" id="Image24" alt="" style="width:79px;height:70px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image25" style="position:absolute;left:38px;top:2105px;width:87px;height:58px;z-index:242;">
<img src="images/icon5.png" id="Image25" alt="" style="width:87px;height:58px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image26" style="position:absolute;left:38px;top:2265px;width:83px;height:82px;z-index:243;">
<img src="images/icon6.png" id="Image26" alt="" style="width:83px;height:82px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Text17" style="position:absolute;left:161px;top:1423px;width:371px;height:96px;z-index:244;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;"><strong>Анализ продукта и<br>конкурентной среды рынка</strong><br>Продающие тексты и качественный дизайн<br>именно для Вашей сферы деятельности</span></div>
<div id="wb_Text18" style="position:absolute;left:161px;top:1582px;width:371px;height:96px;z-index:245;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;"><strong>Посетители сразу<br></strong>Как только мы запускаем Ваш лендинг - Вы<br>сразу же получаете посетителей. Не нужно<br>ждать, просто получайте клиентов</span></div>
<div id="wb_Text19" style="position:absolute;left:161px;top:1743px;width:387px;height:96px;z-index:246;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;"><strong>Команда специалистов<br></strong>Над проектом работает целый штат опытных<br>специалистов. маркетологи, копирайтеры,<br>дизайнеры, верстальщики и Ваш менеджер</span></div>
<div id="wb_Text20" style="position:absolute;left:161px;top:1917px;width:371px;height:96px;z-index:247;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;"><strong>Гарантия успеха<br></strong>Мы гарантируем конверсию для Вашего<br>сайта. Мы приведем к Вам клиентов, а Вам<br>просто нужно будет получить деньги</span></div>
<div id="wb_Text21" style="position:absolute;left:161px;top:2080px;width:397px;height:96px;z-index:248;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;"><strong>Уникальность Вашей странички<br></strong>Мы предлогаем только эксклюзивный дизайн<br>и уникальные продающие текста под Вашу<br>целевую аудиторию</span></div>
<div id="wb_Text22" style="position:absolute;left:161px;top:2266px;width:371px;height:72px;z-index:249;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;"><strong>Сборка сайта в Ваши сроки<br></strong>Соблюдаем заранее оговоренные сроки<br>создания Вашей страницы захвата</span></div>
<div id="wb_Line6" style="position:absolute;left:18px;top:2694px;width:273px;height:0px;z-index:250;">
<img src="images/img0027.png" id="Line6" alt=""></div>
<div id="wb_Text51" style="position:absolute;left:367px;top:5225px;width:235px;height:42px;z-index:251;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:32px;">ОТЗЫВЫ О НАС</span></div>
<div id="wb_Line27" style="position:absolute;left:602px;top:5241px;width:75px;height:0px;z-index:252;">
<img src="images/img0035.png" id="Line27" alt=""></div>
<div id="wb_Line28" style="position:absolute;left:270px;top:5241px;width:75px;height:0px;z-index:253;">
<img src="images/img0036.png" id="Line28" alt=""></div>
<div id="wb_Image59" style="position:absolute;left:16px;top:5292px;width:373px;height:336px;z-index:254;">
<img src="images/img0037.png" id="Image59" alt="" style="width:373px;height:336px;"></div>
<div id="wb_YouTube1" style="position:absolute;left:41px;top:5299px;width:321px;height:181px;z-index:255;">
<iframe width="321" height="181" src="http://www.youtube.com/embed/l2t5CjRh6Ec?rel=1&amp;version=3&amp;autohide=1&amp;fs=1&amp;theme=dark" allowfullscreen></iframe>
</div>
<div id="wb_Text52" style="position:absolute;left:387px;top:5320px;width:321px;height:80px;z-index:256;text-align:left;">
<span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Заказчик:</span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"> <strong>Eкатерина Мирушенко<br></strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Сайт:</span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong> http://furbylands.ru/<br></strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Заявок в месяц до работы с нами</span><span style="color:#696969;font-family:'PT Sans';font-size:16px;">: <strong>5 - 7</strong><br></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Заявок в месяц после работы с нами:</span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"> <strong>15 - 19</strong></span></div>
<div id="wb_Text53" style="position:absolute;left:745px;top:5320px;width:202px;height:27px;z-index:257;text-align:left;">
<span style="color:#2E8B57;font-family:'PT Sans';font-size:21px;"><strong>Увеличение дохода:</strong></span></div>
<div id="wb_Text54" style="position:absolute;left:806px;top:5355px;width:105px;height:44px;z-index:258;text-align:left;">
<span style="color:#FF6347;font-family:'Lyno Stan CYR';font-size:37px;">300%</span></div>
<div id="wb_Text55" style="position:absolute;left:387px;top:5480px;width:572px;height:120px;z-index:259;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;">Хочу выразить свою благодарность ребятам. Спасибо вам большое,<br>особенно команде Олега! Сделан Landing +директ был очень<br>качественно, а самое главное мы получили результат который<br>превзошел наши ожидания. Вы команда профессионалов, я в этом<br>убедилась! Продолжайте в том же духе!</span></div>
<div id="wb_Line29" style="position:absolute;left:390px;top:5436px;width:452px;height:0px;z-index:260;">
<img src="images/img0038.png" id="Line29" alt=""></div>
<div id="wb_Line30" style="position:absolute;left:28px;top:5632px;width:911px;height:0px;z-index:261;">
<img src="images/img0039.png" id="Line30" alt=""></div>
<div id="wb_Shape9" style="position:absolute;left:371px;top:5289px;width:575px;height:344px;z-index:262;">
<a href="#" onmouseover="Animate('wb_Image60', '', '', '', '', '80', 500, '');return false;" onmouseout="Animate('wb_Image60', '', '', '', '', '0', 500, '');return false;"><img src="images/img0040.png" id="Shape9" alt="" style="border-width:0;width:575px;height:344px;"></a></div>
<div id="wb_Image61" style="position:absolute;left:573px;top:5661px;width:373px;height:336px;z-index:263;">
<img src="images/img0041.png" id="Image61" alt="" style="width:373px;height:336px;"></div>
<div id="wb_YouTube2" style="position:absolute;left:599px;top:5668px;width:321px;height:181px;z-index:264;">
<iframe width="321" height="181" src="http://www.youtube.com/embed/l2t5CjRh6Ec?rel=1&amp;version=3&amp;autohide=1&amp;fs=1&amp;theme=dark" allowfullscreen></iframe>
</div>
<div id="wb_Text56" style="position:absolute;left:39px;top:5662px;width:334px;height:80px;z-index:265;text-align:left;">
<span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Заказчик: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>Николай Рапаев</strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;"><br>Сайт: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>розы5.рф</strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;"><br>Заявок в месяц до работы с нами:</span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong> 3 - 4</strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;"><br>Заявок в месяц после работы с нами: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>60 - 65</strong></span></div>
<div id="wb_Text57" style="position:absolute;left:375px;top:5661px;width:202px;height:27px;z-index:266;text-align:left;">
<span style="color:#2E8B57;font-family:'PT Sans';font-size:21px;"><strong>Увеличение дохода:</strong></span></div>
<div id="wb_Text58" style="position:absolute;left:432px;top:5705px;width:105px;height:44px;z-index:267;text-align:left;">
<span style="color:#FF6347;font-family:'Lyno Stan CYR';font-size:37px;">550%</span></div>
<div id="wb_Line31" style="position:absolute;left:38px;top:5757px;width:452px;height:0px;z-index:268;">
<img src="images/img0042.png" id="Line31" alt=""></div>
<div id="wb_Text59" style="position:absolute;left:40px;top:5788px;width:521px;height:120px;z-index:269;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;">Хотел сказать большое спасибо! Реально хорошая работа и отличное отношение к клиентам! Все выполнено в срок, все пожелания учтены, и даже более! Конверсию я такую даже и не ожидал, если честно!<br>Спасибо! Заказывал два проекта, буду заказывать еще!</span></div>
<div id="wb_Line32" style="position:absolute;left:26px;top:5995px;width:911px;height:0px;z-index:270;">
<img src="images/img0043.png" id="Line32" alt=""></div>
<div id="wb_Shape10" style="position:absolute;left:16px;top:5638px;width:575px;height:344px;z-index:271;">
<a href="#" onmouseover="Animate('wb_Image62', '', '', '', '', '80', 500, '');return false;" onmouseout="Animate('wb_Image62', '', '', '', '', '0', 500, '');return false;"><img src="images/img0044.png" id="Shape10" alt="" style="border-width:0;width:575px;height:344px;"></a></div>
<div id="wb_Image63" style="position:absolute;left:16px;top:6030px;width:373px;height:252px;filter:alpha(opacity=0);-moz-opacity:0.00;opacity:0.00;z-index:272;">
<img src="images/telik1.png" id="Image63" alt="" style="width:373px;height:252px;"></div>
<div id="wb_Image64" style="position:absolute;left:16px;top:6029px;width:373px;height:252px;z-index:273;">
<img src="images/telik.png" id="Image64" alt="" style="width:373px;height:252px;"></div>
<div id="wb_YouTube3" style="position:absolute;left:43px;top:6036px;width:321px;height:181px;z-index:274;">
<iframe width="321" height="181" src="http://www.youtube.com/embed/l2t5CjRh6Ec?rel=1&amp;version=3&amp;autohide=1&amp;fs=1&amp;theme=dark" allowfullscreen></iframe>
</div>
<div id="wb_Text60" style="position:absolute;left:400px;top:6038px;width:334px;height:80px;z-index:275;text-align:left;">
<span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Заказчик: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>Евгений Садовников<br></strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Сайт: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>paulokorse.ru</strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;"><br>Заявок в месяц до работы с нами: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>1 - 2<br></strong></span><span style="color:#2E8B57;font-family:'PT Sans';font-size:16px;">Заявок в месяц после работы с нами: </span><span style="color:#696969;font-family:'PT Sans';font-size:16px;"><strong>6 - 9</strong></span></div>
<div id="wb_Text61" style="position:absolute;left:752px;top:6034px;width:202px;height:27px;z-index:276;text-align:left;">
<span style="color:#2E8B57;font-family:'PT Sans';font-size:21px;"><strong>Увеличение дохода:</strong></span></div>
<div id="wb_Text62" style="position:absolute;left:809px;top:6079px;width:105px;height:44px;z-index:277;text-align:left;">
<span style="color:#FF6347;font-family:'Lyno Stan CYR';font-size:37px;">250%</span></div>
<div id="wb_Line33" style="position:absolute;left:400px;top:6129px;width:452px;height:0px;z-index:278;">
<img src="images/img0045.png" id="Line33" alt=""></div>
<div id="wb_Text63" style="position:absolute;left:401px;top:6152px;width:553px;height:96px;z-index:279;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:19px;">Ребята в этой команде профессионалы своего дела! Сделали лендинг качественно на 100% К ним можно обращаться по всем вопросам, теперь я в этом уверен. Отдельное спасибо моему персональному куратору Андрею Седову!</span></div>
<div id="wb_Line34" style="position:absolute;left:12px;top:6306px;width:911px;height:0px;z-index:280;">
<img src="images/img0046.png" id="Line34" alt=""></div>
<div id="wb_Shape11" style="position:absolute;left:404px;top:6016px;width:563px;height:274px;z-index:281;">
<a href="#" onmouseover="Animate('wb_Image63', '', '', '', '', '80', 500, '');return false;" onmouseout="Animate('wb_Image63', '', '', '', '', '0', 500, '');return false;"><img src="images/img0047.png" id="Shape11" alt="" style="border-width:0;width:563px;height:274px;"></a></div>
<div id="wb_Text70" style="position:absolute;left:177px;top:6755px;width:614px;height:62px;z-index:282;text-align:left;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:48px;">Этапы нашей с Вами работы</span></div>
<div id="wb_Image70" style="position:absolute;left:0px;top:6806px;width:431px;height:1011px;z-index:283;">
<img src="images/ccb79da4d6a0.png" id="Image70" alt="" style="width:431px;height:1011px;"></div>
<div id="wb_Image71" style="position:absolute;left:484px;top:6843px;width:103px;height:137px;z-index:284;">
<img src="images/img0048.png" id="Image71" alt="" style="width:103px;height:137px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<div id="wb_Image72" style="position:absolute;left:484px;top:6987px;width:103px;height:137px;z-index:285;">
<img src="images/img0049.png" id="Image72" alt="" style="width:103px;height:137px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<div id="wb_Image73" style="position:absolute;left:484px;top:7138px;width:103px;height:137px;z-index:286;">
<img src="images/img0050.png" id="Image73" alt="" style="width:103px;height:137px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<div id="wb_Image74" style="position:absolute;left:484px;top:7291px;width:103px;height:137px;z-index:287;">
<img src="images/img0051.png" id="Image74" alt="" style="width:103px;height:137px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<div id="wb_Image75" style="position:absolute;left:484px;top:7443px;width:103px;height:137px;z-index:288;">
<img src="images/img0052.png" id="Image75" alt="" style="width:103px;height:137px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<div id="wb_Image76" style="position:absolute;left:484px;top:7605px;width:103px;height:137px;z-index:289;">
<img src="images/img0053.png" id="Image76" alt="" style="width:103px;height:137px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<div id="wb_Text71" style="position:absolute;left:608px;top:6849px;width:301px;height:81px;z-index:290;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:21px;"><strong>Заявка</strong><br>Вы оставляете заявку на сайте<br>или по телефону</span></div>
<div id="wb_Text72" style="position:absolute;left:608px;top:6994px;width:301px;height:81px;z-index:291;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:21px;"><strong>Знакомство<br></strong>Общаемся с Вами. Уточняем у<br>Вас детали</span></div>
<div id="wb_Text73" style="position:absolute;left:608px;top:7148px;width:301px;height:81px;z-index:292;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:21px;"><strong>Брифинг<br></strong>Заполнение нашего брифа<br>занимает не более 15 минут</span></div>
<div id="wb_Text74" style="position:absolute;left:608px;top:7301px;width:301px;height:81px;z-index:293;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:21px;"><strong>Разработка<br></strong>Создаём и согласуем с Вами<br>дизайн сайта</span></div>
<div id="wb_Text75" style="position:absolute;left:608px;top:7451px;width:301px;height:81px;z-index:294;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:21px;"><strong>Интеграция<br></strong>Вёрстка сайта, настройка<br>систем аналитики, CRM</span></div>
<div id="wb_Text76" style="position:absolute;left:608px;top:7597px;width:347px;height:108px;z-index:295;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:21px;"><strong>Сдача проекта<br></strong>Вы начинаете получать множество<br>заявок уже на следующий день и<br>советуете нас друзьям</span></div>
<div id="wb_Line35" style="position:absolute;left:484px;top:6942px;width:324px;height:0px;z-index:296;">
<img src="images/img0054.png" id="Line35" alt=""></div>
<div id="wb_Line36" style="position:absolute;left:480px;top:7086px;width:324px;height:0px;z-index:297;">
<img src="images/img0055.png" id="Line36" alt=""></div>
<div id="wb_Line37" style="position:absolute;left:483px;top:7237px;width:324px;height:0px;z-index:298;">
<img src="images/img0056.png" id="Line37" alt=""></div>
<div id="wb_Line38" style="position:absolute;left:483px;top:7389px;width:324px;height:0px;z-index:299;">
<img src="images/img0057.png" id="Line38" alt=""></div>
<div id="wb_Line39" style="position:absolute;left:483px;top:7542px;width:324px;height:0px;z-index:300;">
<img src="images/img0058.png" id="Line39" alt=""></div>
<div id="wb_Line40" style="position:absolute;left:482px;top:7704px;width:324px;height:0px;z-index:301;">
<img src="images/img0059.png" id="Line40" alt=""></div>
<div id="wb_Shape16" style="position:absolute;left:0px;top:2285px;width:100px;height:100px;z-index:302;">
<div id=link1><img src="images/img0065.png" id="Shape16" alt="" style="border-width:0;width:100px;height:100px;"></div></div>
<div id="wb_Shape17" style="position:absolute;left:0px;top:3701px;width:100px;height:100px;z-index:303;">
<div id=link2><img src="images/img0066.png" id="Shape17" alt="" style="border-width:0;width:100px;height:100px;"></div></div>
<div id="wb_Shape18" style="position:absolute;left:0px;top:5106px;width:100px;height:100px;z-index:304;">
<div id=link3><img src="images/img0067.png" id="Shape18" alt="" style="border-width:0;width:100px;height:100px;"></div></div>
<div id="wb_Shape19" style="position:absolute;left:0px;top:6651px;width:100px;height:100px;z-index:305;">
<div id=link4><img src="images/img0068.png" id="Shape19" alt="" style="border-width:0;width:100px;height:100px;"></div></div>
</div>
<div id="Layer3" style="position:absolute;text-align:center;left:4px;top:134px;width:33%;height:1116px;z-index:306;" title="" class="parallax" data-speed="0.8" data-type="background">
<div id="Layer3_Container" style="width:325px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="Layer1" style="position:absolute;text-align:center;left:0px;top:97px;width:99%;height:1203px;z-index:307;" title="" class="parallax" data-speed="0.4" data-type="background">
<div id="Layer1_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="Layer3" style="position:absolute;text-align:center;left:4px;top:37px;width:33%;height:1116px;z-index:0;" title="" class="parallax" data-speed="0.8" data-type="background">
<div id="Layer3_Container" style="width:325px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="wb_Image1" style="position:absolute;left:171px;top:476px;width:634px;height:545px;z-index:1;">
<img src="images/hab-600-2.png" id="Image1" alt="" style="width:634px;height:545px;"></div>
</div>
</div>
<div id="Layer2" style="position:absolute;text-align:center;left:5px;top:102px;width:99%;height:1192px;z-index:308;" title="">
<div id="Layer2_Container" style="width:962px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text6" style="position:absolute;left:53px;top:42px;width:852px;height:56px;z-index:9;text-align:left;" class="wow fadeIn" data-wow-duration="2s" data-wow-delay="2s">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:43px;">Закажи Landing Page прямо сейчас и получи</span></div>
<div id="wb_Text7" style="position:absolute;left:74px;top:110px;width:810px;height:62px;z-index:10;text-align:left;" class="wow fadeIn" data-wow-duration="0.5s" data-wow-delay="4s">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:48px;"><strong>МГНОВЕННОЕ УВЕЛИЧЕНИЕ ПРОДАЖ</strong></span></div>
<div id="wb_Text8" style="position:absolute;left:182px;top:301px;width:596px;height:48px;z-index:11;text-align:left;" class="wow fadeIn" data-wow-duration="1s" data-wow-delay="6s">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:37px;"><strong>ХОЧУ УВЕЛИЧИТЬ СВОЮ ПРИБЫЛЬ</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:8px;top:321px;width:944px;height:424px;z-index:12;">
<img src="images/ramka.png" id="Image4" alt="" style="width:944px;height:424px;"></div>
<div id="wb_Image5" style="position:absolute;left:442px;top:357px;width:74px;height:28px;z-index:13;">
<img src="images/strelka.png" id="Image5" alt="" style="width:74px;height:28px;" class="wow bounceInDown" data-wow-duration="2s" data-wow-delay="7s"></div>
<div id="wb_Text9" style="position:absolute;left:258px;top:397px;width:446px;height:24px;z-index:14;text-align:left;" class="wow fadeIn" data-wow-duration="2s" data-wow-delay="9s">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:19px;">Заполните форму ниже для получения консультации</span></div>
<div id="wb_Form1" style="position:absolute;left:283px;top:461px;width:389px;height:229px;z-index:15;">
<form name="contact" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
<input type="text" id="Editbox1" style="position:absolute;left:46px;top:11px;width:255px;height:38px;line-height:38px;z-index:2;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox2" style="position:absolute;left:46px;top:62px;width:255px;height:39px;line-height:39px;z-index:3;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image6" style="position:absolute;left:58px;top:18px;width:22px;height:27px;z-index:4;">
<img src="images/name.png" id="Image6" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image7" style="position:absolute;left:57px;top:67px;width:18px;height:28px;z-index:5;">
<img src="images/phone.png" id="Image7" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image8" style="position:absolute;left:56px;top:115px;width:278px;height:58px;z-index:6;">
<img src="images/button2.png" id="Image8" alt="" style="width:278px;height:58px;"></div>
<input type="submit" id="Button1" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:55px;top:115px;width:279px;height:58px;z-index:7;">
<div id="wb_Text10" style="position:absolute;left:71px;top:181px;width:250px;height:34px;text-align:center;z-index:8;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
</form>
</div>
<div id="wb_Image9" style="position:absolute;left:41px;top:899px;width:151px;height:151px;z-index:16;">
<img src="images/5.png" id="Image9" alt="" style="width:151px;height:151px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="2s" data-wow-delay="1s"></div>
<div id="wb_Text11" style="position:absolute;left:69px;top:1054px;width:98px;height:27px;z-index:17;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">лет опыта</span></div>
<div id="wb_Image10" style="position:absolute;left:217px;top:979px;width:151px;height:151px;z-index:18;">
<img src="images/18.png" id="Image10" alt="" style="width:151px;height:151px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="2s" data-wow-delay="1.5s"></div>
<div id="wb_Image11" style="position:absolute;left:403px;top:898px;width:151px;height:151px;z-index:19;">
<img src="images/98.png" id="Image11" alt="" style="width:151px;height:151px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="2s" data-wow-delay="2s"></div>
<div id="wb_Image12" style="position:absolute;left:580px;top:979px;width:151px;height:151px;z-index:20;">
<img src="images/211.png" id="Image12" alt="" style="width:151px;height:151px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="2s" data-wow-delay="2.5s"></div>
<div id="wb_Image13" style="position:absolute;left:762px;top:898px;width:151px;height:151px;z-index:21;">
<img src="images/420.png" id="Image13" alt="" style="width:151px;height:151px;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="2s" data-wow-delay="3s"></div>
<div id="wb_Text13" style="position:absolute;left:423px;top:1060px;width:113px;height:54px;text-align:center;z-index:22;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">довольных клиентов</span></div>
<div id="wb_Text12" style="position:absolute;left:216px;top:1130px;width:156px;height:54px;text-align:center;z-index:23;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">наша средняя конверсия</span></div>
<div id="wb_Text14" style="position:absolute;left:597px;top:1129px;width:125px;height:54px;text-align:center;z-index:24;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">выполненых работ</span></div>
<div id="wb_Text15" style="position:absolute;left:760px;top:1054px;width:160px;height:81px;text-align:center;z-index:25;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">млн.заработали для наших клиентов</span></div>
</div>
</div>
<div id="Layer5" style="position:absolute;text-align:center;left:0px;top:0px;width:99%;height:96px;z-index:309;" title="">
<div id="Layer5_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="Layer6" style="position:absolute;text-align:center;left:0px;top:2386px;width:99%;height:914px;z-index:310;" title="">
<div id="Layer6_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Shape5" style="position:absolute;left:332px;top:158px;width:312px;height:666px;z-index:33;">
<img src="images/img0007.png" id="Shape5" alt="" style="border-width:0;width:312px;height:666px;"></div>
<div id="wb_Shape4" style="position:absolute;left:14px;top:159px;width:312px;height:666px;z-index:34;">
<img src="images/img0008.png" id="Shape4" alt="" style="border-width:0;width:312px;height:666px;"></div>
<div id="wb_Text23" style="position:absolute;left:369px;top:6px;width:229px;height:42px;z-index:35;text-align:left;">
<span style="color:#696969;font-family:'PT Sans';font-size:32px;">НАШИ ПАКЕТЫ</span></div>
<div id="wb_Line2" style="position:absolute;left:589px;top:23px;width:75px;height:0px;z-index:36;">
<img src="images/img0005.png" id="Line2" alt=""></div>
<div id="wb_Line3" style="position:absolute;left:283px;top:25px;width:75px;height:0px;z-index:37;">
<img src="images/img0006.png" id="Line3" alt=""></div>
<div id="wb_Image27" style="position:absolute;left:11px;top:69px;width:299px;height:737px;z-index:38;">
<img src="images/ramka2.png" id="Image27" alt="" style="width:299px;height:737px;"></div>
<div id="wb_Text24" style="position:absolute;left:97px;top:137px;width:115px;height:34px;z-index:39;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:27px;"><strong>Стандарт</strong></span></div>
<div id="wb_Image28" style="position:absolute;left:328px;top:69px;width:299px;height:738px;z-index:40;">
<img src="images/ramka3.png" id="Image28" alt="" style="width:299px;height:738px;"></div>
<div id="wb_Text25" style="position:absolute;left:443px;top:139px;width:69px;height:34px;z-index:41;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:27px;"><strong>Gold</strong></span></div>
<div id="wb_Shape6" style="position:absolute;left:653px;top:160px;width:312px;height:666px;z-index:42;">
<img src="images/img0009.png" id="Shape6" alt="" style="border-width:0;width:312px;height:666px;"></div>
<div id="wb_Image29" style="position:absolute;left:647px;top:69px;width:299px;height:738px;z-index:43;">
<img src="images/ramka4.png" id="Image29" alt="" style="width:299px;height:738px;"></div>
<div id="wb_Text26" style="position:absolute;left:737px;top:137px;width:112px;height:34px;z-index:44;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:27px;"><strong>Premium</strong></span></div>
<div id="wb_Line4" style="position:absolute;left:657px;top:311px;width:273px;height:0px;z-index:45;">
<img src="images/img0010.png" id="Line4" alt=""></div>
<div id="wb_Line5" style="position:absolute;left:340px;top:311px;width:273px;height:0px;z-index:46;">
<img src="images/img0011.png" id="Line5" alt=""></div>
<div id="wb_Line7" style="position:absolute;left:657px;top:361px;width:273px;height:0px;z-index:47;">
<img src="images/img0012.png" id="Line7" alt=""></div>
<div id="wb_Line8" style="position:absolute;left:337px;top:361px;width:273px;height:0px;z-index:48;">
<img src="images/img0013.png" id="Line8" alt=""></div>
<div id="wb_Line9" style="position:absolute;left:20px;top:361px;width:273px;height:0px;z-index:49;">
<img src="images/img0014.png" id="Line9" alt=""></div>
<div id="wb_Line10" style="position:absolute;left:656px;top:410px;width:273px;height:0px;z-index:50;">
<img src="images/img0015.png" id="Line10" alt=""></div>
<div id="wb_Line11" style="position:absolute;left:337px;top:410px;width:273px;height:0px;z-index:51;">
<img src="images/img0016.png" id="Line11" alt=""></div>
<div id="wb_Line12" style="position:absolute;left:19px;top:410px;width:273px;height:0px;z-index:52;">
<img src="images/img0017.png" id="Line12" alt=""></div>
<div id="wb_Line13" style="position:absolute;left:656px;top:460px;width:273px;height:0px;z-index:53;">
<img src="images/img0018.png" id="Line13" alt=""></div>
<div id="wb_Line14" style="position:absolute;left:336px;top:460px;width:273px;height:0px;z-index:54;">
<img src="images/img0019.png" id="Line14" alt=""></div>
<div id="wb_Line15" style="position:absolute;left:17px;top:460px;width:273px;height:0px;z-index:55;">
<img src="images/img0020.png" id="Line15" alt=""></div>
<div id="wb_Line16" style="position:absolute;left:654px;top:509px;width:273px;height:0px;z-index:56;">
<img src="images/img0021.png" id="Line16" alt=""></div>
<div id="wb_Line17" style="position:absolute;left:336px;top:509px;width:273px;height:0px;z-index:57;">
<img src="images/img0022.png" id="Line17" alt=""></div>
<div id="wb_Line18" style="position:absolute;left:654px;top:557px;width:273px;height:0px;z-index:58;">
<img src="images/img0023.png" id="Line18" alt=""></div>
<div id="wb_Line19" style="position:absolute;left:337px;top:557px;width:273px;height:0px;z-index:59;">
<img src="images/img0024.png" id="Line19" alt=""></div>
<div id="wb_Line20" style="position:absolute;left:655px;top:611px;width:273px;height:0px;z-index:60;">
<img src="images/img0025.png" id="Line20" alt=""></div>
<div id="wb_Line21" style="position:absolute;left:657px;top:660px;width:273px;height:0px;z-index:61;">
<img src="images/img0026.png" id="Line21" alt=""></div>
<div id="wb_Text27" style="position:absolute;left:66px;top:290px;width:148px;height:20px;z-index:62;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Разработка дизайна</span></div>
<div id="wb_Text28" style="position:absolute;left:66px;top:345px;width:148px;height:20px;z-index:63;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Верстка</span></div>
<div id="wb_Text29" style="position:absolute;left:66px;top:394px;width:160px;height:20px;z-index:64;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Продающие триггеры</span></div>
<div id="wb_Text30" style="position:absolute;left:66px;top:444px;width:199px;height:20px;z-index:65;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Домен + хостинг (2 месяца)</span></div>
<div id="wb_Text31" style="position:absolute;left:383px;top:297px;width:169px;height:20px;z-index:66;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Разработка прототипа</span></div>
<div id="wb_Text32" style="position:absolute;left:383px;top:345px;width:148px;height:20px;z-index:67;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Уникальный дизайн</span></div>
<div id="wb_Text33" style="position:absolute;left:383px;top:374px;width:148px;height:40px;z-index:68;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Профессиональный<br>копирайтинг</span></div>
<div id="wb_Text34" style="position:absolute;left:383px;top:444px;width:162px;height:20px;z-index:69;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Продающие триггеры</span></div>
<div id="wb_Text35" style="position:absolute;left:383px;top:493px;width:148px;height:20px;z-index:70;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Адаптивная верстка</span></div>
<div id="wb_Text36" style="position:absolute;left:383px;top:541px;width:191px;height:20px;z-index:71;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Домен + хостинг на 1 год</span></div>
<div id="wb_Text37" style="position:absolute;left:707px;top:275px;width:148px;height:40px;z-index:72;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Глубокий анализ конкурентов</span></div>
<div id="wb_Text38" style="position:absolute;left:707px;top:325px;width:208px;height:40px;z-index:73;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Разработка прототипа от<br>ведущих маркетологов</span></div>
<div id="wb_Text39" style="position:absolute;left:707px;top:394px;width:148px;height:20px;z-index:74;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Люкс дизайн</span></div>
<div id="wb_Text40" style="position:absolute;left:707px;top:424px;width:148px;height:40px;z-index:75;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Оптимизация под<br>поисковые системы</span></div>
<div id="wb_Text41" style="position:absolute;left:707px;top:493px;width:148px;height:20px;z-index:76;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Адаптивная верстка</span></div>
<div id="wb_Text42" style="position:absolute;left:707px;top:541px;width:189px;height:20px;z-index:77;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Домен + хостинг на 1 год</span></div>
<div id="wb_Text43" style="position:absolute;left:707px;top:575px;width:184px;height:40px;z-index:78;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Настройка рекламных<br>кампаний в соц. сетях</span></div>
<div id="wb_Text44" style="position:absolute;left:707px;top:625px;width:233px;height:40px;z-index:79;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Профессиональная<br>настройка контекстной рекламы</span></div>
<div id="wb_Line22" style="position:absolute;left:338px;top:611px;width:273px;height:0px;z-index:80;">
<img src="images/img0028.png" id="Line22" alt=""></div>
<div id="wb_Line23" style="position:absolute;left:17px;top:308px;width:273px;height:0px;z-index:81;">
<img src="images/img0029.png" id="Line23" alt=""></div>
<div id="wb_Text45" style="position:absolute;left:383px;top:595px;width:191px;height:20px;z-index:82;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Подключение аналитики</span></div>
<div id="wb_Line24" style="position:absolute;left:655px;top:736px;width:273px;height:0px;z-index:83;">
<img src="images/img0030.png" id="Line24" alt=""></div>
<div id="wb_Text46" style="position:absolute;left:707px;top:675px;width:233px;height:60px;z-index:84;text-align:left;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#696969;font-family:'PT Sans';font-size:16px;">Работа 2 недели над достижением<br>МАКСИМАЛЬНОЙ конверсии</span></div>
<div id="wb_Image30" style="position:absolute;left:26px;top:294px;width:18px;height:16px;z-index:85;">
<img src="images/galka.png" id="Image30" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image31" style="position:absolute;left:26px;top:349px;width:18px;height:16px;z-index:86;">
<img src="images/galka.png" id="Image31" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image32" style="position:absolute;left:26px;top:398px;width:18px;height:16px;z-index:87;">
<img src="images/galka.png" id="Image32" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image33" style="position:absolute;left:26px;top:448px;width:18px;height:16px;z-index:88;">
<img src="images/galka.png" id="Image33" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image34" style="position:absolute;left:345px;top:296px;width:18px;height:16px;z-index:89;">
<img src="images/galka1.png" id="Image34" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image35" style="position:absolute;left:345px;top:349px;width:18px;height:16px;z-index:90;">
<img src="images/galka1.png" id="Image35" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image36" style="position:absolute;left:345px;top:398px;width:18px;height:16px;z-index:91;">
<img src="images/galka1.png" id="Image36" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image37" style="position:absolute;left:345px;top:448px;width:18px;height:16px;z-index:92;">
<img src="images/galka1.png" id="Image37" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image38" style="position:absolute;left:345px;top:497px;width:18px;height:16px;z-index:93;">
<img src="images/galka1.png" id="Image38" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image39" style="position:absolute;left:345px;top:545px;width:18px;height:16px;z-index:94;">
<img src="images/galka1.png" id="Image39" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image40" style="position:absolute;left:345px;top:599px;width:18px;height:16px;z-index:95;">
<img src="images/galka1.png" id="Image40" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image41" style="position:absolute;left:667px;top:298px;width:18px;height:16px;z-index:96;">
<img src="images/galka2.png" id="Image41" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image42" style="position:absolute;left:667px;top:349px;width:18px;height:16px;z-index:97;">
<img src="images/galka2.png" id="Image42" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image43" style="position:absolute;left:667px;top:398px;width:18px;height:16px;z-index:98;">
<img src="images/galka2.png" id="Image43" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image44" style="position:absolute;left:667px;top:448px;width:18px;height:16px;z-index:99;">
<img src="images/galka2.png" id="Image44" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image45" style="position:absolute;left:667px;top:497px;width:18px;height:16px;z-index:100;">
<img src="images/galka2.png" id="Image45" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image46" style="position:absolute;left:667px;top:545px;width:18px;height:16px;z-index:101;">
<img src="images/galka2.png" id="Image46" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image47" style="position:absolute;left:667px;top:599px;width:18px;height:16px;z-index:102;">
<img src="images/galka2.png" id="Image47" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image48" style="position:absolute;left:667px;top:649px;width:18px;height:16px;z-index:103;">
<img src="images/galka2.png" id="Image48" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image49" style="position:absolute;left:667px;top:722px;width:18px;height:16px;z-index:104;">
<img src="images/galka2.png" id="Image49" alt="" style="width:18px;height:16px;"></div>
<div id="wb_Image50" style="position:absolute;left:59px;top:773px;width:196px;height:51px;z-index:105;">
<a href="#" onmouseover="SetImage('Image50','images/button5.png');return false;" onmouseout="SetImage('Image50','images/button4.png');return false;"><img src="images/button4.png" id="Image50" alt="" style="width:196px;height:51px;"></a></div>
<div id="wb_Image51" style="position:absolute;left:383px;top:773px;width:196px;height:51px;z-index:106;">
<a href="#" onmouseover="SetImage('Image51','images/button5.png');return false;" onmouseout="SetImage('Image51','images/button4.png');return false;"><img src="images/button4.png" id="Image51" alt="" style="width:196px;height:51px;"></a></div>
<div id="wb_Image52" style="position:absolute;left:699px;top:773px;width:196px;height:51px;z-index:107;">
<a href="#" onmouseover="SetImage('Image52','images/button5.png');return false;" onmouseout="SetImage('Image52','images/button4.png');return false;"><img src="images/button4.png" id="Image52" alt="" style="width:196px;height:51px;"></a></div>
</div>
</div>
<div id="Layer7" style="position:absolute;text-align:center;left:0px;top:3300px;width:99%;height:500px;z-index:311;" title="" class="parallax" data-speed="0.6" data-type="background">
<div id="Layer7_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="Layer8" style="position:absolute;text-align:center;left:4px;top:3px;width:98%;height:491px;z-index:120;" title="">
<div id="Layer8_Container" style="width:955px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text47" style="position:absolute;left:153px;top:146px;width:225px;height:69px;z-index:115;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:53px;"><strong>АКЦИЯ!!!</strong></span></div>
<div id="wb_Text48" style="position:absolute;left:453px;top:47px;width:326px;height:81px;text-align:center;z-index:116;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">Оставьте заявку<br>и получите БЕСПЛАТНЫЙ аудит<br>для Вашего бизнеса!</span></div>
<div id="wb_Form2" style="position:absolute;left:421px;top:133px;width:389px;height:229px;z-index:117;">
<form name="contact1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form2">
<input type="text" id="Editbox3" style="position:absolute;left:46px;top:11px;width:255px;height:38px;line-height:38px;z-index:108;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox4" style="position:absolute;left:46px;top:62px;width:255px;height:39px;line-height:39px;z-index:109;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image53" style="position:absolute;left:58px;top:18px;width:22px;height:27px;z-index:110;">
<img src="images/name.png" id="Image53" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image54" style="position:absolute;left:57px;top:67px;width:18px;height:28px;z-index:111;">
<img src="images/phone.png" id="Image54" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image55" style="position:absolute;left:56px;top:115px;width:278px;height:58px;z-index:112;">
<img src="images/button2.png" id="Image55" alt="" style="width:278px;height:58px;"></div>
<div id="wb_Text49" style="position:absolute;left:71px;top:181px;width:250px;height:34px;text-align:center;z-index:113;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
<input type="submit" id="Button2" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:55px;top:115px;width:279px;height:58px;z-index:114;">
</form>
</div>
<div id="wb_Image56" style="position:absolute;left:116px;top:183px;width:300px;height:300px;z-index:118;">
<img src="images/strelka119.png" id="Image56" alt="" style="width:300px;height:300px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<iframe name="InlineFrame1" id="InlineFrame1" style="position:absolute;left:452px;top:363px;width:320px;height:108px;z-index:119;" src="./страница1.php" scrolling="no"></iframe>
</div>
</div>
</div>
</div>
<div id="Layer8" style="position:absolute;text-align:center;left:4px;top:3303px;width:98%;height:491px;z-index:312;" title="">
<div id="Layer8_Container" style="width:955px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text47" style="position:absolute;left:153px;top:146px;width:225px;height:69px;z-index:128;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:53px;"><strong>АКЦИЯ!!!</strong></span></div>
<div id="wb_Text48" style="position:absolute;left:453px;top:47px;width:326px;height:81px;text-align:center;z-index:129;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">Оставьте заявку<br>и получите БЕСПЛАТНЫЙ аудит<br>для Вашего бизнеса!</span></div>
<div id="wb_Form2" style="position:absolute;left:421px;top:133px;width:389px;height:229px;z-index:130;">
<form name="contact1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form2">
<input type="text" id="Editbox3" style="position:absolute;left:46px;top:11px;width:255px;height:38px;line-height:38px;z-index:121;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox4" style="position:absolute;left:46px;top:62px;width:255px;height:39px;line-height:39px;z-index:122;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image53" style="position:absolute;left:58px;top:18px;width:22px;height:27px;z-index:123;">
<img src="images/name.png" id="Image53" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image54" style="position:absolute;left:57px;top:67px;width:18px;height:28px;z-index:124;">
<img src="images/phone.png" id="Image54" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image55" style="position:absolute;left:56px;top:115px;width:278px;height:58px;z-index:125;">
<img src="images/button2.png" id="Image55" alt="" style="width:278px;height:58px;"></div>
<div id="wb_Text49" style="position:absolute;left:71px;top:181px;width:250px;height:34px;text-align:center;z-index:126;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
<input type="submit" id="Button2" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:55px;top:115px;width:279px;height:58px;z-index:127;">
</form>
</div>
<div id="wb_Image56" style="position:absolute;left:116px;top:183px;width:300px;height:300px;z-index:131;">
<img src="images/strelka119.png" id="Image56" alt="" style="width:300px;height:300px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
<iframe name="InlineFrame1" id="InlineFrame1" style="position:absolute;left:452px;top:363px;width:320px;height:108px;z-index:132;" src="./страница1.php" scrolling="no"></iframe>
</div>
</div>
<div id="Layer9" style="position:absolute;text-align:center;left:0px;top:2376px;width:99%;height:10px;z-index:313;" title="">
<div id="Layer9_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="Layer10" style="position:absolute;text-align:center;left:0px;top:5188px;width:99%;height:17px;z-index:314;" title="">
<div id="Layer10_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="Layer11" style="position:absolute;text-align:center;left:0px;top:3803px;width:99%;height:1387px;z-index:315;" title="">
<div id="Layer11_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text50" style="position:absolute;left:371px;top:20px;width:229px;height:42px;z-index:140;text-align:left;">
<span style="color:#F5F5F5;font-family:'PT Sans';font-size:32px;">НАШИ РАБОТЫ</span></div>
<div id="wb_Line25" style="position:absolute;left:596px;top:38px;width:75px;height:0px;z-index:141;">
<img src="images/img0032.png" id="Line25" alt=""></div>
<div id="wb_Line26" style="position:absolute;left:284px;top:39px;width:75px;height:0px;z-index:142;">
<img src="images/img0033.png" id="Line26" alt=""></div>
<div id="wb_Image57" style="position:absolute;left:45px;top:100px;width:251px;height:287px;z-index:143;">
<img src="images/kartochka.jpg" id="Image57" alt="" style="width:251px;height:287px;"></div>
<div id="wb_Image58" style="position:absolute;left:44px;top:99px;width:251px;height:287px;filter:alpha(opacity=0);-moz-opacity:0.00;opacity:0.00;z-index:144;">
<img src="images/kartochka1.jpg" id="Image58" alt="" style="width:251px;height:287px;"></div>
<div id="wb_Shape8" style="position:absolute;left:44px;top:99px;width:253px;height:288px;z-index:145;">
<a href="javascript:displaylightbox('http://nemiroff-s.ru/',{width:1500,height:850,})" target="_self" onmouseover="Animate('wb_Image58', '', '', '', '', '75', 500, '');return false;" onmouseout="Animate('wb_Image58', '', '', '', '', '0', 1000, '');return false;"><img src="images/img0034.png" id="Shape8" alt="" style="border-width:0;width:253px;height:288px;"></a></div>
</div>
</div>
<div id="Layer12" style="position:absolute;text-align:center;left:0px;top:6313px;width:99%;height:417px;z-index:316;" title="">
<div id="Layer12_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text64" style="position:absolute;left:73px;top:47px;width:822px;height:62px;z-index:146;text-align:left;" class="wow fadeIn" data-wow-offset="100" data-wow-duration="1s">
<span style="color:#00008B;font-family:'PT Sans';font-size:48px;">Landing Page <strong>идеально подходят</strong> для:</span></div>
<div id="wb_Image65" style="position:absolute;left:14px;top:171px;width:144px;height:145px;z-index:147;">
<img src="images/ikon5.png" id="Image65" alt="" style="width:144px;height:145px;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image66" style="position:absolute;left:212px;top:171px;width:144px;height:145px;z-index:148;">
<img src="images/ikon1.png" id="Image66" alt="" style="width:144px;height:145px;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image67" style="position:absolute;left:410px;top:171px;width:144px;height:145px;z-index:149;">
<img src="images/ikon2.png" id="Image67" alt="" style="width:144px;height:145px;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image68" style="position:absolute;left:792px;top:171px;width:144px;height:145px;z-index:150;">
<img src="images/ikon4.png" id="Image68" alt="" style="width:144px;height:145px;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Image69" style="position:absolute;left:602px;top:171px;width:144px;height:145px;z-index:151;">
<img src="images/ikon3.png" id="Image69" alt="" style="width:144px;height:145px;" class="wow bounceIn" data-wow-offset="100" data-wow-duration="1s"></div>
<div id="wb_Text65" style="position:absolute;left:22px;top:332px;width:142px;height:40px;text-align:center;z-index:152;">
<span style="color:#00008B;font-family:'PT Sans';font-size:16px;">Розничной и<br>оптовой торговли</span></div>
<div id="wb_Text66" style="position:absolute;left:236px;top:334px;width:109px;height:20px;text-align:center;z-index:153;">
<span style="color:#00008B;font-family:'PT Sans';font-size:16px;">Сферы услуг</span></div>
<div id="wb_Text67" style="position:absolute;left:413px;top:334px;width:142px;height:20px;text-align:center;z-index:154;">
<span style="color:#00008B;font-family:'PT Sans';font-size:16px;">Производителей</span></div>
<div id="wb_Text68" style="position:absolute;left:609px;top:334px;width:142px;height:40px;text-align:center;z-index:155;">
<span style="color:#00008B;font-family:'PT Sans';font-size:16px;">Уникального или<br>дорогого товара</span></div>
<div id="wb_Text69" style="position:absolute;left:807px;top:334px;width:121px;height:40px;text-align:center;z-index:156;">
<span style="color:#00008B;font-family:'PT Sans';font-size:16px;">Обучающих<br>семинаров</span></div>
</div>
</div>
<div id="Layer13" style="position:absolute;text-align:center;left:0px;top:7824px;width:99%;height:486px;z-index:317;" title="" class="parallax" data-speed="0.8" data-type="background">
<div id="Layer13_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="Layer14" style="position:absolute;text-align:center;left:5px;top:7px;width:98%;height:472px;z-index:169;" title="">
<div id="Layer14_Container" style="width:953px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Form3" style="position:absolute;left:463px;top:107px;width:389px;height:229px;z-index:164;">
<form name="contact2" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form3">
<input type="text" id="Editbox5" style="position:absolute;left:46px;top:11px;width:255px;height:38px;line-height:38px;z-index:157;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox6" style="position:absolute;left:46px;top:62px;width:255px;height:39px;line-height:39px;z-index:158;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image77" style="position:absolute;left:58px;top:18px;width:22px;height:27px;z-index:159;">
<img src="images/name.png" id="Image77" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image78" style="position:absolute;left:57px;top:67px;width:18px;height:28px;z-index:160;">
<img src="images/phone.png" id="Image78" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image79" style="position:absolute;left:56px;top:115px;width:278px;height:58px;z-index:161;">
<img src="images/button2.png" id="Image79" alt="" style="width:278px;height:58px;"></div>
<div id="wb_Text77" style="position:absolute;left:71px;top:181px;width:250px;height:34px;text-align:center;z-index:162;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
<input type="submit" id="Button3" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:55px;top:115px;width:279px;height:58px;z-index:163;">
</form>
</div>
<iframe name="InlineFrame2" id="InlineFrame2" style="position:absolute;left:499px;top:348px;width:326px;height:114px;z-index:165;" src="./страница1.php" scrolling="no"></iframe>
<div id="wb_Text78" style="position:absolute;left:500px;top:15px;width:326px;height:81px;text-align:center;z-index:166;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">Оставьте заявку<br>и получите БЕСПЛАТНЫЙ аудит<br>для Вашего бизнеса!</span></div>
<div id="wb_Text79" style="position:absolute;left:109px;top:59px;width:225px;height:69px;z-index:167;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:53px;"><strong>АКЦИЯ!!!</strong></span></div>
<div id="wb_Image80" style="position:absolute;left:106px;top:127px;width:300px;height:300px;z-index:168;">
<img src="images/strelka119.png" id="Image80" alt="" style="width:300px;height:300px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
</div>
</div>
</div>
</div>
<div id="Layer14" style="position:absolute;text-align:center;left:5px;top:7831px;width:98%;height:472px;z-index:318;" title="">
<div id="Layer14_Container" style="width:953px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Form3" style="position:absolute;left:463px;top:107px;width:389px;height:229px;z-index:177;">
<form name="contact2" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form3">
<input type="text" id="Editbox5" style="position:absolute;left:46px;top:11px;width:255px;height:38px;line-height:38px;z-index:170;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox6" style="position:absolute;left:46px;top:62px;width:255px;height:39px;line-height:39px;z-index:171;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image77" style="position:absolute;left:58px;top:18px;width:22px;height:27px;z-index:172;">
<img src="images/name.png" id="Image77" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image78" style="position:absolute;left:57px;top:67px;width:18px;height:28px;z-index:173;">
<img src="images/phone.png" id="Image78" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image79" style="position:absolute;left:56px;top:115px;width:278px;height:58px;z-index:174;">
<img src="images/button2.png" id="Image79" alt="" style="width:278px;height:58px;"></div>
<div id="wb_Text77" style="position:absolute;left:71px;top:181px;width:250px;height:34px;text-align:center;z-index:175;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
<input type="submit" id="Button3" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:55px;top:115px;width:279px;height:58px;z-index:176;">
</form>
</div>
<iframe name="InlineFrame2" id="InlineFrame2" style="position:absolute;left:499px;top:348px;width:326px;height:114px;z-index:178;" src="./страница1.php" scrolling="no"></iframe>
<div id="wb_Text78" style="position:absolute;left:500px;top:15px;width:326px;height:81px;text-align:center;z-index:179;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:21px;">Оставьте заявку<br>и получите БЕСПЛАТНЫЙ аудит<br>для Вашего бизнеса!</span></div>
<div id="wb_Text79" style="position:absolute;left:109px;top:59px;width:225px;height:69px;z-index:180;text-align:left;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:53px;"><strong>АКЦИЯ!!!</strong></span></div>
<div id="wb_Image80" style="position:absolute;left:106px;top:127px;width:300px;height:300px;z-index:181;">
<img src="images/strelka119.png" id="Image80" alt="" style="width:300px;height:300px;" class="wow wobble" data-wow-offset="100" data-wow-duration="2s"></div>
</div>
</div>
<div id="Layer15" style="position:absolute;text-align:center;left:0px;top:8311px;width:99%;height:388px;z-index:319;" title="" class="parallax" data-speed="0.8" data-type="background">
<div id="Layer15_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text80" style="position:absolute;left:293px;top:25px;width:381px;height:48px;z-index:196;text-align:left;" class="wow fadeIn" data-wow-duration="1s" data-wow-delay="6s">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:37px;"><strong>ОСТАЛИСЬ ВОПРОСЫ?</strong></span></div>
<div id="wb_Image81" style="position:absolute;left:139px;top:48px;width:687px;height:308px;z-index:197;">
<img src="images/ramka.png" id="Image81" alt="" style="width:687px;height:308px;"></div>
<div id="wb_Form4" style="position:absolute;left:290px;top:124px;width:389px;height:229px;z-index:198;">
<form name="contact2" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form4">
<input type="text" id="Editbox7" style="position:absolute;left:46px;top:11px;width:255px;height:38px;line-height:38px;z-index:189;" name="Имя" value="" maxlength="40" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox8" style="position:absolute;left:46px;top:62px;width:255px;height:39px;line-height:39px;z-index:190;" name="Телефон" value="" maxlength="15" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
<div id="wb_Image82" style="position:absolute;left:58px;top:18px;width:22px;height:27px;z-index:191;">
<img src="images/name.png" id="Image82" alt="" style="width:22px;height:27px;"></div>
<div id="wb_Image83" style="position:absolute;left:57px;top:67px;width:18px;height:28px;z-index:192;">
<img src="images/phone.png" id="Image83" alt="" style="width:18px;height:28px;"></div>
<div id="wb_Image84" style="position:absolute;left:56px;top:115px;width:278px;height:58px;z-index:193;">
<img src="images/button2.png" id="Image84" alt="" style="width:278px;height:58px;"></div>
<div id="wb_Text81" style="position:absolute;left:71px;top:181px;width:250px;height:34px;text-align:center;z-index:194;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:13px;">Ваши личные данные в безопасности<br>и не будут переданы третьим лицам</span></div>
<input type="submit" id="Button4" onmouseover="SetImage('Image8','images/button3.png');return false;" onmouseout="SetImage('Image8','images/button2.png');return false;" name="" value="" style="position:absolute;left:55px;top:115px;width:279px;height:58px;z-index:195;">
</form>
</div>
<div id="wb_Text82" style="position:absolute;left:262px;top:98px;width:446px;height:24px;z-index:199;text-align:left;" class="wow fadeIn" data-wow-duration="2s" data-wow-delay="9s">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:19px;">Заполните форму ниже для получения консультации</span></div>
<div id="wb_Image85" style="position:absolute;left:447px;top:71px;width:74px;height:28px;z-index:200;">
<img src="images/strelka.png" id="Image85" alt="" style="width:74px;height:28px;" class="wow bounceInDown" data-wow-duration="2s" data-wow-delay="7s"></div>
</div>
</div>
<div id="Layer16" style="position:absolute;text-align:center;left:0px;top:8700px;width:99%;height:99px;z-index:320;" title="">
<div id="Layer16_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<img src="images/img0060.png" id="MergedObject1" alt="" title="" style="position:absolute;left:11px;top:8px;width:118px;height:79px;border-width:0;z-index:208">
<div id="wb_Text83" style="position:absolute;left:771px;top:11px;width:181px;height:25px;z-index:209;text-align:left;">
<span style="color:#FFFFFF;font-family:'Lyno Stan CYR';font-size:21px;">+7 123 45 67 89</span></div>
<div id="wb_Image86" style="position:absolute;left:743px;top:9px;width:17px;height:27px;z-index:210;">
<img src="images/truba.png" id="Image86" alt="" style="width:17px;height:27px;"></div>
<div id="wb_Image87" style="position:absolute;left:699px;top:43px;width:255px;height:46px;z-index:211;">
<a href="#" onmouseover="SetImage('Image3','images/button1.png');return false;" onmouseout="SetImage('Image3','images/button.png');return false;"><img src="images/button.png" id="Image87" alt="" style="width:255px;height:46px;"></a></div>
<div id="wb_Text84" style="position:absolute;left:319px;top:25px;width:265px;height:40px;text-align:center;z-index:212;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:16px;">Продающие страницы от франчайзи<br>веб - студии <strong>Kraski</strong></span></div>
<div id="wb_Shape7" style="position:absolute;left:282px;top:20px;width:341px;height:56px;z-index:213;">
<img src="images/img0061.png" id="Shape7" alt="" style="border-width:0;width:341px;height:56px;"></div>
</div>
</div>
<div id="Layer4" style="position:absolute;text-align:center;left:0px;top:0px;width:99%;height:95px;z-index:321;position: fixed;" title="">
<div id="Layer4_Container" style="width:967px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Shape3" style="position:absolute;left:267px;top:5px;width:341px;height:56px;z-index:214;">
<img src="images/img0003.png" id="Shape3" alt="" style="border-width:0;width:341px;height:56px;"></div>
<div id="wb_Text1" style="position:absolute;left:304px;top:10px;width:265px;height:40px;text-align:center;z-index:215;">
<span style="color:#FFFFFF;font-family:'PT Sans';font-size:16px;">Продающие страницы от франчайзи<br>веб - студии <strong>Kraski</strong></span></div>
<div id="wb_Text2" style="position:absolute;left:18px;top:35px;width:103px;height:29px;z-index:216;text-align:left;">
<span style="color:#FFFFFF;font-family:Arial;font-size:24px;"><strong>Landing</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:19px;top:59px;width:78px;height:24px;z-index:217;text-align:left;">
<span style="color:#FFFFFF;font-family:'Lucida Console';font-size:24px;">Pages</span></div>
<div id="wb_Text4" style="position:absolute;left:11px;top:4px;width:118px;height:42px;z-index:218;text-align:left;">
<span style="color:#F9D246;font-family:'PT Sans';font-size:32px;"><strong>KRASKI</strong></span></div>
<div id="wb_Line1" style="position:absolute;left:11px;top:10px;width:0px;height:63px;z-index:219;">
<img src="images/img0004.png" id="Line1" alt=""></div>
<div id="wb_Image2" style="position:absolute;left:715px;top:8px;width:17px;height:27px;z-index:220;">
<img src="images/truba.png" id="Image2" alt="" style="width:17px;height:27px;"></div>
<div id="wb_Text5" style="position:absolute;left:774px;top:9px;width:181px;height:25px;z-index:221;text-align:left;">
<span style="color:#FFFFFF;font-family:'Lyno Stan CYR';font-size:21px;">+7 123 45 67 89</span></div>
<div id="wb_Image3" style="position:absolute;left:703px;top:43px;width:255px;height:46px;z-index:222;">
<a href="javascript:displaylightbox('./страница2.php',{width:350,height:250,centerOnScroll:true,overlayOpacity:0.8,overlayColor:'#000',scrolling:'no'})" target="_self" onmouseover="SetImage('Image3','images/button1.png');return false;" onmouseout="SetImage('Image3','images/button.png');return false;"><img src="images/button.png" id="Image3" alt="" style="width:255px;height:46px;"></a></div>
<div id="wb_Shape12" style="position:absolute;left:133px;top:64px;width:135px;height:24px;filter:alpha(opacity=50);-moz-opacity:0.50;opacity:0.50;z-index:223;">
<a href="#link1"><img src="images/img0031.png" id="Shape12" alt="" style="border-width:0;width:135px;height:24px;"></a></div>
<div id="wb_Shape13" style="position:absolute;left:271px;top:64px;width:135px;height:24px;filter:alpha(opacity=50);-moz-opacity:0.50;opacity:0.50;z-index:224;">
<a href="#link2"><img src="images/img0062.png" id="Shape13" alt="" style="border-width:0;width:135px;height:24px;"></a></div>
<div id="wb_Shape14" style="position:absolute;left:410px;top:64px;width:135px;height:24px;filter:alpha(opacity=50);-moz-opacity:0.50;opacity:0.50;z-index:225;">
<a href="#link3"><img src="images/img0063.png" id="Shape14" alt="" style="border-width:0;width:135px;height:24px;"></a></div>
<div id="wb_Shape15" style="position:absolute;left:549px;top:64px;width:135px;height:24px;filter:alpha(opacity=50);-moz-opacity:0.50;opacity:0.50;z-index:226;">
<a href="#link4"><img src="images/img0064.png" id="Shape15" alt="" style="border-width:0;width:135px;height:24px;"></a></div>
</div>
</div>
</body>
</html>