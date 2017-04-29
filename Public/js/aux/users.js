     var firstName;
     var lastName;
     var phone;
     var phoneType;
     var username;
     var email;
     var address;
     var address_2;
     var city;
     var state;
     var postalCode;
     var validForm = false;//we start with an invalid form
     var holding;
     var primaryRoles;
     var selectedRoleId;
     var selectedRole;
     var filterType;
     var lookupCache = {};
     var queue;
     var term;
$(function(){
     userLoadables();
});

function userLoadables()
{    
          $('#first_name').bind('input', function(){
                             console.log('again');                                  
               if(term != this.value)
               {
                    clearTimeout(queue);
                    term = this.value;
               }
               if(typeof(queue) !== undefined )
               {
                    queue = setTimeout(function(){lookup('first_name');},800);
               }
          });
          $('#last_name').bind('input', function(){
               if(term != this.value)
               {
                    clearTimeout(queue);
                    term = this.value;
               }
               if(typeof(queue) !== undefined )
               {
                    queue = setTimeout(function(){lookup('last_name');},800);
               }
          });
          $('#address').bind('input', function(){
               if(term != this.value)
               {
                    clearTimeout(queue);
                    term = this.value;
               }
               if(typeof(queue) !== undefined )
               {
                    queue = setTimeout(function(){lookup('address');},800);
               }
          });
          $('#city').bind('input', function(){
               if(term != this.value)
               {
                    clearTimeout(queue);
                    term = this.value;
               }
               if(typeof(queue) !== undefined )
               {
                    queue = setTimeout(function(){lookup('city');},800);
               }
          });
          $('#state').bind('input', function(){
               if(term != this.value)
               {
                    clearTimeout(queue);
                    term = this.value;
               }
               if(typeof(queue) !== undefined )
               {
                    queue = setTimeout(function(){lookup('state');},800);
               }
          });
}

function lookup(id)
{
     var area = $('#'+id);
     var options = $('<div class="list-group" style="position:fixed;margin-top:-16px;margin-left:0px;z-index:1052;" />');
     switch(id)
     {
          case 'first_name':
               if(filterType != 'first_name')
               {
                    filterType = 'first_name';
               }               
               break;
          case 'last_name':
               if(filterType != 'last_name')
               {
                    filterType = 'last_name';
               }               
               break;
          case 'address':
               if(filterType != 'address')
               {
                    filterType = 'address';
               }               
               break;
          case 'city':
               if(filterType != 'city')
               {
                    filterType = 'city';
               }               
               break;
          case 'state':
               if(filterType != 'state')
               {
                    filterType = 'state';
               }               
               break;          
     }
     var insides = $('<a class="list-group-item" onclick="$(\'#'+id+'\').val($(this).html());$(this).parent().remove();">OptionA</a><a class="list-group-item" onclick="$(\'#'+id+'\').val($(this).html());$(this).parent().remove();">OptionB</a>');  
     options.append(insides);
     area.parent().append(options);
}

function errorWithAutocomplete(className)
{
     if(!$('#'+className).prev().hasClass('text-danger'))
     {
          $('#'+className).prev().addClass('text-danger');                            
     }
     
     if(!$('#'+className).parent().parent().hasClass('has-error'))
     {
          $('#'+className).parent().parent().addClass('has-error');
     }
     
     if(!$('#'+className).parent().parent().hasClass('has-feedback'))
     {
          $('#'+className).parent().parent().addClass('has-feedback');
     }
     
     if(!$('#'+className).next().hasClass('form-control-feedback'))
     {                  
          $('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" style="right:16px;"></span>').insertAfter('#'+className);  
     }
     else
     {
         if(!$('#'+className).next().hasClass('glyphicon-remove'))
          {
               $('#'+className).next().addClass('glyphicon-remove');
          }
          if($('#'+className).next().hasClass('glyphicon-ok'))
          {
               $('#'+className).next().removeClass('glyphicon-ok');
          } 
     }
}

function successWithAutocomplete(className)
{
     if($('#'+className).parent().parent().hasClass('has-error'))
     {
          $('#'+className).parent().parent().removeClass('has-error'); 
     }
     if(!$('#'+className).parent().parent().hasClass('has-success'))
     {
          $('#'+className).parent().parent().addClass('has-success');
     }
     if(!$('#'+className).parent().parent().hasClass('has-feedback'))
     {
          $('#'+className).parent().parent().addClass('has-feedback');
     }          
     if($('#'+className).prev().hasClass('text-danger'))
     {
         $('#'+className).prev().removeClass('text-danger');
     }          
     if(!$('#'+className).prev().hasClass('text-success'))
     {
          $('#'+className).prev().addClass('text-success');
     }
     if($('#'+className).next().hasClass('form-control-feedback'))
     {                  
          if($('#'+className).next().hasClass('glyphicon-remove'))
          {
               $('#'+className).next().removeClass('glyphicon-remove');
          }
          if(!$('#'+className).next().hasClass('glyphicon-ok'))
          {
               $('#'+className).next().addClass('glyphicon-ok');
          }
     }
     else
     {
          $('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true" style="right:16px;"></span>').insertAfter('#'+className);
     }
}

function errorMessage(className)
{
     if(!$('#'+className).prev().hasClass('text-danger'))
          {
               $('#'+className).prev().addClass('text-danger');                            
          }
          
          if(!$('#'+className).parent().hasClass('has-error'))
          {
               $('#'+className).parent().addClass('has-error');
          }
          
          if(!$('#'+className).parent().hasClass('has-feedback'))
          {
               $('#'+className).parent().addClass('has-feedback');
          }
          
          if(!$('#'+className).next().hasClass('form-control-feedback'))
          {                  
               $('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" style="right:16px;"></span>').insertAfter('#'+className);  
          }
          else
          {
              if(!$('#phone').next().hasClass('glyphicon-remove'))
               {
                    $('#phone').next().addClass('glyphicon-remove');
               }
               if($('#phone').next().hasClass('glyphicon-ok'))
               {
                    $('#phone').next().removeClass('glyphicon-ok');
               } 
          }
}

function successMessage(className)
{
     if($('#'+className).parent().hasClass('has-error'))
     {
          $('#'+className).parent().removeClass('has-error'); 
     }
     if(!$('#'+className).parent().hasClass('has-success'))
     {
          $('#'+className).parent().addClass('has-success');
     }
     if(!$('#'+className).parent().hasClass('has-feedback'))
     {
          $('#'+className).parent().addClass('has-feedback');
     }          
     if($('#'+className).prev().hasClass('text-danger'))
     {
         $('#'+className).prev().removeClass('text-danger');
     }          
     if(!$('#'+className).prev().hasClass('text-success'))
     {
          $('#'+className).prev().addClass('text-success');
     }
     if($('#'+className).next().hasClass('form-control-feedback'))
     {                  
          if($('#'+className).next().hasClass('glyphicon-remove'))
          {
               $('#'+className).next().removeClass('glyphicon-remove');
          }
          if(!$('#'+className).next().hasClass('glyphicon-ok'))
          {
               $('#'+className).next().addClass('glyphicon-ok');
          }
     }
     else
     {
          $('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true" style="right:16px;"></span>').insertAfter('#'+className);
     }
}

function addUser()
{
     var checks = {};
     if(holding === undefined)
     {
          holding = $('#modal-container-addUser .modal-body').html();
     }
     
     //now that we have all the values lets validate each form element, and return errors if they don't meet our requirements.
     if(document.addAuthUserForm.first_name !== undefined)
     {          
          if(firstName === undefined || firstName != document.addAuthUserForm.first_name.value )
          {
               firstName = document.addAuthUserForm.first_name.value;
          }
          
          if(lastName === undefined || lastName != document.addAuthUserForm.last_name.value)
          {
               lastName = document.addAuthUserForm.last_name.value;
          }
          
          if(phone === undefined || phone != document.addAuthUserForm.phone.value)
          {
               phone = document.addAuthUserForm.phone.value;
          }
          
          if(phoneType === undefined || phoneType != document.addAuthUserForm.phone_type.value)
          {
               phoneType = document.addAuthUserForm.phone_type.value;
          }
          
          if(username === undefined || username != document.addAuthUserForm.username.value)
          {
               username = document.addAuthUserForm.username.value;
          }
          
          if(email === undefined || email != document.addAuthUserForm.email.value)
          {
               email = document.addAuthUserForm.email.value;
          }
          
          if(address === undefined || address != document.addAuthUserForm.address.value)
          {
               address = document.addAuthUserForm.address.value;
          }
          
          if(address_2 === undefined || address_2 != document.addAuthUserForm.address_2.value)
          {
               address_2 = document.addAuthUserForm.address_2.value;
          }
          
          if(city === undefined || city != document.addAuthUserForm.city.value)
          {
               city = document.addAuthUserForm.city.value;
          }
          
          if(state === undefined || state != document.addAuthUserForm.state.value)
          {
               state = document.addAuthUserForm.state.value;
          }
          
          if(postalCode === undefined || postalCode != document.addAuthUserForm.postal_code.value)
          {
               postalCode = document.addAuthUserForm.postal_code.value;
          }               
     }
     if (firstName !== '' && firstName.search(/[^a-zA-Z]+/) === -1)
     {          
          checks.firstname = true;          
          successWithAutocomplete('first_name');
     }
     else
     {
          checks.firstname = false;
          errorWithAutocomplete('first_name');          
     }

     if (lastName !== '' && lastName.search(/[^a-zA-Z]+/) === -1)
     {          
          checks.lastname = true;
          successWithAutocomplete('last_name');
     }
     else
     {
          checks.lastname = false;
          errorWithAutocomplete('last_name');
     }
     
     if (phone !== '' && phone.search(/[^0-9]+/) === -1)
     {          
          checks.phone = true;          
          successMessage('phone');
     }
     else
     {
          checks.phone = false;
          errorMessage('phone');          
     }
     
     if(phoneType !== '' && (phoneType == 'cell' || phoneType == 'landline'))
     {
          checks.phoneType = true;
          if($('input[name="phone_type"]').parent().hasClass('has-error'))
          {
               $('input[name="phone_type"]').parent().removeClass('has-error'); 
          }
          if(!$('input[name="phone_type"]').parent().hasClass('has-success'))
          {
               $('input[name="phone_type"]').parent().addClass('has-success');
          }
          if(!$('input[name="phone_type"]').parent().hasClass('has-feedback'))
          {
               $('input[name="phone_type"]').parent().addClass('has-feedback');
          }          
          if($('input[name="phone_type"]').prev().hasClass('text-danger'))
          {
              $('input[name="phone_type"]').prev().removeClass('text-danger');
          }          
          if(!$('input[name="phone_type"]').prev().hasClass('text-success'))
          {
               $('input[name="phone_type"]').prev().addClass('text-success');
          }
          if($('input[name="phone_type"]').next().hasClass('form-control-feedback'))
          {                  
               if($('input[name="phone_type"]').next().hasClass('glyphicon-remove'))
               {
                    $('input[name="phone_type"]').next().removeClass('glyphicon-remove');
               }
               if(!$('input[name="phone_type"]').next().hasClass('glyphicon-ok'))
               {
                    $('input[name="phone_type"]').next().addClass('glyphicon-ok');
               }
          }
          else
          {
               $('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true" style="right:16px;"></span>').insertAfter('input[name="phone_type"]');
          }
     }
     else
     {
          checks.phoneType = false;
          if(!$('input[name="phone_type"]').prev().hasClass('text-danger'))
          {
               $('input[name="phone_type"]').prev().addClass('text-danger');                            
          }
          
          if(!$('input[name="phone_type"]').parent().hasClass('has-error'))
          {
               $('input[name="phone_type"]').parent().addClass('has-error');
          }
          
          if(!$('input[name="phone_type"]').parent().hasClass('has-feedback'))
          {
               $('input[name="phone_type"]').parent().addClass('has-feedback');
          }
          
          if(!$('input[name="phone_type"]').next().hasClass('form-control-feedback'))
          {                  
               $('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" style="right:16px;"></span>').insertAfter('input[name="phone_type"]');  
          }
          else
          {
              if(!$('input[name="phone_type"]').next().hasClass('glyphicon-remove'))
               {
                    $('input[name="phone_type"]').next().addClass('glyphicon-remove');
               }
               if($('input[name="phone_type"]').next().hasClass('glyphicon-ok'))
               {
                    $('input[name="phone_type"]').next().removeClass('glyphicon-ok');
               } 
          }
     }

     if (username !== '' && username.search(/[^a-zA-Z0-9]+/) === -1)
     {          
          checks.username = true;          
          successMessage('username');
     }
     else
     {
          checks.username = false;
          errorMessage('username');
     }
     
     if (email !== '')
     {          
          checks.email = true;          
          successMessage('email');
     }
     else
     {
          checks.email = false;
          errorMessage('email');
     }
     
     if (address !== '')
     {          
          checks.address = true;          
          successWithAutocomplete('address');
     }
     else
     {
          checks.address = false;
          errorWithAutocomplete('address');
     }
     
     if (address_2 !== '')
     {          
          checks.address_2 = true; 
          successMessage('address_2');
     }
     
     if (city !== '')
     {          
          checks.city = true;          
          successWithAutocomplete('city');
     }
     else
     {
          checks.city = false;
          errorWithAutocomplete('city');
     }
     
     if (state !== '')
     {          
          checks.state = true;          
          successWithAutocomplete('state');
     }
     else
     {
          checks.state = false;
          errorWithAutocomplete('state');
     }
     
     if (postalCode !== '')
     {          
          checks.postalCode = true;          
          successWithAutocomplete('postal_code');
     }
     else
     {
          checks.postalCode = false;
          errorWithAutocomplete('postal_code');
     }
     
     if($.inArray( false, $.map(checks, function(val) { return val; })) === -1 )
     {
          if(selectedRole === '' ||  typeof(selectedRole) === 'undefined' )
          {
               var primaryRoleId = 0;
               $.ajax(
                 {
                    type: 'POST',
                    url: '/Roles',
                    dataType:'json',
                    data:{output:'json',role:primaryRoleId},
                    beforeSend: function()
                    {
                         /*TODO add before alert*/
                         $('#modal-container-addUser .modal-body').empty().html('<h1>Role Selection :: Loading Roles...</h1>');
                         
                    },
                    success: function ( responseData )
                    {                    
                         primaryRoles = $.map(responseData, function(val) { return '<li><button class="btn btn-xs" onclick="selectRole('+val.id+', \''+val.role+'\')">'+
                                              val.role+
                                              '</button> OR '+
                                              '<button class="btn btn-xs" onclick="chooseSubordinate('+val.id+', \''+val.role+'\')">Choose A Subordinate</button></li>';
                                              });
                         $('#modal-container-addUser .modal-body').empty().html('<div class="row"><div class="col-md-12"><h3>Role Selection</h3>Choose a selection : </br><div class="text-center"><ul class="list-unstyled">'+ primaryRoles +'</ul></div></div></div>');
                    },
                    error: function()
                    {
                         /*TODO add error alert*/
                         $('#modal-container-addUser .modal-body').empty().html('<h3>There has been an error select roles. please try again.</h3>');
                    }
               });             
          }
          if(selectedRole !== '' &&  typeof(selectedRole) !== 'undefined' )
          {
               var addUserConfirmation = false;
               if(document.addAuthUserForm.addUserConfirmation !== undefined)
               {
                    addUserConfirmation = document.addAuthUserForm.addUserConfirmation.checked;
               }
               if(addUserConfirmation)
               {
                    $.ajax({
                            type: 'POST',
                            url: '/AddAuthUser',
                            dataType:'json',
                            data:{output:'json',user:{first_name:firstName,
                                                      last_name:lastName,
                                                      phone:phone,
                                                      phone_type:phoneType,
                                                      username:username,
                                                      email:email,
                                                      address:address,
                                                      address_2:address_2,
                                                      city:city,
                                                      state:state,
                                                      postal_code:postalCode,
                                                      role_id:selectedRoleId}},
                            beforeSend: function()
                            {
                                 //TODO add before alert
                                 $('#modal-container-addUser .modal-body').empty().html('<h1>Adding User...</h1>');
                                 
                            },
                            success: function ( responseData )
                            {
                                  console.log(responseData);
                                  $('#modal-container-addUser .modal-body').empty().html('<div class="row"><div class="col-md-12">User Added!</div></div>');
                                  setTimeout(function(){ resetAddUser(); viewEnabled();}, 300);
                            },
                            error: function()
                            {
                                 //TODO add error alert
                                 $('#modal-container-addUser .modal-body').empty().html('<h3>There has been an error adding the user. Please try again.</h3>');
                            }
                       });     
               }
               else
               {
                    $('#modal-container-addUser .modal-body').empty().html('<div class="checkbox"><label for="addUserConfirmation"><input type="checkbox" name="addUserConfirmation"/>By checking here you confirm you want to add this user.</label></div>');
               }
          }
     }
}

function selectRole(id, role)
{
     selectedRoleId = id;
     selectedRole = role;
     addUser();
}

function chooseSubordinate(id, role)
{
     $.ajax(
       {
          type: 'POST',
          url: '/Roles',
          dataType:'json',
          data:{output:'json',role:id},
          beforeSend: function()
          {
               /*TODO add before alert*/
               $('#modal-container-addUser .modal-body').empty().html('<h1>Role Selection :: Loading Roles...</h1>');
               
          },
          success: function ( responseData )
          {                    
               primaryRoles = $.map(responseData, function(val) { return '<li><button class="btn btn-xs" onclick="selectRole('+val.id+', \''+val.role+'\')">'+
                                    val.role+
                                    '</button> OR '+
                                    '<button class="btn btn-xs" onclick="chooseSubordinate('+val.id+', \''+val.role+'\')">Choose A Subordinate</button></li>';
                                    });
               $('#modal-container-addUser .modal-body').empty().html('<div class="row"><div class="col-md-12"><h3>Role Selection</h3>Choose a selection : </br><div class="text-center"><ul class="list-unstyled">'+ primaryRoles +'</ul></div></div></div>');
          },
          error: function()
          {
               /*TODO add error alert*/
               console.log('error');
          }
     });
}

function resetAddUser()
{     
     if(holding !== undefined)
     {
          $('#modal-container-addUser .modal-body').empty().html(holding);
     }
     selectedRoleId = '';
     selectedRole = '';
     document.addAuthUserForm.reset();
     userLoadables();
}


function resetEnableUser()
{
     enableUserConfirmation = '';
     if($('#modal-container-enableUser').length >= 1)
     {
          $('#modal-container-enableUser').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#modal-container-enableUser').remove();
     }
}

function resetDisableUser()
{
     disableUserConfirmation = '';
     if($('#modal-container-disableUser').length >= 1)
     {
          $('#modal-container-disableUser').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#modal-container-disableUser').remove();
     }
}

function resetDeleteUser()
{     
     deleteUserConfirmation = '';
     if($('#modal-container-deleteUser').length >= 1)
     {
          $('#modal-container-deleteUser').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#modal-container-deleteUser').remove();
     }
}

function enableUser(id)
{
     var enableUserConfirmation = false;
     if(document.enableAuthUserForm !== undefined)
     {
          enableUserConfirmation = document.enableAuthUserForm.enableUserConfirmation.checked;
          resetEnableUser();          
     }
     if(enableUserConfirmation)
     {
          $.ajax(
            {
               type: 'POST',
               url: '/EnableAuthUsers',
               dataType:'json',
               data:{output:'json',userId:id},
               beforeSend: function()
               {
                    /*TODO add before alert*/
                    console.log('processing');               
               },
               success: function ( responseData )
               {
                    authUsers = responseData;
                    viewDisabled();
               },
               error: function()
               {
                    /*TODO add error alert*/
                    console.log('error');
               }
          });
          return;
     }
     resetEnableUser();
     var enableUserModal = $('<div class="modal fade" id="modal-container-enableUser" role="dialog" aria-labelledby="enableUser" aria-hidden="true" />');     
     var enableUserForm = $('<form class="form" name="enableAuthUserForm">');
     enableUserModal.append(enableUserForm);
     var enableUserModalDialog = $('<div class="modal-dialog" />');
     enableUserForm.append(enableUserModalDialog);
     var enableUserModalContent = $('<div class="modal-content" />');
     enableUserModalDialog.append(enableUserModalContent);
     var enableUserModalHeader = $('<div class="modal-header" />');               
     enableUserModalContent.append( enableUserModalHeader );                      
     var enableUserModalCloseButton = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>');
     enableUserModalHeader.append(enableUserModalCloseButton);
     var enableUserModalTitle = $('<h4 class="modal-title" id="enableUser">Enable Auth User</h4>');
     enableUserModalHeader.append( enableUserModalTitle );                      
                            
     var enableUserModalBody = $('<div class="modal-body" />');                                 
     enableUserModalContent.append(enableUserModalBody);                       
                        
     var enableUserConfirmationFormElements = $('<div class="checkbox"><label for="enableUserConfirmation"><input type="checkbox" name="enableUserConfirmation"/>By checking here you confirm you want to enable this user.</label></div>');
          enableUserModalBody.append(enableUserConfirmationFormElements);
          
     var enableUserModalFooter ='<div class="modal-footer">'+
                            '<button type="button" class="btn btn-default" data-dismiss="modal">'+
                             '   Close'+
                            '</button>'+
                            '<button type="button" class="btn btn-default" onclick="resetEnableUser();">'+
                            '    Reset'+
                            '</button>'+ 
                            '<button type="button" class="btn btn-primary" onclick="enableUser(\''+id+'\');" >'+
                             '   Save Changes'+
                            '</button>'+
                        '</div>';
     enableUserModalContent.append(enableUserModalFooter);                   
     $('body').append(enableUserModal);
     $('#modal-container-enableUser').modal('show');
     return;
}

function disableUser(id)
{
     var disableUserConfirmation = false;
     if(document.disableAuthUserForm !== undefined)
     {
          disableUserConfirmation = document.disableAuthUserForm.disableUserConfirmation.checked;
          resetDisableUser();          
     }
     if(disableUserConfirmation)
     {
          $.ajax(
            {
               type: 'POST',
               url: '/DisableAuthUsers',
               dataType:'json',
               data:{output:'json',userId:id},
               beforeSend: function()
               {
                    /*TODO add before alert*/
                    console.log('processing');               
               },
               success: function ( responseData )
               {
                    authUsers = responseData;
                    viewDisabled();
               },
               error: function()
               {
                    /*TODO add error alert*/
                    console.log('error');
               }
          });
          return;
     }
     resetDisableUser();
     var disableUserModal = $('<div class="modal fade" id="modal-container-disableUser" role="dialog" aria-labelledby="disableUser" aria-hidden="true" />');     
     var disabledUserForm = $('<form class="form" name="disableAuthUserForm">');
          disableUserModal.append(disabledUserForm);
     var disableUserModalDialog = $('<div class="modal-dialog" />');
          disabledUserForm.append(disableUserModalDialog);
     var disabledUserModalContent = $('<div class="modal-content" />');
          disableUserModalDialog.append(disabledUserModalContent);
     var disabledUserModalHeader = $('<div class="modal-header" />');               
          disabledUserModalContent.append( disabledUserModalHeader );                      
     var disableUserModalCloseButton = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>');
          disabledUserModalHeader.append(disableUserModalCloseButton);
     var disableUserModalTitle = $('<h4 class="modal-title" id="disableUser">Disable Auth User</h4>');
          disabledUserModalHeader.append( disableUserModalTitle );
     var disabledUserModalBody = $('<div class="modal-body" />');                                 
          disabledUserModalContent.append(disabledUserModalBody);
          
     var disabledUserConfirmationFormElements = $('<div class="checkbox"><label for="disableUserConfirmation"><input type="checkbox" name="disableUserConfirmation"/>By checking here you confirm you want to disable this user.</label></div>');
          disabledUserModalBody.append(disabledUserConfirmationFormElements);
     var disabledUserModalFooter ='<div class="modal-footer">'+
                                 '<button type="button" class="btn btn-default" data-dismiss="modal">'+
                                  '   Close'+
                                 '</button>'+
                                 '<button type="button" class="btn btn-default" onclick="resetDisableUser();">'+
                                 '    Reset'+
                                 '</button>'+ 
                                 '<button type="button" class="btn btn-primary" onclick="disableUser(\''+id+'\');" >'+
                                  '   Save Changes'+
                                 '</button>'+
                             '</div>';
          disabledUserModalContent.append(disabledUserModalFooter);                   
     $('body').append(disableUserModal);
     $('#modal-container-disableUser').modal('show');
     return;
}

function deleteUser(id)
{
     var deleteUserConfirmation = false;
     if(document.deleteAuthUserForm !== undefined)
     {
          deleteUserConfirmation = document.deleteAuthUserForm.deleteUserConfirmation.checked;
          resetDeleteUser();
     }
     if(deleteUserConfirmation)
     {
          $.ajax(
            {
               type: 'POST',
               url: '/DeleteAuthUser',
               dataType:'json',
               data:{output:'json',userId:id},
               beforeSend: function()
               {
                    /*TODO add before alert*/
                    console.log('processing');               
               },
               success: function ( responseData )
               {
                    authUsers = responseData;
                    viewEnabled();
               },
               error: function()
               {
                    /*TODO add error alert*/
                    console.log('error');
               }
          });
          return;
     }
     resetDeleteUser();
     var deleteUserModal = $('<div class="modal fade" id="modal-container-deleteUser" role="dialog" aria-labelledby="deleteUser" aria-hidden="true" />');     
     var deleteUserForm = $('<form class="form" name="deleteAuthUserForm">');
          deleteUserModal.append(deleteUserForm);
     var deleteUserModalDialog = $('<div class="modal-dialog" />');
          deleteUserForm.append(deleteUserModalDialog);
     var deleteUserModalContent = $('<div class="modal-content" />');
          deleteUserModalDialog.append(deleteUserModalContent);
     var deleteUserModalHeader = $('<div class="modal-header" />');               
          deleteUserModalContent.append( deleteUserModalHeader );                      
     var deleteUserModalCloseButton = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>');
          deleteUserModalHeader.append(deleteUserModalCloseButton);
     var deleteUserModalTitle = $('<h4 class="modal-title" id="deleteUser">Delete Auth User</h4>');
          deleteUserModalHeader.append( deleteUserModalTitle );
     var deleteUserModalBody = $('<div class="modal-body" />');                                 
          deleteUserModalContent.append(deleteUserModalBody);
     var deleteUserConfirmationFormElements = $('<div class="checkbox"><label for="deleteUserConfirmation"><input type="checkbox" name="deleteUserConfirmation"/>By checking here you confirm you want to completely delete this user.</label></div>');
          deleteUserModalBody.append(deleteUserConfirmationFormElements);
     var deleteUserModalFooter ='<div class="modal-footer">'+
                                 '<button type="button" class="btn btn-default" data-dismiss="modal">'+
                                  '   Close'+
                                 '</button>'+
                                 '<button type="button" class="btn btn-default" onclick="resetDeleteUser();">'+
                                 '    Reset'+
                                 '</button>'+ 
                                 '<button type="button" class="btn btn-primary" onclick="deleteUser(\''+id+'\');" >'+
                                  '   Save Changes'+
                                 '</button>'+
                             '</div>';
          deleteUserModalContent.append(deleteUserModalFooter);                   
     $('body').append(deleteUserModal);
     $('#modal-container-deleteUser').modal('show');
     return;
}


function viewDisabled()
{
     $.ajax(
       {
          type: 'POST',
          url: '/AuthUsers',
          dataType:'json',
          data:{output:'json',filterType:'disabled'},
          beforeSend: function()
          {
               /*TODO add before alert*/
               console.log('processing');               
          },
          success: function ( responseData )
          {
               authUsers = responseData;
               userFilterType = 'disabled';
               buildUserTable();
          },
          error: function()
          {
               /*TODO add error alert*/
               console.log('error');
          }
     }); 
}

function viewEnabled()
{
     $.ajax(
       {
          type: 'POST',
          url: '/AuthUsers',
          dataType:'json',
          data:{output:'json',filterType:'enabled'},
          beforeSend: function()
          {
               /*TODO add before alert*/
               console.log('processing');               
          },
          success: function ( responseData )
          {                    
               authUsers = responseData;
               userFilterType = 'enabled';
               buildUserTable();
          },
          error: function()
          {
               /*TODO add error alert*/
               console.log('error');
          }
     }); 
}

function buildUserTable()
{
     var userTable = $('<table class="table table-bordered table-condensed" id="authUsers"/>');
     var userTableHead = $('<thead />');
     var userTableRow = $('<tr />');
     var userTableHeadCol = $('<th />');
     var userTableBody = $('<tbody />');
     var userTableCol = $('<td />');
     var userTableHeader = userTableRow.clone();
     var headRow1Col1 = userTableHeadCol.clone().html('ID');
     var headRow1Col2 = userTableHeadCol.clone().html('FIRST NAME');
     var headRow1Col3 = userTableHeadCol.clone().html('LAST NAME');
     var headRow1Col4 = userTableHeadCol.clone().html('USERNAME');
     var headRow1Col5 = userTableHeadCol.clone().html('ROLE');
     var headRow1Col6 = userTableHeadCol.clone().html('ACTIVE');
     var headRow1Col7 = userTableHeadCol.clone();
     userTableHeader.append(headRow1Col1);
     userTableHeader.append(headRow1Col2);
     userTableHeader.append(headRow1Col3);
     userTableHeader.append(headRow1Col4);
     userTableHeader.append(headRow1Col5);
     userTableHeader.append(headRow1Col6);
     userTableHeader.append(headRow1Col7);     
     addUserButton = '<button onclick="$(\'#modal-container-addUser\').modal(\'show\');" class="btn btn-xs btn-success" id="modal-addUser" role="button" title="Add User"><em class="glyphicon glyphicon-plus" style="padding: 3px 3px;"></em> User</button>';
     headRow1Col7.append(addUserButton);
     viewEnabledUsersButton = '<button onclick="viewEnabled();" id="modal-viewEnabledUsers" class="btn btn-xs btn-default" role="button" title="View Enabled"><em class="glyphicon glyphicon-eye-open" style="padding: 3px 3px;"></em>  Enabled</button>';
     viewDisabledUsersButton = '<button onclick="viewDisabled();" id="modal-viewDisabledUsers" class="btn btn-xs btn-warning" role="button" title="View Disabled"><em class="glyphicon glyphicon-eye-close" style="padding: 3px 3px;"></em>  Disabled</button>';
     if(userFilterType == 'disabled')
     {
          headRow1Col7.append(viewEnabledUsersButton);
     }
     else
     {
          headRow1Col7.append(viewDisabledUsersButton);
     }     
     userTableHead.append(userTableHeader);
     userTable.append(userTableHead);
     $.map(authUsers, function(val){
          //console.log(val);
          var userTableBodyRow = userTableRow.clone();
          
          var userTableBodyRowCol1 = userTableCol.clone();
          var userTableBodyRowCol2 = userTableCol.clone();
          var userTableBodyRowCol3 = userTableCol.clone();
          var userTableBodyRowCol4 = userTableCol.clone();
          var userTableBodyRowCol5 = userTableCol.clone();
          var userTableBodyRowCol6 = userTableCol.clone();
          var userTableBodyRowCol7 = userTableCol.clone();
          
          userTableBodyRowCol1.append(val.id);
          userTableBodyRow.append(userTableBodyRowCol1);
          
          
          userTableBodyRowCol2.append(val.first_name);
          userTableBodyRow.append(userTableBodyRowCol2);
          
          
          userTableBodyRowCol3.append(val.last_name);
          userTableBodyRow.append(userTableBodyRowCol3);
          
          
          userTableBodyRowCol4.append(val.username);
          userTableBodyRow.append(userTableBodyRowCol4);
          
          userTableBodyRowCol5.append(val.role);
          userTableBodyRow.append(userTableBodyRowCol5);          
          userTableBodyRowCol6.append(val.active === '1' ? 'Enabled' : 'Disabled');
          userTableBodyRow.append(userTableBodyRowCol6);
          
          
          var userTableBodyButtonGroup = $('<div class="btn-group" />');
          var userProfileButton = '<button class="btn btn-xs btn-info" title="User Profile" onclick="viewUserProfile(\''+val.id+'\');"><em class="glyphicon glyphicon-user" style="padding: 3px 3px;"></em></button>';
          var userPhoneNumbersButton = '<button class="btn btn-xs btn-info" title="User Phone Numbers" onclick="viewUserPhoneList(\''+val.id+'\')"><em class="glyphicon glyphicon-earphone" style="padding: 3px 3px;"></em></button>';
          var userAddressesButton = '<button class="btn btn-xs btn-info" title="User Addresses" onclick="viewUserAddressList(\''+val.id+'\');"><em class="glyphicon glyphicon-envelope" style="padding: 3px 3px;"></em></button>';
          userTableBodyButtonGroup.append(userProfileButton);
          userTableBodyButtonGroup.append(userPhoneNumbersButton);
          userTableBodyButtonGroup.append(userAddressesButton);
          var banUserButton = '<button class="btn btn-xs btn-warning" title="Disable User" onclick="disableUser(\''+val.id+'\');">'+
                                   '<em class="glyphicon glyphicon-eye-close" style="padding: 3px 3px;"></em>'+
                                   '</button>';
          var unBanUserButton = '<button class="btn btn-xs btn-success" title="Enable User" onclick="enableUser(\''+val.id+'\');">'+
                                   '<em class="glyphicon glyphicon-eye-open" style="padding: 3px 3px;"></em></button>';
          var deleteUserButton = '<button class="btn btn-xs btn-danger" title="Delete User" onclick="deleteUser(\''+val.id+'\');"><em class="glyphicon glyphicon-trash" style="padding: 3px 3px;"></em></button>';
          if(val.active === '1')
          {
               userTableBodyButtonGroup.append(banUserButton);
          }
          else
          {
               userTableBodyButtonGroup.append(unBanUserButton);
          }
          userTableBodyButtonGroup.append(deleteUserButton);          
          userTableBodyRowCol7.append(userTableBodyButtonGroup);
          userTableBodyRow.append(userTableBodyRowCol7);          
          userTableBody.append(userTableBodyRow);
          });
     userTable.append(userTableBody);     
     $('#authUsers').replaceWith(userTable);
     userLoadables();
}


function viewUserProfile(id)
{
     var viewUserProfileModal = $('<div class="modal fade" id="modal-container-viewUserProfile" role="dialog" aria-labelledby="viewUserProfile" aria-hidden="true" />');     
     var viewUserProfileForm = $('<form class="form" name="viewUserProfileForm">');
          viewUserProfileModal.append(viewUserProfileForm);
     var viewUserProfileModalDialog = $('<div class="modal-dialog" />');
          viewUserProfileForm.append(viewUserProfileModalDialog);
     var viewUserProfileModalContent = $('<div class="modal-content" />');
          viewUserProfileModalDialog.append(viewUserProfileModalContent);
     var viewUserProfileModalHeader = $('<div class="modal-header" />');               
          viewUserProfileModalContent.append( viewUserProfileModalHeader );                      
     var viewUserProfileModalCloseButton = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>');
          viewUserProfileModalHeader.append(viewUserProfileModalCloseButton);
     var viewUserProfileModalTitle = $('<h4 class="modal-title" id="deleteUser">User Profile</h4>');
          viewUserProfileModalHeader.append( viewUserProfileModalTitle );
     var viewUserProfileModalBody = $('<div class="modal-body" />');
     
          viewUserProfileModalContent.append(viewUserProfileModalBody);
          
     var viewUserProfileConfirmationFormElements = $('<h1>User Profile Under Construction...</h1>');
          viewUserProfileModalBody.append(viewUserProfileConfirmationFormElements);
          
     var viewUserProfileModalFooter ='<div class="modal-footer">'+
                                 '<button type="button" class="btn btn-default" data-dismiss="modal">'+
                                  '   Close'+
                                 '</button>'+
                             '</div>';
          viewUserProfileModalContent.append(viewUserProfileModalFooter);                   
     $('body').append(viewUserProfileModal);
     
     $.ajax(
       {
          type: 'POST',
          url: '/ViewAuthUserProfile',
          dataType:'json',
          data:{output:'json',userId:id,active:true},
          beforeSend: function()
          {
               $('#modal-container-viewUserProfile .modal-body').empty().html('Loading User Profile');
               $('#modal-container-viewUserProfile').modal('show');              
          },
          success: function ( responseData )
          {
               var viewUserProfileWrapper = $('<div class="row" />');               
               $.map(responseData,function(val){
                    
                    viewUserProfileWrapper.append('<div class="col-md-6" ><h4><strong>Role</strong> : ' +val.role + '</h4></div><div class="col-md-6" ><h4><strong>Parent Role</strong> : ' +val.parent !== null ? val.parent : ''+ '</h4></div>');
                    viewUserProfileWrapper.append('<div class="col-md-6" ><h4><strong>First Name</strong> : ' +val.first_name + '</h4></div><div class="col-md-6" ><h4><strong>Last Name</strong> : ' +val.last_name + '</h4></div>');
                    viewUserProfileWrapper.append('<div class="col-md-12 text-center" ><h4><strong>Username</strong> : ' +val.username + '</h4></div>');
                    viewUserProfileWrapper.append('<div class="col-md-12 text-center" ><h4><strong>Email</strong> : ' +val.email + '</h4></div>'); 
               });
               
               console.log( responseData );
               $('#modal-container-viewUserProfile .modal-body').empty().html(viewUserProfileWrapper);
          },
          error: function()
          {
               /*TODO add error alert*/
               $('#modal-container-viewUserProfile .modal-body').empty().html('<strong>Error</strong> Loading User Profile');
          }
     });
     return;
}

function viewUserPhoneList(id)
{
     var viewUserPhoneListModal = $('<div class="modal fade" id="modal-container-viewUserPhoneList" role="dialog" aria-labelledby="viewUserPhoneList" aria-hidden="true" />');     
     var viewUserPhoneListForm = $('<form class="form" name="viewUserPhoneListForm">');
          viewUserPhoneListModal.append(viewUserPhoneListForm);
     var viewUserPhoneListModalDialog = $('<div class="modal-dialog" />');
          viewUserPhoneListForm.append(viewUserPhoneListModalDialog);
     var viewUserPhoneListModalContent = $('<div class="modal-content" />');
          viewUserPhoneListModalDialog.append(viewUserPhoneListModalContent);
     var viewUserPhoneListModalHeader = $('<div class="modal-header" />');               
          viewUserPhoneListModalContent.append( viewUserPhoneListModalHeader );                      
     var viewUserPhoneListModalCloseButton = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>');
          viewUserPhoneListModalHeader.append(viewUserPhoneListModalCloseButton);
     var viewUserPhoneListModalTitle = $('<h4 class="modal-title" id="deleteUser">User Phone List</h4>');
          viewUserPhoneListModalHeader.append( viewUserPhoneListModalTitle );
     var viewUserPhoneListModalBody = $('<div class="modal-body" />');
     
          viewUserPhoneListModalContent.append(viewUserPhoneListModalBody);
          
     var viewUserPhoneListConfirmationFormElements = $('<h1>User Phone List Under Construction...</h1>');
          viewUserPhoneListModalBody.append(viewUserPhoneListConfirmationFormElements);
          
     var viewUserPhoneListModalFooter ='<div class="modal-footer">'+
                                 '<button type="button" class="btn btn-default" data-dismiss="modal">'+
                                  '   Close'+
                                 '</button>'+
                             '</div>';
          viewUserPhoneListModalContent.append(viewUserPhoneListModalFooter);                   
     $('body').append(viewUserPhoneListModal);
     
     $.ajax(
       {
          type: 'POST',
          url: '/ViewAuthUserPhoneList',
          dataType:'json',
          data:{output:'json',userId:id,active:true},
          beforeSend: function()
          {
               $('#modal-container-viewUserPhoneList .modal-body').empty().html('Loading User Phone List');
               $('#modal-container-viewUserPhoneList').modal('show');             
          },
          success: function ( responseData )
          {
               var phoneListTable = $('<table class="table table-bordered table-hover">');
               var phoneListTableHead = $('<thead>');
               var tableRow = $('<tr>');
               var tableCol = $('<td>');
               var tableHeadCol1 = $('<th>ID</th>');
               var tableHeadCol2 = $('<th>TYPE</th>');
               var tableHeadCol3 = $('<th>PHONE</th>');
               var tableHeadCol4 = $('<th><button class="btn btn-xs btn-success">Add Phone</button></th>');
               phoneListTableHeadRow = tableRow.clone();
               phoneListTableHeadRow.append(tableHeadCol1);
               phoneListTableHeadRow.append(tableHeadCol2);
               phoneListTableHeadRow.append(tableHeadCol3);
               phoneListTableHeadRow.append(tableHeadCol4);
               phoneListTableHead.append(phoneListTableHeadRow);
               var phoneListTableBody = $('<tbody/>');
               
                    $.map(responseData, function(val){
                         phoneListTableBodyRow = tableRow.clone();
                         phoneListTableBodyCol1 = tableCol.clone();
                         phoneListTableBodyCol2 = tableCol.clone();
                         phoneListTableBodyCol3 = tableCol.clone();
                         phoneListTableBodyCol4 = tableCol.clone();
                         phoneListTableBodyRow.append(phoneListTableBodyCol1);
                         phoneListTableBodyRow.append(phoneListTableBodyCol2);
                         phoneListTableBodyRow.append(phoneListTableBodyCol3);
                         phoneListTableBodyRow.append(phoneListTableBodyCol4);                    
                         phoneListTableBodyCol1.append(val.id); 
                         phoneListTableBodyCol2.append(val.phone_type); 
                         phoneListTableBodyCol3.append(val.phone);
                         phoneListTableBodyCol4.append('<button class="btn btn-xs">Options</button>');
                         phoneListTableBody.append(phoneListTableBodyRow);
                         });                    
                    

               phoneListTable.append(phoneListTableHead);
               phoneListTable.append(phoneListTableBody);               
               $('#modal-container-viewUserPhoneList .modal-body').empty().html(phoneListTable);
          },
          error: function()
          {
               /*TODO add error alert*/
               $('#modal-container-viewUserPhoneList .modal-body').empty().html('<strong>Error</strong> Loading User Phone List');
          }
     });
     return;
}

function viewUserAddressList(id)
{     
     var viewUserAddressListModal = $('<div class="modal fade" id="modal-container-viewUserAddressList" role="dialog" aria-labelledby="viewUserAddressList" aria-hidden="true" />');     
     var viewUserAddressListForm = $('<form class="form" name="viewUserAddressListForm">');
          viewUserAddressListModal.append(viewUserAddressListForm);
     var viewUserAddressListModalDialog = $('<div class="modal-dialog" />');
          viewUserAddressListForm.append(viewUserAddressListModalDialog);
     var viewUserAddressListModalContent = $('<div class="modal-content" />');
          viewUserAddressListModalDialog.append(viewUserAddressListModalContent);
     var viewUserAddressListModalHeader = $('<div class="modal-header" />');               
          viewUserAddressListModalContent.append( viewUserAddressListModalHeader );                      
     var viewUserAddressListModalCloseButton = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>');
          viewUserAddressListModalHeader.append(viewUserAddressListModalCloseButton);
     var viewUserAddressListModalTitle = $('<h4 class="modal-title" id="deleteUser">User Address List</h4>');
          viewUserAddressListModalHeader.append( viewUserAddressListModalTitle );
     var viewUserAddressListModalBody = $('<div class="modal-body" />');
     
          viewUserAddressListModalContent.append(viewUserAddressListModalBody);
          
     var viewUserAddressListConfirmationFormElements = $('<h1>User Address List Under Construction...</h1>');
          viewUserAddressListModalBody.append(viewUserAddressListConfirmationFormElements);
          
     var viewUserAddressListModalFooter ='<div class="modal-footer">'+
                                 '<button type="button" class="btn btn-default" data-dismiss="modal">'+
                                  '   Close'+
                                 '</button>'+
                             '</div>';
          viewUserAddressListModalContent.append(viewUserAddressListModalFooter);                   
     $('body').append(viewUserAddressListModal);
     $.ajax(
       {
          type: 'POST',
          url: '/ViewAuthUserAddressList',
          dataType:'json',
          data:{output:'json',userId:id,active:true},
          beforeSend: function()
          {
               $('#modal-container-viewUserAddressList .modal-body').empty().html('Loading User Address List');
               $('#modal-container-viewUserAddressList').modal('show');              
          },
          success: function ( responseData )
          {
               var wrapper = $('<div class="row"/>');
               var mainList = $('<ul class="list-unstyled col-md-12">');
               var wrapperCol = $('<div class="col-md-12" />');
               wrapperCol.append(mainList);
               wrapper.append(wrapperCol);              
               $.map(responseData, function(val){
                    var addressEntry = $('<li />');
                    var addressWrapper = $('<div class="row" />');
                    addressEntry.append(addressWrapper);
                    var address_line_1 = $('<div class="col-md-12">' + val.address + '</div>');
                    var address_line_2 = $('<div class="col-md-12">' + val.address_2 + '</div>');
                    var address_line_3 = $('<div class="col-md-12">' + val.city + ', ' + val.state + ' ' + val.postal_code + '</div>');
                    addressWrapper.append(address_line_1);
                    if(val.address_2 !== null && val.address_2 !=='')
                    {
                         addressWrapper.append(address_line_2);
                    }                    
                    addressWrapper.append(address_line_3);
                    mainList.append(addressEntry);
                    });
               
               $('#modal-container-viewUserAddressList .modal-body').empty().html(wrapper);
          },
          error: function()
          {
               /*TODO add error alert*/
               $('#modal-container-viewUserAddressList .modal-body').empty().html('<strong>Error</strong> Loading User Address List');
          }
     });
     return;
}