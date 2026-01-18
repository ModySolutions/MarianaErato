'use strict';
(function($){

    const body = $('body');

    body.on('click', '.current-language', function(e){
        e.preventDefault();
        return false;
    });

    if(body.attr('class').includes('pleasure-project')){
        const elementInViewport = (element) => {
            const bounding = element.getBoundingClientRect();
            return bounding.top >= 0 &&
                   bounding.left >= 0;
        }

        const getScrollDirection = (event) => {
            const originalEvent = event.originalEvent;
            return originalEvent.deltaY > 0;
        }

        const determineCurrentScroll = elements => {
            let currentScroll = 0, elementScroll = 0, scrollSelected = false;
            elements.each((i, e) => {
                if(elementInViewport(e)) {
                    if(currentScroll === 0 && !scrollSelected) {
                        scrollSelected = true;
                        currentScroll = i;
                        elementScroll = $(e)[0].scrollHeight * currentScroll;
                    }
                }
            });
            return {
                currentScroll: currentScroll,
                elementScroll: elementScroll
            }
        }

        const elements = $('.pp-section')
        let scrolling = false;
        let { currentScroll, elementScroll } = determineCurrentScroll(elements);

        let xDown, yDown;

        const getTouches = (evt) => {
            return evt.touches ||
                   evt.originalEvent.touches;
        }

        const handleTouchStart = (evt) => {
            const firstTouch = getTouches(evt)[0];
            xDown = firstTouch.clientX;
            yDown = firstTouch.clientY;
        };

        const handleTouchMove = (evt) => {
            if ( ! xDown || ! yDown ) {
                return;
            }

            const xUp = evt.touches[0].clientX;
            const yUp = evt.touches[0].clientY;

            const xDiff = xDown - xUp;
            const yDiff = yDown - yUp;

            if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
                if ( xDiff > 0 ) {
                    // alert('Swipe right');
                } else {
                    // alert('Swipe left');
                }
            } else {
                if ( yDiff > 0 ) {
                    scrollDown();
                } else {
                    // alert('Swipe up');
                }
            }
            /* reset values */
            xDown = null;
            yDown = null;
        };

        const scrollDown = () => {
            currentScroll ++;
            const element = $(elements[currentScroll]);
            elementScroll += element[0].scrollHeight;
            $('body, html').animate({
                scrollTop: elementScroll
            }, 2000, function(){
                scrolling = false;
            });
        }

        document.addEventListener('touchstart', handleTouchStart, false);
        document.addEventListener('touchmove', handleTouchMove, false);
        $(window).on('wheel', function(e){
            if(scrolling) {
                return;
            }
            scrolling = true;
            const elements = $('.pp-section');
            const scrollDirection = getScrollDirection(e);
            if(scrollDirection) {
                scrollDown();
            }
        });
    }
})(jQuery);
