var mySwiper = new Swiper('.swiper-container', {
  // Optional parameters
  loop: true,

  autoplay: {
    delay: 5000,
  },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  
})

let menuToggle = $('.header-menu-toggle');
menuToggle.on('click', function(event){
  event.preventDefault();
  $('.header-nav').slideToggle(200);
})


// let contactForm = $('.contacts-form');

// contactForm.on('submit', function(event){
//   event.preventDefault();
//   let formData = new FormData(this);
//   formData.append('action', 'contacts_form');
//   $.ajax({
//     type: "POST",
//     url: adminAjax.url,
//     contentType: false,
//     processData: false,
//     data: formData ,
//     success: function (response) {
//       console.log('Ответ сервера:   ' + response);
//     }
//   });

// });