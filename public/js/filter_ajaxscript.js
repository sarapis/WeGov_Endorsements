


      $(document).ready(function () {
          var selected_sort="";
          var profile_name="";
          $(document).on('click', "#profile_btn button", function () {
              profile_name="";
              sendfilter();
          });

          $(document).on('click', ".overlay", function () {
              profile_name="";
              sendfilter();
          });

          $(document).on('click', ".profile_name", function () {
             profile_name = $(this).html();
                    // console.log(profile_name);
                    // debugger;
                    sendfilter();
          });
          $("#sidebar").mCustomScrollbar({
              theme: "minimal"
          });

          $('#exampleTopComponents a').click(function(){
                selected_sort = $(this).html();
                // console.log(selected_sort);
                // debugger;
                sendfilter();
            });

          


          $('#sidebarCollapse').on('click', function () {
              $('#sidebar, #content').toggleClass('active');
              $('.overlay').fadeToggle();
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });

          $('#sidebarCollapse1').on('click', function () {
              $('#sidebar, #content').toggleClass('active');
              $('.overlay').fadeOut();
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });
          $('#district li').click(function(){

              var value = $(this).html();
              $('#btn-district span').html("District: "+value);
              $('#btn-district').show();
              sendfilter();
          });

          $('#search_address').change(function(){
              var value = $(this).val();
              $('#btn-search span').html("Search: "+value);
              $('#btn-search').show();
              if(value == "")
                $('#btn-search').hide();
              sendfilter();
          });

          

          $('#projectstatus li').click(function(){
              var value = $('span',this).html();
              $('#btn-status span').html("Status: "+value);
              $('#btn-status').show();
              sendfilter();
          });
          $('#projectcategory li').click(function(){
              var value = $(this).html();

              $('#btn-category span').html("Category: "+value);
              

              $('#btn-category').show();
              sendfilter();
          });
          $('#cityagency li').click(function(){
              var value = $(this).html();
              $('#btn-city span').html("City: "+value);

              $('#btn-city').show();
              sendfilter();
          });
          $('#btn-cost').click(function(){
            $( "#slider-range" ).slider({
              values: [ 0, 1500000 ]
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
              " - $" + $( "#slider-range" ).slider( "values", 1 ) );
          });

          $('#btn-year').click(function(){
            $( "#slider-range-year" ).slider({
              values: [ 2012, 2018 ]
            });
            $( "#amount-year" ).val(  $( "#slider-range-year" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-year" ).slider( "values", 1 ) );
          });

          $('#btn-vote').click(function(){
            $( "#slider-range-vote" ).slider({
              values: [ 0, 5293 ]
            });
            $( "#amount-vote" ).val(  $( "#slider-range-vote" ).slider( "values", 0 ) +
              " - " + $( "#slider-range-vote" ).slider( "values", 1 ) );
          });

          $('#filter_buttons button').click(function(){
              $(this).hide();
              sendfilter();
          });



    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1500000,
      values: [ 0, 1500000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      
        var value1 = ui.values[0]; var value2 = ui.values[1];
        $( "#btn-cost span" ).html("Cost: " + $("#amount").val());
        $('#btn-cost').show();
        
      }
    });

    
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    // $('.profile_name').click(function(){
    //           profile_name = $(this).html();
    //           // console.log(profile_name);
    //           // debugger;
    //           sendfilter();
    //       });


    $( "#slider-range-year" ).slider({ 
        range: true, 
        min: 2012, 
        max: 2018, 
        values: [ 2012, 2018 ], 
        slide: function( event, ui ) { 
          $( "#amount-year" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
          var value1 = ui.values[0]; var value2 = ui.values[1];
          $( "#btn-year span" ).html("Year of Vote: " + $("#amount-year").val());
          $('#btn-year').show();
           } 
    }); 



    $( "#amount-year" ).val(  $( "#slider-range-year" ).slider( "values", 0 ) +
      " - " + $( "#slider-range-year" ).slider( "values", 1 ) );
   
    $( "#slider-range-vote" ).slider({
      range: true,
      min: 0,
      max: 5293,
      values: [ 0, 5293 ],
      slide: function( event, ui ) {
        $( "#amount-vote" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        var value1 = ui.values[0]; var value2 = ui.values[1];
        $( "#btn-vote span" ).html("Vote: " + $("#amount-vote").val());
        $('#btn-vote').show();
        }
    });

    $( "#amount-vote" ).val(  $( "#slider-range-vote" ).slider( "values", 0 ) +
      " - " + $( "#slider-range-vote" ).slider( "values", 1 ) );
    
    $('.ui-slider-handle.ui-corner-all.ui-state-default').mouseup(function(){
          sendfilter();      
      });

          function sendfilter(){
           
            var form_data = new FormData();    
            // var form_data = [];
            // var form_name = [];
            form_data.append('price_min',$( "#slider-range" ).slider( "values", 0 ));
            form_data.append('price_max',$( "#slider-range" ).slider( "values", 1 ));
            form_data.append('vote_min',$( "#slider-range-vote" ).slider( "values", 0 ));
            form_data.append('vote_max',$( "#slider-range-vote" ).slider( "values", 1 ));
            form_data.append('year_min',$( "#slider-range-year" ).slider( "values", 0 ));
            form_data.append('year_max',$( "#slider-range-year" ).slider( "values", 1 ));
            if(selected_sort)
            form_data.append('selected_sort',selected_sort);
            form_data.append('is_ajax',1);
            form_data.append('address',$('#location').val());
            form_data.append('profile_name', profile_name);
            $('#filter_buttons button').each(function(index){
                
                if($(this).css('display') != 'none')
                {
                  var values = $('span', $(this)).html();

                  value_array = values.split(':');
                  value_array[1] = value_array[1].replace('&amp;','&');    
                  value_array[1] = value_array[1].slice(1);
                  form_data.append(value_array[0],value_array[1]);
                  //form_data[] = value_array[1];
                }
            });
            ///
            $("*").animsition({
              inClass: 'fade-in',
              inDuration: 100,
              loading: true,
              loadingClass: 'loader-overlay',
              loadingParentElement: 'html',
              loadingInner: '\n      <div class="loader-content">\n        <div class="loader-index">\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n        </div>\n      </div>',
              onLoadEvent: true
            });
            var ajax_url;
            if(window.location.href.search('explore') != -1)
              ajax_url = '/range';
            else if(window.location.href.search('summary') != -1)
              ajax_url = '/filter';
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
            })    
            
              $.ajax({
                type: 'POST',
                url: ajax_url,
                data: form_data,
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(data) {
                    
                  $('.loader-overlay').remove();
                  
                  $('#content').html(data);
                },
                error: function(errResponse) {
                
                }
              });

          }
      });
      
