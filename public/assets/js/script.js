$(document).ready(function(){
	if (location.pathname == "/get/users" || location.pathname == "/get/numbers") {
		let url = location.pathname;
		$.ajax({
			url: url,
			method: "GET",
			success: function(res){
				res = JSON.parse(res);
				$('#table').append('<tbody></tbody>');
				if (url == "/get/users") {
					for(let i = 0; i <= res.length; i++){
						try {
							$('#table tbody').append("<tr><td>"+res[i].fname+"</td><td>"+res[i].lname+"</td><td>"+res[i].email+"</td><td><a class='btn btn-xs btn-primary edit' href='/edit/user/"+res[i].id+"'>edit</span></td><td><span class='btn btn-xs btn-danger delete' data-href='/delete/user/"+res[i].id+"'>delete</a></td></tr>");
						} catch {
							//
						}
					}
				} else if (url == "/get/numbers") {
					for(let i = 0; i <= res.length; i++){
						try {
							$('#table tbody').append("<tr><td>"+res[i].home+"</td><td>"+res[i].mobile+"</td><td>"+res[i].office+"</td><td><span class='btn btn-xs btn-primary edit' href='/edit/number/"+res[i].userId+"'>edit</a></td><td><a class='btn btn-xs btn-danger delete' data-href='/delete/number/"+res[i].userId+"'>delete</span></td></tr>");
						} catch {
							//
						}
					}
				}
			}
		});
	}

	$('.delete').on('click', function(){
		let url = $(this).attr('href');
		$.ajax({
			url: url,
			method: "delete",
			success: function() {
				location.reload();
			}, error: function(res) {
				$('#error').addClass('alert');
				$('#error').html(res.message);
			}
		}); 
	});

	$('.edit').on('click', function(){
		let url = $(this).attr('href');
		$.ajax({
			url: url,
			method: "put",
			success: function() {
				location.reload();
			}, error: function(res) {
				$('#error').addClass('alert');
				$('#error').html(res.message);
			}
		}); 
	});

	$('#createUser').on('click', function(){
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
				$('#message').html(res.success);
			}
		});
	});

});