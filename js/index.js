// Anonymous function which manage the NavBar

(() => {
  const openMenu = document.querySelector(".open-menu");
  const closeMenu = document.querySelector(".close-menu");
  const navMenu = document.querySelector("nav");
  const content = document.querySelector("header");
  const dropdown = document.querySelector(".dropdown");
  const filterIcon = document.querySelector(".filter-icon");

  const toggleMenu = () => {
    navMenu.classList.toggle("open");
    openMenu.classList.toggle("none");
    content.classList.toggle("opacity");
  };

  if (dropdown) {
    dropdown.addEventListener("click", () => {
      document.querySelector(".dropdown-menu").classList.toggle("active");
    });
  }

  if (filterIcon) {
    filterIcon.addEventListener("click", () => {
      document
        .querySelector(".dropdown-filter-menu")
        .classList.toggle("active");
    });
  }

  openMenu.addEventListener("click", toggleMenu);
  closeMenu.addEventListener("click", toggleMenu);
})();

// Form Management

const eyeIcon = document.getElementById("view-password");
const passwordInput = document.querySelector('input[type="password"]');
const inputs = document.querySelectorAll(".register-form input");
const progressBar = document.getElementById("progress-bar");
// let username, password, email, lastName;
let password;

if (eyeIcon != null) {
  eyeIcon.addEventListener("click", () => {
    if (eyeIcon.classList.contains("fa-eye-slash")) {
      eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
      passwordInput.type = "text";
    } else {
      eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
      passwordInput.type = "password";
    }
  });
}

/**
 * Help to display error when user type
 * @param {String} tag - Input value name
 * @param {String} message - What will be displayed if an error occurs
 * @param {Boolean} valid - Boolean which indicate if an error occurs
 */
const errorDisplay = (tag, message, valid) => {
  const container = document.querySelector("." + tag + "-container");
  const span = document.querySelector("." + tag + "-container > span");

  if (!valid) {
    container.classList.add("error");
    span.textContent = message;
  } else {
    container.classList.remove("error");
    span.textContent = "";
  }
};

/**
 * Check the username and the lastName
 * @param {String} value - The value of the username's field
 * @param {String} tag - Specifies the kind of name is going to be handled
 */
const usernamesChecker = (value, tag) => {
  if (value.length < 3 || value.length > 20) {
    errorDisplay(
      tag,
      "Le nom d'utilisateur doit faire entre 3 et 20 caractères."
    );
    // return null;
  } else {
    errorDisplay(tag, "", true);
    // return value;
  }
};

/**
 * Check the email
 * @param {String} value - The value of email's field
 */
const emailChecker = (value) => {
  if (!value.match(/^[\w_-]+@[\w]+\.[a-z]{2,4}$/)) {
    errorDisplay("email", "Email invalide");
  } else {
    errorDisplay("email", "", true);
  }
};

/**
 * Check the password
 * @param {String} value - The value of password's field
 */

const passwordChecker = (value) => {
  progressBar.classList = "";

  if (!value.match(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/)) {
    errorDisplay(
      "password",
      "Le mot de passe doit faire au moins 8 caractères, doit inclure une majuscule, un chiffre et ne doit pas contenir de caractères spéciaux"
    );
    progressBar.classList.add("progress-third");
    password = null;
  } else if (value.length < 12) {
    errorDisplay("password", "", true);
    progressBar.classList.add("progress-two-third");
    password = value;
  } else {
    errorDisplay("password", "", true);
    progressBar.classList.add("progress-complete");
    password = value;
  }
};

inputs.forEach((input) => {
  input.addEventListener("input", (e) => {
    switch (e.target.id) {
      case "username":
        usernamesChecker(e.target.value, "username");
        break;
      case "lastName":
        usernamesChecker(e.target.value, "lastName");
        break;
      case "email":
        emailChecker(e.target.value);
        break;
      case "password":
        passwordChecker(e.target.value);
        break;
      default:
        null;
    }
  });
});

const registerForm = document.querySelector(".register-form");
if (registerForm) {
  registerForm.addEventListener("submit", (e) => {
    if (!password) {
      e.preventDefault();
    }
  });
}
