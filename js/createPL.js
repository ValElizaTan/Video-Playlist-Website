$(function () {

    var itemNameArray = []; // initialise empty array for item names

    $(".add_button").on("click", function () {
        var itemID = $(this).attr('name');

        itemNameArray.push(itemID);

        //alert($("#img_".itemID).attr('src'));
        var output = "<hr>";
        output = output + "<table class='itemtable'><tr><th class='leftalign'>Item</th> <th>Title</th></tr>"; // add table headers to the output
        for (var i = 0; i < itemNameArray.length; i++) { // for each of the food item in the array, we will extract the name, price and qty.             

            itemID = itemNameArray[i];
            var namefile = $("#name_" + itemID).text();
            output = output + "<tr ><td class='leftalign'>" + itemNameArray[i] + "</td> <td><div class='iconsimg'>" + namefile + "</div></td></tr>";

        }
        output = output + "</table><hr>";
        output = output + "<input type='text' name='addedLists' hidden value='" + itemNameArray.toString() + "'/>"; // ending of table and add a horizontal rule/line.

        $("#itemised").html(output); // set the itemised div with generated content 


    });

});


var videos = document.querySelectorAll('video');
for (var i = 0; i < videos.length; i++)
    videos[i].addEventListener('play', function () { pauseAll(this) }, true);


function pauseAll(elem) {
    for (var i = 0; i < videos.length; i++) {

        //Is this the one we want to play?
        if (videos[i] == elem) continue;

        //Have we already played it && is it already paused?
        if (videos[i].played.length > 0 && !videos[i].paused) {
            // Then pause it now
            videos[i].pause();
        }
    }
}



