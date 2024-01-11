
<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "photo");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image'];
  	
  	

  	// image file directory
			

	
	$target_file= $target_dir . basename($_FILES["file_to_upload"]["name"]);
  	//$target = "img/".basename($image);

  	$sql = "INSERT INTO images (image) VALUES ('$image')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Test.css">
    <link rel="stylesheet" href="Upload.css">

    <title>My Images</title>
</head>
<body>


         
    <div class="container">
        <div class="header">

       
        <nav class="menu">

        <div class="logo">
            <h2>PHOTOGRAPH</h2>
        </div>

        <ul>
            <li><a href="Test.html" class="active" onclick="markMenuItem(this)">Home</a></li>
            <li><a href="Myimaga.html"onclick="markMenuItem(this)">My Images</a></li>
            <li><a href="Library.html"onclick="markMenuItem(this)">Library</a></li>
			<li><a href="Login.html"onclick="markMenuItem(this)">Sign in</a></li>
        </ul>
  
        </nav>
      </div>

      
      <div id="container">
        <form method="post" action="Upload.php" enctype="multipart/form-data" novalidate="" class="box has-advanced-upload">
          <div class="box-input">
            <svg x="0px" y="0px" viewBox="0 0 64 62" style="enable-background:new 0 0 64 62;" xml:space="preserve">
    
      <g id="spa-launch">
          <path class="st0" d="M33,27.1h-8c0,0-2-6-2-12c0-8,6-14,6-14s6,6,6,14C35,21.1,33,27.1,33,27.1z"/>
          <line class="st0" x1="29" y1="17.1" x2="29" y2="27.1"/>
          <polyline class="st0" points="25,27.1 17,27.1 17,23.1 23.1,17.1 	"/>
          <polyline class="st0" points="33,27.1 41,27.1 41,23.1 34.9,17.1 	"/>
          <path class="st0" d="M18,41.2c0.5-5.7,5.2-10.1,11-10.1c5.1,0,9.3,3.4,10.6,8.1"/>
          <path class="st0" d="M48,41.1c-0.2-3.4-3.1-6-6.5-6c-1.2,0-2.4,0.3-3.3,0.9"/>
          <path class="st0" d="M42.3,47.1c0,0-1-4-6-4"/>
          <path class="st0" d="M26.3,43.1c-3-1-4,2-4,2s-3-2-5,0s-1,4-1,4"/>
          <path class="st0" d="M9,46.1c-0.8-0.6-1.9-1-3-1c-2.8,0-5,2.2-5,5s2.2,5,5,5h46c2.8,0,5-2.2,5-5c0-5-4-9-9-9
              c-0.9,0-1.8,0.1-2.6,0.4"/>
          <path class="st0" d="M18.8,37.9c-1.1-0.5-2.4-0.8-3.8-0.8c-4.6,0-8.5,3.5-8.9,8"/>
      </g>
      </svg>
            <input type="file" name="image" id="file" class="box-file" data-multiple-caption="{count} files selected" multiple="">
            <label for="file"><strong>Choose a Image </strong><span class="box-dragndrop"> or drag it here</span>.</label>
            <button type="submit" name="upload"class="button">Upload</button>
          </div>
      
          <div class="box-uploading">Uploading…</div>
          <div class="box-success">Done! <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" class="box-restart" role="button" data-unsp-sanitized="clean">Upload more?</a></div>
          <div class="box-error">Error! <span></span>. <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" class="box-restart" role="button" data-unsp-sanitized="clean">Try again!</a></div>
          <input type="hidden" name="ajax" value="1"></form>
      
      </div>



      <script>
    
	'use strict';

	;( function( $, window, document, undefined )
	{
		// feature detection for drag&drop upload

		var isAdvancedUpload = function()
			{
				var div = document.createElement( 'div' );
				return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
			}();


		// applying the effect for every form

		$( '.box' ).each( function()
		{
			var $form		 = $( this ),
				$input		 = $form.find( 'input[type="file"]' ),
				$label		 = $form.find( 'label' ),
				$errorMsg	 = $form.find( '.box-error span' ),
				$restart	 = $form.find( '.box-restart' ),
				droppedFiles = false,
				showFiles	 = function( files )
				{
					$label.text( files.length > 1 ? ( $input.attr( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name );
				};

			// letting the server side to know we are going to make an Ajax request
			$form.append( '<input type="hidden" name="ajax" value="1" />' );

			// automatically submit the form on file select
			$input.on( 'change', function( e )
			{
				showFiles( e.target.files );

				
			});


			// drag&drop files if the feature is available
			if( isAdvancedUpload )
			{
				$form
				.addClass( 'has-advanced-upload' ) // letting the CSS part to know drag&drop is supported by the browser
				.on( 'drag dragstart dragend dragover dragenter dragleave drop', function( e )
				{
					// preventing the unwanted behaviours
					e.preventDefault();
					e.stopPropagation();
				})
				.on( 'dragover dragenter', function() //
				{
					$form.addClass( 'is-dragover' );
				})
				.on( 'dragleave dragend drop', function()
				{
					$form.removeClass( 'is-dragover' );
				})
				.on( 'drop', function( e )
				{
					droppedFiles = e.originalEvent.dataTransfer.files; // the files that were dropped
					showFiles( droppedFiles );

					
				});
			}


			// if the form was submitted

			$form.on( 'submit', function( e )
			{
				// preventing the duplicate submissions if the current one is in progress
				if( $form.hasClass( 'is-uploading' ) ) return false;

				$form.addClass( 'is-uploading' ).removeClass( 'is-error' );

				if( isAdvancedUpload ) // ajax file upload for modern browsers
				{
					e.preventDefault();

					// gathering the form data
					var ajaxData = new FormData( $form.get( 0 ) );
					if( droppedFiles )
					{
						$.each( droppedFiles, function( i, file )
						{
							ajaxData.append( $input.attr( 'name' ), file );
						});
					}

					// ajax request
					$.ajax(
					{
						url: 			$form.attr( 'action' ),
						type:			$form.attr( 'method' ),
						data: 			ajaxData,
						dataType:		'json',
						cache:			false,
						contentType:	false,
						processData:	false,
						complete: function()
						{
							$form.removeClass( 'is-uploading' );
						},
						success: function( data )
						{
							$form.addClass( data.success == true ? 'is-success' : 'is-error' );
							if( !data.success ) $errorMsg.text( data.error );
						},
						error: function()
						{
							alert( 'Error. Please, contact the webmaster!' );
						}
					});
				}
				else // fallback Ajax solution upload for older browsers
				{
					var iframeName	= 'uploadiframe' + new Date().getTime(),
						$iframe		= $( '<iframe name="' + iframeName + '" style="display: none;"></iframe>' );

					$( 'body' ).append( $iframe );
					$form.attr( 'target', iframeName );

					$iframe.one( 'load', function()
					{
						var data = $.parseJSON( $iframe.contents().find( 'body' ).text() );
						$form.removeClass( 'is-uploading' ).addClass( data.success == true ? 'is-success' : 'is-error' ).removeAttr( 'target' );
						if( !data.success ) $errorMsg.text( data.error );
						$iframe.remove();
					});
				}
			});


			// restart the form if has a state of error/success

			$restart.on( 'click', function( e )
			{
				e.preventDefault();
				$form.removeClass( 'is-error is-success' );
				$input.trigger( 'click' );
			});

			// Firefox focus bug fix for file input
			$input
			.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
			.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
		});

	})( jQuery, window, document );



	'use strict';

	;( function ( document, window, index )
	{
		// feature detection for drag&drop upload
		var isAdvancedUpload = function()
			{
				var div = document.createElement( 'div' );
				return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
			}();


		// applying the effect for every form
		var forms = document.querySelectorAll( '.box' );
		Array.prototype.forEach.call( forms, function( form )
		{
			var input		 = form.querySelector( 'input[type="file"]' ),
				label		 = form.querySelector( 'label' ),
				errorMsg	 = form.querySelector( '.box-error span' ),
				restart		 = form.querySelectorAll( '.box-restart' ),
				droppedFiles = false,
				showFiles	 = function( files )
				{
					label.textContent = files.length > 1 ? ( input.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name;
				},
				triggerFormSubmit = function()
				{
					var event = document.createEvent( 'HTMLEvents' );
					event.initEvent( 'submit', true, false );
					form.dispatchEvent( event );
				};

			// letting the server side to know we are going to make an Ajax request
			var ajaxFlag = document.createElement( 'input' );
			ajaxFlag.setAttribute( 'type', 'hidden' );
			ajaxFlag.setAttribute( 'name', 'ajax' );
			ajaxFlag.setAttribute( 'value', 1 );
			form.appendChild( ajaxFlag );

			// automatically submit the form on file select
			input.addEventListener( 'change', function( e )
			{
				showFiles( e.target.files );

				
			});

			// drag&drop files if the feature is available
			if( isAdvancedUpload )
			{
				form.classList.add( 'has-advanced-upload' ); // letting the CSS part to know drag&drop is supported by the browser

				[ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( function( event )
				{
					form.addEventListener( event, function( e )
					{
						// preventing the unwanted behaviours
						e.preventDefault();
						e.stopPropagation();
					});
				});
				[ 'dragover', 'dragenter' ].forEach( function( event )
				{
					form.addEventListener( event, function()
					{
						form.classList.add( 'is-dragover' );
					});
				});
				[ 'dragleave', 'dragend', 'drop' ].forEach( function( event )
				{
					form.addEventListener( event, function()
					{
						form.classList.remove( 'is-dragover' );
					});
				});
				form.addEventListener( 'drop', function( e )
				{
					droppedFiles = e.dataTransfer.files; // the files that were dropped
					showFiles( droppedFiles );

									});
			}


			// if the form was submitted
			form.addEventListener( 'submit', function( e )
			{
				// preventing the duplicate submissions if the current one is in progress
				if( form.classList.contains( 'is-uploading' ) ) return false;

				form.classList.add( 'is-uploading' );
				form.classList.remove( 'is-error' );

				if( isAdvancedUpload ) // ajax file upload for modern browsers
				{
					e.preventDefault();

					// gathering the form data
					var ajaxData = new FormData( form );
					if( droppedFiles )
					{
						Array.prototype.forEach.call( droppedFiles, function( file )
						{
							ajaxData.append( input.getAttribute( 'name' ), file );
						});
					}

					// ajax request
					var ajax = new XMLHttpRequest();
					ajax.open( form.getAttribute( 'method' ), form.getAttribute( 'action' ), true );

					ajax.onload = function()
					{
						form.classList.remove( 'is-uploading' );
						if( ajax.status >= 200 && ajax.status < 400 )
						{
							var data = JSON.parse( ajax.responseText );
							form.classList.add( data.success == true ? 'is-success' : 'is-error' );
							if( !data.success ) errorMsg.textContent = data.error;
						}
						else alert( 'Error. Please, contact the webmaster!' );
					};

					ajax.onerror = function()
					{
						form.classList.remove( 'is-uploading' );
						alert( 'Error. Please, try again!' );
					};

					ajax.send( ajaxData );
				}
				else // fallback Ajax solution upload for older browsers
				{
					var iframeName	= 'uploadiframe' + new Date().getTime(),
						iframe		= document.createElement( 'iframe' );

						$iframe		= $( '<iframe name="' + iframeName + '" style="display: none;"></iframe>' );

					iframe.setAttribute( 'name', iframeName );
					iframe.style.display = 'none';

					document.body.appendChild( iframe );
					form.setAttribute( 'target', iframeName );

					iframe.addEventListener( 'load', function()
					{
						var data = JSON.parse( iframe.contentDocument.body.innerHTML );
						form.classList.remove( 'is-uploading' )
						form.classList.add( data.success == true ? 'is-success' : 'is-error' )
						form.removeAttribute( 'target' );
						if( !data.success ) errorMsg.textContent = data.error;
						iframe.parentNode.removeChild( iframe );
					});
				}
			});


			// restart the form if has a state of error/success
			Array.prototype.forEach.call( restart, function( entry )
			{
				entry.addEventListener( 'click', function( e )
				{
					e.preventDefault();
					form.classList.remove( 'is-error', 'is-success' );
					input.click();
				});
			});

			// Firefox focus bug fix for file input
			input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
			input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });

		});
	}( document, window, 0 ));
      </script>



                    

      
</body>
</html>