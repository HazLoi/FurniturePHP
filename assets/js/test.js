function showPass() {
	let a = document.getElementById("password");
	let b = document.getElementById("showPass");
	if (a.type == "password") {
		 a.type = "text";
		 b.innerHTML = "Ẩn mật khẩu";
	} else {
		 a.type = "password";
		 b.innerHTML = "Hiện mật khẩu";
	}
};

function showRePass() {
	let a = document.getElementById("repassword");
	let b = document.getElementById("showRePass");
	if (a.type == "password") {
		 a.type = "text";
		 b.innerHTML = "Ẩn mật khẩu";
	} else {
		 a.type = "password";
		 b.innerHTML = "Hiện mật khẩu";
	}
};


function showPassOld() {
	let x = document.getElementById("passwordOld");
	let y = document.getElementById("showPassOld");
	if (x.type == "password") {
		x.type = "text";
		y.innerHTML = "Ẩn mật khẩu";
	} else {
		x.type = "password";
		y.innerHTML = "Hiện mật khẩu";
	}
};

function showPassNew() {
	let x = document.getElementById("passwordNew");
	let y = document.getElementById("showPassNew");
	if (x.type == "password") {
		x.type = "text";
		y.innerHTML = "Ẩn mật khẩu";
	} else {
		x.type = "password";
		y.innerHTML = "Hiện mật khẩu";
	}
};

function showPassRenew() {
	let x = document.getElementById("passwordRenew");
	let y = document.getElementById("showPassRenew");
	if (x.type == "password") {
		x.type = "text";
		y.innerHTML = "Ẩn mật khẩu";
	} else {
		x.type = "password";
		y.innerHTML = "Hiện mật khẩu";
	}
};