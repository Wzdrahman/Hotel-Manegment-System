// read more function for subcategories

$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 15;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "read more >";
    var lesstext = "hide";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

// form to get the bill receipt

function row(category_id,name, price) {
  this.category_id = category_id;
  this.name = name;
  this.price = price;
}
  
function model() {
  this.rows = [];
}

var mymodel = new model();

$(document).ready(function() {
//draw();

  $("body").on("click", ".delete", function() {
    var row = $(this).data('row');
    mymodel.rows.splice(row,1);
    draw();
  });

  $('.buy').click(function() {
   mymodel.rows.push(new row
     ($(this).data('category_id'),
     $(this).data('name'),
     $(this).data('price')
    ))
    draw();                                                                             
});
})

function draw() {
  $('tbody').empty();
  var totalPrice = 0;
  $.each(mymodel.rows, function(i, row) {
    totalPrice += row.price;
    var myrow = '<tr>'
    $.each(row, function(key, value) {
      myrow += '<td>' + value + '</td>'
    });
    myrow += '<td><input type="button" class="btn btn-danger delete" data-row="' + i + '" value="X"/></td>'
    myrow += '</tr>'
    $('tbody').append(myrow);
  });
  $('#totalPrice').text(totalPrice);
  '</br>';

}

 // function show receipt button









// $('#menu').children('li').on('click', function(){
//  var categoryId = $(this).val();
    
//    $.ajax({
//      url: '/table/' + categoryId,
//      method: 'GET',
//      dataType: 'json',
//      success: function(response){
      
//        response.forEach(function(item){

//          var d = $('div');

//          d.append(item.name);

//          $( "#2" ).append( d );
//        })

//        //console.log(response);
        
        
//        // return;

        
//      },

//    });
// });
