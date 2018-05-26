$('#table').on('load', getData(location.pathname));

function getData(url) {
	$.ajax({
		uri: url,
		method: "GET",
		success: function(res){
			res = JSON.parse(res);
			$('#table').append('<tbody></tbody>');
			if (url == "/get/users") {
				for(let i = 0; i <= res.length; i++){
					try {
						$('#table tbody').append("<tr><td>"+res[i].fname+"</td><td>"+res[i].lname+"</td><td>"+res[i].email+"</td><td><a class='btn btn-xs btn-primary edit' href='/edit/user/"+res[i].id+"'>edit</span></td><td><span class='btn btn-xs btn-danger delete' onclick="+"deleteRecord('/delete/user/"+res[i].id+"')>delete</a></td></tr>");
					} catch(e) {
						console.log("Can not load resource");
					}
				}
			} else if (url == "/get/numbers") {
				for(let i = 0; i <= res.length; i++){
					try {
						$('#table tbody').append("<tr><td>"+res[i].home+"</td><td>"+res[i].mobile+"</td><td>"+res[i].office+"</td><td><a class='btn btn-xs btn-primary edit' href='/edit/number/"+res[i].id+"'>edit</a></td><td><a class='btn btn-xs btn-danger delete' onclick="+"deleteRecord('/delete/number/"+res[i].id+"')>delete</span></td></tr>");
					} catch(e) {
						console.log("Can not load resource");
					}
				}
			}
		}
	});
}

function deleteRecord(url){
	$.ajax({
		url: url,
		method: "delete",
		success: function(res) {
			location.reload();
		}, error: function(res) {
			$('#error').addClass('alert');
			$('#error').html(res.message);
		}
	}); 
}

function updateRecord(alias){
	let url = "/edit/"+alias+"/"+$('#id').val();
	let data;
	if (alias == 'user') {
		data = {
			fname: $('#fname').val(),
			lname: $('#lname').val(),
			email: $('#email').val(),
		};
	} else if (alias == 'number') {
		data = {
			user_id: 	$('#userId').val(),
			home: 		$('#home').val(),
			office: 	$('#office').val(),
			mobile: 	$('#mobile').val(),
		}
	}
	$.ajax({
		url: url,
		method: "PUT",
		data: data,
		success: function() {
			window.location.replace("/get/"+alias+"s");
		}, error: function(res) {
			$('#error').addClass('alert');
			$('#error').html(res.message);
		}
	}); 
}

function createUser(alias){
	let data;
	if (alias == 'user') {
		data = {
			fname: $('#fname').val(),
			lname: $('#lname').val(),
			email: $('#email').val(),
		};
	} else if (alias == 'numbers') {
		data = {
			user_id: 	$('#userId').val(),
			home: 		$('#home').val(),
			office: 	$('#office').val(),
			mobile: 	$('#mobile').val(),
		}
	}
	$.ajax({
		url: "/add/"+alias,
		method: "POST",
		data: data,
		success: function(res) {
			location.reload();
		}
	});
};

$('#createRecord').on('click', function(){
	let alias = $('#alias').val();
	createRecord(alias);
}); 
$('#updateRecord').on('click', function(){
	let alias = $('#alias').val();
	updateRecord(alias);
});
