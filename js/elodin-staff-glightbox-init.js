var lightbox = GLightbox({
	selector: '.staff-lightbox',
	height: 'auto',
	width: '960px',
	draggable: false,
	// touchNavigation: false,
});

// // when the slide is loaded...
// lightbox.on('slide_after_load', (data) => {
// 	// data is an object that contain the following
// 	const { slideIndex, slideNode, slideConfig, player, trigger } = data;

// 	actualIndex = slideIndex + 1;

// 	let href = lightbox.elements[actualIndex].href;

// 	// update the URL to match the href
// 	history.pushState({}, '', href);

// 	// slideIndex - the slide index
// 	// slideNode - the node you can modify
// 	// slideConfig - will contain the configuration of the slide like title, description, etc.
// 	// player - the slide player if it exists otherwise will return false
// 	// trigger - this will contain the element that triggers this slide, this can be a link, a button, etc in your HTML, it can be null if the elements in the gallery were set dynamically
// });

// do something after the page is fully loaded
document.addEventListener('DOMContentLoaded', function () {
	// console.log(lightbox.elements);

	let slides = lightbox.elements;
	let count = 0;

	// loop through each slide and check whether the current page URL matches any of the slide.href value
	slides.forEach((slide, index) => {
		console.log('slide href: ' + slide.href);
		console.log('window href: ' + window.location.href);
		console.log(count);

		if (slide.href === window.location.href) {
			// open the lightbox at the index of the slide
			// console.log('automated open at: ' + count);
			lightbox.openAt(count);

			// bail out of the loop
			return;
		}

		// add 1 to the count
		count++;
	});
});
