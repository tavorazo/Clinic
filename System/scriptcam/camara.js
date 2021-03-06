$(document).ready(function() {
				$("#container").scriptcam({
					showMicrophoneErrors:false,
					onError:onError,
					cornerRadius:20,
					disableHardwareAcceleration:1,
					cornerColor:'e3e5e2',
					onWebcamReady:onWebcamReady,
					uploadImage:'scriptcam/upload.gif',
					onPictureAsBase64:base64_tofield_and_image
				});
			});
			function base64_tofield_and_image() {
				$('#formfield').val($.scriptcam.getFrameAsBase64());  // Se puede hacer POST de este valor en codigo Base64 y en php decodificar
				$('#foto').attr("src","data:image/png;base64,"+$.scriptcam.getFrameAsBase64());
			};
			function changeCamera() {
				$.scriptcam.changeCamera($('#cameraNames').val());
			}
			function onError(errorId,errorMsg) {
				$( "#btn1" ).attr( "disabled", true );
				$( "#btn2" ).attr( "disabled", true );
				alert(errorMsg);
			}			
			function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
				$.each(cameraNames, function(index, text) {
					$('#cameraNames').append( $('<option></option>').val(index).html(text) )
				}); 
				$('#cameraNames').val(camera);
			}