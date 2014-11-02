<?PHP
    /* 
       Murdoch University - ICT333 - F03 - ISCon - TSA14

       Author: MyVi14
       Date: 22 September 2014
       Purpose: Starting point of the web abb
    */

  require_once '../app/init.php';
  
  /* 
   * URL will be processed by App class.
   * 
   * URL format: http:[address]/[typeOfFolder]/[controllerName]/[methodName]/[parameter]/[parameter]
   *    typeOfFolder: public for everyone, private for authorised users
   *    controllerName: name of the controller which the site is requesting. e.g. Home, ISC
   *    methodName: method of the aforedmention controller. This method will do business logic
   *    parameter: parameter that can be used for method
   * 
   * e.g. http://localhost/MVCSimple/public/home/index
   * Call method index of controller home from folder public
   */
  $app = new App;
?>

