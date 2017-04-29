<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Lookup extends Auth
{
     public function lookup()
     {
          $lookupType = $this->getRequest()->getParam('lookupType');
          switch($lookupType)
          {
               case 'LastName':
                    return $this->renderAsJSON(array('McDowel','Dennis','McCoy','Bell','Hall'));
                    break;
               
               case 'State':
                    return $this->renderAsJSON(array(
                                                     'Alabama'
                                                     , 'Alaska'
                                                     , 'Arizona'
                                                     , 'Arkansas'
                                                     , 'California'
                                                     , 'Colorado'
                                                     , 'Connecticut'
                                                     , 'Delaware'
                                                     , 'Florida'
                                                     , 'Georgia'
                                                     , 'Hawaii'
                                                     , 'Idaho'
                                                     , 'Illinois'
                                                     , 'Indiana'
                                                     , 'Iowa'
                                                     , 'Kansas'
                                                     , 'Kentucky'
                                                     , 'Louisiana'
                                                     , 'Maine'
                                                     , 'Maryland'
                                                     , 'Massachusetts'
                                                     , 'Michigan'
                                                     , 'Minnesota'
                                                     , 'Mississippi'
                                                     , 'Missouri'
                                                     , 'Montana'
                                                     , 'Nebraska'
                                                     , 'Nevada'
                                                     , 'New Hampshire'
                                                     , 'New Jersey'
                                                     , 'New Mexico'
                                                     , 'New York'
                                                     , 'North Carolina'
                                                     , 'North Dakota'
                                                     , 'Ohio'
                                                     , 'Oklahoma'
                                                     , 'Oregon'
                                                     , 'Pennsylvania'
                                                     , 'Rhode Island'
                                                     , 'South Carolina'
                                                     , 'South Dakota'
                                                     , 'Tennessee'
                                                     , 'Texas'
                                                     , 'Utah'
                                                     , 'Vermont'
                                                     , 'Virginia'
                                                     , 'Washington'
                                                     , 'West Virginia'
                                                     , 'Wisconsin'
                                                     , 'Wyoming')
                                               );
               
                    break;
               case 'FirstName':
               default:
                    return $this->renderAsJSON(array('Michael','Mitch','Mason','David','Frank'));
               break;
          }
          return  $this->renderAsJSON(array('No Results'));
     }
}