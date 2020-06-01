import 'isotope-layout/dist/isotope.pkgd.min'

export default {
  init() {
    // JavaScript to be fired on the about us page
    console.log('Episodes page');

    // Tag tabs 
    $('.tag-title').click(function () {
      let thisTag = $(this).data('tags');
      let theTags = $('.tag-cat[data-tags="' + thisTag + '"]')

      $(this).toggleClass('active');
      
      if (theTags.hasClass('active')) {
        $('.tag-cat').removeClass('active');
      } else { 
        $('.tag-cat').removeClass('active');
        theTags.addClass('active');
      }
    });

    
  },
  finalize() {
    // Isotope Init
   let $grid = $('.episodes');
    
    setTimeout(() => {
      $grid.isotope({
        // options
        itemSelector: '.episode',
        layoutMode: 'fitRows',
        percentPosition: true,
        fitRows: {
          gutter: '.gutter-sizer',
        },
      });  
    }, 500);

    // filter items on button click
    let $reset = $('.reset');
    let $buttons = $('.tag-cat button');

    $reset.click(function () { 
      $buttons.removeClass('active');
      $reset.removeClass('active');
      $grid.isotope({ filter: '*' })
    });

    $('.tag-cat').on('click', 'button', function () {
      if ($(this).hasClass('active')) {
        $buttons.removeClass('active');
        $reset.removeClass('active');

        $grid.isotope({ filter: '*' })
      } else { 
        $buttons.removeClass('active');
        $(this).addClass('active');
        $reset.addClass('active');

        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
      }
    });
  },
};
