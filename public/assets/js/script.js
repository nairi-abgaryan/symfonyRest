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
						$('#table tbody').append("<tr><td>"+res[i].fname+"</td><td>"+res[i].lname+"</td><td>"+res[i].email+"</td><td><a class='btn btn-xs btn-primary edit' href='/edit/user/"+res[i].id+"'>edit</span></td><td><span class='btn btn-xs btn-danger delete' onclick="+"deleteRecord('|delete|user|"+res[i].id+"')>delete</a></td></tr>");
					} catch(e) {
						console.log("Can not load resource");
					}
				}
			} else if (url == "/get/numbers") {
				for(let i = 0; i <= res.length; i++){
					try {
						$('#table tbody').append("<tr><td>"+res[i].home+"</td><td>"+res[i].mobile+"</td><td>"+res[i].office+"</td><td><span class='btn btn-xs btn-primary edit' href='/edit/number/"+res[i].userId+"'>edit</a></td><td><a class='btn btn-xs btn-danger delete' onclick="+"deleteRecord('|delete|number|"+res[i].userId+"')>delete</span></td></tr>");
					} catch(e) {
						console.log("Can not load resource");
					}
				}
			}
		}
	});
}

function deleteRecord(url){
	url = url.toString(); //.repace("|", "/");
	url = url.replace(/\|/g, "/");
	$.ajax({
		url: url,
		method: "delete",
		success: function(res) {
			// location.reload();
		}, error: function(res) {
			$('#error').addClass('alert');
			$('#error').html(res.message);
		}
	}); 
}

function updateRecord(){
	let url = "/edit/user/"+$('#id').val();
	$.ajax({
		url: url,
		method: "PUT",
		data: {
			fname: $('#fname').val(),
			lname: $('#lname').val(),
			email: $('#email').val(),
		},
		success: function() {
			window.location.replace("/get/users");
		}, error: function(res) {
			alert("asds")
			$('#error').addClass('alert');
			$('#error').html(res.message);
		}
	}); 
}

function createUser(){
	let data = {
		fname: $('#fname').val(),
		lname: $('#lname').val(),
		email: $('#email').val(),
	};
	$.ajax({
		url: "/add/users",
		method: "POST",
		data: data,
		success: function(res) {
			location.reload();
		}
	});
};

$('#createUser').on('click', createUser); 
$('#updateUser').on('click', updateRecord);
