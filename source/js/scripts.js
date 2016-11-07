( function( $ ) {

	// Masonry init options.
	var $grid = $( '.masonry-grid' );
	var $posts = $( '#posts' );
	var masonryOptions = {
		columnWidth: '.masonry-grid__sizer',
		itemSelector: '.masonry-grid__item',
		gutter: '.masonry-grid__gutter-sizer',
		percentPosition: true,
		initLayout: false,
	};

	// Debouncer, The function will be called after it stops being called for given interval.
	var debounce = function( func, wait ) {
		var timeout;
		var later = function() {
			timeout = undefined;
			func.call();
		};

		return function() {
			if ( timeout ) {
				clearTimeout( timeout );
			}
			timeout = setTimeout( later, wait );
		};
	};

	// Set initial image size based on its attributes.
	function imgInitSize( $self ) {
		var width = $self.width();
		var orgWidth = $self.attr( 'width' );
		var orgHeight = $self.attr( 'height' );

		$self.css( {
			'width': width + 'px',
			'height': width / orgWidth * orgHeight + 'px',
		} );
	}

	// Remove image size.
	function imgRemoveInitSize( $self ) {
		$self.css( {
			'width': '',
			'height': '',
		} );
	}

	// Trigger initSize on images.
	function gridImages( $grid ) {
		var $gridImages = $( 'img', $grid );
		$gridImages
			.on( 'initSize', function() {
				imgInitSize( $( this ) );
			} )
			.on( 'removeInitSize', function() {
				imgRemoveInitSize( $( this ) );
			} );

		$gridImages.trigger( 'initSize' );
		return $gridImages;
	}

	// Masonry init.
	var $gridImages = gridImages( $grid );
	$grid.masonry( masonryOptions );

	// Masonry: Add class layout complete (visibility:visible;).
	$grid.masonry( 'on', 'layoutComplete', function() {
		$grid.addClass( 'layout-complete' );
	} );

	// Masonry: When images are loaded remove init size.
	$gridImages.imagesLoaded().then( function() {
		$gridImages.trigger( 'removeInitSize' );
		$grid.masonry();
		$( '.infinite-loader' ).hide();
	} );

	$( '#infinite-handle' ).on( 'click', function() {
		$( this ).hide();
		$( '.infinite-loader' ).show();
	});

	// Post load.
	$( document.body ).on( 'post-load', function () {
		var $newposts = $( '.masonry-grid__item', $posts );
		var $newpostsImages = gridImages( $newposts );

		$newpostsImages.imagesLoaded().then( function() {
			$newpostsImages.trigger( 'removeInitSize' );
			$grid.masonry( 'appended', $newposts );
			$newposts.css( 'visibility', 'visible' );
		} );

		$grid.append( $newposts.css( 'visibility', 'hidden' ) );
		$( '.infinite-loader' ).hide();
		$( '#infinite-handle' ).show();
	} );

	// Footer recents post grid match height.
	function matchHeight() {
		var footerRecentPosts = $( 'footer .rpwe-li' );
		footerRecentPosts.height( 'auto' );
		var maxHeight = 0;

		for( var i = 0; i < footerRecentPosts.length; i++ ) {
			var postHeight = footerRecentPosts.eq( i ).height();
			if( postHeight > maxHeight ) {
				maxHeight = postHeight;
			}
		}

		footerRecentPosts.height( maxHeight );
	}

	// Match height when images are loaded and on resize.
	var recentPostsImages = $( 'footer .rpwe-li' );
	recentPostsImages.imagesLoaded( matchHeight );
	$( window ).on( 'resize', debounce( matchHeight, 200 ) );

	// Open/close custom modal .
	// Close modal if clicked outside of it.
	$( document ).on( 'click', function( event ) {
		if ( $( event.target ).closest( '.modal' ).length ) {
			return;
		}

		$( '.modal.modal--active' ).trigger( 'karta.modal.close' );
	} );

	// Open modal, close modals already opened.
	$( document ).on( 'karta.modal.open', '.modal', function( event ) {
		if ( $( this ).hasClass( 'modal--active' ) ) {
			return;
		}

		$( '.modal.modal--active' ).trigger( 'karta.modal.close' );
		$( this ).addClass( 'modal--active' ).slideDown();
	} );

	// Close modal.
	$( document ).on( 'karta.modal.close', '.modal', function( event ) {
		$( this ).removeClass( 'modal--active' ).slideUp();
	} );

	// Close modal on X.
	$( document ).on( 'click', '.modal__close', function( event ) {
		event.preventDefault();
		event.stopPropagation();

		$( this ).closest( '.modal' ).trigger( 'karta.modal.close' );
	} );

	// Open modal when clicked on its trigger.
	$( document ).on( 'click', '[href^="#modal-"]', function( event ) {
		var $modal_id = $( '[data-modal-id="' + $( this ).attr( 'href' ).replace( '#modal-', '' ) + '"]' );
		if ( $modal_id.length ) {
			event.preventDefault();
			event.stopPropagation();

			var $modal = $modal_id.closest( '.modal' );

			$modal.trigger( 'karta.modal.open' );
			return false;
		}
	} );

	// Open sub-menu modal.
	$( document ).on( 'click', '.main-navigation__menu > .menu-item-has-children > a', function( event ) {
		event.preventDefault();
		event.stopPropagation();

		var $li = $( this ).closest( 'li' );
		var $modal = $( '> .modal', $li );
		$modal.trigger( 'karta.modal.open' );
	} );

	// Remove input labels from comment-respond section if value of input/textarea not equal to empty string.
	var fieldsCommentRespond = $( '.comment-respond input, .comment-respond textarea' );
	$( document ).on( 'ready', function() {
		for( var i = 0; l = fieldsCommentRespond.length, i < l; i++ ) {
			if( fieldsCommentRespond.eq( i ).val() !== "" ) {
				fieldsCommentRespond.eq( i ).prev( 'label' ).hide();
			}
		}
	} );

	// Remove input labels from comment-respond section on focus blur.
	fieldsCommentRespond.on( 'focus blur', function () {
		var self = $( this );
		if( self.val() !== '' ) {
			self.prev().hide();
		} else {
			self.prev().toggle();
		}
	});

} ( jQuery ) );