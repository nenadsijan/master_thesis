@extends('layouts.index')

@section('content')
        <style type="text/css">
#container{
    width: 100%;
    margin: 0 auto;
    
}

.col-lg-6 {
    margin-bottom: 10%;
    min-width: 40%;
    max-width: 100%;
    margin: 1em auto;
    height: 400px;

}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 10%; /* Location of the box */
    padding-right: 10%;
    padding-left: 10%;
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}  
#container.modal{
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    display:block;

   
}


 

        </style>

<h2 class="text-center" >{{$user->first_name}} Charts </h2>


<div id="container">
    <div class="row">
    <div class="alert2 alert-danger fade out" id="bsalert">
        
           <strong>Info!</strong> <p>There is no connection ! <br></p>
          
    </div>
   </div>
</div>

  <script type="text/javascript">

var array = {!! json_encode($path) !!};

$.getJSON( array+"clients", function( data ) {


var mappedClientsAllias = _.map(_.uniqBy(data, "clientAllias"), "clientAllias");
var mappedClients = _.map(_.uniqBy(data, "clientId"), "clientId");


var clients = [];

_.forEach(mappedClients, function(clientId, clientAllias) {

  var tempClient = {
    Allias: mappedClientsAllias[clientAllias],
    name: clientId,
    freq: [],
    data: [],
    memory:[]
  };


  _.forEach(data, function(tempData) {
      
    if (clientId === tempData.clientId) {
       tempClient.freq.push([
         tempData.dataUploadFrequency
        ]);
      _.forEach(tempData.clientData, function(clientData) {

       

        tempClient.data.push([
          clientData.timestamp,
          clientData.cpuUsage,
        ]);
         tempClient.memory.push([
          clientData.timestamp,
          clientData.memoryUsage,
        ]);


      });
    }
  });
  

  clients.push(tempClient);
});

  



var a = _.forEach(clients, function(client) {

 var chart= $('<div class="col-lg-6">')
    .css("position", "relative")
    .appendTo("#container")
    .highcharts("StockChart", {
      marker: {
        states: {
          enabled: true
        }
      },
      time: {
        timezoneOffset: -1 * 60
      },
    exporting: {
                buttons: {
                   
                      customButton3: {
                        text: 'Zooming',
                        //make fullscreen of chart with size change
                        onclick: function(e) {
                           var w = $(window).width();
                           var h = $(window).height();
                        $(e.target).closest('#container').toggleClass('modal');
  if($(e.target).closest('#container').hasClass('modal')) {
    $('.col-lg-6').hide();
    $(e.target).closest('.col-lg-6').show();
      $('.col-lg-6').css({
                  'width': w * .9,
                'height': h * .9
            });  
    
  } else {
    $('.col-lg-6').show();
     $('.col-lg-6').css({
                 'width': '',
                'height': ''
               
            });
   
  }
$(e.target).closest('.col-lg-6').highcharts().reflow();
  

                        }
                    }
                }
            }, 
      rangeSelector: {
        y: 15,
        buttons: [
          {
            count: 1,
            type: "minute",
            text: "Sec"
          },
          {
            count: 1,
            type: "hour",
            text: "Min"
          },
          {
            count: 1,
            type: "day",
            text: "Hours"
          },

          {
            type: "all",
            text: "All"
          }
        ],
        title: "hours",
        inputEnabled: true,
        _selected: 1
      },

      title: {
        text: client.Allias
      },
      yAxis: [{
        
                labels: {
                    enabled: true,
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Memory'
                },
                height: '50%',
                lineWidth: 2,
                   color: 'red'
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'CPU'
                },
                top: '70%',
                height: '50%',
                offset: 0,
                lineWidth: 2,
             
            }],
      xAxis: {
        tickInterval: 5,
        title: {
          enabled: true,
          text: "Client usage"
        },
         top: '20%',
        type: "datetime",
        dateTimeLabelFormats: {
          second: "%H:%M:%S",
          minute: "%H:%M",
          hour: "%H:%M",
          day: "%e. %b",
          week: "%e. %b",
          day: "%Y<br/>%b-%d"
        }
      },

        series: {
          marker: {
            enabled: false,
          }
        
      },

 

      series: [{
        name: "Memory USAGE",
        data: client.memory.sort(function(a, b) {
        return a[0] - b[0];
    }),
        turboThreshold:200
    },  // Add a new series
    {
        name: "Cpu USAGE",
         yAxis: 1,
          color: 'red',
        data: client.data.sort(function(a, b) {
        return a[0] - b[0];
    }),
    turboThreshold:200
    }],

 tooltip: {
        pointFormat: "{point.series.name}:{point.y:.2f}"
    },

      chart: {
        renderTo: "container",
        height:400,
     events: {
//loading again json to load data dynamicaly every 5 seconds
            load: function () {
                            var chart = this;
                              var series = chart.series[0]
console.log(client.freq);
                        setInterval(function () {
                                     $.getJSON( array+"clients", function( data ) {
     var mappedClientsAllias = _.map(_.uniqBy(data, "clientAllias"), "clientAllias");
              var mappedClients = _.map(_.uniqBy(data, "clientId"), "clientId");

              var clients2 = [];

              _.forEach(mappedClients, function(clientId, clientAllias) {
                var tempClient2 = {
                  Allias: mappedClientsAllias[clientAllias],
                  name: clientId,
                  data: [],
                  memory: []
                };

                _.forEach(data, function(tempData) {
                  if (clientId === tempData.clientId) {
                    _.forEach(tempData.clientData, function(clientData) {
                      tempClient2.data.push([
                        clientData.timestamp,
                        clientData.cpuUsage,
                      ]);
                      tempClient2.memory.push([
                        clientData.timestamp,
                        clientData.memoryUsage,
                      ]);

                    });
                  }
                });
                clients2.push(tempClient2);
              });
   
              _.forEach(clients2, function(client2) {
                                if (chart.title.textStr === client2.Allias) {
                                    var cpu = client2.data.sort(function(a, b) {
                                               return a[0] - b[0];
                                                 });
                                    var memory = client2.memory.sort(function(a, b) {
                                               return a[0] - b[0];
                                                 });
                                  
                                    _.forEach(memory, function(el) {
                                       client.memory.push(el);
                                 
                                    });
                                    _.forEach(cpu, function(el) {
                                       client.data.push(el);
                                 
                                    });
 

 /*
                                                    chart.series[0].setData(
                                       client.memory.sort(function(a, b) {
                                               return a[0] - b[0];
                                                 }), true, true, false);


                            chart.series[1].setData(
                                       client.data.sort(function(a, b) {
                                               return a[0] - b[0];
                                                 }), true, true, false);


*/

                                        
                                   chart.update({
                                        series: [{
                                          data: client.memory.sort(function(a, b) {
                                               return a[0] - b[0];

                                                 }),
                                           },  // Add a new series
                                      {
                                          data: client.data.sort(function(a, b) {
                                               return a[0] - b[0];
                                                 }),
                                        }]
                                   })
                                                                     }
                            });   
                });   
                                         
                },  client.freq * 1000);
            }
        }
      },

    });


});


(function($){
    
    var paginate = {
        startPos: function(pageNumber, perPage) {
            // determine what array position to start from
            // based on current page and # per page
            return pageNumber * perPage;
        },

        getPage: function(items, startPos, perPage) {
            // declare an empty array to hold our page items
            var page = [];

            // only get items after the starting position
            items = items.slice(startPos, items.length);

            // loop remaining items until max per page
            for (var i=0; i < perPage; i++) {
                page.push(items[i]); }

            return page;
        },

        totalPages: function(items, perPage) {
            // determine total number of pages
            return Math.ceil(items.length / perPage);
        },

        createBtns: function(totalPages, currentPage) {
            // create buttons to manipulate current page
            var pagination = $('<div class="pagination" />');

            // add a "first" button
            pagination.append('<span class="pagination-button">&laquo;</span>');

            // add pages inbetween
            for (var i=1; i <= totalPages; i++) {
                // truncate list when too large
                if (totalPages > 5 && currentPage !== i) {
                    // if on first two pages
                    if (currentPage === 1 || currentPage === 2) {
                        // show first 5 pages
                        if (i > 5) continue;
                    // if on last two pages
                    } else if (currentPage === totalPages || currentPage === totalPages - 1) {
                        // show last 5 pages
                        if (i < totalPages - 4) continue;
                    // otherwise show 5 pages w/ current in middle
                    } else {
                        if (i < currentPage - 2 || i > currentPage + 2) {
                            continue; }
                    }
                }

                // markup for page button
                var pageBtn = $('<span class="pagination-button page-num" />');

                // add active class for current page
                if (i == currentPage) {
                    pageBtn.addClass('active'); }

                // set text to the page number
                pageBtn.text(i);

                // add button to the container
                pagination.append(pageBtn);
            }

            // add a "last" button
            pagination.append($('<span class="pagination-button">&raquo;</span>'));

            return pagination;
        },

        createPage: function(items, currentPage, perPage) {
            // remove pagination from the page
            $('.pagination').remove();

            // set context for the items
            var container = items.parent(),
                // detach items from the page and cast as array
                items = items.detach().toArray(),
                // get start position and select items for page
                startPos = this.startPos(currentPage - 1, perPage),
                page = this.getPage(items, startPos, perPage);

            // loop items and readd to page
            $.each(page, function(){
                // prevent empty items that return as Window
                if (this.window === undefined) {
                    container.append($(this)); }
            });

            // prep pagination buttons and add to page
            var totalPages = this.totalPages(items, perPage),
                pageButtons = this.createBtns(totalPages, currentPage);

            container.after(pageButtons);
        }
    };

    // stuff it all into a jQuery method!
    $.fn.paginate = function(perPage) {
        var items = $(this);

        // default perPage to 5
        if (isNaN(perPage) || perPage === undefined) {
            perPage = 5; }

        // don't fire if fewer items than perPage
        if (items.length <= perPage) {
            return true; }

        // ensure items stay in the same DOM position
        if (items.length !== items.parent()[0].children.length) {
            items.wrapAll('<div class="pagination-items" />');
        }

        // paginate the items starting at page 1
        paginate.createPage(items, 1, perPage);

        // handle click events on the buttons
        $(document).on('click', '.pagination-button', function(e) {
            // get current page from active button
            var currentPage = parseInt($('.pagination-button.active').text(), 10),
                newPage = currentPage,
                totalPages = paginate.totalPages(items, perPage),
                target = $(e.target);

            // get numbered page
            newPage = parseInt(target.text(), 10);
            if (target.text() == '«') newPage = 1;
            if (target.text() == '»') newPage = totalPages;

            // ensure newPage is in available range
            if (newPage > 0 && newPage <= totalPages) {
                paginate.createPage(items, newPage, perPage); }
        });
    };

})(jQuery);


$('.col-lg-6').paginate(4);

    }).catch(function (jqXHR, textStatus, errorThrown) {
     $(".alert2").toggleClass('in out'); 
    return false; // Keep close.bs.alert event from removing from DOM
});

</script>


 @endsection
