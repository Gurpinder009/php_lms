function menu() {
  let x = document.documentElement.style;
  if (document.querySelector("#drawer").offsetWidth !== 0) {
    x.setProperty("--width-drawer", "0em");
  } else {
    x.setProperty("--width-drawer", "16em");
  }
}

function toggle_password_visibility(signPassword) {
  console.log("working");
  let x = document.getElementById(signPassword);
  x.getAttribute("type") === "password"
    ? x.setAttribute("type", "text")
    : x.setAttribute("type", "password");
}

function unverified(e, text) {
  e.style.border = "2px solid red";
  x = document.getElementById(e.name + "-error");
  x.innerText = text ? text : "Invalid Text";
  x.style.color = "red";
  // if (e.getAttribute("onkeydown") === null) {
  //   e.setAttribute("onkeydown", "validateEmail(this)");
  // }
}

function verified(e) {
  x = document.getElementById(e.name + "-error");
  x.innerText = "Looks Good";
  x.style.color = "green";
  e.style.border = "1.5px solid 	rgba(0,255,0,0.6)";
}

function validateDate(e){
  e.value = e.value.trim();
  if(e.value != ""){
    verified(e);
    return true;
  }
  else{
    unverified(e,"Valid date is required");
    return false;
  }
}


function validateName(e) {
  e.value = e.value.trim();
  let NamePattern = /^[a-z ]+$/i;
  if (NamePattern.test(e.value) === false) {
    unverified(e, "Only Alpabets are allowed");
    return false;
  } else if (e.value.length < 3) {
    unverified(e, "Invalid length 3 is minimum");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validateEmail(e) {
  e.value = e.value.trim();
  if (e.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/) == null) {
    unverified(e, "Valid Email address is required");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validateNumber(e) {
  e.value = e.value.trim();
  let NumberPattern = /^[0-9]+$/;
  if (NumberPattern.test(e.value) === false) {
    unverified(e, "Only Number are allowed");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validatePhoneNum(e) {
  e.value = e.value.trim();
  let PhoneNumberPattern = /^[0-9]+$/;
  if (PhoneNumberPattern.test(e.value) == false) {
    unverified(e, "Only Numbers are allowed");
    return false;
  } else if (e.value.length < 10) {
    unverified(e, "Length must exceed 9 digits");
    return false;
  } else {
    verified(e);
    return true;
  }
}



function validatePinCode(e) {
  e.value = e.value.trim();
  let PinPattern = /^[0-9]+$/i;
  if (PinPattern.test(e.value) === false) {
    unverified(e, "Pin-codes only contains numbers");
    return false;
  } else if (e.value.length < 5) {
    unverified(e, "Invalid length 5 is minimum");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validatePassword(e) {
  e.value = e.value.trim();
  let NumberPattern = /[0-9]{2,}/;
  let AlphabetsPattern = /[a-z]{3,}/;
  let SpecialPattern = /[@_]{1,}/;

  if (AlphabetsPattern.test(e.value) === false) {
    unverified(e, "Atleast 3 alphabets are required");
    return false;
  } else if (NumberPattern.test(e.value) === false) {
    unverified(e, "Atleast 2 numbers are required");
    return false;
  } else if (SpecialPattern.test(e.value) === false) {
    unverified(e, "Atleast 1 Special Characters(@,_) are required");
    return false;
  }
  {
    verified(e);
    return true;
  }
}

function validateConfirmPassword(e) {
  e.value = e.value.trim();
  x = document.getElementById("signPassword");
  if (x.value !== e.value) {
    unverified(e, "Passwords don't match");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validateURForm(e) {
  return (
    validateName(e["name"]) &&
    validateEmail(e["email"]) &&
    validatePhoneNum(e["phone_num"]) &&
    validateDateOfBirth(e["dob"]) &&
    validateName(e["city"]) &&
    validateName(e["state"]) &&
    validateName(e["country"]) &&
    validatePinCode(e["pin_code"]) &&
    validatePassword(e["password"]) &&
    validateConfirmPassword(e["confirmPassword"])
  );
}

function validateULForm(e) {
  return validateEmail(e["email"]) && validatePassword(e["password"]);
}

function validateBookForm(e) {
  return (
    validateName(e["title"]) &&
    validateNumber(e["no_of_copies"]) &&
    validateCondtion(e["condition"]) &&
    validateNumber(e["edition"]) &&
    validateName(e["language"])
  );
}

function validateCondtion(e) {
  e.value = e.value.trim();
  let conditionPattern = /(bad|good|best)/;
  if (conditionPattern.test(e.value) === false) {
    unverified(e, "Invalidate Condtion");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validateTitle(e) {
  e.value = e.value.trim();
  let NamePattern = /^[a-z '_]+$/i;
  if (NamePattern.test(e.value) === false) {
    unverified(e, "Only name is allowed");
    return false;
  } else if (e.value.length < 3) {
    unverified(e, "Invalid length 3 is minimum");
    return false;
  } else {
    verified(e);
    return true;
  }
}

function validateAuthorForm(e) {
  return validateName(e["name"]);
}

function validateCategoryForm(e) {
  return validateTitle(e["title"]);
}

function validatePublisherForm(e) {
  return validateTitle(e["name"]);
}

document.addEventListener("click", (e) => {
  let dropDown = e.target.matches("[drop-down]");
  let dropDownBtn = e.target.matches("[drop-down-btn]");
  if (!dropDown && !dropDownBtn) {
    closeAll();
    console.log("click 1");
  } else if (!dropDown && dropDownBtn) {
    closeAll();
    e.target.nextElementSibling.classList.toggle("active");
  } else return;
});

function closeAll() {
  x = document.querySelectorAll("[drop-down]");
  x.forEach((el) => {
    el.classList.remove("active");
  });
}

function closeAlert(e) {
  e.style.display = "none";
}

function searchBooks(e) {
  axios
    .get(`/search-books?title=${e["search_box"].value}`)
    .then((res) => {
      document.getElementById("element").innerHTML = "";
      res.data.map((values) => {
        document.getElementById("element").innerHTML += documentWrite(values);
      });
    })
    .catch((error) => error);
}

function documentWrite(values) {
  return `<tr>
        <td data-label="Accession Number">${values.accession_no}</td>
        <td data-label="Title">${values.title}</td>
        <td data-label="Publisher">${values.publisher_name}</td>
        <td data-label="language">${values.language}</td>
        <td data-label="page_count">${values.page_count}</td>
        <td data-label="year_of_publication">${values.year_of_publication}</td>
        <td data-label="condition">${values.condition}</td>
        <td data-label="author">${values.author_name}</td>
        <td data-label="categories">${values.category_name}</td>
        <td data-label="Edit"><a href="/edit/book/${values.accession_no}">Edit</a></td>
        
        </tr>`;
}

function SearchBooks(e) {
  axios
    .get(`/search-books?title=${e["search_box"].value}`)
    .then((res) => {
      document.getElementById("element").innerHTML = "";
      res.data.map((values) => {
        document.getElementById("element").innerHTML += documentWriteSubscriber(values);
      });
    })
    .catch((error) => error);
}


function documentWriteSubscriber(values) {
  return `<tr>
        <td data-label="Accession Number">${values.accession_no}</td>
        <td data-label="Title">${values.title}</td>
        <td data-label="Publisher">${values.publisher_name}</td>
        <td data-label="language">${values.language}</td>
        <td data-label="page_count">${values.page_count}</td>
        <td data-label="year_of_publication">${values.year_of_publication}</td>
        <td data-label="condition">${values.condition}</td>
        <td data-label="author">${values.author_name}</td>
        <td data-label="categories">${values.category_name}</td>
        
        </tr>`;
}

function test() {
  console.log("working");
}
