function validateProductInfo() {
    let arr = ['pname', 'price', 'discount', 'qty', 'img_path', 'processor', 'ram', 'storage', 'display', 'battery', 'graphics', 'color'];
    let contentArr = ['Product Name', 'Price', 'Discount', 'Quantity', 'Image Path', 'Processor', 'RAM', 'Storage', 'Display', 'Battery', 'Graphics', 'Color']


    for (let i = 0; i < 4; i++) {
        let content = document.forms['product-form'][arr[i]];
        // alert(arr[i] + " " + content.value);


        if (content.value == '') {
            alert('Cannot Have Empty ' + contentArr[i]);
            return false;
        } else if (arr[i] === 'price' || arr[i] === 'discount' || arr[i] === 'qty') {
            if (isNaN(content.value)) {
                alert(contentArr[i] + " must be a number!");
                return false;
            }
            if (content.value < 0) {
                alert(contentArr[i] + " Cannot be less than 0!");
                return false;
            }
            if (arr[i] === 'discount') {
                if (content.value > 100) {
                    alert("Discount cannot be Greater than 100!");
                    return false;
                }
            }

        }
    }
    return true;
}

function validateCatagory() {
    let catName = document.forms["form-3"]['cat_name'].value;
    if (catName == "") {
        alert('Catagory cannot Be Empty!');
        return false;
    } else {
        alert('Catagory Has been Set !\nEnter a product to Start it!');
        return true;
    }
}

function validateAdminInfo() {
    let Aname = document.forms["form-2"]['admin_name'].value;
    let pswd = document.forms["form-2"]['admin_pswd'].value;
    let Cpswd = document.forms["form-2"]['confirm_pswd'].value;
   
    if (Aname == "") {
        alert('Admin name cannot be empty');
        return false;
    } else if (pswd == "") {
        alert('Password cannot be empty');
        return false;
    } else if (Cpswd == "") {
        alert('Confirm Password cannot be empty');
        return false;
    } else if (pswd.length < 8) {
        alert('Password is too small');
        return false;
    } else if (pswd !== Cpswd) {
        alert('Confirm password and password do not MATCH');
        return false;
    } else {
        return true;
    }
}