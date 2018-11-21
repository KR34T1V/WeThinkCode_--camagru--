<?PHP
/*********************HEADER********************/
include_once "header.php";
include_once "back.connect.php";
if (empty($_SESSION['user_id'])){
	header("Location: index.php?login=required");
	exit();
}
else {
/*********************END********************/


/*********************BODY********************/
echo '<DIV class=camera>
<VIDEO autoplay="true" id="videoElement" width="400" height="300"></VIDEO>
<A href="#" id="capture" >Capture</A>
<IMG id="photoElement" src="dep/Preview.png" alt="Photo of You" width="400" height="300">
<CANVAS id="capturedElement" width="400" height="300"> </CANVAS>
</DIV>
<DIV class="camera-stickers">
	<IMG href="#" id="stick1" src="dep/stick1.png" alt="Sticker 1" width="150" height="150">
	<IMG href="#" id="stick2" src="dep/stick2.png" alt="Sticker 2" width="150" height="150">
	<IMG href="#" id="stick3" src="dep/stick3.png" alt="Sticker 3" width="150" height="150">
	<DIV class=save_upload>
		<INPUT class="upload" type="file" id="img">
		<BUTTON id="btn">Save & Upload</BUTTON>
	</DIV>
</DIV>';
}
/*********************END********************/

/*********************JAVA SCRIPT********************/
?>
<SCRIPT>
var video	=	document.getElementById('videoElement'),
	canvas	=	document.getElementById('capturedElement'),
	photo	=	document.getElementById('photoElement'),
	context	=	canvas.getContext('2d'),
	stick1	=	document.getElementById('stick1'),
	stick2	=	document.getElementById('stick2'),
	stick3	=	document.getElementById('stick3');
	save	=	document.getElementById('btn');
	ac1		=	0,
	ac2		=	0,
	ac3		=	0;
	Data	=	canvas.toDataURL("image/png"),
    xhr		=	new XMLHttpRequest();

//UPLOAD IMAGE
document.getElementById('img').onchange = function() {
  var img = new Image();
  img.onload = draw;
  img.onerror = failed;
  img.src = URL.createObjectURL(this.files[0]);
};
function draw() {
	context.drawImage(this, 0,0,400,300);
	photoElement.setAttribute('src',canvas.toDataURL('image/png'));
	ac1 = 0;
	ac2 = 0;
	ac3 = 0;
}
function failed() {
  console.error("The provided file couldn't be loaded as an Image media");
}
//REQUEST PERMISSION TO USE CAMERA
if (navigator.mediaDevices.getUserMedia) {    
	 //SHOW VIDEO FEED   
	 navigator.mediaDevices.getUserMedia({video: true})
   .then(function(stream) {
	 video.srcObject = stream;
   })
   .catch(function(error) {
	 console.log("Something went wrong!");
   });
 }
 //TAKE THE PHOTO
 document.getElementById('capture').addEventListener('click',function(){
	context.drawImage(video, 0, 0, 400, 300);
	photoElement.setAttribute('src',canvas.toDataURL('image/png'));
	ac1 = 0;
	ac2 = 0;
	ac3 = 0;
});
//CHECK STICKERS CLICKED
stick1.addEventListener('click',function(){
	if (ac1 == 0){
		ac1 = 1;
		context.drawImage(stick1, 0, 0, 400, 300);
	}
	else{
		ac1 = 0;
		ac2 = 0;
		ac3 = 0;
		context.drawImage(photoElement, 0, 0, 400, 300)
	};
});
stick2.addEventListener('click',function(){
	if (ac2 == 0){
		ac2 = 1;
		context.drawImage(stick2, 0, 0, 400, 300);
	}
	else{
		ac1 = 0;
		ac2 = 0;
		ac3 = 0;
		context.drawImage(photoElement, 0, 0, 400, 300)
	};
});
stick3.addEventListener('click',function(){
	if (ac3 == 0){
		ac3 = 1;
		context.drawImage(stick3, 0, 0, 400, 300);
	}
	else{
		ac1 = 0;
		ac2 = 0;
		ac3 = 0;
		context.drawImage(photoElement, 0, 0, 400, 300)
	};
});
//SAVE BUTTON
save.addEventListener('click',function(){
	xhr.open('POST','back/upload.php');
	xhr.send(canvas);
})
</SCRIPT>
<?PHP
/*********************END********************/

/*********************FOOTER********************/
include_once "footer.php";
/*********************END********************/