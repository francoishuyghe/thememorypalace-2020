import 'isotope-layout/dist/isotope.pkgd.min'

export default {
  init() {
    console.log('Episodes page');

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

    $grid.on('arrangeComplete', function () {
      $('.episodes').addClass('active');
    } );
      
    $grid.isotope({
        // options
        itemSelector: '.episode',
        layoutMode: 'fitRows',
        percentPosition: true,
        fitRows: {
          gutter: '.gutter-sizer',
        },
    });

    // filter items on button click
    let $reset = $('.reset');
    let $buttons = $('.tag-cat button');

    $reset.click(function () { 
      $buttons.removeClass('active');
      $reset.removeClass('active');
      $grid.isotope({ filter: '*' })
    });

    // Display favorites
    $('a.favorites').click(function () {
      if ($(this).hasClass('active')) {
        $grid.isotope({ filter: '*' });
      } else {
        $grid.isotope({ filter: '.favorite' });
      }

      $(this).toggleClass('active');
    });

    $('.tag-cat button').click(function () {
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
