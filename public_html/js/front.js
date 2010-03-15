(function($)
{
  /*
   * Afficher la suite du texte d'une pétition
   */
   $('a.show_more').click(function()
   {
     $('div.petition_text').toggle(200);
   });
   $('div.petition_text').hide();
  
  /*
   * Compteurs
   */
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

  /*
   * Citations
   */
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
  
  /*
   * OpenInviter
   */
  $('.open_inviter_form').each(function()
  {
    var $form = $(this), url = $form.metadata().url;

    function reloadForm()
    {
      var data = {
        open_inviter: {
          email:      $form.find('.email').val(),
          password:   $form.find('.password').val(),
          provider:   $form.find('.provider').val()
        }
      };

      $form.html('Chargement...');

      $.ajax({
        url:      url,
        type:     'POST',
        data:     data,
        cache:    false,
        success:  function(html)
        {
          $form.html(html);

          if(contacts = $form.find('.contacts').text())
          {
            $('.contacts_receiver').val(contacts);
          }

          $form.find('a.import_contacts').click(function()
          {
            reloadForm();
          });

          $form.find('input, select').bind('keypress', function(e)
          {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) //Enter keycode
            {
              reloadForm();
              e.stopPropagation();
              return false;
            }
          });
        }
      });
    }

    reloadForm();
  });
  
})(jQuery);