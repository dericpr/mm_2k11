/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
  $('.error').hide();
  $(".button").click(function() {
    // validate and process form here

    $('.error').hide();
      var name = $("input#email").val();
        if (name == "") {
      $("label#email_error").show();
      $("input#email").focus();
      return false;
    }

    var password = $("input#password").val();
        if (password == "") {
      $("label#password_error").show();
      $("input#password").focus();
      return false;
    }
  });
});

