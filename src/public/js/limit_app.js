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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/limit_app.js":
/*!***********************************!*\
  !*** ./resources/js/limit_app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

$(document).ready(function () {
  $('.modal.show').modal('show');
});
$('#confirmDeleteCompany').on('show.bs.modal', function (e) {
  //get data-id attribute of the clicked element
  var company_del_link = $(e.relatedTarget).data('company_del_link');
  $("#delForm").attr('action', company_del_link);
});
$('#confirmDeleteGsz').on('show.bs.modal', function (e) {
  //get data-id attribute of the clicked element
  var gsz_del_link = $(e.relatedTarget).data('gsz_del_link');
  $("#delForm").attr('action', gsz_del_link);
});
$('#editCompany').on('show.bs.modal', function (e) {
  var company_name = $(e.relatedTarget).data('company_name');
  var company_action = $(e.relatedTarget).data('company_action');
  var company_inn = $(e.relatedTarget).data('company_inn');
  var company_opf = $(e.relatedTarget).data('company_opf');
  var company_sno = $(e.relatedTarget).data('company_sno');
  var company_date_registr = $(e.relatedTarget).data('company_date_registr');
  var company_date_begin_work = $(e.relatedTarget).data('company_date_begin_work');
  var modal = $(this);

  if (company_name != null) {
    modal.find('.invalid-feedback').remove();
    modal.find('.is-invalid').removeClass('is-invalid');
    modal.find('#edit_name_company').val(company_name);
    modal.find('#edit_inn').val(company_inn);
    modal.find('#edit_opf').val(company_opf);
    modal.find('#edit_sno').val(company_sno);
    modal.find('#edit_date_registr').val(company_date_registr);
    modal.find('#edit_date_begin_work').val(company_date_begin_work);
    modal.find("#edit_companyForm").attr('action', company_action);
  }
});
$('#editGsz').on('show.bs.modal', function (e) {
  var gsz_action = $(e.relatedTarget).data('gsz_action');
  var gsz_brief_name = $(e.relatedTarget).data('gsz_brief_name');
  var gsz_full_name = $(e.relatedTarget).data('gsz_full_name');
  var modal = $(this);

  if (gsz_brief_name != null) {
    modal.find('.invalid-feedback').remove();
    modal.find('.is-invalid').removeClass('is-invalid');
    modal.find('#edit_brief_name').val(gsz_brief_name);
    modal.find('#edit_full_name').val(gsz_full_name);
    modal.find("#edit_gszForm").attr('action', gsz_action);
  }
});
$('#editDate').on('show.bs.modal', function (e) {
  var gsz_date_action = $(e.relatedTarget).data('gsz_date_action');
  var gsz_brief_name = $(e.relatedTarget).data('gsz_brief_name');
  var gsz_date = $(e.relatedTarget).data('gsz_date');
  var modal = $(this);

  if (gsz_brief_name != null) {
    modal.find('.invalid-feedback').remove();
    modal.find('.is-invalid').removeClass('is-invalid');
    modal.find('#modal-title').text('Дата расчета лимита для ' + gsz_brief_name);
    modal.find('#date_calc_limit').val(gsz_date);
    modal.find("#editDateForm").attr('action', gsz_date_action);
  }
});
$('#editCreditInfo').on('show.bs.modal', function (e) {
  var credit_info_action = $(e.relatedTarget).data('credit_info_action');
  var gsz_name = $(e.relatedTarget).data('gsz_name');
  var credit_info_month = $(e.relatedTarget).data('credit_info_month');
  var credit_info_sum = $(e.relatedTarget).data('credit_info_sum');
  var credit_info_stavka = $(e.relatedTarget).data('credit_info_stavka');
  var modal = $(this);

  if (gsz_name != null) {
    modal.find('.invalid-feedback').remove();
    modal.find('.is-invalid').removeClass('is-invalid');
    modal.find('#modal-title').text('Данные кредита для ' + gsz_name);
    modal.find('#month').val(credit_info_month);
    modal.find('#sum').val(credit_info_sum);
    modal.find('#stavka').val(credit_info_stavka);
    modal.find("#editCreditInfo").attr('action', credit_info_action);
  }
});
var calc_app = new Vue({
  el: '#limit_app',
  data: {},
  methods: {
    summing: function summing(_ref) {
      var target = _ref.target;
      var parent_code = target.getAttribute('data-parent-code');
      var childElements = $('.' + parent_code);
      var sum = 0;

      var _iterator = _createForOfIteratorHelper(childElements),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          child = _step.value;
          sum += parseFloat(child.value.replace(/ /g, ""));
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      $('#' + parent_code).val(sum.toFixed(2));
      $('#' + parent_code + 'div').text(sum.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
      var section_code = target.getAttribute('data-section-code');
      childElements = $('.' + section_code);
      sum = 0.00;
      flt = 0.00;

      var _iterator2 = _createForOfIteratorHelper(childElements),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          child = _step2.value;
          str = child.value.replace(/ /g, "");
          flt = parseFloat(str);
          sum += flt;
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      $('#' + section_code).text(parseFloat(sum.toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
      var part = target.getAttribute('data-part');
      childElements = $('.' + part);
      sum = 0.00;

      var _iterator3 = _createForOfIteratorHelper(childElements),
          _step3;

      try {
        for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
          child = _step3.value;
          sum += parseFloat(child.innerText.replace(/ /g, ""));
        }
      } catch (err) {
        _iterator3.e(err);
      } finally {
        _iterator3.f();
      }

      $('#' + part).text(parseFloat(sum.toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
      var parts = part.slice(0, -1);
      var alert = $('#' + parts);
      var balance_id = target.getAttribute('data-balance-id');
      var button = $('#but' + balance_id);
      var passiv = parseFloat($('#' + parts + '0').text().replace(/ /g, ""));
      var activ = parseFloat($('#' + parts + '1').text().replace(/ /g, ""));

      if (passiv == activ) {
        alert.removeClass('alert-danger');
        alert.text('Все хорошо, пассив равен активу.');
        alert.addClass('alert-success');
        button.prop('disabled', false);
      } else {
        alert.removeClass('alert-success');

        if (passiv > activ) {
          alert.text('Пассив больше актива на ' + parseFloat((passiv - activ).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '! Сохранение не возможно!');
        } else {
          alert.text('Актив больше пассива на ' + parseFloat((activ - passiv).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '! Сохранение не возможно!');
        }

        alert.addClass('alert-danger');
        button.prop('disabled', true);
      }
    }
  }
});

/***/ }),

/***/ 2:
/*!*****************************************!*\
  !*** multi ./resources/js/limit_app.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/site/resources/js/limit_app.js */"./resources/js/limit_app.js");


/***/ })

/******/ });