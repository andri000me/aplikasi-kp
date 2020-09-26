<?php 
class Bbcode{
function parse($text){
	//BBcode array
	$bbcode	= array(
				'~\[b\](.*?)\[/b\]~s',
				'~\[br\]~s',
				'~\[i\](.*?)\[/i\]~s',
				'~\[u\](.*?)\[/u\]~s',
				'~\[quote\](.*?)\[/quote\]~s',
				'~\[size=(.*?)\](.*?)\[/size\]~s',
				'~\[color=(.*?)\](.*?)\[/color\]~s',
				'~\[url=(.*?)\]((?:ftp|htpp|https?)://.*?)\[/url\]~s', //cek ulang https|http
				'~\[img\](http?://.*?\.(?:jpg|jpeg|png))\[/img\]~s' //cek ulang https|http
	);

	//BB to HTML
	$replace	= array(
				'<b>$1</b>',
				'<br>',
				'<i>$1</i>',
				'<span style="text-decoration:underline;">$1</span>',
				'<pre>$1</'.'pre>',
				'<span style="font-size:$1px;">$2</span>',
				'<span style="color:$1;">$2</span>',
				'<a href="$1">$1</a>',
				//IMAGE PREVIEW
				'
				 <style type="text/css">
				 	#imgPreview {
					  border-radius: 5px;
					  cursor: pointer;
					  transition: 0.3s;
					}

					#imgPreview:hover {opacity: 0.7;}

					/* The Modal (background) */
					.modalImg {
					  display: none; /* Hidden by default */
					  position: fixed; /* Stay in place */
					  z-index: 300; /* Sit on top */
					  padding-top: 100px; /* Location of the box */
					  margin-top: 25px;
					  left: 0;
					  top: 0;
					  width: 100%; /* Full width */
					  height: 100%; /* Full height */
					  overflow: auto; /* Enable scroll if needed */
					  background-color: rgb(0,0,0); /* Fallback color */
					  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
					}

					/* Modal Content (image) */
					.ImgContent {
					  margin: auto;
					  display: block;
					  width: 80%;
					  max-width: 700px;
					  -webkit-animation-name: zoom;
					  -webkit-animation-duration: 0.6s;
					  animation-name: zoom;
					  animation-duration: 0.6s;
					}

					@-webkit-keyframes zoom {
					  from {-webkit-transform:scale(0)} 
					  to {-webkit-transform:scale(1)}
					}

					@keyframes zoom {
					  from {transform:scale(0)} 
					  to {transform:scale(1)}
					}

					/* 100% Image Width on Smaller Screens */
					@media only screen and (max-width: 700px){
					  .ImgContent {
					    width: 70%;
					  }
					}
				 </style>
				<br><img src="$1" id="imgPreview" style="max-width: 330px; max-height: 400px;" /><br><br>',
	);

	return preg_replace($bbcode, $replace, $text);
}

}