var services = ["service1", "service2"];
var services2 = ["Test1", ""];
var services3 = ["Test2"];
var services4 = [""];

var starttime1 = "02:00";

QUnit.test( "hello test", function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});


QUnit.test( "Boolean test", function( assert ) {
  assert.ok( test1() == true, "Passed!" );
});



QUnit.test( "convertTime test", function( assert ) {
  assert.equal( convertTime(15,5), "05:50", "15,5 -> 05:50" );
  assert.equal( convertTime(00,0), "00:00", "0,0 -> 00:00" );
  assert.equal( convertTime(24,00), "", "24,0 -> "  );
  assert.equal( convertTime(1,1), "1:10", "1,1 -> 01:10"  );
  assert.equal( convertTime(01,01), "1:10", "01,01 -> 01:10"  );
  assert.equal( convertTime('a','a'), "", "a,a -> "  );
});

//
// QUnit.test( "displayCheckboxes", function( assert ) {
//
//   var answer = displayCheckboxes( services );
//   var res = "<tr class='col-sm-12'><td class='checkbox-inline checkbox'> <label><input type='checkbox' value = '0' > <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span>" + services[0] + " </label></td><td class='checkbox-inline checkbox'> <label><input type='checkbox' value = '0' > <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span>" + services[1] + " </label></td></tr>";
//   assert.equal( answer , res, "html attributes added as expected" );
//
//    var answer = displayCheckboxes( services2 );
//    var res = "<tr class='col-sm-12'><td class='checkbox-inline checkbox'> <label><input type='checkbox' value = '0' > <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span>Test1 </label></td><td class='checkbox-inline checkbox'> <label><input type='checkbox' value = '0' > <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span> </label></td></tr>";
//    assert.equal( answer , res, "html attributes added as expected" );
//
//     var answer = displayCheckboxes( services3 );
//     var res = "<tr class='col-sm-12'><td class='checkbox-inline checkbox'> <label><input type='checkbox' value = '0' > <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span>Test2 </label></td></tr>";
//     assert.equal( answer , res, "html attributes added not as expected" );
//
//     var answer = displayCheckboxes( services4 );
//     var res = "<tr class='col-sm-12'><td class='checkbox-inline checkbox'> <label><input type='checkbox' value = '0' > <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span> </label></td></tr>"
//     assert.equal( answer , res, "html attributes added as expected" );
// });


QUnit.test( "ShowAvailableRoom test", function( assert ) {
    var answer = ShowAvailableRoom(starttime1);
    var res = "true";
    assert.equal(answer,res, "passed the ShowAvailableRoom test");
});



