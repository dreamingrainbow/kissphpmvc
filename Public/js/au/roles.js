function addRole(newRole,parentId)
{
     $.ajax(
            {
               type: 'POST',
               url: '/',
               dataType:'json',
               data:{role:newRole,parent:parentId},
               beforeSend: function()
               {
                    
                    var alertHtml = '<div class="alert alert-info alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          Loading...'+
                    '     </h4> <strong>Loading Data!</strong> Please Wait</a>'+
                    '</div>';                    
                    $('.alert-wrapper').empty().html(alertHtml);
               },
               success: function ( responseData )
               {
                    $('.alert-wrapper').empty();
               },
               error: function()
               {
                    var alertHtml = '<div class="alert alert-danger alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          Error'+
                    '     </h4> <strong>Error!</strong> Loading Data. Please try again.</a>'+
                    '</div>';                    
                    $('.alert-wrapper').empty().html(alertHtml);
               }
          } 
     );
}

function viewRoleSubordinate( primaryRoleId, primaryRole )
{
     $('.alert-wrapper').empty();
          $.ajax(
            {
               type: 'POST',
               url: '/Roles',
               dataType:'json',
               data:{output:'json',role:primaryRoleId},
               beforeSend: function()
               {
                    $('.modal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    var alertHtml = '<div class="alert alert-info alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          Loading...'+
                    '     </h4> <strong>Searcing...</strong> Gathering subordinate roles for ' + primaryRole +'. Please Wait.</a>'+
                    '</div>';                    
                    $('.alert-wrapper').empty().html(alertHtml);
                    
               },
               success: function ( responseData )
               {
                    $('.alert-wrapper').empty();
                    var bodyContent ='';                    
                    if(responseData.length !== 0 )
                    {
                         go = true;
                         $.each(responseData,function(k,v)
                                {
                                   bodyContent += '        <tr>'+
                                   '            <td>'+
                                   '                '+ v.id +
                                   '            </td>'+
                                   '            <td>'+
                                   '                '+ v.role +
                                   '            </td>'+
                                   '            <td>'+
                                   '                <div class="btn-group">'+
                                   '                    <button class="btn btn-xs btn-info" title="View Subordinate Role" onclick="viewRoleSubordinate(\''+ v.id +'\', \''+ v.role +'\');">'+
                                   '<em class="glyphicon glyphicon-list-alt" style="padding: 3px 3px;"></em></button>'+
                                   '                    <button class="btn btn-xs btn-success" title="Add Subordinate Role" onclick="addRoleSubordinate(\''+ v.id +'\', \''+primaryRoleId+'\');">'+
                                   '<em class="glyphicon glyphicon-plus" style="padding: 3px 3px;"></em></button>'+
                                   '                    <button class="btn btn-xs btn-danger" title="Remove Role & Subordinate Roles" onclick="removeRole(\''+ v.id +'\', \''+ v.role +'\');">'+
                                   '<em class="glyphicon glyphicon-trash" style="padding: 3px 3px;"></em></button>'+
                                   '                </div>'+
                                   '            </td>'+
                                   '        </tr>';                              
                                   });
                    }
                    else
                    {
                         go = false;
                         bodyContent = '<tr><td colspan=3>No Data found!</td></tr>';
                    }
                    var modalBody ='';
                    //console.log($.each(responseData[0],function(k,v){ modalBody += v;}));                    
                    modalBody ='<table class="table table-condensed">'+
                    '    <thead>'+
                    '        <tr>'+
                    '            <th>ID</th>'+
                    '            <th>ROLE</th>'+
                    '            <th></th>'+
                    '        </tr>'+
                    '    </thead> ' +          
                    '    <tbody>'+
                    bodyContent+                   
                    '    </tbody>'+          
                    '</table> ';                    
                    var alertSuccessHtml = '<div class="alert alert-success alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          Subordination role data found!'+
                    '     </h4> <strong>Subordination Data found!</strong> Listed below are the subordinate roles to ' + primaryRole +'.</a>'+
                    '</div>';
                    var alertFailureHtml = '<div class="alert alert-warning alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          No subordination role data found!'+
                    '     </h4> <strong>No subordination data found!</strong> There are no subordinate roles to ' + primaryRole +'.</a>'+
                    '</div>';
                    var alertHtml = go ? alertSuccessHtml : alertFailureHtml;
                    
                    var modalHtml = '<div class="modal fade" id="modal-container-viewRoleSubordinate" role="dialog" aria-labelledby="viewRoleSubordinate" aria-hidden="true">'+
                    '   <form class="form">'+
                    '       <div class="modal-dialog-lg" style="padding-right:16px;">'+
                    '           <div class="modal-content">'+
                    '               <div class="modal-header">'+
                    '                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">'+
                    '                       <em class="glyphicon glyphicon-remove"></em>'+
                    '                   </button>'+
                    '                   <h4 class="modal-title" id="viewRoleSubordinate">'+
                    '                       View Role Subordinates for : <strong>' + primaryRole +'</strong>'+
                    '                   </h4>'+
                    '               </div>'+
                    '               <div class="modal-body">'+
                    alertHtml+
                    modalBody+
                    '               </div>'+
                    '               <div class="modal-footer">'+
                    '                   <button type="button" class="btn btn-default" data-dismiss="modal">'+
                    '                       Close'+
                    '                   </button>' +
                    '                   <button type="button" class="btn btn-primary" onclick="addParentRole();">'+
                    '                       Save changes'+
                    '                   </button>'+
                    '               </div>'+
                    '           </div>	'+
                    '       </div>'+
                    '   </form> '+
                    '</div>';
                    $('.alert-wrapper').append(modalHtml);    
                    $('#modal-container-viewRoleSubordinate').modal('show');
               },
               error: function()
               {
                    var alertHtml = '<div class="alert alert-danger alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          Error'+
                    '     </h4> <strong>Error!</strong> Loading subordinate role data. Please try again.</a>'+
                    '</div>';                    
                    $('.alert-wrapper').empty().html(alertHtml);
               }
          } 
     );    

}


function removeRole(roleId, role)
{
                    var alertHtml = '<div class="alert alert-danger alert-dismissable">'+
                    '     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                    '          <em class="glyphicon glyphicon-remove"></em>'+
                    '     </button>'+
                    '     <h4>'+
                    '          Remove Role <strong>'+role+'</strong>'+
                    '     </h4> <strong>Error!</strong> Loading Data. Please try again.</a>'+
                    '</div>';
                    $('.alert-wrapper').empty().html(alertHtml);
                    //$('#modal-container-viewRoleSubordinate').modal('show');
}