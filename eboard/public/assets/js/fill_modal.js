function fillModal (title, description, link, date_pub, username, mail, phone) {
    
    $('#adTitle').html('<span class="glyphicon glyphicon-pushpin"></span> ' + title);

    $('#modalImage').css('background-image', 'url("' + link + '")');
    $('#adDescription').html(description);
    $('#contactsPanel').html('<p class = "lead"><span class="glyphicon glyphicon-user"></span> Published by <b>' + username + '</b> on date ' + date_pub + '</p> <p class = "lead"><span class="glyphicon glyphicon-envelope"></span> ' + mail + '</p> <p class = "lead"><span class="glyphicon glyphicon-phone"></span> ' + phone + '</p>');
    //$('#adBody').html(title + " " + description + " " + link + " " + date_pub + " " + date_until + " " + username + " " + mail + " " + phone);
    $('#adModal').modal('show');
    
  }


function fillModalMod (title, description, link, username, adclass) {
    
    $('#adTitle').html('<span class="glyphicon glyphicon-pushpin"></span> ' + title);

    $('#modalImage').css('background-image', 'url("' + link + '")');
    $('#adDescription').html(description);
    $('#contactsPanel').html('<p class = "lead"><span class="glyphicon glyphicon-user"></span> Published by <b>' + username + '</b></p>');

    setActions(adclass);

    $('#adModal').modal('show');
    
  }