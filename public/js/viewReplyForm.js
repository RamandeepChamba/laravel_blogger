/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/viewReplyForm.js":
/*!***************************************!*\
  !*** ./resources/js/viewReplyForm.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.getElementById('app').addEventListener('click', function (e) {
  var clist = e.target.classList;

  if (clist.contains('renderReplyForm') || clist.contains('renderEditForm')) {
    // Render Form
    var renderForm = function renderForm(form, formToggleButton) {
      formToggleButton.insertAdjacentHTML('beforebegin', form);
      formToggleButton.disabled = false; // Toggle button

      formToggleButton.classList.remove($editing ? 'renderEditForm' : 'renderReplyForm');
      formToggleButton.classList.add($editing ? 'cancelEditForm' : 'cancelReplyForm');
      formToggleButton.innerHTML = 'Cancel';
    }; // - Make Ajax call and get form


    var makeRequest = function makeRequest(url, data, formToggleButton) {
      axios.post(url, data).then(function (response) {
        renderForm(response.data, formToggleButton);
      })["catch"](function (error) {
        console.log(error);
      });
    }; // -- Send blog and parent id


    $editing = clist.contains('renderEditForm'); // Prevent double click

    e.target.innerHTML = 'Wait...';
    e.target.disabled = true;
    var url = '/comments/getForm';
    var comment = {};

    if ($editing) {
      comment['comment_id'] = e.target.dataset.comment_id;
    } else {
      comment['parent_id'] = e.target.dataset.parent_id;
      comment['blog_id'] = e.target.dataset.blog_id;
    } // -- Get response
    // - Display the form


    var form;
    makeRequest(url, comment, e.target);
  } else if (clist.contains('cancelReplyForm') || clist.contains('cancelEditForm')) {
    $editing = clist.contains('cancelEditForm');
    e.target.disabled = true; // Remove Form

    e.target.parentNode.removeChild(e.target.previousElementSibling); // Toggle button

    e.target.classList.remove($editing ? 'cancelEditForm' : 'cancelReplyForm');
    e.target.classList.add($editing ? 'renderEditForm' : 'renderReplyForm');
    e.target.innerHTML = $editing ? 'Edit' : 'Reply';
    e.target.disabled = false;
  }
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************!*\
  !*** multi ./resources/js/viewReplyForm.js ./resources/sass/app.scss ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/vagrant/code/blog/resources/js/viewReplyForm.js */"./resources/js/viewReplyForm.js");
module.exports = __webpack_require__(/*! /home/vagrant/code/blog/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });