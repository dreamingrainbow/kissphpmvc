/* userData declared in home.phtml*/
var filterCols = [];
var sortCols = [];
var filteredData = [];
var sortedData = [];
var interval;
var timeout = 500;
var page = $('input[name="mp"]').val();
var limit = $('input[name="ml"]').val();
function setupPagination()
{
     $('input[name="p"]').on('keyup change', function(){
          if(page == this.value)
          {
               return false;
          }
          clearTimeout(interval);
          interval = setTimeout(function(){
               loadPage( this.value, limit );
               }, timeout);
          });
     $('input[name="p"]').on('keydown', function(){
          clearTimeout(interval);
          });
     $('input[name="l"]').on('keyup', function(){
          if(limit == this.value)
          {
               return false;
          }
          clearTimeout(interval);
          interval = setTimeout(function(){
               loadPage(  page, this.value);
               }, timeout);
          });
     $('input[name="l"]').on('keydown', function(){
          clearTimeout(interval);
          });     
}

function filterData(colId)
{
     filteredData = [{col:'first', order:1, value:'M'},{col:'email', order:2, value:'@'}];
}

function sortData(colId)
{
     sortedData = [{col:'first', order:1, direction:'Asc'},{col:'email', order:2, direction:'Desc'}];
}

function bindEvents()
{
     setupPagination();
     
     $('.filter').on('click', function(){
          clearTimeout(interval);
          interval = setTimeout(function(){
               filterData(this.id);
               }, timeout);
          });
     
     $('.sort').on('click', function(){
          clearTimeout(interval);
          interval = setTimeout(function(){
               sortData(this.id);
               }, timeout);
          });
     
     $('.Address, .Phone-Numbers, .Information').on('click', function(e){
          var panelType;
          if( $(this).hasClass('Address') )
          {
               panelType = 'Address';
          }
          else if($(this).hasClass('Phone-Numbers'))
          {
               panelType = 'Numbers';
          }
          else if($(this).hasClass('Information'))
          {
               panelType = 'Information';
          }
          clearTimeout(interval);
          interval = setTimeout(function(){
               minifyInfoWrapper(e.target.parentNode.firstChild.id, panelType );
               }, timeout);
          });
}

function minifyInfoWrapper(wrapperLabel, panelType)
{
     var user = $.grep(userData, function(e){ return e.id == wrapperLabel.split('-').pop(); }).pop();
     var x = $('#'+wrapperLabel);
     var clearfix = x.next();
     if($(clearfix).hasClass('clearfix'))
     {
          clearfix.remove();
     }
     var xImg = $('#'+wrapperLabel+' img').attr('src');
     var panelHead ='';
     var panelBody =''; 
     switch(panelType)
     {
          case 'Address':
               panelHead = '<div class="panel-heading">Address Information</div>';
               panelBody = '<div class="panel-body">'+
                              'E-Mail : '+user.email+                            
                              '</div>';
               break;
          case 'Numbers':
               panelHead = '<div class="panel-heading">Phone Numbers</div>';
               panelBody = '<div class="panel-body">Something great</div>';
               break;
          case 'Information':
               panelHead = '<div class="panel-heading">General Information</div>';
               panelBody = '<div class="panel-body"><ul class="list-unstyled">'+
                              '<li>DOB : '+user.dob+'</li>'+
                              '<li> SSN : '+user.ssn+'</li>'+
                              '<li> Registered : '+user.registered+  '</li>'+                           
                              '</ul></div>';
                              
               break;
     }
     x.empty().html('<div id="'+wrapperLabel+'"><img src="'+xImg+'" style="width:100px" class="img-circle"/>'+
                    '<div class="clearfix" style="padding-top:16px;"/>'+
                    '<div class="panel '+ ( user.gender == 'male' ? 'panel-info' : 'panel-danger') +'"  style="margin-bottom:3px;">'+
                    panelHead+
                    panelBody+
                    '</div>');     
     
}

function getUserPictureSrc(userId)
{
     var pictureSrc = $('<div id="user-info-wrapper-'+userId+'"><img class="img-circle" src="//placehold.it/225x225"/></div>');    
     $.ajax({
               type: 'POST',
               url: '/GetPicturesByUserId/' + userId,
               dataType:'json',
               data:{apiKey:'somekey'},
               success: function ( data ) {
                   $('#user-info-wrapper-'+userId ).empty().html('<img class="img-circle" src="'+data[0].picture+'" style="max-width:225px;"/>');
                   bindEvents();
                   },
               error: function()
               {
                   alert('Unable to load image.');
               }
           });
     return pictureSrc[0].outerHTML;
}

function buildUsersList()
{
     var wrapper = $('<div id="users-list-wrapper"/>');     
     var content = $('<ul id="users-list" class="list-unstyled"/>');     
     $.each(userData, function(k, user){
          var userSection = $('<li id="user-section-' + user.id + '" style="padding-top:3px;" ' + ( user.gender == 'male' ? 'class="bg-info"' : 'class="bg-danger"') + '/>');
          var userContent = $('<div id="user-section-wrapper-' + user.id + '" style="padding-top:3px;"/>');
          userSection.append(userContent);
               userContent.append('<div class="col-sm-3 text-center" style="padding-top:16px;">'+
                                  getUserPictureSrc(user.id)+
                                  '<div class="clearfix" style="padding-top:16px;"/>'+
                                  '<span id="address-' + user.id + '"  class="Address text-center thumbnail ' + ( user.gender == 'male' ? 'text-info' : 'text-danger') +' glyphicon glyphicon-envelope col-sm-4" style="font-size:32px;"></span>'+
                                  '<span id="numbers-' + user.id + '" class="Phone-Numbers text-center thumbnail ' + ( user.gender == 'male' ? 'text-info' : 'text-danger') +' glyphicon glyphicon-phone-alt col-sm-4" style="font-size:32px;"></span>'+
                                  '<span id="info-' + user.id + '" class="Information text-center thumbnail ' + ( user.gender == 'male' ? 'text-info' : 'text-danger') +' glyphicon glyphicon-info-sign col-sm-4" style="font-size:32px;"></span>'+
                                  '</div>');
          var subSection = $('<div class="col-sm-9" style="margin-left:-36px;"/>');
          var subSectionSideA = $('<div class="col-sm-3"/>');
               subSectionSideA.append('<h2 class="panel-info"><strong>'+ user.title+ ' ' + user.first + ' ' + user.last +'</strong></h2>');
               subSectionSideA.append('<h3 class="panel-info"><strong>'+ user.username+ '</strong></h3>');
               
               col1 = $('<div class="col-sm-12 text-center"/>');
               
               subSectionSideA.append(col1);
                    col1.append('<div class="clearfix"/>');
               var mediaSection = $('<div class="media"/>');
               
               col1.append(mediaSection);
               
               mediaBody = $('<div class="media-body text-left"/>');
               mediaSection.append(mediaBody);
               mediaHeading = $('<h4 class="media-heading text-center">');
               mediaBody.append(mediaHeading);
               mediaHeading.append('Job Title : Undisclosed');
               mediaBody.append('<p class="text-justify">Job Description : Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at.</p>');
               
          subSection.append(subSectionSideA);
               var subSectionSideB = $('<div class="col-sm-9"/>');
                    subSectionSideB.append('<div class="panel ' + ( user.gender == 'male' ? 'panel-info' : 'panel-danger') + '">'+
                                           '<div class="panel-heading clearfix ">'+
                                           '<form class="form " role="form">'+
                                                          '<div class="col-md-8 col-md-offset-2 clearfix">'+
                                                                      '<div class="row">'+
                                                                           '<div class="form-group col-md-6">'+
                                                                                '<label for="first_name">'+
                                                                                     'First Name'+
                                                                                '</label>'+
                                                                                '<input class="form-control input-sm" id="first_name" type="text" />'+
                                                                                '<p class="help-block">'+
                                                                                     '<sub>Enter Your First Name.</sub>'+
                                                                                '</p>'+
                                                                           '</div>'+
                                                                           '<div class="form-group col-md-6">'+
                                                                                '<label for="last_name">'+
                                                                                     'Last Name'+
                                                                                '</label>'+
                                                                                '<input class="form-control input-sm" id="last_name" type="text" />'+
                                                                                '<p class="help-block">'+
                                                                                     '<sub>Enter Your Last Name</sub>'+
                                                                                '</p>'+
                                                                           '</div>'+
                                                                      '</div>'+
                                                                      '<div class="row">'+
                                                                           '<div class="form-group col-md-6">'+
                                                                                '<label for="phone">'+
                                                                                     'Phone'+
                                                                                '</label>'+
                                                                                '<input class="form-control input-sm" id="phone" type="text" />'+
                                                                                '<p class="help-block">'+
                                                                                     '<sub>Enter Your Phone Number.</sub>'+
                                                                                '</p>'+
                                                                           '</div>'+
                                                                           '<div class="form-group col-md-6 text-center" style="margin-top:18px;">'+
                                                                                               
                                                                                     '<label>'+
                                                                                          'Cell'+
                                                                                     '</label>'+
                                                                                     '<input type="radio" name="phone-type" id="cell-phone" value="cell-phone" autocomplete="off" >'+
                                                                                     
                                                                                     '<label>'+
                                                                                          'Landline'+
                                                                                     '</label>'+
                                                                                     '<input type="radio" name="phone-type" id="landline-phone" value="landline-phone" autocomplete="off" >'+
                                                                                '<p class="help-block">'+
                                                                                     '<sub>Is this a Cell or Landline?</sub>'+
                                                                                '</p>'+																																
                                                                           '</div>'+
                                                                      '</div>'+
                                                                      '<div class="row">'+
                                                                           '<div class="form-group col-md-12">'+
                                                                           '<label for="phone">'+
                                                                                     'E-Mail'+
                                                                                '</label>'+
                                                                                '<input class="form-control input-sm" id="email" type="email" />'+
                                                                                '<p class="help-block">'+
                                                                                     '<sub>Enter Your E-Mail Address.</sub>'+
                                                                                '</p>'+
                                                                      '</div>'+
                                                                      '</div>'+
                                                                 '</div>'+
                                                                      '<div class="row">'+
                                                                      '<div class="form-group col-sm-12 text-center">'+
                                                                           '<input type="submit" class="col-sm-8 col-sm-offset-2 btn '+ ( user.gender == 'male' ? 'btn-info' : 'btn-danger') +' btn-sm" name="Contact" value="Contact Now"/>'+
                                                                      '</div>'+
                                                                      '</div>'+
                                             '</form>'+
                                           '</div>'+
                                           '</div>');
          subSection.append(subSectionSideB);
          subSection.append('<div class="clearfix"/>');
          
          userContent.append(subSection);
          userContent.append('<div class="clearfix"/>' );
     
          content.append(  userSection );
     
     });
     wrapper.append(content);
     return wrapper;
}

function pageContent()
{
     var content = $('<div id="main-page-wrapper"/>').append(buildUsersList());
     return content;
}

function loadPage(p,l)
{
     if(page != p)
     {
          page = p;
     }
     if(limit != l)
     {
          limit = l;
     }
     $('#body-wrapper').empty().append(pageContent());
     bindEvents();
}