const slider = document.querySelector('.container-scroll');
let mouseDown = false;
let startX, scrollLeft;

let startDragging = function (e) {
  mouseDown = true;
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
  $('.container-scroll').addClass('grabbing')
};
let stopDragging = function (event) {
  mouseDown = false;
  $('.container-scroll').removeClass('grabbing')

};

if(slider){
    slider.addEventListener('mousemove', (e) => {
        e.preventDefault();
        if(!mouseDown) { return; }
        const x = e.pageX - slider.offsetLeft;
        const scroll = x - startX;
        slider.scrollLeft = scrollLeft - scroll;
    });

      // Add the event listeners
      slider.addEventListener('mousedown', startDragging, false);
      slider.addEventListener('mouseup', stopDragging, false);
      slider.addEventListener('mouseleave', stopDragging, false);
}

$("img.lazy").lazyload({
    effect : "fadeIn"
});
