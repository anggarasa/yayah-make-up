// document.addEventListener("DOMContentLoaded", function () {
//     const slider = document.getElementById("slider");
//     const prevBtn = document.getElementById("prev");
//     const nextBtn = document.getElementById("next");

//     let scrollAmount = 0;
//     const slideWidth = slider.querySelector("div").offsetWidth;

//     prevBtn.addEventListener("click", () => {
//         scrollAmount = Math.max(scrollAmount - slideWidth, 0);
//         slider.style.transform = `translateX(-${scrollAmount}px)`;
//     });

//     nextBtn.addEventListener("click", () => {
//         scrollAmount = Math.min(
//             scrollAmount + slideWidth,
//             slider.scrollWidth - slider.clientWidth
//         );
//         slider.style.transform = `translateX(-${scrollAmount}px)`;
//     });

//     function adjustSliderForScreenSize() {
//         const windowWidth = window.innerWidth;
//         if (windowWidth < 640) {
//             slider.style.transform = "translateX(0)";
//             scrollAmount = 0;
//         }
//     }

//     window.addEventListener("resize", adjustSliderForScreenSize);
//     adjustSliderForScreenSize();
// });
