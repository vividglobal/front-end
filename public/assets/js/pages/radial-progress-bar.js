// document.addEventListener("DOMContentLoaded", function() {
    const circleProgress = (function(selector) {
      const wrapper = document.querySelectorAll(selector);

      Array.prototype.forEach.call(wrapper, function(wrapper, i) {
        let wrapperWidth,
          wrapperHeight,
          percent,
          innerHTML,
          context,
          lineWidth,
          centerX,
          centerY,
          radius,
          newPercent,
          speed,
          from,
          to,
          duration,
          start,
          strokeStyle,
          amount,
          text;
        const getValues = function() {
          wrapperWidth = parseInt(window.getComputedStyle(wrapper).width);
          wrapperHeight = wrapperWidth;
          percent = wrapper.getAttribute('data-cp-percentage');
          amount = wrapper.getAttribute('data-cp-amount');
          innerHTML = ` <span class="percentage"><strong>${percent}</strong>%</span>
                        <p class="amount" >${amount}</p>
                        <canvas class="circleProgressCanvas" width=" ${wrapperWidth * 2} " height=" ${wrapperHeight * 2} "></canvas>`;
          wrapper.innerHTML = innerHTML;
          text = wrapper.querySelector(".percentage");
          canvas = wrapper.querySelector(".circleProgressCanvas");
          wrapper.style.height = canvas.style.width = canvas.style.height = wrapperWidth + "px";
          context = canvas.getContext('2d');
          centerX = canvas.width / 2;
          centerY = canvas.height / 2;
          newPercent = 0;
          speed = 1;
          from = 0;
          to = percent;
          duration = 3000;
          lineWidth = 20;
          radius = canvas.width / 2 - lineWidth;
          strokeStyle = wrapper.getAttribute('data-cp-color');
          start = new Date().getTime();
        };

        function animate() {
          requestAnimationFrame(animate);
          let time = new Date().getTime() - start;
          if (time <= duration) {
            var x = easeInOutQuart(time, from, to - from, duration);
            newPercent = x;
            text.innerHTML = Math.round(newPercent) + "%";
            drawArc();
          }
        }

        function drawArc() {
          let circleStart = 1.5 * Math.PI;
          let circleEnd = circleStart + (newPercent / 50) * Math.PI;
          context.clearRect(0, 0, canvas.width, canvas.height);
          context.beginPath();
          context.arc(centerX, centerY, radius, circleStart, 4 * Math.PI, false);
          context.lineWidth = lineWidth;
          context.strokeStyle = "#FFD2DA";
          context.stroke();
          context.beginPath();
          context.arc(centerX, centerY, radius, circleStart, circleEnd, false);
          context.lineWidth = lineWidth;
          context.strokeStyle = strokeStyle;
          context.stroke();

        }
        const update = function() {
          getValues();
          animate();
        }
        update();

        wrapper.addEventListener("click", function() {
          update();
        });

        let resizeTimer;
        window.addEventListener("resize", function() {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function() {
            clearTimeout(resizeTimer);
            start = new Date().getTime();
            update();
          }, 250);
        });
      });

      function easeInOutQuart(t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
        return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
      }

    });

//   });
