(function($)
{
  $('div.jquery_countdown').each(function()
  {
    $.countdown.regional['fr'] = {
      labels: ['Années', 'Mois', 'Semaines', 'Jours', 'Heures', 'Minutes', 'Secondes'],
      labels1: ['Année', 'Mois', 'Semaine', 'Jour', 'Heure', 'Minute', 'Seconde'],
      compactLabels: ['a', 'm', 's', 'j'],
      timeSeparator: ':',
      isRTL: false
    };
    $.countdown.setDefaults($.countdown.regional['fr']);
    
    $(this).countdown({until: $(this).text()});
  });

  $('div.citation_list ul').each(function()
  {
    $(this).cycle({
      timeout:       0,     // milliseconds between slide transitions (0 to disable auto advance)
      speed:         1000,  // speed of the transition (any valid fx speed value)
      next:          '#citation_next',     // id of element to use as click trigger for next slide
      prev:          '#citation_previous', // id of element to use as click trigger for previous slide
      height:       'auto', // container height
      fit:           1     // force slides to fit container
    });
  });
  
})(jQuery);